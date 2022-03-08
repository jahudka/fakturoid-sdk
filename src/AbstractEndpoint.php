<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;

use GuzzleHttp\Psr7\Response;


/**
 * @template T of AbstractEntity
 */
abstract class AbstractEndpoint implements \IteratorAggregate {
    protected Client $api;
    protected string $url;
    /** @var class-string<T> */
    protected string $entityClass;
    protected array $options = [];
    protected bool $original = true;
    protected bool $readonly = false;


    /**
     * @param class-string<T> $entityClass
     */
    public function __construct(Client $api, string $url, string $entityClass) {
        $this->api = $api;
        $this->url = $url;
        $this->entityClass = $entityClass;
    }

    protected abstract function getKnownOptions(): array;

    /**
     * @return $this
     */
    public function setOption(string $option, $value) {
        if ($this->original) {
            $endpoint = clone $this;
            return $endpoint->setOption($option, $value);
        }

        if (!in_array($option, $this->getKnownOptions(), true)) {
            throw new \InvalidArgumentException("Unknown option: '$option'");
        }

        $this->options[$option] = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options) {
        if ($this->original) {
            $endpoint = clone $this;
            return $endpoint->setOptions($options);
        }

        if ($unknown = array_diff(array_keys($options), $this->getKnownOptions())) {
            throw new \InvalidArgumentException("Unknown options: '" . implode(', ', $unknown) . "'");
        }

        $this->options = $options + $this->options;
        return $this;
    }


    /**
     * @return EndpointIterator<T>
     */
    public function getIterator(?int $offset = null, ?int $limit = null): EndpointIterator {
        return new EndpointIterator(
            $this->api,
            $this->url . '.json',
            $this->options,
            $this->entityClass,
            $offset,
            $limit
        );
    }

    /**
     * @return T
     */
    public function get(int $id): AbstractEntity {
        $response = $this->api->sendRequest($this->url . '/' . $id . '.json');
        $payload = json_decode($response->getBody()->getContents(), true);
        return new $this->entityClass($payload);
    }

    /**
     * @return T
     */
    public function create(array $data): AbstractEntity {
        unset($data['id']);
        return $this->save(new $this->entityClass($data));
    }

    /**
     * @param T $entity
     * @return T
     */
    public function save(AbstractEntity $entity): AbstractEntity {
        if ($this->readonly) {
            throw new ReadonlyEndpointException();
        } else if (get_class($entity) !== $this->entityClass) {
            throw new \InvalidArgumentException("Invalid entity for endpoint");
        }

        $url = $this->url;
        $method = 'PATCH';
        $expectedStatus = 200;

        if ($entity->hasId()) {
            $url .= '/' . $entity->getId();
            $data = $entity->getModifiedData();
        } else {
            $method = 'POST';
            $expectedStatus = 201;
            $data = $entity->toArray();
        }

        unset($data['id']);
        $readonly = array_fill_keys($entity->getReadonlyProperties(), 1);
        $data = array_diff_key($data, Utils::toPascalKeys($readonly));

        $response = $this->api->sendRequest($url . '.json', $method, $data);
        $this->assertStatus($response, $expectedStatus);

        $payload = json_decode($response->getBody()->getContents(), true);
        $entity->setData($payload);

        return $entity;
    }

    /**
     * @param T|int $entity
     * @return $this
     */
    public function delete($entity) {
        if ($this->readonly) {
            throw new ReadonlyEndpointException();
        } else if ($entity instanceof AbstractEntity) {
            if (get_class($entity) !== $this->entityClass) {
                throw new \InvalidArgumentException("Invalid entity for endpoint");
            }

            $id = $entity->getId();

        } else {
            $id = $entity;
        }

        $response = $this->api->sendRequest($this->url . '/' . $id . '.json', 'DELETE');
        $this->assertStatus($response, 204);

        return $this;
    }

    protected function assertStatus(Response $response, int $expectedStatus): void {
        if ($response->getStatusCode() !== $expectedStatus) {
            throw new \RuntimeException('Invalid response code: ' . $response->getStatusCode() . ", expected $expectedStatus");
        }
    }

    public function __clone() {
        $this->original = false;
    }

}

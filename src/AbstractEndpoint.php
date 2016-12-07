<?php


namespace Jahudka\FakturoidSDK;

use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\json_decode;


abstract class AbstractEndpoint implements \IteratorAggregate {

    /** @var Client */
    protected $api;

    /** @var string */
    protected $url;

    /** @var string */
    protected $entityClass;

    /** @var array */
    protected $options = [];

    /** @var bool */
    protected $original = true;

    /** @var bool */
    protected $readonly = false;


    /**
     * @param Client $api
     * @param string $url
     * @param string $entityClass
     */
    public function __construct(Client $api, $url, $entityClass) {
        $this->api = $api;
        $this->url = $url;
        $this->entityClass = $entityClass;
    }

    /**
     * @return Client
     */
    public function getClient() {
        return $this->api;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEntityClass() {
        return $this->entityClass;
    }

    /**
     * @return array
     */
    protected abstract function getKnownOptions();

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setOption($option, $value) {
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
     * @param array $options
     * @return $this
     * @throws \InvalidArgumentException
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
     * @param int $offset
     * @param int $limit
     * @return \Iterator|AbstractEntity[]
     */
    public function getIterator($offset = null, $limit = null) {
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
     * @param int $id
     * @return AbstractEntity
     */
    public function get($id) {
        $response = $this->api->sendRequest($this->url . '/' . $id . '.json');
        $payload = json_decode($response->getBody()->getContents(), true);
        return new $this->entityClass($payload);
    }

    /**
     * @param array $data
     * @return AbstractEntity
     */
    public function create(array $data) {
        unset($data['id']);
        return $this->save(new $this->entityClass($data));
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ReadonlyEndpointException
     * @throws \InvalidArgumentException
     */
    public function save(AbstractEntity $entity) {
        if ($this->readonly) {
            throw new ReadonlyEndpointException();
        } else if (get_class($entity) !== $this->entityClass) {
            throw new \InvalidArgumentException("Invalid entity for endpoint");
        }

        $data = $entity->toArray();
        $url = $this->url;
        $method = 'PATCH';
        $expectedStatus = 200;

        if (!empty($data['id'])) {
            $url .= '/' . $data['id'];
        } else {
            $method = 'POST';
            $expectedStatus = 201;
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
     * @param AbstractEntity|int $entity
     * @return $this
     * @throws ReadonlyEndpointException
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

    /**
     * @param Response $response
     * @param int $expectedStatus
     */
    protected function assertStatus(Response $response, $expectedStatus) {
        if ($response->getStatusCode() !== $expectedStatus) {
            throw new \RuntimeException('Invalid response code: ' . $response->getStatusCode() . ", expected $expectedStatus");
        }
    }

    public function __clone() {
        $this->original = false;
    }

}

<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Todo;
use Jahudka\FakturoidSDK\Utils;


/**
 * @extends AbstractEndpoint<Todo>
 */
class Todos extends AbstractEndpoint {
    protected bool $readonly = true;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/todos', Todo::class);
    }

    public function getKnownOptions(): array {
        return [
            'since',
        ];
    }

    /**
     * @param \DateTimeInterface|string|int $date
     * @return $this
     */
    public function since($date) {
        return $this->setOption('since', Utils::formatDate($date));
    }

    /**
     * @param Todo|int $todo
     */
    public function markAsCompleted($todo): Todo {
        if ($todo instanceof Todo) {
            $id = $todo->getId();
        } else {
            $id = $todo;
            $todo = new Todo();
        }

        $response = $this->api->sendRequest($this->url . '/' . $id . '/toggle_completion.json', 'POST');
        $this->assertStatus($response, 200);
        $payload = json_decode($response->getBody()->getContents(), true);
        $todo->setData($payload);

        return $todo;
    }
}

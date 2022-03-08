<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\User;


/**
 * @extends AbstractEndpoint<User>
 */
class Users extends AbstractEndpoint {
    protected bool $readonly = true;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/users', User::class);
    }

    protected function getKnownOptions(): array {
        return [];
    }

    public function getCurrent(): User {
        $response = $this->api->sendRequest('user.json');
        $payload = json_decode($response->getBody()->getContents(), true);
        return new $this->entityClass($payload);
    }
}

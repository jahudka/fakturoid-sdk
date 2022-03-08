<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\AccountInfo;


class Account {
    private Client $api;

    public function __construct(Client $api) {
        $this->api = $api;
    }

    public function getInfo(): AccountInfo {
        $response = $this->api->sendRequest('accounts/' . $this->api->getSlug() . '/account.json');
        return new AccountInfo(json_decode($response->getBody()->getContents(), true));
    }
}

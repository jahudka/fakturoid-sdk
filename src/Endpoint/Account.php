<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\AccountInfo;
use function GuzzleHttp\json_decode;


class Account {

    /** @var Client */
    private $api;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        $this->api = $api;
    }

    /**
     * @return AccountInfo
     */
    public function getInfo() {
        $response = $this->api->sendRequest('accounts/' . $this->api->getSlug() . '/account.json');
        return new AccountInfo(json_decode($response->getBody()->getContents(), true));
    }
}

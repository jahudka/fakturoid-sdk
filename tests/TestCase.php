<?php


namespace Jahudka\FakturoidSDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework;

abstract class TestCase extends Framework\TestCase {

    /**
     * @param array $responses
     * @return Client
     */
    protected function createHttpClientMock(array $responses) {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }

}

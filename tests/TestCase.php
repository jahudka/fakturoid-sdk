<?php


namespace Jahudka\FakturoidSDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;


abstract class TestCase extends \PHPUnit_Framework_TestCase {

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

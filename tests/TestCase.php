<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework;

abstract class TestCase extends Framework\TestCase {
    protected function createHttpClientMock(array $responses): Client {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }
}

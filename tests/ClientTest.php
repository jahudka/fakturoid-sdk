<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Tests;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Endpoint;


class ClientTest extends TestCase {
    public function testEndpointGetters(): Client {
        $httpClient = $this->createHttpClientMock([]);

        $client = new Client($httpClient, 'tester@sdk.fakturoid.cz', '1234567890', 'test-app');

        $this->assertInstanceOf(Endpoint\Account::class, $client->account);
        $this->assertInstanceOf(Endpoint\BankAccounts::class, $client->bankAccounts);
        $this->assertInstanceOf(Endpoint\Events::class, $client->events);
        $this->assertInstanceOf(Endpoint\Expenses::class, $client->expenses);
        $this->assertInstanceOf(Endpoint\Generators::class, $client->generators);
        $this->assertInstanceOf(Endpoint\Invoices::class, $client->invoices);
        $this->assertInstanceOf(Endpoint\Reports::class, $client->reports);
        $this->assertInstanceOf(Endpoint\Subjects::class, $client->subjects);
        $this->assertInstanceOf(Endpoint\Todos::class, $client->todos);
        $this->assertInstanceOf(Endpoint\Users::class, $client->users);

        return $client;
    }

    /**
     * @depends testEndpointGetters
     */
    public function testNonexistentEndpointGetter(Client $client): void {
        $this->expectException(\Jahudka\FakturoidSDK\MemberAccessException::class);
        $client->nonexistentEndpoint;
    }

    /**
     * @depends testEndpointGetters
     */
    public function testAbstractEndpointGetter(Client $client): void {
        $this->expectException(\Jahudka\FakturoidSDK\MemberAccessException::class);
        $client->abstractBillable;
    }
}

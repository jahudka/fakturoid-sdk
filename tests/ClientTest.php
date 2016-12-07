<?php


namespace Jahudka\FakturoidSDK\Tests;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Endpoint;


class ClientTest extends TestCase {

    /**
     * @return Client
     */
    public function testEndpointGetters() {
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
     * @expectedException \Jahudka\FakturoidSDK\MemberAccessException
     *
     * @param Client $client
     */
    public function testNonexistentEndpointGetter(Client $client) {
        $client->nonexistentEndpoint;
    }

    /**
     * @depends testEndpointGetters
     * @expectedException \Jahudka\FakturoidSDK\MemberAccessException
     *
     * @param Client $client
     */
    public function testAbstractEndpointGetter(Client $client) {
        $client->abstractBillable;
    }

}

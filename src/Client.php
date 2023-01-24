<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;


/**
 * @property-read Endpoint\Account $account
 * @property-read Endpoint\BankAccounts $bankAccounts
 * @property-read Endpoint\Events $events
 * @property-read Endpoint\Expenses $expenses
 * @property-read Endpoint\Generators $generators
 * @property-read Endpoint\Invoices $invoices
 * @property-read Endpoint\Reports $reports
 * @property-read Endpoint\Subjects $subjects
 * @property-read Endpoint\Todos $todos
 * @property-read Endpoint\Users $users
 */
class Client {

    const API_URL = 'https://app.fakturoid.cz/api/v2',
        ITEMS_PER_PAGE = 40;


    /** @var HttpClient */
    private $httpClient;

    /** @var string */
    private $email;

    /** @var string */
    private $apiToken;

    /** @var string */
    private $slug;

    /** @var string */
    private $userAgent;

    /** @var AbstractEndpoint[] */
    private $endpoints = [];


    /**
     * @param string $email
     * @param string $apiToken
     * @param string $slug
     * @param string $userAgent
     * @return static
     */
    public static function create($email, $apiToken, $slug, $userAgent = null) {
        return new static(new HttpClient(), $email, $apiToken, $slug, $userAgent);
    }

    /**
     * @param HttpClient $client
     * @param string $email
     * @param string $apiToken
     * @param string $slug
     * @param string $userAgent
     */
    public function __construct(HttpClient $client, $email, $apiToken, $slug, $userAgent = null) {
        $this->httpClient = $client;
        $this->email = $email;
        $this->apiToken = $apiToken;
        $this->slug = $slug;
        $this->userAgent = $userAgent ?: 'jahudka/fakturoid-sdk (me@subsonic.cz)';
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient() {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return Response
     */
    public function sendRequest($url, $method = 'GET', array $data = null) {
        $url = self::API_URL . '/' . ltrim($url, '/');
        $options = [
            'auth' => [
                $this->email,
                $this->apiToken,
            ],
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
            'http_errors' => true,
        ];

        if ($data) {
            $options['json'] = $data;
        }

        return $this->httpClient->request($method, $url, $options);
    }


    /**
     * @param string $name
     * @return AbstractEndpoint|object
     * @throws MemberAccessException
     */
    public function __get($name) {
        if (isset($this->endpoints[$name])) {
            return $this->endpoints[$name];
        }

        $class = 'Jahudka\FakturoidSDK\Endpoint\\' . ucfirst($name);

        if (class_exists($class)) {
            $reflection = new \ReflectionClass($class);

            if ($reflection->isInstantiable()) {
                return $this->endpoints[$name] = $reflection->newInstance($this);
            }
        }

        $class = get_class($this);
        throw new MemberAccessException("Trying to get non-existent property '$name' of class $class");
    }
}

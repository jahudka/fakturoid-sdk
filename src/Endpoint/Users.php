<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\User;
use function GuzzleHttp\json_decode;


/**
 * @method User get(int $id)
 * @method User[] getIterator(int $offset = null, int $limit = null)
 */
class Users extends AbstractEndpoint {

    /** @var bool */
    protected $readonly = true;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/users', User::class);
    }


    /**
     * @return array
     */
    protected function getKnownOptions() {
        return [];
    }

    /**
     * @return User
     */
    public function getCurrent() {
        $response = $this->api->sendRequest('user.json');
        $payload = json_decode($response->getBody()->getContents(), true);
        return new $this->entityClass($payload);
    }

}

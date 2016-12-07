<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\BankAccount;


/**
 * @method BankAccount get(int $id)
 * @method BankAccount[] getIterator(int $offset = null, int $limit = null)
 */
class BankAccounts extends AbstractEndpoint {

    /** @var bool */
    protected $readonly = true;

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/bank_accounts', BankAccount::class);
    }

    /**
     * @return array
     */
    protected function getKnownOptions() {
        return [];
    }

}

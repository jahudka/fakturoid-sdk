<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\AbstractEndpoint;
use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\BankAccount;


/**
 * @extends AbstractEndpoint<BankAccount>
 */
class BankAccounts extends AbstractEndpoint {
    protected bool $readonly = true;

    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/bank_accounts', BankAccount::class);
    }

    protected function getKnownOptions(): array {
        return [];
    }
}

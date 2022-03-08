<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Expense;


/**
 * @extends AbstractBillable<Expense>
 * @method $this pay(Expense|int $expense, \DateTimeImmutable|string|int $paidAt = null)
 * @method $this removePayment(Expense|int $expense)
 */
class Expenses extends AbstractBillable {
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/expenses', Expense::class);
    }

    protected function getKnownOptions(): array {
        return [
            'since',
            'updated_since',
            'number',
            'variable_symbol',
            'status',
            'subject_id',
            'query',
        ];
    }

    /**
     * @return $this
     */
    public function byVariableSymbol(string $variableSymbol) {
        return $this->setOption('variable_symbol', $variableSymbol);
    }
}

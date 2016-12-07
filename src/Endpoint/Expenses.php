<?php


namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Client;
use Jahudka\FakturoidSDK\Entity\Expense;


/**
 * @method Expense get(int $id)
 * @method Expense[] getIterator(int $offset = null, int $limit = null)
 * @method Expense create(array $data)
 * @method Expense save(Expense $expense)
 * @method $this delete(Expense|int $expense)
 *
 * @method $this pay(Expense|int $expense, \DateTime|string|int $paidAt = null)
 * @method $this removePayment(Expense|int $expense)
 */
class Expenses extends AbstractBillable {

    /**
     * @param Client $api
     */
    public function __construct(Client $api) {
        parent::__construct($api, 'accounts/' . $api->getSlug() . '/expenses', Expense::class);
    }

    /**
     * @return array
     */
    protected function getKnownOptions() {
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
     * @param string $variableSymbol
     * @return $this
     */
    public function byVariableSymbol($variableSymbol) {
        return $this->setOption('variable_symbol', $variableSymbol);
    }
}

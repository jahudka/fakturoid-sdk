<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;

/**
 * @property-read string $name
 * @property-read string $number
 * @property-read string $currency
 * @property-read string $iban
 * @property-read string $swiftBic
 * @property-read bool $pairing
 * @property-read bool $paymentAdjustment
 *
 * @method string getName()
 * @method string getNumber()
 * @method string getCurrency()
 * @method string getIban()
 * @method string getSwiftBic()
 * @method bool isPairing()
 * @method bool isPaymentAdjustment()
 */
class BankAccount extends AbstractEntity {

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'name',
            'number',
            'currency',
            'iban',
            'swiftBic',
            'pairing',
            'paymentAdjustment',
        ];
    }

}

<?php

declare(strict_types=1);

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
 *
 * @method bool hasName()
 * @method bool hasNumber()
 * @method bool hasCurrency()
 * @method bool hasIban()
 * @method bool hasSwiftBic()
 * @method bool hasPairing()
 * @method bool hasPaymentAdjustment()
 */
class BankAccount extends AbstractEntity {
    protected bool $readonly = true;

    public function getKnownProperties(): array {
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

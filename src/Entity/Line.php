<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property string $name
 * @property string $quantity
 * @property string $unitName
 * @property string $unitPrice
 * @property int $vatRate
 * @property-read string $unitPriceWithoutVat
 * @property-read string $unitPriceWithVat
 *
 * @method string getName()
 * @method string getQuantity()
 * @method string getUnitName()
 * @method string getUnitPrice()
 * @method int getVatRate()
 * @method string getUnitPriceWithoutVat()
 * @method string getUnitPriceWithVat()
 *
 * @method bool hasName()
 * @method bool hasQuantity()
 * @method bool hasUnitName()
 * @method bool hasUnitPrice()
 * @method bool hasVatRate()
 * @method bool hasUnitPriceWithoutVat()
 * @method bool hasUnitPriceWithVat()
 *
 * @method $this setName(string $name)
 * @method $this setQuantity(string $quantity)
 * @method $this setUnitName(string $unitName)
 * @method $this setUnitPrice(string $unitPrice)
 * @method $this setVatRate(int $vatRate)
 */
class Line extends AbstractEntity {
    private bool $removed = false;

    public function getKnownProperties(): array {
        return [
            'id',
            'name',
            'quantity',
            'unitName',
            'unitPrice',
            'vatRate',
            'unitPriceWithoutVat',
            'unitPriceWithVat',
        ];
    }

    public function getReadonlyProperties(): array {
        return [
            'unitPriceWithoutVat',
            'unitPriceWithVat',
        ];
    }

    /**
     * @return $this
     */
    public function setRemoved() {
        $this->removed = true;
        $this->readonly = true;
        return $this;
    }

    public function toArray(): array {
        $data = parent::toArray();

        if ($this->hasId() && $this->removed) {
            $data['_destroy'] = true;
        }

        return $data;
    }

    public function getModifiedData(): array {
        $data = parent::getModifiedData();

        if ($this->removed) {
            $data['_destroy'] = true;
        }

        if (!empty($data)) {
            $data['id'] = $this->getId();
        }

        return $data;
    }
}

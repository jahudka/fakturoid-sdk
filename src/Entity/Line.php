<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property string $name
 * @property float $quantity
 * @property string $unitName
 * @property float $unitPrice
 * @property int $vatRate
 * @property-read float $unitPriceWithoutVat
 * @property-read float $unitPriceWithVat
 *
 * @method string getName()
 * @method float getQuantity()
 * @method string getUnitName()
 * @method float getUnitPrice()
 * @method int getVatRate()
 * @method float getUnitPriceWithoutVat()
 * @method float getUnitPriceWithVat()
 *
 * @method $this setName(string $name)
 * @method $this setQuantity(float $quantity)
 * @method $this setUnitName(string $unitName)
 * @method $this setUnitPrice(float $unitPrice)
 * @method $this setVatRate(int $vatRate)
 */
class Line extends AbstractEntity {

    /** @var bool */
    private $removed = false;

    /**
     * @return array
     */
    public function getKnownProperties() {
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

    /**
     * @return array
     */
    public function getReadonlyProperties() {
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

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();

        if ($this->removed) {
            $data['_destroy'] = true;
        }

        return $data;
    }


}

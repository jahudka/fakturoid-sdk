<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property int $subjectId
 * @property array $tags
 * @property int $bankAccountId
 * @property string $bankAccount
 * @property string $iban
 * @property string $swiftBic
 * @property string $paymentMethod
 * @property string $currency
 * @property float $exchangeRate
 * @property bool $transferredTaxLiability
 * @property string $vatPriceMode
 * @property-read float $subtotal
 * @property-read float $nativeSubtotal
 * @property-read float $total
 * @property-read float $nativeTotal
 * @property-read string $url
 * @property-read string $htmlUrl
 * @property-read string $subjectUrl
 * @property-read \DateTime $updatedAt
 * @property \ArrayObject|Line[] $lines
 *
 * @method int getSubjectId()
 * @method array getTags()
 * @method int getBankAccountId()
 * @method string getBankAccount()
 * @method string getIban()
 * @method string getSwiftBic()
 * @method string getPaymentMethod()
 * @method string getCurrency()
 * @method string getExchangeRate()
 * @method bool isTransferredTaxLiability()
 * @method string getVatPriceMode()
 * @method float getSubtotal()
 * @method float getNativeSubtotal()
 * @method float getTotal()
 * @method float getNativeTotal()
 * @method string getUrl()
 * @method string getHtmlUrl()
 * @method string getSubjectUrl()
 *
 * @method $this setSubjectId(int $subjectId)
 * @method $this setTags(array $tags)
 * @method $this setBankAccountId(int $bankAccountId)
 * @method $this setBankAccount(string $bankAccount)
 * @method $this setIban(string $iban)
 * @method $this setSwiftBic(string $swiftBic)
 * @method $this setPaymentMethod(string $paymentMethod)
 * @method $this setCurrency(string $currency)
 * @method $this setExchangeRate(string $exchangeRate)
 * @method $this setTransferredTaxLiability(bool $transferredTaxLiability)
 * @method $this setVatPriceMode(string $vatPriceMode)
 */
abstract class AbstractBillable extends AbstractEntity {

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'subjectId',
            'tags',
            'bankAccountId',
            'bankAccount',
            'iban',
            'swiftBic',
            'paymentMethod',
            'currency',
            'exchangeRate',
            'transferredTaxLiability',
            'vatPriceMode',
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'url',
            'htmlUrl',
            'subjectUrl',
            'updatedAt',
            'lines',
        ];
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return [
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'url',
            'htmlUrl',
            'subjectUrl',
            'updatedAt',
        ];
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function addTag($tag) {
        if (!isset($this->data['tags']) || !in_array($tag, $this->data['tags'], true)) {
            $this->data['tags'][] = $tag;
        }

        return $this;
    }

    /**
     * @param string $tag
     * @return bool
     */
    public function hasTag($tag) {
        return isset($this->data['tags']) && in_array($tag, $this->data['tags'], true);
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function removeTag($tag) {
        if (isset($this->data['tags']) && ($i = array_search($tag, $this->data['tags'], true)) !== false) {
            array_splice($this->data['tags'], $i, 1);
        }

        return $this;
    }

    /**
     * @return \ArrayObject|Line[]
     */
    public function getLines() {
        if (!isset($this->data['lines'])) {
            $this->data['lines'] = new \ArrayObject();
        }

        return $this->data['lines'];
    }

    /**
     * @param \Traversable|array $lines
     * @return $this
     */
    public function setLines($lines) {
        if (!is_array($lines) && !($lines instanceof \Traversable)) {
            throw new \InvalidArgumentException("First argument to " . __METHOD__ . " must be either an array or a Traversable object");
        }

        $this->data['lines'] = new \ArrayObject();

        foreach ($lines as $k => $line) {
            if (!($line instanceof Line)) {
                throw new \InvalidArgumentException("Invalid item at key '$k', must be an instance of Line");
            }

            $this->data['lines']->append($line);
        }

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt() {
        return isset($this->data['updatedAt']) ? new \DateTime($this->data['updatedAt']) : null;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
        if (isset($data['lines'])) {
            $lines = array_map(function($data) {
                return new Line($data);
            }, $data['lines']);

            $data['lines'] = new \ArrayObject($lines);
        }

        return parent::setData($data);
    }

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();

        if (isset($data['lines'])) {
            $data['lines'] = array_map(function(Line $line) {
                return $line->toArray();
            }, $data['lines']->getArrayCopy());
        }

        return $data;
    }
}

<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;
use Jahudka\FakturoidSDK\Utils;


/**
 * @property string $number
 * @property string $originalNumber
 * @property string $variableSymbol
 * @property-read string $supplierName
 * @property-read string $supplierStreet
 * @property-read string $supplierStreet2
 * @property-read string $supplierCity
 * @property-read string $supplierZip
 * @property-read string $supplierCountry
 * @property-read string $supplierRegistrationNo
 * @property-read string $supplierVatNo
 * @property int $subjectId
 * @property-read string $status
 * @property string $documentType
 * @property \DateTime $issuedOn
 * @property \DateTime $taxableFulfillmentDue
 * @property \DateTime $dueOn
 * @property-read \DateTime $paidOn
 * @property string $description
 * @property string $privateNote
 * @property array $tags
 * @property int $bankAccountId
 * @property string $bankAccount
 * @property string $iban
 * @property string $swiftBic
 * @property string $paymentMethod
 * @property string $currency
 * @property string $exchangeRate
 * @property bool $transferredTaxLiability
 * @property string $vatPriceMode
 * @property int $supplyCode
 * @property bool $roundTotal
 * @property-read float $subtotal
 * @property-read float $nativeSubtotal
 * @property-read float $total
 * @property-read float $nativeTotal
 * @property Attachment $attachment
 * @property-read string $htmlUrl
 * @property-read string $url
 * @property-read string $subjectUrl
 * @property-read \DateTime $createdAt
 * @property-read \DateTime $updatedAt
 * @property \ArrayObject|Line[] $lines
 *
 * @method string getNumber()
 * @method string getOriginalNumber()
 * @method string getVariableSymbol()
 * @method string getSupplierName()
 * @method string getSupplierStreet()
 * @method string getSupplierStreet2()
 * @method string getSupplierCity()
 * @method string getSupplierZip()
 * @method string getSupplierCountry()
 * @method string getSupplierRegistrationNo()
 * @method string getSupplierVatNo()
 * @method int getSubjectId()
 * @method string getStatus()
 * @method string getDocumentType()
 * @method \DateTime getIssuedOn()
 * @method \DateTime getTaxableFulfillmentDue()
 * @method \DateTime getDueOn()
 * @method \DateTime getPaidOn()
 * @method string getDescription()
 * @method string getPrivateNote()
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
 * @method int getSupplyCode()
 * @method bool isRoundTotal()
 * @method float getSubtotal()
 * @method float getNativeSubtotal()
 * @method float getTotal()
 * @method float getNativeTotal()
 * @method Attachment getAttachment()
 * @method string getHtmlUrl()
 * @method string getUrl()
 * @method string getSubjectUrl()
 * @method \DateTime getCreatedAt()
 * @method \DateTime getUpdatedAt()
 *
 * @method $this setNumber(string $number)
 * @method $this setOriginalNumber(string $originalNumber)
 * @method $this setVariableSymbol(string $variableSymbol)
 * @method $this setSubjectId(int $subjectId)
 * @method $this setDocumentType(string $documentType)
 * @method $this setIssuedOn(\DateTime $issuedOn)
 * @method $this setTaxableFulfillmentDue(\DateTime $taxableFulfillmentDue)
 * @method $this setDueOn(\DateTime $dueOn)
 * @method $this setDescription(string $description)
 * @method $this setPrivateNote(string $privateNote)
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
 * @method $this setSupplyCode(int $supplyCode)
 * @method $this setRoundTotal(bool $roundTotal)
 */
class Expense extends AbstractEntity {
    use TaggableTrait,
        LinesTrait;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'number',
            'originalNumber',
            'variableSymbol',
            'supplierName',
            'supplierStreet',
            'supplierStreet2',
            'supplierCity',
            'supplierZip',
            'supplierCountry',
            'supplierRegistrationNo',
            'supplierVatNo',
            'subjectId',
            'status',
            'documentType',
            'issuedOn',
            'taxableFulfillmentDue',
            'dueOn',
            'paidOn',
            'description',
            'privateNote',
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
            'supplyCode',
            'roundTotal',
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'attachment',
            'htmlUrl',
            'url',
            'subjectUrl',
            'createdAt',
            'updatedAt',
            'lines',
        ];
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return [
            'supplierName',
            'supplierStreet',
            'supplierStreet2',
            'supplierCity',
            'supplierZip',
            'supplierCountry',
            'supplierRegistrationNo',
            'supplierVatNo',
            'status',
            'paidOn',
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'htmlUrl',
            'url',
            'subjectUrl',
            'createdAt',
            'updatedAt',
        ];
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
        $data = $this->importLines($data);

        if (isset($data['attachment'])) {
            $data['attachment'] = new Attachment($data['attachment']);
        }

        return parent::setData($data);
    }

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();
        $data = $this->exportLines($data);

        if (isset($data['attachment'])) {
            if ($data['attachment']->isNew()) {
                $data['attachment'] = $data['attachment']->toDataUrl();
            } else {
                unset($data['attachment']);
            }
        }

        return $data;
    }

    /**
     * @param Attachment|string $attachment
     * @return $this
     */
    public function setAttachment($attachment) {
        if (is_string($attachment)) {
            $attachment = new Attachment($attachment);
        } else if (!($attachment instanceof Attachment)) {
            throw new \InvalidArgumentException("Invalid argument supplied for " . __METHOD__ . ", must be a string or an instance of Attachment");
        }

        $this->data['attachment'] = $attachment;
        return $this;
    }

    /**
     * @param string $name
     * @return \DateTime|mixed|null
     */
    public function __get($name) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn', 'paidOn', 'createdAt', 'updatedAt'], true)) {
            return isset($this->data[$name]) ? new \DateTime($this->data[$name]) : null;
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn'], true)) {
            $this->data[$name] = Utils::formatDate($value);
            return;
        }

        parent::__set($name, $value);
    }


}

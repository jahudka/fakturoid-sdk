<?php


namespace Jahudka\FakturoidSDK\Entity;

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
 * @property-read string $status
 * @property string $documentType
 * @property \DateTime $issuedOn
 * @property \DateTime $taxableFulfillmentDue
 * @property \DateTime $dueOn
 * @property-read \DateTime $paidOn
 * @property string $description
 * @property string $privateNote
 * @property int $supplyCode
 * @property bool $roundTotal
 * @property Attachment $attachment
 * @property-read \DateTime $createdAt
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
 * @method string getStatus()
 * @method string getDocumentType()
 * @method \DateTime getIssuedOn()
 * @method \DateTime getTaxableFulfillmentDue()
 * @method \DateTime getDueOn()
 * @method \DateTime getPaidOn()
 * @method string getDescription()
 * @method string getPrivateNote()
 * @method int getSupplyCode()
 * @method bool isRoundTotal()
 * @method Attachment getAttachment()
 * @method \DateTime getCreatedAt()
 *
 * @method bool hasNumber()
 * @method bool hasOriginalNumber()
 * @method bool hasVariableSymbol()
 * @method bool hasSupplierName()
 * @method bool hasSupplierStreet()
 * @method bool hasSupplierStreet2()
 * @method bool hasSupplierCity()
 * @method bool hasSupplierZip()
 * @method bool hasSupplierCountry()
 * @method bool hasSupplierRegistrationNo()
 * @method bool hasSupplierVatNo()
 * @method bool hasStatus()
 * @method bool hasDocumentType()
 * @method bool hasIssuedOn()
 * @method bool hasTaxableFulfillmentDue()
 * @method bool hasDueOn()
 * @method bool hasPaidOn()
 * @method bool hasDescription()
 * @method bool hasPrivateNote()
 * @method bool hasSupplyCode()
 * @method bool hasRoundTotal()
 * @method bool hasAttachment()
 * @method bool hasCreatedAt()
 *
 * @method $this setNumber(string $number)
 * @method $this setOriginalNumber(string $originalNumber)
 * @method $this setVariableSymbol(string $variableSymbol)
 * @method $this setDocumentType(string $documentType)
 * @method $this setIssuedOn(\DateTime $issuedOn)
 * @method $this setTaxableFulfillmentDue(\DateTime $taxableFulfillmentDue)
 * @method $this setDueOn(\DateTime $dueOn)
 * @method $this setDescription(string $description)
 * @method $this setPrivateNote(string $privateNote)
 * @method $this setSupplyCode(int $supplyCode)
 * @method $this setRoundTotal(bool $roundTotal)
 */
class Expense extends AbstractBillable {

    /**
     * @return array
     */
    public function getKnownProperties() {
        return array_merge(parent::getKnownProperties(), [
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
            'status',
            'documentType',
            'issuedOn',
            'taxableFulfillmentDue',
            'dueOn',
            'paidOn',
            'description',
            'privateNote',
            'supplyCode',
            'roundTotal',
            'attachment',
            'createdAt',
        ]);
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return array_merge(parent::getReadonlyProperties(), [
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
            'createdAt',
        ]);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
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
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn', 'paidOn', 'createdAt'], true)) {
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

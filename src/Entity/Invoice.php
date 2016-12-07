<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\Utils;


/**
 * @property string $customId
 * @property bool $proforma
 * @property bool $partialProforma
 * @property string $number
 * @property string $variableSymbol
 * @property-read string $yourName
 * @property-read string $yourStreet
 * @property-read string $yourStreet2
 * @property-read string $yourCity
 * @property-read string $yourZip
 * @property-read string $yourCountry
 * @property-read string $yourRegistrationNo
 * @property-read string $yourVatNo
 * @property-read string $clientName
 * @property-read string $clientStreet
 * @property-read string $clientStreet2
 * @property-read string $clientCity
 * @property-read string $clientZip
 * @property-read string $clientCountry
 * @property-read string $clientRegistrationNo
 * @property-read string $clientVatNo
 * @property int $generatorId
 * @property int $relatedId
 * @property bool $correction
 * @property int $correctionId
 * @property-read string $token
 * @property-read string $status
 * @property string $orderNumber
 * @property \DateTime $issuedOn
 * @property \DateTime $taxableFulfillmentDue
 * @property int $due
 * @property-read \DateTime $dueOn
 * @property-read \DateTime $sentAt
 * @property-read \DateTime $paidAt
 * @property-read \DateTime $reminderSentAt
 * @property-read \DateTime $acceptedAt
 * @property \DateTime $canceledAt
 * @property string $note
 * @property string $footerNote
 * @property string $privateNote
 * @property bool $paypal
 * @property bool $gopay
 * @property string $language
 * @property int $supplyCode
 * @property bool $euElectronicService
 * @property bool $roundTotal
 * @property-read float $remainingAmount
 * @property-read float $remainingNativeAmount
 * @property-read string $publicHtmlUrl
 * @property-read string $pdfUrl
 *
 * @method string getCustomId()
 * @method bool isProforma()
 * @method bool isPartialProforma()
 * @method string getNumber()
 * @method string getVariableSymbol()
 * @method string getYourName()
 * @method string getYourStreet()
 * @method string getYourStreet2()
 * @method string getYourCity()
 * @method string getYourZip()
 * @method string getYourCountry()
 * @method string getYourRegistrationNo()
 * @method string getYourVatNo()
 * @method string getClientName()
 * @method string getClientStreet()
 * @method string getClientStreet2()
 * @method string getClientCity()
 * @method string getClientZip()
 * @method string getClientCountry()
 * @method string getClientRegistrationNo()
 * @method string getClientVatNo()
 * @method int getGeneratorId()
 * @method int getRelatedId()
 * @method bool isCorrection()
 * @method int getCorrectionId()
 * @method string getToken()
 * @method string getStatus()
 * @method string getOrderNumber()
 * @method \DateTime getIssuedOn()
 * @method \DateTime getTaxableFulfillmentDue()
 * @method int getDue()
 * @method \DateTime getDueOn()
 * @method \DateTime getSentAt()
 * @method \DateTime getPaidAt()
 * @method \DateTime getReminderSentAt()
 * @method \DateTime getAcceptedAt()
 * @method \DateTime getCanceledAt()
 * @method string getNote()
 * @method string getFooterNote()
 * @method string getPrivateNote()
 * @method bool isPaypal()
 * @method bool isGopay()
 * @method string getLanguage()
 * @method int getSupplyCode()
 * @method bool isEuElectronicService()
 * @method bool isRoundTotal()
 * @method float getRemainingAmount()
 * @method float getRemainingNativeAmount()
 * @method string getPublicHtmlUrl()
 * @method string getPdfUrl()
 *
 * @method $this setCustomId(string $customId)
 * @method $this setProforma(bool $proforma)
 * @method $this setPartialProforma(bool $partialProforma)
 * @method $this setNumber(string $number)
 * @method $this setVariableSymbol(string $variableSymbol)
 * @method $this setGeneratorId(int $generatorId)
 * @method $this setRelatedId(int $relatedId)
 * @method $this setCorrection(bool $correction)
 * @method $this setCorrectionId(int $correctionId)
 * @method $this setOrderNumber(string $orderNumber)
 * @method $this setIssuedOn(\DateTime|string|int $issuedOn)
 * @method $this setTaxableFulfillmentDue(\DateTime|string|int $taxableFulfillmentDue)
 * @method $this setDue(int $due)
 * @method $this setNote(string $note)
 * @method $this setFooterNote(string $footerNote)
 * @method $this setPrivateNote(string $privateNote)
 * @method $this setPaypal(bool $paypal)
 * @method $this setGopay(bool $gopay)
 * @method $this setLanguage(string $language)
 * @method $this setSupplyCode(int $supplyCode)
 * @method $this setEuElectronicService(bool $euElectronicService)
 * @method $this setRoundTotal(bool $roundTotal)
 */
class Invoice extends AbstractBillable {

    /**
     * @return array
     */
    public function getKnownProperties() {
        return array_merge(parent::getKnownProperties(), [
            'customId',
            'proforma',
            'partialProforma',
            'number',
            'variableSymbol',
            'yourName',
            'yourStreet',
            'yourStreet2',
            'yourCity',
            'yourZip',
            'yourCountry',
            'yourRegistrationNo',
            'yourVatNo',
            'clientName',
            'clientStreet',
            'clientStreet2',
            'clientCity',
            'clientZip',
            'clientCountry',
            'clientRegistrationNo',
            'clientVatNo',
            'generatorId',
            'relatedId',
            'correction',
            'correctionId',
            'token',
            'status',
            'orderNumber',
            'issuedOn',
            'taxableFulfillmentDue',
            'due',
            'dueOn',
            'sentAt',
            'paidAt',
            'reminderSentAt',
            'acceptedAt',
            'canceledAt',
            'note',
            'footerNote',
            'privateNote',
            'paypal',
            'gopay',
            'language',
            'supplyCode',
            'euElectronicService',
            'roundTotal',
            'remainingAmount',
            'remainingNativeAmount',
            'publicHtmlUrl',
            'pdfUrl',
        ]);
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return array_merge(parent::getReadonlyProperties(), [
            'yourName',
            'yourStreet',
            'yourStreet2',
            'yourCity',
            'yourZip',
            'yourCountry',
            'yourRegistrationNo',
            'yourVatNo',
            'clientName',
            'clientStreet',
            'clientStreet2',
            'clientCity',
            'clientZip',
            'clientCountry',
            'clientRegistrationNo',
            'clientVatNo',
            'token',
            'status',
            'dueOn',
            'sentAt',
            'paidAt',
            'reminderSentAt',
            'acceptedAt',
            'canceledAt',
            'remainingAmount',
            'remainingNativeAmount',
            'publicHtmlUrl',
            'pdfUrl',
        ]);
    }

    /**
     * @param string $name
     * @return \DateTime|mixed|null
     */
    public function __get($name) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn', 'sentAt', 'paidAt', 'reminderSentAt', 'acceptedAt', 'canceledAt'], true)) {
            return isset($this->data[$name]) ? new \DateTime($this->data[$name]) : null;
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue'], true)) {
            $this->data[$name] = Utils::formatDate($value);
            return;
        }

        parent::__set($name, $value);
    }


}

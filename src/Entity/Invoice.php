<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;
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
 * @property int $subjectId
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
 * @property array $tags
 * @property int $bankAccountId
 * @property string $bankAccount
 * @property string $iban
 * @property string $swiftBic
 * @property string $paymentMethod
 * @property string $currency
 * @property string $exchangeRate
 * @property bool $paypal
 * @property bool $gopay
 * @property string $language
 * @property bool $transferredTaxLiability
 * @property int $supplyCode
 * @property bool $euElectronicService
 * @property string $vatPriceMode
 * @property bool $roundTotal
 * @property-read float $subtotal
 * @property-read float $nativeSubtotal
 * @property-read float $total
 * @property-read float $nativeTotal
 * @property-read float $remainingAmount
 * @property-read float $remainingNativeAmount
 * @property-read string $htmlUrl
 * @property-read string $publicHtmlUrl
 * @property-read string $url
 * @property-read string $pdfUrl
 * @property-read string $subjectUrl
 * @property-read \DateTime $updatedAt
 * @property \ArrayObject|Line[] $lines
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
 * @method int getSubjectId()
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
 * @method string getNote()
 * @method string getFooterNote()
 * @method string getPrivateNote()
 * @method array getTags()
 * @method int getBankAccountId()
 * @method string getBankAccount()
 * @method string getIban()
 * @method string getSwiftBic()
 * @method string getPaymentMethod()
 * @method string getCurrency()
 * @method string getExchangeRate()
 * @method bool isPaypal()
 * @method bool isGopay()
 * @method string getLanguage()
 * @method bool isTransferredTaxLiability()
 * @method int getSupplyCode()
 * @method bool isEuElectronicService()
 * @method string getVatPriceMode()
 * @method bool isRoundTotal()
 * @method float getSubtotal()
 * @method float getNativeSubtotal()
 * @method float getTotal()
 * @method float getNativeTotal()
 * @method float getRemainingAmount()
 * @method float getRemainingNativeAmount()
 * @method string getHtmlUrl()
 * @method string getPublicHtmlUrl()
 * @method string getUrl()
 * @method string getPdfUrl()
 * @method string getSubjectUrl()
 * @method \DateTime getUpdatedAt()
 *
 * @method $this setCustomId(string $customId)
 * @method $this setProforma(bool $proforma)
 * @method $this setPartialProforma(bool $partialProforma)
 * @method $this setNumber(string $number)
 * @method $this setVariableSymbol(string $variableSymbol)
 * @method $this setSubjectId(int $subjectId)
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
 * @method $this setTags(array $tags)
 * @method $this setBankAccountId(int $bankAccountId)
 * @method $this setBankAccount(string $bankAccount)
 * @method $this setIban(string $iban)
 * @method $this setSwiftBic(string $swiftBic)
 * @method $this setPaymentMethod(string $paymentMethod)
 * @method $this setCurrency(string $currency)
 * @method $this setExchangeRate(string $exchangeRate)
 * @method $this setPaypal(bool $paypal)
 * @method $this setGopay(bool $gopay)
 * @method $this setLanguage(string $language)
 * @method $this setTransferredTaxLiability(bool $transferredTaxLiability)
 * @method $this setSupplyCode(int $supplyCode)
 * @method $this setEuElectronicService(bool $euElectronicService)
 * @method $this setVatPriceMode(string $vatPriceMode)
 * @method $this setRoundTotal(bool $roundTotal)
 */
class Invoice extends AbstractEntity {
    use TaggableTrait,
        LinesTrait;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
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
            'subjectId',
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
            'tags',
            'bankAccountId',
            'bankAccount',
            'iban',
            'swiftBic',
            'paymentMethod',
            'currency',
            'exchangeRate',
            'paypal',
            'gopay',
            'language',
            'transferredTaxLiability',
            'supplyCode',
            'euElectronicService',
            'vatPriceMode',
            'roundTotal',
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'remainingAmount',
            'remainingNativeAmount',
            'htmlUrl',
            'publicHtmlUrl',
            'url',
            'pdfUrl',
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
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'remainingAmount',
            'remainingNativeAmount',
            'htmlUrl',
            'publicHtmlUrl',
            'url',
            'pdfUrl',
            'subjectUrl',
            'updatedAt',
        ];
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
        $data = $this->importLines($data);
        return parent::setData($data);
    }

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();
        $data = $this->exportLines($data);
        return $data;
    }

    /**
     * @param string $name
     * @return \DateTime|mixed|null
     */
    public function __get($name) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn', 'sentAt', 'paidAt', 'reminderSentAt', 'acceptedAt', 'canceledAt', 'updatedAt'], true)) {
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

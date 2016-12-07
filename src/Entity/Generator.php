<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;
use Jahudka\FakturoidSDK\Utils;


/**
 * @property string $name
 * @property bool $recurring
 * @property bool $proforma
 * @property bool $paypal
 * @property bool $gopay
 * @property \DateTime $startDate
 * @property \DateTime $endDate
 * @property int $monthsPeriod
 * @property \DateTime $nextOccurrenceOn
 * @property int $due
 * @property bool $sendEmail
 * @property int $subjectId
 * @property int $bankAccountId
 * @property string $bankAccount
 * @property string $iban
 * @property string $swiftBic
 * @property array $tags
 * @property string $paymentMethod
 * @property string $currency
 * @property float $exchangeRate
 * @property string $language
 * @property string $vatPriceMode
 * @property bool $transferredTaxLiability
 * @property bool $euElectronicService
 * @property-read float $subtotal
 * @property-read float $nativeSubtotal
 * @property-read float $total
 * @property-read float $nativeTotal
 * @property-read string $htmlUrl
 * @property-read string $url
 * @property-read string $subjectUrl
 * @property-read \DateTime $updatedAt
 * @property \ArrayObject|Line[] $lines
 *
 * @method string getName()
 * @method bool isRecurring()
 * @method bool isProforma()
 * @method bool isPaypal()
 * @method bool isGopay()
 * @method \DateTime getStartDate()
 * @method \DateTime getEndDate()
 * @method int getMonthsPeriod()
 * @method \DateTime getNextOccurrenceOn()
 * @method int getDue()
 * @method bool isSendEmail()
 * @method int getSubjectId()
 * @method int getBankAccountId()
 * @method string getBankAccount()
 * @method string getIban()
 * @method string getSwiftBic()
 * @method array getTags()
 * @method string getPaymentMethod()
 * @method string getCurrency()
 * @method float getExchangeRate()
 * @method string getLanguage()
 * @method string getVatPriceMode()
 * @method bool isTransferredTaxLiability()
 * @method bool isEuElectronicService()
 * @method float getSubtotal()
 * @method float getNativeSubtotal()
 * @method float getTotal()
 * @method float getNativeTotal()
 * @method string getHtmlUrl()
 * @method string getUrl()
 * @method string getSubjectUrl()
 * @method \DateTime getUpdatedAt()
 *
 * @method $this setName(string $name)
 * @method $this setRecurring(bool $recurring)
 * @method $this setProforma(bool $proforma)
 * @method $this setPaypal(bool $paypal)
 * @method $this setGopay(bool $gopay)
 * @method $this setStartDate(\DateTime $startDate)
 * @method $this setEndDate(\DateTime $endDate)
 * @method $this setMonthsPeriod(int $monthsPeriod)
 * @method $this setNextOccurrenceOn(\DateTime $nextOccurrenceOn)
 * @method $this setDue(int $due)
 * @method $this setSendEmail(bool $sendEmail)
 * @method $this setSubjectId(int $subjectId)
 * @method $this setBankAccountId(int $bankAccountId)
 * @method $this setBankAccount(string $bankAccount)
 * @method $this setIban(string $iban)
 * @method $this setSwiftBic(string $swiftBic)
 * @method $this setTags(array $tags)
 * @method $this setPaymentMethod(string $paymentMethod)
 * @method $this setCurrency(string $currency)
 * @method $this setExchangeRate(float $exchangeRate)
 * @method $this setLanguage(string $language)
 * @method $this setVatPriceMode(string $vatPriceMode)
 * @method $this setTransferredTaxLiability(bool $transferredTaxLiability)
 * @method $this setEuElectronicService(bool $euElectronicService)
 */
class Generator extends AbstractEntity {
    use TaggableTrait,
        LinesTrait;

    public function getKnownProperties() {
        return [
            'id',
            'name',
            'recurring',
            'proforma',
            'paypal',
            'gopay',
            'startDate',
            'endDate',
            'monthsPeriod',
            'nextOccurrenceOn',
            'due',
            'sendEmail',
            'subjectId',
            'bankAccountId',
            'bankAccount',
            'iban',
            'swiftBic',
            'tags',
            'paymentMethod',
            'currency',
            'exchangeRate',
            'language',
            'vatPriceMode',
            'transferredTaxLiability',
            'euElectronicService',
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'htmlUrl',
            'url',
            'subjectUrl',
            'updatedAt',
            'lines',
        ];
    }

    public function getReadonlyProperties() {
        return [
            'subtotal',
            'nativeSubtotal',
            'total',
            'nativeTotal',
            'htmlUrl',
            'url',
            'subjectUrl',
            'updatedAt',
        ];
    }

    /**
     * @param string $name
     * @return \DateTime|mixed|null
     */
    public function __get($name) {
        if (in_array($name, ['startDate', 'endDate', 'nextOccurrenceOn', 'updatedAt'], true)) {
            return isset($this->data[$name]) ? new \DateTime($this->data[$name]) : null;
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value) {
        if (in_array($name, ['startDate', 'endDate', 'nextOccurrenceOn'], true)) {
            $this->data[$name] = Utils::formatDate($value);
            return;
        }

        parent::__set($name, $value);
    }
}

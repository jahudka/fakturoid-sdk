<?php


namespace Jahudka\FakturoidSDK\Entity;

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
 * @property bool $lastDayInMonth
 * @property bool $taxDateAtEndOfLastMonth
 * @property int $due
 * @property bool $sendEmail
 * @property string $language
 * @property int $supplyCode
 * @property bool $euElectronicService
 * @property string $note
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
 * @method bool isLastDayInMonth()
 * @method bool isTaxDateAtEndOfLastMonth()
 * @method int getDue()
 * @method bool isSendEmail()
 * @method string getLanguage()
 * @method int getSupplyCode()
 * @method bool isEuElectronicService()
 * @method string getNote()
 *
 * @method bool hasName()
 * @method bool hasRecurring()
 * @method bool hasProforma()
 * @method bool hasPaypal()
 * @method bool hasGopay()
 * @method bool hasStartDate()
 * @method bool hasEndDate()
 * @method bool hasMonthsPeriod()
 * @method bool hasNextOccurrenceOn()
 * @method bool hasLastDayInMonth()
 * @method bool hasTaxDateAtEndOfLastMonth()
 * @method bool hasDue()
 * @method bool hasSendEmail()
 * @method bool hasLanguage()
 * @method bool hasSupplyCode()
 * @method bool hasEuElectronicService()
 * @method bool hasNote()
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
 * @method $this setLastDayInMonth(bool $lastDayInMonth)
 * @method $this setTaxDateAtEndOfLastMonth(bool $taxDateAtEndOfLastMonth)
 * @method $this setDue(int $due)
 * @method $this setSendEmail(bool $sendEmail)
 * @method $this setLanguage(string $language)
 * @method $this setSupplyCode(int $supplyCode)
 * @method $this setEuElectronicService(bool $euElectronicService)
 * @method $this setNote(string $note)
 */
class Generator extends AbstractBillable {

    public function getKnownProperties() {
        return array_merge(parent::getKnownProperties(), [
            'name',
            'recurring',
            'proforma',
            'paypal',
            'gopay',
            'startDate',
            'endDate',
            'monthsPeriod',
            'nextOccurrenceOn',
            'lastDayInMonth',
            'taxDateAtEndOfLastMonth',
            'due',
            'sendEmail',
            'language',
            'supplyCode',
            'euElectronicService',
            'note',
        ]);
    }

    /**
     * @param string $name
     * @return \DateTime|mixed|null
     */
    public function __get($name) {
        if (in_array($name, ['startDate', 'endDate', 'nextOccurrenceOn'], true)) {
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

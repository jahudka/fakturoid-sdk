<?php

declare(strict_types=1);

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
 * @property \DateTimeImmutable $issuedOn
 * @property \DateTimeImmutable $taxableFulfillmentDue
 * @property int $due
 * @property-read \DateTimeImmutable $dueOn
 * @property-read \DateTimeImmutable $sentAt
 * @property-read \DateTimeImmutable $paidAt
 * @property-read \DateTimeImmutable $reminderSentAt
 * @property-read \DateTimeImmutable $acceptedAt
 * @property \DateTimeImmutable $canceledAt
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
 * @method \DateTimeImmutable getIssuedOn()
 * @method \DateTimeImmutable getTaxableFulfillmentDue()
 * @method int getDue()
 * @method \DateTimeImmutable getDueOn()
 * @method \DateTimeImmutable getSentAt()
 * @method \DateTimeImmutable getPaidAt()
 * @method \DateTimeImmutable getReminderSentAt()
 * @method \DateTimeImmutable getAcceptedAt()
 * @method \DateTimeImmutable getCanceledAt()
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
 * @method bool hasCustomId()
 * @method bool hasProforma()
 * @method bool hasPartialProforma()
 * @method bool hasNumber()
 * @method bool hasVariableSymbol()
 * @method bool hasYourName()
 * @method bool hasYourStreet()
 * @method bool hasYourStreet2()
 * @method bool hasYourCity()
 * @method bool hasYourZip()
 * @method bool hasYourCountry()
 * @method bool hasYourRegistrationNo()
 * @method bool hasYourVatNo()
 * @method bool hasClientName()
 * @method bool hasClientStreet()
 * @method bool hasClientStreet2()
 * @method bool hasClientCity()
 * @method bool hasClientZip()
 * @method bool hasClientCountry()
 * @method bool hasClientRegistrationNo()
 * @method bool hasClientVatNo()
 * @method bool hasGeneratorId()
 * @method bool hasRelatedId()
 * @method bool hasCorrection()
 * @method bool hasCorrectionId()
 * @method bool hasToken()
 * @method bool hasStatus()
 * @method bool hasOrderNumber()
 * @method bool hasIssuedOn()
 * @method bool hasTaxableFulfillmentDue()
 * @method bool hasDue()
 * @method bool hasDueOn()
 * @method bool hasSentAt()
 * @method bool hasPaidAt()
 * @method bool hasReminderSentAt()
 * @method bool hasAcceptedAt()
 * @method bool hasCanceledAt()
 * @method bool hasNote()
 * @method bool hasFooterNote()
 * @method bool hasPrivateNote()
 * @method bool hasPaypal()
 * @method bool hasGopay()
 * @method bool hasLanguage()
 * @method bool hasSupplyCode()
 * @method bool hasEuElectronicService()
 * @method bool hasRoundTotal()
 * @method bool hasRemainingAmount()
 * @method bool hasRemainingNativeAmount()
 * @method bool hasPublicHtmlUrl()
 * @method bool hasPdfUrl()
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
 * @method $this setIssuedOn(\DateTimeImmutable|string|int $issuedOn)
 * @method $this setTaxableFulfillmentDue(\DateTimeImmutable|string|int $taxableFulfillmentDue)
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
    public function getKnownProperties(): array {
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

    public function getReadonlyProperties(): array {
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

    public function __get(string $name) {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue', 'dueOn', 'sentAt', 'paidAt', 'reminderSentAt', 'acceptedAt', 'canceledAt'], true)) {
            return isset($this->data[$name]) ? new \DateTimeImmutable($this->data[$name]) : null;
        }

        return parent::__get($name);
    }

    public function __set(string $name, $value): void {
        if (in_array($name, ['issuedOn', 'taxableFulfillmentDue'], true)) {
            $this->data[$name] = Utils::formatDate($value);
            return;
        }

        parent::__set($name, $value);
    }
}

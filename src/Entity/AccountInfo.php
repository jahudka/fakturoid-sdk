<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read string $subdomain
 * @property-read string $plan
 * @property-read int $planPrice
 * @property-read string $email
 * @property-read string $invoiceEmail
 * @property-read string $phone
 * @property-read string $web
 * @property-read string $name
 * @property-read string $fullName
 * @property-read string $registrationNo
 * @property-read string $vatNo
 * @property-read string $vatMode
 * @property-read string $vatPriceMode
 * @property-read string $street
 * @property-read string $street2
 * @property-read string $city
 * @property-read string $zip
 * @property-read string $country
 * @property-read string $bankAccount
 * @property-read string $iban
 * @property-read string $swiftBic
 * @property-read string $currency
 * @property-read string $unitName
 * @property-read int $vatRate
 * @property-read string $displayedNote
 * @property-read string $invoiceNote
 * @property-read int $due
 * @property-read string $customEmailText
 * @property-read string $overdueEmailText
 * @property-read bool $invoicePaypal
 * @property-read bool $invoiceGopay
 * @property-read string $htmlUrl
 * @property-read string $url
 * @property-read \DateTime $updatedAt
 * @property-read \DateTime $createdAt
 *
 * @method string getSubdomain()
 * @method string getPlan()
 * @method int getPlanPrice()
 * @method string getEmail()
 * @method string getInvoiceEmail()
 * @method string getPhone()
 * @method string getWeb()
 * @method string getName()
 * @method string getFullName()
 * @method string getRegistrationNo()
 * @method string getVatNo()
 * @method string getVatMode()
 * @method string getVatPriceMode()
 * @method string getStreet()
 * @method string getStreet2()
 * @method string getCity()
 * @method string getZip()
 * @method string getCountry()
 * @method string getBankAccount()
 * @method string getIban()
 * @method string getSwiftBic()
 * @method string getCurrency()
 * @method string getUnitName()
 * @method int getVatRate()
 * @method string getDisplayedNote()
 * @method string getInvoiceNote()
 * @method int getDue()
 * @method string getCustomEmailText()
 * @method string getOverdueEmailText()
 * @method bool isInvoicePaypal()
 * @method bool isInvoiceGopay()
 * @method string getHtmlUrl()
 * @method string getUrl()
 *
 * @method bool hasSubdomain()
 * @method bool hasPlan()
 * @method bool hasPlanPrice()
 * @method bool hasEmail()
 * @method bool hasInvoiceEmail()
 * @method bool hasPhone()
 * @method bool hasWeb()
 * @method bool hasName()
 * @method bool hasFullName()
 * @method bool hasRegistrationNo()
 * @method bool hasVatNo()
 * @method bool hasVatMode()
 * @method bool hasVatPriceMode()
 * @method bool hasStreet()
 * @method bool hasStreet2()
 * @method bool hasCity()
 * @method bool hasZip()
 * @method bool hasCountry()
 * @method bool hasBankAccount()
 * @method bool hasIban()
 * @method bool hasSwiftBic()
 * @method bool hasCurrency()
 * @method bool hasUnitName()
 * @method bool hasVatRate()
 * @method bool hasDisplayedNote()
 * @method bool hasInvoiceNote()
 * @method bool hasDue()
 * @method bool hasCustomEmailText()
 * @method bool hasOverdueEmailText()
 * @method bool hasInvoicePaypal()
 * @method bool hasInvoiceGopay()
 * @method bool hasHtmlUrl()
 * @method bool hasUrl()
 */
class AccountInfo extends AbstractEntity {

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'subdomain',
            'plan',
            'planPrice',
            'email',
            'invoiceEmail',
            'phone',
            'web',
            'name',
            'fullName',
            'registrationNo',
            'vatNo',
            'vatMode',
            'vatPriceMode',
            'street',
            'street2',
            'city',
            'zip',
            'country',
            'bankAccount',
            'iban',
            'swiftBic',
            'currency',
            'unitName',
            'vatRate',
            'displayedNote',
            'invoiceNote',
            'due',
            'customEmailText',
            'overdueEmailText',
            'invoicePaypal',
            'invoiceGopay',
            'htmlUrl',
            'url',
            'updatedAt',
            'createdAt',
        ];
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt() {
        return isset($this->data['updatedAt']) ? new \DateTime($this->data['updatedAt']) : null;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt() {
        return isset($this->data['createdAt']) ? new \DateTime($this->data['createdAt']) : null;
    }
}

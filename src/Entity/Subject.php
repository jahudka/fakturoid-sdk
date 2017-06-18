<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read int $id
 * @property string $customId
 * @property string $type
 * @property string $name
 * @property string $street
 * @property string $street2
 * @property string $city
 * @property string $zip
 * @property string $country
 * @property string $registrationNo
 * @property string $vatNo
 * @property string $bankAccount
 * @property string $iban
 * @property string $variableSymbol
 * @property bool $enabledReminders
 * @property string $fullName
 * @property string $email
 * @property string $emailCopy
 * @property string $phone
 * @property string $web
 * @property-read string $avatarUrl
 * @property-read string $htmlUrl
 * @property-read string $url
 * @property-read \DateTime $updatedAt
 *
 * @method int getId()
 * @method string getCustomId()
 * @method string getType()
 * @method string getName()
 * @method string getStreet()
 * @method string getStreet2()
 * @method string getCity()
 * @method string getZip()
 * @method string getCountry()
 * @method string getRegistrationNo()
 * @method string getVatNo()
 * @method string getBankAccount()
 * @method string getIban()
 * @method string getVariableSymbol()
 * @method bool isEnabledReminders()
 * @method string getFullName()
 * @method string getEmail()
 * @method string getEmailCopy()
 * @method string getPhone()
 * @method string getWeb()
 * @method string getAvatarUrl()
 * @method string getHtmlUrl()
 * @method string getUrl()
 *
 * @method bool hasId()
 * @method bool hasCustomId()
 * @method bool hasType()
 * @method bool hasName()
 * @method bool hasStreet()
 * @method bool hasStreet2()
 * @method bool hasCity()
 * @method bool hasZip()
 * @method bool hasCountry()
 * @method bool hasRegistrationNo()
 * @method bool hasVatNo()
 * @method bool hasBankAccount()
 * @method bool hasIban()
 * @method bool hasVariableSymbol()
 * @method bool hasEnabledReminders()
 * @method bool hasFullName()
 * @method bool hasEmail()
 * @method bool hasEmailCopy()
 * @method bool hasPhone()
 * @method bool hasWeb()
 * @method bool hasAvatarUrl()
 * @method bool hasHtmlUrl()
 * @method bool hasUrl()
 *
 * @method $this setCustomId(string $customId)
 * @method $this setType(string $type)
 * @method $this setName(string $name)
 * @method $this setStreet(string $street)
 * @method $this setStreet2(string $street2)
 * @method $this setCity(string $city)
 * @method $this setZip(string $zip)
 * @method $this setCountry(string $country)
 * @method $this setRegistrationNo(string $registrationNo)
 * @method $this setVatNo(string $vatNo)
 * @method $this setBankAccount(string $bankAccount)
 * @method $this setIban(string $iban)
 * @method $this setVariableSymbol(string $variableSymbol)
 * @method $this setEnabledReminders(bool $enabledReminders)
 * @method $this setFullName(string $fullName)
 * @method $this setEmail(string $email)
 * @method $this setEmailCopy(string $emailCopy)
 * @method $this setPhone(string $phone)
 */
class Subject extends AbstractEntity {

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'customId',
            'type',
            'name',
            'street',
            'street2',
            'city',
            'zip',
            'country',
            'registrationNo',
            'vatNo',
            'bankAccount',
            'iban',
            'variableSymbol',
            'enabledReminders',
            'fullName',
            'email',
            'emailCopy',
            'phone',
            'web',
            'avatarUrl',
            'htmlUrl',
            'url',
            'updatedAt',
        ];
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return [
            'avatarUrl',
            'htmlUrl',
            'url',
            'updatedAt',
        ];
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt() {
        return isset($this->data['updatedAt']) ? new \DateTime($this->data['updatedAt']) : null;
    }

}

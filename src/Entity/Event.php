<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read string $name
 * @property-read \DateTime $createdAt
 * @property-read int $invoiceId
 * @property-read int $subjectId
 * @property-read string $text
 * @property-read string $invoiceUrl
 * @property-read string $subjectUrl
 * @property-read User $user
 *
 * @method string getName()
 * @method int getInvoiceId()
 * @method int getSubjectId()
 * @method string getText()
 * @method string getInvoiceUrl()
 * @method string getSubjectUrl()
 * @method User getUser()
 *
 * @method bool hasName()
 * @method bool hasInvoiceId()
 * @method bool hasSubjectId()
 * @method bool hasText()
 * @method bool hasInvoiceUrl()
 * @method bool hasSubjectUrl()
 * @method bool hasUser()
 */
class Event extends AbstractEntity {

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'name',
            'createdAt',
            'invoiceId',
            'subjectId',
            'text',
            'invoiceUrl',
            'subjectUrl',
            'user',
        ];
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
        if (isset($data['user'])) {
            $data['user'] = new User($data['user']);
        }

        return parent::setData($data);
    }

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();

        if (isset($data['user'])) {
            $data['user'] = $data['user']->toArray();
        }

        return $data;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt() {
        return isset($this->data['createdAt']) ? new \DateTime($this->data['createdAt']) : null;
    }

}

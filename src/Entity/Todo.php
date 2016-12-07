<?php


namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read int $id
 * @property-read string $name
 * @property-read \DateTime $createdAt
 * @property-read \DateTime $completedAt
 * @property-read int $invoiceId
 * @property-read int $subjectId
 * @property-read string $text
 * @property-read string $invoiceUrl
 * @property-read string $subjectUrl

 * @method int getId()
 * @method string getName()
 * @method int getInvoiceId()
 * @method int getSubjectId()
 * @method string getText()
 * @method string getInvoiceUrl()
 * @method string getSubjectUrl()
 */
class Todo extends AbstractEntity {

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'name',
            'createdAt',
            'completedAt',
            'invoiceId',
            'subjectId',
            'text',
            'invoiceUrl',
            'subjectUrl',
        ];
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt() {
        return isset($this->data['createdAt']) ? new \DateTime($this->data['createdAt']) : null;
    }

    /**
     * @return \DateTime|null
     */
    public function getCompletedAt() {
        return isset($this->data['completedAt']) ? new \DateTime($this->data['completedAt']) : null;
    }

}

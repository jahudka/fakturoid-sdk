<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read string $name
 * @property-read \DateTimeImmutable $createdAt
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
    protected bool $readonly = true;

    public function getKnownProperties(): array {
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
     * @return $this
     */
    public function setData(array $data) {
        if (isset($data['user'])) {
            $data['user'] = new User($data['user']);
        }

        return parent::setData($data);
    }

    public function toArray(): array {
        $data = parent::toArray();

        if (isset($data['user'])) {
            $data['user'] = $data['user']->toArray();
        }

        return $data;
    }

    public function getCreatedAt(): ?\DateTimeImmutable {
        return isset($this->data['createdAt']) ? new \DateTimeImmutable($this->data['createdAt']) : null;
    }
}

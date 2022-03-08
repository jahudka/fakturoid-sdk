<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read int $id
 * @property-read string $name
 * @property-read \DateTimeImmutable $createdAt
 * @property-read \DateTimeImmutable $completedAt
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

 * @method bool hasId()
 * @method bool hasName()
 * @method bool hasInvoiceId()
 * @method bool hasSubjectId()
 * @method bool hasText()
 * @method bool hasInvoiceUrl()
 * @method bool hasSubjectUrl()
 */
class Todo extends AbstractEntity {
    protected bool $readonly = true;

    public function getKnownProperties(): array {
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

    public function getCreatedAt(): ?\DateTimeImmutable {
        return isset($this->data['createdAt']) ? new \DateTimeImmutable($this->data['createdAt']) : null;
    }

    public function getCompletedAt(): ?\DateTimeImmutable {
        return isset($this->data['completedAt']) ? new \DateTimeImmutable($this->data['completedAt']) : null;
    }
}

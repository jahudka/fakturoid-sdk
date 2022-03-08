<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read string $slug
 * @property-read string $logo
 * @property-read string $name
 * @property-read string $permission
 *
 * @method string getSlug()
 * @method string getLogo()
 * @method string getName()
 * @method string getPermission()
 *
 * @method bool hasSlug()
 * @method bool hasLogo()
 * @method bool hasName()
 * @method bool hasPermission()
 */
class Account extends AbstractEntity {
    protected bool $readonly = true;

    public function getKnownProperties(): array {
        return [
            'slug',
            'logo',
            'name',
            'permission',
        ];
    }

    public function isWritable(): bool {
        return in_array($this->getPermission(), ['owner', 'write'], true);
    }
}

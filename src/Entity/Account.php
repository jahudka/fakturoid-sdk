<?php


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

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'slug',
            'logo',
            'name',
            'permission',
        ];
    }

    /**
     * @return bool
     */
    public function isWritable() {
        return in_array($this->getPermission(), ['owner', 'write'], true);
    }

}

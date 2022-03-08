<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\AbstractEntity;


/**
 * @property-read int $id
 * @property-read string $fullName
 * @property-read string $email
 * @property-read string $avatarUrl
 * @property-read Account[] $accounts
 *
 * @method int getId()
 * @method string getFullName()
 * @method string getEmail()
 * @method string getAvatarUrl()
 * @method Account[] getAccounts()
 *
 * @method bool hasId()
 * @method bool hasFullName()
 * @method bool hasEmail()
 * @method bool hasAvatarUrl()
 * @method bool hasAccounts()
 */
class User extends AbstractEntity {
    protected bool $readonly = true;

    public function getKnownProperties(): array {
        return [
            'id',
            'fullName',
            'email',
            'avatarUrl',
            'accounts',
        ];
    }

    /**
     * @return $this
     */
    public function setData(array $data) {
        if (isset($data['accounts'])) {
            $data['accounts'] = array_map(function($data) {
                return new Account($data);
            }, $data['accounts']);
        }

        return parent::setData($data);
    }

    public function toArray(): array {
        $data = parent::toArray();

        $data['accounts'] = array_map(function(Account $account) {
            return $account->toArray();
        }, $data['accounts']->getArrayCopy());

        return $data;
    }
}

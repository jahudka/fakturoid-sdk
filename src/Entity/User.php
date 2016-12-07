<?php


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
 */
class User extends AbstractEntity {

    /** @var bool */
    protected $readonly = true;

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
            'fullName',
            'email',
            'avatarUrl',
            'accounts',
        ];
    }

    /**
     * @param array $data
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

    /**
     * @return array
     */
    public function toArray() {
        $data = parent::toArray();

        $data['accounts'] = array_map(function(Account $account) {
            return $account->toArray();
        }, $data['accounts']->getArrayCopy());

        return $data;
    }


}

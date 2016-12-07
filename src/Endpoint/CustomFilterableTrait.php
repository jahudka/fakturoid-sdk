<?php


namespace Jahudka\FakturoidSDK\Endpoint;


trait CustomFilterableTrait {

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public abstract function setOption($option, $value);

    /**
     * @param string $customId
     * @return $this
     */
    public function withCustomId($customId) {
        return $this->setOption('custom_id', $customId);
    }

}

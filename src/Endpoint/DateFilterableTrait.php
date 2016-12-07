<?php


namespace Jahudka\FakturoidSDK\Endpoint;


use Jahudka\FakturoidSDK\Utils;

trait DateFilterableTrait {

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public abstract function setOption($option, $value);

    /**
     * @param \DateTime|string|int $date
     * @return $this
     */
    public function since($date) {
        return $this->setOption('since', Utils::formatDate($date));
    }

    /**
     * @param \DateTime|string|int $date
     * @return $this
     */
    public function updatedSince($date) {
        return $this->setOption('updated_since', Utils::formatDate($date));
    }

}

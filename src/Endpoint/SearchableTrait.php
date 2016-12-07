<?php


namespace Jahudka\FakturoidSDK\Endpoint;


trait SearchableTrait {

    /**
     * @param string $option
     * @param mixed $value
     * @return $this
     */
    public abstract function setOption($option, $value);

    /**
     * @param string $query
     * @return $this
     */
    public function matching($query) {
        return $this->setOption('query', $query);
    }

}

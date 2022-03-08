<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;


trait SearchableTrait {
    /**
     * @return $this
     */
    public abstract function setOption(string $option, $value);

    /**
     * @return $this
     */
    public function matching(string $query) {
        return $this->setOption('query', $query);
    }
}

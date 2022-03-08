<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;


trait CustomFilterableTrait {
    /**
     * @return $this
     */
    public abstract function setOption(string $option, $value);

    /**
     * @return $this
     */
    public function withCustomId(string $customId) {
        return $this->setOption('custom_id', $customId);
    }
}

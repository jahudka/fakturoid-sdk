<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Endpoint;

use Jahudka\FakturoidSDK\Utils;


trait DateFilterableTrait {
    /**
     * @return $this
     */
    public abstract function setOption(string $option, $value);

    /**
     * @param \DateTimeInterface|string|int $date
     * @return $this
     */
    public function since($date) {
        return $this->setOption('since', Utils::formatDateTime($date));
    }

    /**
     * @param \DateTimeInterface|string|int $date
     * @return $this
     */
    public function updatedSince($date) {
        return $this->setOption('updated_since', Utils::formatDateTime($date));
    }
}

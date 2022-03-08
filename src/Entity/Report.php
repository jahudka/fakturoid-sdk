<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK\Entity;

use Jahudka\FakturoidSDK\ReadonlyEntityException;


class Report implements \ArrayAccess, \Iterator {

    const KEY_NUMERIC = 'numeric',
        KEY_STRING = 'string';

    private array $data;

    private array $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    private int $current = 0;
    private string $keyMode = self::KEY_STRING;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function setKeyMode(string $mode) {
        $this->keyMode = $mode;
        return $this;
    }

    public function withKeyMode(string $mode) {
        $report = clone $this;
        return $report->setKeyMode($mode);
    }

    public function getTotalIncome(): float {
        return array_reduce($this->data, function($sum, $item) {
            return $sum + $item['income'];
        }, 0);
    }

    public function getTotalVat(): float {
        return array_reduce($this->data, function($sum, $item) {
            return $sum + $item['vat'];
        }, 0);
    }

    /******* ArrayAccess implementation *******/

    /**
     * @param string|int $offset
     */
    public function offsetExists($offset): bool {
        return is_int($offset) ? $offset >= 1 && $offset <= 12 : array_key_exists($offset, $this->months);
    }

    /**
     * @param string|int $offset
     */
    public function offsetGet($offset): array {
        if (is_int($offset)) {
            if ($offset < 1 || $offset > 12) {
                throw new \RangeException("Invalid month");
            }

            $offset = $this->months[$offset - 1];
        }

        return $this->data[$offset];
    }

    public function offsetSet($offset, $value): void {
        throw new ReadonlyEntityException();
    }

    public function offsetUnset($offset): void {
        throw new ReadonlyEntityException();
    }


    /******* Iterator implementation *******/

    public function current(): array {
        return $this->data[$this->months[$this->current]];
    }

    public function next(): void {
        $this->current++;
    }

    public function key() {
        return $this->keyMode === self::KEY_NUMERIC ? $this->current + 1 : $this->months[$this->current];
    }

    public function valid(): bool {
        return $this->current >= 0 && $this->current < 12;
    }

    public function rewind(): void {
        $this->current = 0;
    }
}

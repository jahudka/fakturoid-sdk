<?php


namespace Jahudka\FakturoidSDK\Entity;


use Jahudka\FakturoidSDK\ReadonlyEntityException;

class Report implements \ArrayAccess, \Iterator {

    const KEY_NUMERIC = 'numeric',
        KEY_STRING = 'string';

    /** @var array */
    private $data;

    /** @var array */
    private $months = [
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

    /** @var int */
    private $current = 0;

    /** @var string */
    private $keyMode = self::KEY_STRING;

    /**
     * @param array $data
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setKeyMode($mode) {
        $this->keyMode = $mode;
        return $this;
    }

    /**
     * @param string $mode
     * @return Report
     */
    public function withKeyMode($mode) {
        $report = clone $this;
        return $report->setKeyMode($mode);
    }

    /**
     * @return float
     */
    public function getTotalIncome() {
        return array_reduce($this->data, function($sum, $item) {
            return $sum + $item['income'];
        }, 0);
    }

    /**
     * @return float
     */
    public function getTotalVat() {
        return array_reduce($this->data, function($sum, $item) {
            return $sum + $item['vat'];
        }, 0);
    }

    /******* ArrayAccess implementation *******/

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return is_int($offset) ? $offset >= 1 && $offset <= 12 : array_key_exists($offset, $this->months);
    }

    /**
     * @param string|int $offset
     * @return array
     */
    public function offsetGet($offset) {
        if (is_int($offset)) {
            if ($offset < 1 || $offset > 12) {
                throw new \RangeException("Invalid month");
            }

            $offset = $this->months[$offset - 1];
        }

        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws ReadonlyEntityException
     */
    public function offsetSet($offset, $value) {
        throw new ReadonlyEntityException();
    }

    /**
     * @param mixed $offset
     * @throws ReadonlyEntityException
     */
    public function offsetUnset($offset) {
        throw new ReadonlyEntityException();
    }


    /******* Iterator implementation *******/

    /**
     * @return mixed
     */
    public function current() {
        return $this->data[$this->months[$this->current]];
    }

    /**
     * @return void
     */
    public function next() {
        $this->current++;
    }

    /**
     * @return string|int
     */
    public function key() {
        return $this->keyMode === self::KEY_NUMERIC ? $this->current + 1 : $this->months[$this->current];
    }

    /**
     * @return bool
     */
    public function valid() {
        return $this->current >= 0 && $this->current < 12;
    }

    /**
     * @return void
     */
    public function rewind() {
        $this->current = 0;
    }


}

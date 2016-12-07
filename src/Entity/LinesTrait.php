<?php


namespace Jahudka\FakturoidSDK\Entity;


trait LinesTrait {

    /**
     * @param array $data
     * @return array
     */
    protected function importLines(array $data) {
        if (isset($data['lines'])) {
            $lines = array_map(function($data) {
                return new Line($data);
            }, $data['lines']);

            $data['lines'] = new \ArrayObject($lines);
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function exportLines(array $data) {
        if (isset($data['lines'])) {
            $data['lines'] = array_map(function(Line $line) {
                return $line->toArray();
            }, $data['lines']->getArrayCopy());
        }

        return $data;
    }

    /**
     * @return \ArrayObject|Line[]
     */
    public function getLines() {
        if (!isset($this->data['lines'])) {
            $this->data['lines'] = new \ArrayObject();
        }

        return $this->data['lines'];
    }

    /**
     * @param \Traversable|array $lines
     * @return $this
     */
    public function setLines($lines) {
        if (!is_array($lines) && !($lines instanceof \Traversable)) {
            throw new \InvalidArgumentException("First argument to " . __METHOD__ . " must be either an array or a Traversable object");
        }

        $this->data['lines'] = new \ArrayObject();

        foreach ($lines as $k => $line) {
            if (!($line instanceof Line)) {
                throw new \InvalidArgumentException("Invalid item at key '$k', must be an instance of Line");
            }

            $this->data['lines']->append($line);
        }

        return $this;
    }
}

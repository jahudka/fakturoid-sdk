<?php


namespace Jahudka\FakturoidSDK;


/**
 * @property int $id
 * @method int getId()
 * @method $this setId(int $id)
 * @method bool hasId()
 */
abstract class AbstractEntity {

    /** @var array */
    protected $data;

    /** @var array */
    protected $originalData;

    /** @var bool */
    protected $readonly = false;

    /**
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->setData($data);
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data) {
        $this->data = $this->originalData = array_intersect_key(Utils::toCamelKeys($data), array_fill_keys($this->getKnownProperties(), 1));
        return $this;
    }

    /**
     * @return array
     */
    public function getKnownProperties() {
        return [
            'id',
        ];
    }

    /**
     * @return array
     */
    public function getReadonlyProperties() {
        return [];
    }

    /**
     * @return array
     */
    public function toArray() {
        return Utils::toPascalKeys($this->data);
    }

    /**
     * @return array
     */
    public function getModifiedData() {
        $modified = [];

        foreach ($this->data as $key => $value) {
            if (!array_key_exists($key, $this->originalData) || $value !== $this->originalData[$key]) {
                $modified[$key] = $value;
            }
        }

        return Utils::toPascalKeys($modified);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws MemberAccessException
     */
    public function __get($name) {
        $method = 'get' . ucfirst($name);

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        if (!in_array($name, $this->getKnownProperties(), true)) {
            $class = get_class($this);
            throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");
        }

        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws MemberAccessException
     * @throws ReadonlyEntityException
     */
    public function __set($name, $value) {
        $method = 'set' . ucfirst($name);

        if (method_exists($this, $method)) {
            if ($this->readonly) {
                throw new ReadonlyEntityException();
            }

            call_user_func([$this, $method], $value);

        } else if (in_array($name, $this->getKnownProperties(), true)) {
            $this->assertWritable($name);
            $this->data[$name] = $value;

        } else {
            $class = get_class($this);
            throw new MemberAccessException("Trying to access non-existent property '$name' of class $class");

        }
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed|bool|$this
     * @throws \InvalidArgumentException
     * @throws MemberAccessException
     * @throws ReadonlyEntityException
     */
    public function __call($name, $args) {
        if (preg_match('/^(get|set|is|has)([A-Z].*)$/', $name, $m)) {
            switch ($m[1]) {
                case 'get':
                    return $this->__get(lcfirst($m[2]));

                case 'is':
                    return (bool) $this->__get(lcfirst($m[2]));

                case 'has':
                    return $this->__isset(lcfirst($m[2]));

                case 'set':
                    if (empty($args)) {
                        $class = get_class($this);
                        throw new \InvalidArgumentException("Missing argument #1 for method $class::$name()");
                    }

                    $this->__set(lcfirst($m[2]), $args[0]);
                    return $this;
            }
        }

        $class = get_class($this);
        $types = implode(', ', array_map('gettype', $args));
        throw new MemberAccessException("Call to undefined method $class::$name($types)");

    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * @param string $property
     * @throws ReadonlyEntityException
     * @throws ReadonlyPropertyException
     */
    protected function assertWritable($property) {
        if ($this->readonly) {
            throw new ReadonlyEntityException();
        } else if (in_array($property, $this->getReadonlyProperties())) {
            throw new ReadonlyPropertyException();
        }
    }

}

<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;


/**
 * @property int $id
 * @method int getId()
 * @method $this setId(int $id)
 * @method bool hasId()
 */
abstract class AbstractEntity {
    protected array $data;
    protected array $originalData;
    protected bool $readonly = false;

    public function __construct(array $data = []) {
        $this->setData($data);
    }

    /**
     * @return $this
     */
    public function setData(array $data) {
        $this->data = $this->originalData = array_intersect_key(Utils::toCamelKeys($data), array_fill_keys($this->getKnownProperties(), 1));
        return $this;
    }

    public function getKnownProperties(): array {
        return [
            'id',
        ];
    }

    public function getReadonlyProperties(): array {
        return [];
    }

    public function toArray(): array {
        return Utils::toPascalKeys($this->data);
    }

    public function getModifiedData(): array {
        $modified = [];

        foreach ($this->data as $key => $value) {
            if (!array_key_exists($key, $this->originalData) || $value !== $this->originalData[$key]) {
                $modified[$key] = $value;
            }
        }

        return Utils::toPascalKeys($modified);
    }

    public function __get(string $name) {
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

    public function __set(string $name, $value): void {
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

    public function __call(string $name, array $args) {
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

    public function __isset(string $name): bool {
        return isset($this->data[$name]);
    }

    protected function assertWritable(string $property): void {
        if ($this->readonly) {
            throw new ReadonlyEntityException();
        } else if (in_array($property, $this->getReadonlyProperties())) {
            throw new ReadonlyPropertyException();
        }
    }

}

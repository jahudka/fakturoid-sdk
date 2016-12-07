<?php


namespace Jahudka\FakturoidSDK;


class Utils {

    /**
     * @param array $data
     * @return array
     */
    public static function toCamelKeys(array $data) {
        $result = [];

        foreach ($data as $key => $value) {
            $result[self::toCamelCase($key)] = $value;
        }

        return $result;
    }

    /**
     * @param string $key
     * @return string
     */
    public static function toCamelCase($key) {
        return preg_replace_callback('/_(.)/', function($m) { return strtoupper($m[1]); }, $key);
    }

    /**
     * @param array $data
     * @return array
     */
    public static function toPascalKeys(array $data) {
        $result = [];

        foreach ($data as $key => $value) {
            $result[self::toPascalCase($key)] = $value;
        }

        return $result;
    }

    /**
     * @param string $key
     * @return string
     */
    public static function toPascalCase($key) {
        return preg_replace_callback('/([A-Z])/', function($m) { return '_' . strtolower($m[1]); }, $key);
    }

    /**
     * @param \DateTime|string|int|null $value
     * @return string|null
     */
    public static function formatDate($value) {
        return self::formatDateTime($value, 'Y-m-d');
    }

    /**
     * @param \DateTime|string|int|null $value
     * @param string $format
     * @return string|null
     */
    public static function formatDateTime($value, $format = 'c') {
        if ($value === null) {
            return null;
        } else if ($value instanceof \DateTime) {
            return $value->format($format);
        } else {
            return date($format, is_string($value) ? strtotime($value) : $value);
        }
    }

    final private function __construct() {}

}

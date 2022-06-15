<?php

declare(strict_types=1);

namespace Jahudka\FakturoidSDK;

class Utils {

    public static function toCamelKeys(array $data): array {
        $result = [];

        foreach ($data as $key => $value) {
            $result[self::toCamelCase($key)] = $value;
        }

        return $result;
    }

    public static function toCamelCase(string $key): string {
        return preg_replace_callback('/_(.)/', function($m) { return strtoupper($m[1]); }, $key);
    }

    public static function toPascalKeys(array $data): array {
        $result = [];

        foreach ($data as $key => $value) {
            $result[self::toPascalCase($key)] = $value;
        }

        return $result;
    }

    public static function toPascalCase(string $key): string {
        return preg_replace_callback('/([A-Z])/', function($m) { return '_' . strtolower($m[1]); }, $key);
    }

    /**
     * @param \DateTimeInterface|string|int|null $value
     */
    public static function formatDate($value): ?string {
        return self::formatDateTime($value, 'Y-m-d');
    }

    /**
     * @param \DateTimeInterface|string|int|null $value
     */
    public static function formatDateTime($value, string $format = 'c'): ?string {
        if ($value === null) {
            return null;
        } else if ($value instanceof \DateTimeInterface) {
            return $value->format($format);
        } else {
            return date($format, is_string($value) ? strtotime($value) : $value);
        }
    }

    final private function __construct() {}

}

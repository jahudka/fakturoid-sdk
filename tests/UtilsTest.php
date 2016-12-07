<?php

namespace Jahudka\FakturoidSDK\Tests;



use Jahudka\FakturoidSDK\Utils;

class UtilsTest extends TestCase {

    public function testToCamelCase() {
        $this->assertEquals('pascalCaseString', Utils::toCamelCase('pascal_case_string'));
        $this->assertEquals('camelCaseString', Utils::toCamelCase('camelCaseString'));
        $this->assertEquals('StringStartingWithUnderscore', Utils::toCamelCase('_string_starting_with_underscore'));
        $this->assertEquals('stringEndingWithUnderscore_', Utils::toCamelCase('string_ending_with_underscore_'));
    }

    /**
     * @depends testToCamelCase
     */
    public function testToCamelKeys() {
        $src = [
            'pascal_key_1' => 1,
            'pascal_key_2' => 2,
            'camelKey' => 3,
        ];

        $expected = [
            'pascalKey1' => 1,
            'pascalKey2' => 2,
            'camelKey' => 3,
        ];

        $this->assertEquals($expected, Utils::toCamelKeys($src));
    }

    public function testToPascalCase() {
        $this->assertEquals('camel_case_string', Utils::toPascalCase('camelCaseString'));
        $this->assertEquals('pascal_case_string', Utils::toPascalCase('pascal_case_string'));
        $this->assertEquals('_string_starting_with_capital_letter', Utils::toPascalCase('StringStartingWithCapitalLetter'));
        $this->assertEquals('string_ending_with_underscore_', Utils::toPascalCase('stringEndingWithUnderscore_'));
        $this->assertEquals('multiple_c_a_pital_letters', Utils::toPascalCase('multipleCAPitalLetters'));
    }

    /**
     * @depends testToPascalCase
     */
    public function testToPascalKeys() {
        $src = [
            'camelKey1' => 1,
            'camelKey2' => 2,
            'pascal_key' => 3,
        ];

        $expected = [
            'camel_key1' => 1,
            'camel_key2' => 2,
            'pascal_key' => 3,
        ];

        $this->assertEquals($expected, Utils::toPascalKeys($src));
    }

    public function testFormatDateTime() {
        date_default_timezone_set('UTC');

        $this->assertEquals(null, Utils::formatDateTime(null));
        $this->assertEquals('2016-12-07T12:00:00+00:00', Utils::formatDateTime(1481112000, 'c'));
        $this->assertEquals('2016-12-07T12:00:00+00:00', Utils::formatDateTime('2016-12-07T13:00:00+01:00', 'c'));
        $this->assertEquals('2016-12-07T13:00:00+01:00', Utils::formatDateTime(new \DateTime('2016-12-07 13:00:00', new \DateTimeZone('Europe/Prague'))), 'c');
    }

    /**
     * @depends testFormatDateTime
     */
    public function testFormatDate() {
        $this->assertEquals(null, Utils::formatDate(null));
        $this->assertEquals('2016-12-07', Utils::formatDate(1481112000));
        $this->assertEquals('2016-12-07', Utils::formatDate('2016-12-07T13:00:00+01:00'));
        $this->assertEquals('2016-12-07', Utils::formatDate(new \DateTime('2016-12-07 13:00:00', new \DateTimeZone('Europe/Prague'))));
    }

}

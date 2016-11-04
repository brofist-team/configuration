<?php

namespace BrofistTest\Configuration;

use Brofist\Configuration\Configuration;
use Brofist\Configuration\ConfigurationInterface;
use PHPUnit_Framework_TestCase;

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function implementsConfigurationInterface()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, new Configuration());
    }

    /**
     * @test
     */
    public function defaultsToEmptyArray()
    {
        $config = new Configuration();
        $this->assertEquals([], $config->toArray());
    }

    /**
     * @test
     */
    public function canConvertToArray()
    {
        $array = ['foo' => 'bar'];
        $config = new Configuration($array);

        $this->assertEquals($array, $config->toArray());
    }

    /**
     * @test
     */
    public function canHandleMergingOfSingleStringValues()
    {
        $original = [
            'foo' => 'bar',
            'x'   => 'y',
        ];

        $other = [
            'foo' => 'baz',
        ];

        $expected = [
            'foo' => 'baz',
            'x'   => 'y',
        ];

        $this->assertMerge($original, $other, $expected);
    }

    /**
     * @test
     */
    public function canMergeArrayConfigs()
    {
        $original = [
            'foo' => ['bar'],
            'x'   => 'y',
        ];

        $other = [
            'foo' => ['baz'],
        ];

        $expected = [
            'foo' => ['bar', 'baz'],
            'x'   => 'y',
        ];

        $this->assertMerge($original, $other, $expected);
    }

    /**
     * @test
     */
    public function canMergeArraysReplacingKeysWhenNecessary()
    {
        $original = [
            'foo' => [
                'name'       => 'John',
                'middleName' => 'Some Middle Name',
            ],
        ];

        $other = [
            'foo' => [
                'name'     => 'Other Name',
                'lastName' => 'John',
            ],
            'newKey' => 'foo',
        ];

        $expected = [
            'foo' => [
                'name'       => 'Other Name',
                'middleName' => 'Some Middle Name',
                'lastName'   => 'John',
            ],
            'newKey' => 'foo',
        ];

        $this->assertMerge($original, $other, $expected);
    }

    private function assertMerge(array $original, array $other, array $expected)
    {
        $original = new Configuration($original);
        $other = new Configuration($other);
        $expected = new Configuration($expected);

        $actual = $original->merge($other);

        $this->assertEquals($actual, $expected);
        $this->assertNotSame($original, $actual);
        $this->assertNotSame($other, $actual);
    }
}

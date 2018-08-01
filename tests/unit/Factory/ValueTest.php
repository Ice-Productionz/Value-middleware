<?php

namespace IceProductionzTests\ValueMiddleware\Unit\Factory;

use IceProductionz\Value\Identifier\Uuid;
use IceProductionz\Value\Number\Integer;
use IceProductionz\Value\Text\Short;
use IceProductionz\Value\Uri\Url;
use IceProductionz\ValueMiddleware\Exception\InvalidType;
use IceProductionz\ValueMiddleware\Exception\MissingKey;
use IceProductionz\ValueMiddleware\Factory\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    /**
     * @return Value
     */
    public function testConstruction(): Value
    {
        $sut = new Value();

        $this->assertInstanceOf(Value::class, $sut);

        return $sut;
    }

    /**
     * Test toValue() make Uuid
     */
    public function testToValueMakeUuid()
    {
        $expected = Uuid::class;

        $input = [
            'type'  => 'identifier.uuid',
            'value' => '4c1a7822-0e33-449e-8753-ffad579f4216'
        ];

        $sut = new Value();

        $result = $sut->toValue($input);

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Test toValue() make Integer
     */
    public function testToValueMakeInteger()
    {
        $expected = Integer::class;

        $input = [
            'type'  => 'number.integer',
            'value' => 12
        ];

        $sut = new Value();

        $result = $sut->toValue($input);

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Test toValue() make Integer
     */
    public function testToValueMakeShortText()
    {
        $expected = Short::class;

        $input = [
            'type'  => 'text.short',
            'value' => ''
        ];

        $sut = new Value();

        $result = $sut->toValue($input);

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Test toValue() make Url
     */
    public function testToValueMakeUrl()
    {
        $expected = Url::class;

        $input = [
            'type'  => 'uri.url',
            'value' => 'https://as.xcd'
        ];

        $sut = new Value();

        $result = $sut->toValue($input);

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Test invalid input
     *
     * @dataProvider provideToValueData
     * @param $expectedException
     * @param $input
     */
    public function testToValueInvalidInput($expectedException, $input)
    {
        $this->expectException($expectedException);

        $sut = new Value();

        $result = $sut->toValue($input);

    }

    /**
     * @return array
     */
    public function provideToValueData()
    {
        return [
            [
                MissingKey::class,
                [],
            ],
            [
                MissingKey::class,
                ['type' => '',],
            ],
            [
                MissingKey::class,
                ['value' => ''],
            ],
            [
                InvalidType::class,
                ['type' => 12, 'value' => ''],
            ]
        ];
    }

}
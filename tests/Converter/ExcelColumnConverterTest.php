<?php

namespace App\Tests\Converter;

use App\Converter\ExcelColumnConverter;
use InvalidArgumentException;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

class ExcelColumnConverterTest extends TestCase
{
    private ExcelColumnConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ExcelColumnConverter();
    }

    public function testConvertToColumnNumberReturnsExpectedResult(): void
    {
        $this->assertEquals(1, $this->converter->convertToColumnNumber('A'));
        $this->assertEquals(26, $this->converter->convertToColumnNumber('Z'));
        $this->assertEquals(27, $this->converter->convertToColumnNumber('AA'));
        $this->assertEquals(28, $this->converter->convertToColumnNumber('AB'));
        $this->assertEquals(16384, $this->converter->convertToColumnNumber('XFD'));
    }

    public function testConvertToColumnNumberThrowsExceptionForInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->converter->convertToColumnNumber('1');
    }

    public function testConvertToColumnNumberThrowsExceptionForInputGreaterThanMaximum(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->converter->convertToColumnNumber('XFE');
    }

    public function testConvertToColumnTitleReturnsExpectedResult(): void
    {
        $this->assertEquals('A', $this->converter->convertToColumnTitle(1));
        $this->assertEquals('Z', $this->converter->convertToColumnTitle(26));
        $this->assertEquals('AA', $this->converter->convertToColumnTitle(27));
        $this->assertEquals('AB', $this->converter->convertToColumnTitle(28));
        $this->assertEquals('XFD', $this->converter->convertToColumnTitle(16384));
    }

    public function testConvertToColumnTitleThrowsExceptionForInvalidInput(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->converter->convertToColumnTitle(0);
    }

    public function testConvertToColumnTitleThrowsExceptionForInputGreaterThanMaximum(): void
    {
        $this->expectException(OutOfRangeException::class);
        $this->converter->convertToColumnTitle(16385);
    }
}

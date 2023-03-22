<?php

namespace App\Converter;

interface ExcelColumnConverterInterface
{
    public function convertToColumnNumber(string $columnTitle): int;

    public function convertToColumnTitle(int $columnNumber): string;
}
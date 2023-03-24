<?php

namespace App\Converter;

use InvalidArgumentException;
use OutOfRangeException;

class ExcelColumnConverter implements ExcelColumnConverterInterface
{
    /**
     * @param string $columnTitle
     * @return int
     */
    public function convertToColumnNumber(string $columnTitle): int
    {
        // Validate input
        if (!preg_match('/^[A-Z]+$/', $columnTitle)) {
            throw new InvalidArgumentException('Invalid input: column title must contain only uppercase letters');
        }

        $columnNumber = 0;

        foreach (str_split(strtoupper($columnTitle)) as $char) {
            $columnNumber = $columnNumber * 26 + (ord($char) - 64);
        }

        // Validate output
        if ($columnNumber < 1 || $columnNumber > 16384) {
            throw new OutOfRangeException('Invalid output: column number must be between 1 and 16384');
        }

        return $columnNumber;
    }

    /**
     * @param int $columnNumber
     * @return string
     */
    public function convertToColumnTitle(int $columnNumber): string
    {
        // Validate input
        if ($columnNumber < 1 || $columnNumber > 16384) {
            throw new OutOfRangeException('Invalid input: column number must be between 1 and 16384');
        }

        $columnTitle = '';

        while ($columnNumber > 0) {
            $mod = ($columnNumber - 1) % 26;
            $columnTitle = chr(65 + $mod) . $columnTitle;
            $columnNumber = intval(($columnNumber - $mod) / 26);
        }

        return $columnTitle;
    }
}

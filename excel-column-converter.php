<?php
// Set the error reporting level to exclude notices and warnings
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

use App\Converter\ExcelColumnConverter;
use App\Tests\Converter\ExcelColumnConverterTest;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/phpunit/phpunit/src/TextUI/TestRunner.php';
// Get the input value and mode from the command line arguments
$input = $argv[1] ?? null;
$mode = $argv[2] ?? null;

// Create an instance of the ExcelColumnConverter class
$converter = new ExcelColumnConverter();

// Determine the conversion mode based on the input value
if (is_numeric($input) && $mode == '--to-name') {
    // Convert a column number to its corresponding name
    $columnName = $converter->convertToColumnTitle($input);
    echo "$input -> $columnName\n";
} elseif (is_string($input) && $mode == '--to-number') {
    // Convert a column name to its corresponding number
    $columnNumber = $converter->convertToColumnNumber($input);
    echo "$input -> $columnNumber\n";
} elseif ($input == '-u') {
    // Run the unit tests
    $result = (new TestRunner)->run(new TestSuite(ExcelColumnConverterTest::class));
    if ($result->wasSuccessful()) {
        echo "All tests passed!\n";
    } else {
        echo "Some tests failed.\n";
    }
} else {
    // Invalid input value or mode, show usage message
    echo "Usage: php excel-column-converter.php <input> --to-number|--to-name [-u]\n";
    echo "Examples:\n";
    echo " Convert column name to its corresponding number\n";
    echo "  php excel-column-converter.php AB --to-number\n";
    echo " Convert column number to its corresponding name\n";
    echo "  php excel-column-converter.php 28 --to-name\n";
    echo " Do Unit Tests\n";
    echo "  php excel-column-converter.php -u\n";
}

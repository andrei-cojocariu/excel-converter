# Excel Column Converter

This script converts between Excel column names and numbers.

## Requirements

- PHP 7.4 or later
- PHPUnit 9.6 or later (for running unit tests)

## Installation

1. Clone this repository
2. Run `composer install` to install the required dependencies.

## Usage

    php excel-column-converter.php <input> --to-number|--to-name [-u]

    Examples:
    Convert column name to its corresponding number
      php excel-column-converter.php AB --to-number
    Convert column number to its corresponding name
      php excel-column-converter.php 28 --to-name
    Do Unit Tests
      php excel-column-converter.php -u
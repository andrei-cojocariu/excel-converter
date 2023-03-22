<?php


use App\Converter\ExcelColumnConverter;

require_once __DIR__ . '/vendor/autoload.php';

$converter = new ExcelColumnConverter();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Render the form
    $html  = '<form method="POST">';
    $html .= '<label for="input">Input:</label>';
    $html .= '<input type="text" name="input" id="input" required>';
    $html .= '<br>';
    $html .= '<input type="radio" name="conversion" id="to-number" value="to-number" checked>';
    $html .= '<label for="to-number">Convert to column number</label>';
    $html .= '<br>';
    $html .= '<input type="radio" name="conversion" id="to-title" value="to-title">';
    $html .= '<label for="to-title">Convert to column title</label>';
    $html .= '<br>';
    $html .= '<button type="submit">Convert</button>';
    $html .= '</form>';

    echo $html;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission
    $input = $_POST['input'];
    $conversion = $_POST['conversion'];

    try {
        if ($conversion === 'to-number') {
            $output = $converter->convertToColumnNumber($input);
        } elseif ($conversion === 'to-title') {
            $output = $converter->convertToColumnTitle($input);
        }

        echo $output;
    } catch (InvalidArgumentException $e) {
        http_response_code(400);
        echo $e->getMessage();
    }
}
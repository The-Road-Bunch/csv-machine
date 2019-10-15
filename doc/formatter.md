# Formatters
If you find yourself wanting to clean up those nasty looking header names you pull from the database or you use for array indexes, worry not! 
Using a variety of provided formatters, you can format an array quickly and easily.

### Available Formatters
 Formatter | input header | output header
:-----------|:----------|:-------
SplitCamelCaseWordsFormatter::class | `['splitCamelCase']` | `['split Camel Case']` 
UnderscoreToSpaceFormatter::class | `['words_with_underscores']` | `['words with underscores']` 
UpperCaseFormatter::class | `['upper case']` | `['UPPER CASE']` 
UpperCaseWordsFormatter::class | `['upper case_words']` | `['Upper Case_Words']` 

_Note:_ `SplitCamelCaseWordsFormatter` can split camel case strings with acronyms and abbreviations

 Formatter | input header | output header  
:-----------|:----------|:-------
SplitCamelCaseWordsFormatter::class | `['TheCSVMachine']` | `['The CSV Machine']`
SplitCamelCaseWordsFormatter::class | `['evenT.H.I.S.Works']` | `['even T.H.I.S. Works']`

### Usage
```php
<?php

use RoadBunch\Csv as Csv;
use RoadBunch\Csv\Formatter\UpperCaseWordsFormatter;
use RoadBunch\Csv\Formatter\UnderscoreToSpaceFormatter;

$writer = new Csv\Writer();

$writer->setHeader(
    [ 'first_column', 'second_column' ], 
    [
        UpperCaseWordsFormatter::create(), 
        UnderscoreToSpaceFormatter::create(),       
    ]
);

echo $writer->writeToString();

// output
"First Column","Second Column"
```
Use your own formatters
```php
$writer = new Csv\Writer();

$writer->setHeader(
    ['USERNAME', 'ADDRESS'],
    [
        new Csv\Formatter\Formatter('strtolower'),
        new Csv\Formatter\Formatter(function ($var) {
            return ucfirst($var);
        })
    ]
);

echo $writer->writeToString();

// output
"Username","Address"
```

For more information, take a look at the [FormatterInterface](../src/Csv/Formatter/FormatterInterface.php) and the [AbstractFormatter](../src/Csv/Formatter/Formatter.php)

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

use \RoadBunch\Csv as Csv;
use \RoadBunch\Csv\Formatter as Formatter;

$writer = new Csv\Writer();
$writer->setHeader(
    [ 'first_column', 'second_column' ], 
    [
        Formatter\UpperCaseWordsFormatter::class, 
        Formatter\UnderscoreToSpaceFormatter::class
    ]
);

echo $writer->writeToString();

// output
"First Column","Second Column"
```

### Create your own formatter  

**extend** `\RoadBunch\Csv\Formatter\AbstractFormatter`  
**call** `self::applyFilter(callable $filter, array $data)`

**Example**
```php
<?php

class LowerCaseFormatter extends \RoadBunch\Csv\Formatter\AbstractFormatter 
{
    public static function format(array $data): array
    {
        return self::applyFilter(function ($var) {
            return strtolower($var);
        }, $data);
    }
};
```

For more information, take a look at the [FormatterInterface](../src/Csv/Formatter/FormatterInterface.php) and the [AbstractFormatter](../src/Csv/Formatter/AbstractFormatter.php)

# Formatters
If you find yourself wanting to clean up those nasty looking header names you pull from the database or you use for array indexes, worry not! 
Using a variety of provided formatters, you can format an array quickly and easily.

### Available Formatters
 Formatter | Ex: original | Ex: formatted 
:-----------|:----------|:-------
SplitCamelCaseWordsFormatter::class | splitCamelCase | split Camel Case 
UnderscoreToSpaceFormatter::class | words_with_underscores | words with underscores 
UpperCaseFormatter::class | upper case formatter | UPPER CASE FORMATTER 
UpperCaseWordsFormatter::class | upper case_words formatter | Upper Case_Words Formatter 

_Note:_ `SplitCamelCaseWordsFormatter` can split camel case strings with acronyms and abbreviations

 Formatter | Ex: original | Ex: formatted 
:-----------|:----------|:-------
SplitCamelCaseWordsFormatter::class | TheCSVMachine | The CSV Machine
SplitCamelCaseWordsFormatter::class | evenT.H.I.S.Works | even T.H.I.S. Works

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

```
outputs
```
"First Column","Second Column"
```

### Create your own formatter  

**extend** `Csv\Formatter\Formatter`  
**call** `self::filterArray(callable $filter, array $data)`

**Example**
```php
<?php

class LowerCaseFormatter extends \RoadBunch\Csv\Formatter\AbstractFormatter 
{
    /**
     * @param array $data
     * @return array
     */
    public static function format(array $data): array
    {
        return self::applyFilter(function ($var) {
            return strtolower($var);
        }, $data);
    }
};
```

For more information, take a look at the [FormatterInterface](../src/Csv/Formatter/FormatterInterface.php) and the [AbstractFormatter](../src/Csv/Formatter/AbstractFormatter.php)

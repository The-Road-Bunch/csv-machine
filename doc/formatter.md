# Formatter

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

class LowerCaseFormatter extends \RoadBunch\Csv\Formatter\Formatter 
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

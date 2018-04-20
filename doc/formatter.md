## Formatter

#### Available Formatters
 FormatterInterface | Ex: original | Ex: formatted 
:-----------|:----------|:-------
SplitCamelCaseWordsFormatter::class | splitCamelCase | split Camel Case 
SplitCamelCaseWordsFormatter::class | TheCSVMachine | The CSV Machine
UnderscoreToSpaceFormatter::class | words_with_underscores | words with underscores 
UpperCaseFormatter::class | upper case formatter | UPPER CASE FORMATTER 
UpperCaseWordsFormatter::class | upper case_words formatter | Upper Case_Words Formatter 

#### Create your own formatter:  
extend `Csv\Formatter\Formatter`  
call `self::filterArray(callable $filter, array $data)`

example:
```php
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

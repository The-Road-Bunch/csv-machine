### Headers
```php
$header = new Header(['first_name', 'last_name', 'email_address']);

$header->addFormatter(new UpperCaseWordsFormatter());
$header->addFormatter(new UnderscoreToSpaceFormatter());

var_dump($header->getColumns());
```
output:
```
array(3) {
  [0] =>
  string(10) "First Name"
  [1] =>
  string(9) "Last Name"
  [2] =>
  string(13) "Email Address"
}
```
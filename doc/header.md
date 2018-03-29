## Header

#### Using Formatters

If you find yourself wanting to clean up those nasty looking header names you pull from the database
or you use for array indexes, worry not! You can create a new header from an array and apply formatting rules.

Here's how:
```php
// example using pre-defined formatters
$header = new Header(['first_name', 'last_name', 'email_address']);

$header->addFormatter(new UpperCaseWordsFormatter());
$header->addFormatter(new UnderscoreToSpaceFormatter());

var_dump($header->getColumns());

// output:
array(3) {
  [0] =>
  string(10) "First Name"
  [1] =>
  string(9) "Last Name"
  [2] =>
  string(13) "Email Address"
}
```

You can also pass in a new formatter object with your own callback function, if you'd like:
```php
// e to 3 example formatter
$header = new Header(['elite', 'gamer', 'speak']);
$header->addFormatter(
    new Formatter(function ($var) {
        return str_ireplace('e', '3', $var);
    })
);

var_dump($header->getColumns());

// output:
array(3) {
  [0] =>
  string(10) "3lit3"
  [1] =>
  string(9) "gam3r"
  [2] =>
  string(13) "sp3ak"
}
```

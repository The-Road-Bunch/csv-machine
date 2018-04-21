# theroadbunch/csv-machine
_A separation values manipulation library_   
  
[![build status](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/build.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/)
[![scrutinzer quality score](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/)
![Code Coverage](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/coverage.png?b=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

### Contents
1. [Release Notes](doc/release.md)
2. [Installation](#installation)
3. [Basic Usage](#basic_usage)  
    a. [Creating a CSV](#create)
4. [Formatters](doc/formatter.md)

### <a name="installation">Installation</a>

`composer require theroadbunch/csv-machine`

### <a name="basic_usage">Basic Usage</a>

#### <a name="create">Creating a CSV</a>
```php
<?php

// create a new Writer object
$csv = new \RoadBunch\Csv\Writer();

// set the header
$csv->setHeader([ 'Column A', 'Column B' ]);

// add some rows
$csv->addRow([ 'data_one_a', 'data_one_b' ]);
$csv->addRow([ 'data_two_a', 'data_two_b' ]);

// save the CSV to a file
$csv->saveToFile('/path/to/filename.csv');

// write the csv to a string
echo $csv->writeToString();
```

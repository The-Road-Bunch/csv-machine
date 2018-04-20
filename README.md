# theroadbunch/csv-machine
_A separation values manipulation library_   
  
[![build status](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/build.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/)
[![scrutinzer quality score](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/)
![Code Coverage](https://scrutinizer-ci.com/g/The-Road-Bunch/csv-machine/badges/coverage.png?b=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

1. [Installation](#installation)
2. [Basic Usage](#basic_usage)
3. [Headers](header.md)
4. [Formatters](formatter.md)

#### <a name="installation">Installation</a>

`composer require theroadbunch/csv-machine`

#### <a name="basic_usage">Basic Usage</a>

```php
// create a new Writer object
$csv = new \RoadBunch\Csv\Writer();

// set the header
$csv->setHeader([ 'Column One', 'Column Two' ]);

// add some rows
$csv->addRow([ 'data_one_a', 'data_one_b' ]);
$csv->addRow([ 'data_two_a', 'data_two_b' ]);

// write the CSV to a file
$csv->saveToFile('sample_file.csv');
```

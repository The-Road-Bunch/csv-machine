<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Csv;


use RoadBunch\Csv\Csv;

class CsvSpy extends Csv
{
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getEnclosure()
    {
        return $this->enclosure;
    }

    public function getNewline()
    {
        return $this->newline;
    }

    public function getEscapeCharacter()
    {
        return $this->escape;
    }
}

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

use RoadBunch\Csv\Writer;

/**
 * Class WriterSpy
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Csv
 */
class WriterSpy extends Writer
{
    public function getHeader()
    {
        return $this->header;
    }

    public function getRows()
    {
        return $this->rows;
    }
}

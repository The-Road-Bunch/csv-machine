<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv;

/**
 * Interface CsvWriterInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
interface CsvWriterInterface
{
    /**
     * @param array $header
     */
    public function setHeader(array $header);
}

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
 * Interface CsvInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
interface CsvInterface
{
    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter);

    /**
     * @param string $enclosure
     */
    public function setEnclosure(string $enclosure);

    /**
     * @param string $newline
     */
    public function setNewline(string $newline);

    /**
     * @param string $escape
     */
    public function setEscape(string $escape);
}

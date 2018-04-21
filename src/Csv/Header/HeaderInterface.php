<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Header;

/**
 * Interface HeaderInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Header
 */
interface HeaderInterface
{
    /**
     * @param string $column
     *
     * @return void
     */
    public function addColumn(string $column);

    /**
     * This method should loop through the formatters
     * calling ->format($header);
     *
     * @return array
     */
    public function getFormattedColumns(): array;

    /**
     * @param mixed $formatter
     * @return HeaderInterface
     */
    public function addFormatter($formatter): HeaderInterface;
}

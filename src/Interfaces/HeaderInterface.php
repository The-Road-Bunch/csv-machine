<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Interfaces;

/**
 * Interface HeaderInterface
 *
 * @package RoadBunch\Csv\Interfaces
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
     * @return array
     */
    public function getColumns(): array;
}

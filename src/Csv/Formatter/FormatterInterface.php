<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Formatter;


/**
 * Interface FormatterInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
interface FormatterInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function format(array $data): array;
}

<?php

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Formatters;


/**
 * Interface FormatterInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatters
 */
interface FormatterInterface
{
    /**
     * @param array $header
     *
     * @return array
     */
    public function format(array $header): array;
}

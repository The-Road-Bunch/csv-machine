<?php declare(strict_types=1);

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
 * Class UnderscoreToSpaceFormatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
class UnderscoreToSpaceFormatter extends AbstractFormatter
{
    /**
     * @param array $data
     *
     * @return array
     * @throws \RoadBunch\Csv\Exception\FormatterResultException
     */
    public static function format(array $data): array
    {
        return self::applyFilter(function ($var) {
            return str_replace('_', ' ', $var);
        }, $data);
    }
}

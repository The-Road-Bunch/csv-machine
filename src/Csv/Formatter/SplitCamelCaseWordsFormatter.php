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
 * Class SplitCamelCaseWordsFormatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
class SplitCamelCaseWordsFormatter extends Formatter
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
            $regex = '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z\.])(?=[A-Z][a-z])/x';
            $words = preg_split($regex, $var, $limit = -1, PREG_SPLIT_NO_EMPTY);

            if (!empty($words)) {
                return implode(' ', $words);
            };
            return $var;
        }, $data);
    }
}

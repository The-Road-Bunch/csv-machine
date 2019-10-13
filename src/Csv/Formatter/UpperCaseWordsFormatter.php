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
 * Class UpperCaseWordsFormatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
class UpperCaseWordsFormatter implements FactoryInterface
{
    public static function create(): FormatterInterface
    {
        return new Formatter(function($var) {
            $del = [" ", "-", "_", "."];
            return ucwords($var, implode('', $del));
        });
    }
}

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

use RoadBunch\Csv\Exception\FormatterResultException;


/**
 * Class Formatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
abstract class AbstractFormatter implements FormatterInterface
{
    protected static function formatElements(callable $filter, array $data): array
    {
        $formatted = [];
        foreach ($data as $element) {
            if (!is_string($element)) {
                throw new \InvalidArgumentException('All elements of the array must be strings');
            }
            if (!is_string($formattedElement = call_user_func($filter, $element))) {
                throw new FormatterResultException('Formatter must result in an array of strings');
            }
            $formatted[] = $formattedElement;
        }
        return $formatted;
    }
}

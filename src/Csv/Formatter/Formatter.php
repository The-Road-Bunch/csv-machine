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

use RoadBunch\Csv\Exception\FormatterDoesNotReturnStringException;


/**
 * Class Formatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
class Formatter implements FormatterInterface
{
    protected $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function format(array $data): array
    {
        $formatted = [];
        foreach ($data as $element) {
            $formatted[] = $this->formatElement($element);
        }
        return $formatted;
    }

    private function formatElement($element): string
    {
        if (!is_string($element)) {
            throw new NonStringElementException();
        }
        return call_user_func($this->callable, $element);
    }
}

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
class Formatter implements FormatterInterface
{
    /** @var callable */
    protected $callback;

    /**
     * Formatter constructor.
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param array $data an array of strings to be formatted
     *
     * @return array
     * @throws \InvalidArgumentException|FormatterResultException
     */
    public function format(array $data): array
    {
        $formatted = [];
        foreach ($data as $element) {
            if (!is_string($element)) {
                throw new \InvalidArgumentException('All elements of the array must be strings');
            }
            if (!is_string($formattedElement = call_user_func($this->callback, $element))) {
                throw new FormatterResultException('Formatter must result in an array of strings');
            }
            $formatted[] = $formattedElement;
        }
        return $formatted;
    }
}

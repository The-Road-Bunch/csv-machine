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
            // assert element to format is string
            $this->assertString($element);
            // assert resulting element is string
            $this->assertResultString($formattedElement = call_user_func($this->callback, $element));

            $formatted[] = $formattedElement;
        }
        return $formatted;
    }

    /**
     * @param $value
     * @throws \InvalidArgumentException
     */
    protected function assertString($value)
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('All elements of the array must be strings');
        }
    }

    /**
     * @param $result
     * @throws FormatterResultException
     */
    protected function assertResultString($result)
    {
        if (!is_string($result)) {
            throw new FormatterResultException('Formatter must result in an array of strings');
        }
    }
}

<?php declare(strict_types=1);

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
 * Class Formatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatters
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
     * @param array $header an array of strings to be formatted
     *
     * @return array
     */
    public function format(array $header): array
    {
        $ret = [];
        foreach ($header as $value) {
            if (!is_string($value)) {
                throw new \InvalidArgumentException('All elements of the array must be strings');
            }
            $ret[] = call_user_func($this->callback, $value);
        }
        return $ret;
    }
}

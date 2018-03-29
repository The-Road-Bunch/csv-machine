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
class SplitCamelCaseWordsFormatter implements FormatterInterface
{
    /** @var FormatterInterface */
    protected $formatter;

    /**
     * SplitCamelCaseWordsFormatter constructor.
     */
    public function __construct()
    {
        // @todo Make sure to uppercase the first word of a string like userFirstName -> User First Name
        $callback = function ($var) {
            $regEx  = '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/x';
            $words  = preg_split($regEx, $var);
            return implode(' ', $words);
        };
        $this->formatter = new Formatter($callback);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function format(array $data): array
    {
        return $this->formatter->format($data);
    }
}

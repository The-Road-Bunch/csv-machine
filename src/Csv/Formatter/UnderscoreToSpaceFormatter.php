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
class UnderscoreToSpaceFormatter implements FormatterInterface
{
    /** @var FormatterInterface */
    protected $formatter;

    /**
     * UnderscoreToSpaceFormatter constructor.
     */
    public function __construct()
    {
        $this->formatter = new Formatter(function ($var) {
            return str_replace('_', ' ', $var);
        });
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

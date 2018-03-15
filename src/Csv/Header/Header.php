<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Header;


use RoadBunch\Csv\Exception\InvalidInputArrayException;
use RoadBunch\Csv\Formatter\FormatterInterface;

/**
 * Class Header
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Header
 */
class Header implements HeaderInterface
{
    /** @var array */
    protected $columns;
    /** @var FormatterInterface[] */
    protected $formatters = [];

    /**
     * Header constructor.
     *
     * @param array $columns array of strings of column names
     *
     * @throws InvalidInputArrayException
     */
    public function __construct(array $columns = [])
    {
        foreach ($columns as $column) {
            if (!is_string($column)) {
                throw new InvalidInputArrayException('Columns must be array of (string)');
            }
        }
        $this->columns = $columns;
    }

    /**
     * @param string $column
     *
     * @return void
     */
    public function addColumn(string $column)
    {
        $this->columns[] = $column;
    }

    /**
     * @param FormatterInterface $formatter
     */
    public function addFormatter(FormatterInterface $formatter)
    {
        $this->formatters[] = $formatter;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        $columns = $this->columns;

        foreach ($this->formatters as $formatter) {
            $columns = $formatter->format($columns);
        }
        return $columns;
    }
}

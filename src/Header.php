<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv;


use RoadBunch\Csv\Exceptions\InvalidHeaderArrayException;
use RoadBunch\Csv\Interfaces\HeaderInterface;

/**
 * Class Header
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Header implements HeaderInterface
{
    protected $columns;

    /**
     * Header constructor.
     *
     * @param array $columns
     *
     * @throws InvalidHeaderArrayException
     */
    public function __construct(array $columns = [])
    {
        foreach ($columns as $column) {
            if (!is_string($column)) {
                throw new InvalidHeaderArrayException('Columns must be array of (string)');
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
        if (!in_array($column, $this->columns)) {
            $this->columns[] = $column;
        }
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }
}

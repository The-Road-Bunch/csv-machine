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

use RoadBunch\Csv\Exception\InvalidInputArrayException;

/**
 * Class Writer
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Writer extends Csv implements WriterInterface
{
    /** @var array */
    protected $header;

    /** @var string */
    protected $filename;

    /** @var array */
    protected $rows = [];

    /**
     * @param array $header
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
        array_unshift($this->rows, $header);
    }

    /**
     * Writer constructor.
     *
     * @param string $filename
     * @throws \Exception
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;

        // attempt to open the file one time
        // this will create the file if it doesn't exist
        $handle = $this->openStream();
        $this->closeStream($handle);
    }

    /**
     * @param  array $row
     * @return WriterInterface
     */
    public function addRow(array $row): WriterInterface
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * @param array $rows
     * @throws InvalidInputArrayException
     */
    public function addRows(array $rows)
    {
        foreach ($rows as $row) {
            if (!is_array($row)) {
                throw new InvalidInputArrayException('Element must be an array');
            }
            $this->rows[] = $row;
        }
    }

    /**
     * @return bool|resource
     * @throws \Exception
     */
    private function openStream()
    {
        $handle = fopen($this->filename, 'a');
        if (false === $handle) {
            throw new \Exception(sprintf('Cannot open steam: %s', $this->filename));
        }
        return $handle;
    }

    private function closeStream($handle)
    {
        fclose($handle);
    }
}

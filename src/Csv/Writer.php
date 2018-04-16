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

    /** @var array */
    protected $rows = [];

    /** @var bool */
    protected $isStreamSeekable = false;

    /**
     * @param array $header
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
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
     * Write the CSV to the stream
     *
     * @param string $filename
     */
    public function write(string $filename)
    {
        $handle = $this->openStream($filename);
        $this->writeRows($handle);
        $this->closeStream($handle);
    }

    /**
     * @param string $filename
     * @return bool|resource
     */
    private function openStream(string $filename)
    {
        $handle = fopen($filename, 'w+');
        $this->setSeekableFlag($handle);
        return $handle;
    }

    /**
     * @param $handle
     */
    private function closeStream($handle)
    {
        fclose($handle);
    }

    /**
     * @param resource $handle
     */
    private function updateNewLine($handle)
    {
        if ((Newline::NEWLINE_LF !== $this->newline) && (0 === fseek($handle, -1, SEEK_CUR))) {
            fwrite($handle, $this->newline);
        }
    }

    /**
     * @param $handle
     * @param $row
     */
    private function writeRow($handle, $row)
    {
        fputcsv($handle, $row, $this->delimiter, $this->enclosure, $this->escape);

        if ($this->isStreamSeekable) {
            $this->updateNewLine($handle);
        }
    }

    /**
     * @param resource $handle
     */
    private function writeRows($handle)
    {
        if ($this->header) {
            $this->writeRow($handle, $this->header);
        }
        foreach ($this->rows as $row) {
            $this->writeRow($handle, $row);
        }
    }

    /**
     * Checks resource, if it's seekable set the seekable flag
     * this will be used when determining if line endings should be updated
     *
     * @param resource $handle
     */
    private function setSeekableFlag($handle)
    {
        if (stream_get_meta_data($handle)['seekable']) {
            $this->isStreamSeekable = true;
            return;
        }
        // @todo: add return for not seekable. I haven't written a test for it, so that's why it's not here
        // @todo: but it is definitely a bug
    }
}

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
use RoadBunch\Csv\Formatter\FormatterInterface;
use RoadBunch\Csv\Header\Header;

/**
 * Class Writer
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Writer extends Csv implements WriterInterface
{
    /** @var array */
    protected $header = [];

    /** @var array */
    protected $rows = [];

    /** @var bool */
    protected $isStreamSeekable = false;

    /** @var resource|bool */
    protected $handle;

    /**
     * @param array $header
     * @param FormatterInterface[] $formatters
     * @throws InvalidInputArrayException
     */
    public function setHeader(array $header, array $formatters = [])
    {
        $header = new Header($header);
        foreach ($formatters as $formatter) {
            $header->addFormatter($formatter);
        }
        $this->header = $header->getFormattedColumns();
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
        $this->openStream($filename);
        $this->writeRows();
        $this->closeStream();
    }

    /**
     * @param string $filename
     */
    private function openStream(string $filename)
    {
        $this->handle = fopen($filename, 'w+');
        $this->setSeekableFlag();
    }

    /**
     * Close the stream
     */
    private function closeStream()
    {
        fclose($this->handle);
    }

    /**
     * If the requested newline is not PHP default \n update the newline character
     */
    private function updateNewLine()
    {
        if ((Newline::NEWLINE_LF !== $this->newline) && (0 === fseek($this->handle, -1, SEEK_CUR))) {
            fwrite($this->handle, $this->newline);
        }
    }

    /**
     * Write a row to the stream, if needed, update line endings
     *
     * @param $row
     */
    private function writeRow(array $row)
    {
        fputcsv($this->handle, $row, $this->delimiter, $this->enclosure, $this->escape);

        if ($this->isStreamSeekable) {
            $this->updateNewLine();
        }
    }

    /**
     * Write CSV header and rows to stream
     */
    private function writeRows()
    {
        if (!empty($this->header)) {
            $this->writeRow($this->header);
        }
        foreach ($this->rows as $row) {
            $this->writeRow($row);
        }
    }

    /**
     * Checks resource, if it's seekable set the seekable flag
     * this will be used when determining if line endings should be updated
     */
    private function setSeekableFlag()
    {
        if (stream_get_meta_data($this->handle)['seekable']) {
            $this->isStreamSeekable = true;
            return;
        }
        // @todo: add return for not seekable. I haven't written a test for it, so that's why it's not here
        // @todo: but it is definitely a bug
    }
}

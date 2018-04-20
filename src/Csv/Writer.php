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

use RoadBunch\Csv\Exception\FormatterException;
use RoadBunch\Csv\Exception\InvalidInputArrayException;
use RoadBunch\Csv\Header\Header;
use RoadBunch\Csv\Header\HeaderInterface;

/**
 * Class Writer
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Writer extends Csv implements WriterInterface
{
    /** @var HeaderInterface */
    protected $header;

    /** @var array */
    protected $rows = [];

    /** @var bool */
    protected $isStreamSeekable = false;

    /** @var resource */
    protected $handle;

    /**
     * @param array $header
     * @param mixed $formatters
     * @return void
     * @throws FormatterException
     * @throws InvalidInputArrayException
     */
    public function setHeader(array $header, array $formatters = [])
    {
        $header = new Header($header);
        foreach ($formatters as $formatter) {
            $header->addFormatter($formatter);
        }
        $this->header = $header;
    }

    /**
     * No row array passed will create an empty row
     *
     * @param  array $row
     * @return void
     */
    public function addRow(array $row = [])
    {
        $this->rows[] = $row;
    }

    /**
     * @param array $rows
     * @throws InvalidInputArrayException
     * @return void
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
     * @return string
     * @throws \Exception
     */
    public function writeToString(): string
    {
        ob_start();
        $this->saveToFile('php://output');
        return ob_get_clean();
    }

    /**
     * Write the CSV to the stream
     *
     * @param string $filename
     * @throws \Exception
     */
    public function saveToFile(string $filename)
    {
        $this->openStream($filename);
        $this->writeRows();
        $this->closeStream();
    }

    /**
     * @param string $filename
     * @throws \Exception
     */
    private function openStream(string $filename)
    {
        $this->handle = fopen($filename, 'w+');

        if (false === $this->handle) {
            throw new \Exception(sprintf('Could not open file for writing. %s', error_get_last()['message']));
        }
        $this->setSeekableFlag();
    }

    /**
     * Write CSV header and rows to stream
     */
    private function writeRows()
    {
        if (!empty($this->header)) {
            $this->writeRow($this->header->getFormattedColumns());
        }
        foreach ($this->rows as $row) {
            $this->writeRow($row);
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
     * If the requested newline is not PHP default \n update the newline character
     */
    private function updateNewLine()
    {
        if ((Newline::NEWLINE_LF !== $this->newline) && (0 === fseek($this->handle, -1, SEEK_CUR))) {
            fwrite($this->handle, $this->newline);
        }
    }

    /**
     * Close the stream
     */
    private function closeStream()
    {
        fclose($this->handle);
    }

    /**
     * Checks resource, if it's seekable set the seekable flag
     * this will be used when determining if line endings should be/can be updated
     */
    private function setSeekableFlag()
    {
        if (stream_get_meta_data($this->handle)['seekable']) {
            $this->isStreamSeekable = true;
            return;
        }
        $this->isStreamSeekable = false;
    }
}

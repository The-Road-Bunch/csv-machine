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


/**
 * Class Csv
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class Csv implements CsvInterface
{
    protected $delimiter = Delimiter::DELIMITER_COMMA;
    protected $enclosure = Enclosure::ENCLOSURE_DOUBLE_QUOTE;
    protected $newline   = Newline::NEWLINE_LF;
    protected $escape    = Escape::ESCAPE_CHAR;

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * @param string $enclosure
     */
    public function setEnclosure(string $enclosure)
    {
        $this->enclosure = $enclosure;
    }

    /**
     * @param string $newline
     */
    public function setNewline(string $newline)
    {
        $this->newline = $newline;
    }

    /**
     * @param string $escape
     */
    public function setEscape(string $escape)
    {
        $this->escape = $escape;
    }
}

<?php

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
 * Interface CsvInterface
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
interface CsvInterface
{
    // delimiter
    const DELIMITER_COMMA     = ",";
    const DELIMITER_PIPE      = "|";
    const DELIMITER_SEMICOLON = ";";
    const DELIMITER_TAB       = "\t";

    // new line
    const NEWLINE_LF   = "\n";
    const NEWLINE_CR   = "\r";
    const NEWLINE_CRLF = "\r\n";

    // enclosure
    const ENCLOSURE_QUOTE = '"';

    // escape char
    const ESCAPE_CHAR = "\\";
}

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

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Csv
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
abstract class Csv implements CsvInterface
{
    protected $delimiter = Delimiter::DELIMITER_COMMA;
    protected $enclosure = Enclosure::ENCLOSURE_DOUBLE_QUOTE;
    protected $newline   = Newline::NEWLINE_LF;
    protected $escape    = Escape::ESCAPE_CHAR;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Csv constructor.
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = null !== $logger ? $logger : new NullLogger();
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
        $this->logger->info('Delimiter character set ' . json_encode($delimiter));
    }

    /**
     * @param string $enclosure
     */
    public function setEnclosure(string $enclosure)
    {
        $this->enclosure = $enclosure;
        $this->logger->info('Enclosure character set ' . json_encode($enclosure));
    }

    /**
     * @param string $newline
     */
    public function setNewline(string $newline)
    {
        $this->newline = $newline;
        $this->logger->info('Newline character set ' . json_encode($newline));
    }

    /**
     * @param string $escape
     */
    public function setEscape(string $escape)
    {
        $this->escape = $escape;
        $this->logger->info('Escape character set ' . json_encode($escape));
    }
}

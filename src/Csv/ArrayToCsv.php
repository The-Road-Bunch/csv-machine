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
 * Class ArrayToCsv
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class ArrayToCsv
{
    private $header;
    private $data;
    private $handle;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function writeToPath(string $path): void
    {
        $this->openCsv($path);

        $this->writeHeader();
        $this->writeRows();

        $this->closeCsv();
    }

    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    private function openCsv(string $path): void
    {
        $this->handle = fopen($path, 'w');
    }

    private function writeRows(): void
    {
        foreach ($this->data as $data) {
            fputcsv($this->handle, $data);
        }
    }

    private function writeHeader(): void
    {
        if ($this->header) {
            fputcsv($this->handle, $this->header);
        }
    }

    private function closeCsv(): void
    {
        if (!is_null($this->handle)) {
            fclose($this->handle);
        }
    }
}

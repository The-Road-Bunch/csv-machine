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


class StreamHandler
{
    protected $handle;
    protected $path;

    /**
     * StreamHandler constructor.
     *
     * If passing a filename, the default mode will be READ ONLY for safety
     * if you want to write to a file, pass a new mode
     *
     * @param        $resource
     * @param string $mode
     */
    public function __construct($resource, string $mode = 'r')
    {
        if (is_resource($resource)) {
            $this->handle = $resource;
        } elseif (is_string($resource)) {
            $this->path = $resource;
        }
    }
}

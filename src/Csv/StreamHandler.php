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
 * Class StreamHandler
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv
 */
class StreamHandler
{
    /** @var null|resource */
    protected $handle = null;
    /** @var string */
    protected $path;
    /** @var string */
    protected $mode;

    /**
     * StreamHandler constructor.
     *
     * If passing a filename, the default mode will be READ ONLY for safety
     * if you want to write to a file, pass a new mode
     *
     * @param resource|string $resource
     * @param string          $mode
     */
    public function __construct($resource, string $mode = 'r')
    {
        if (is_resource($resource)) {
            $this->handle = $resource;
            $this->mode   = stream_get_meta_data($resource)['mode'];
        } elseif (is_string($resource)) {
            $this->path = $resource;
            $this->mode = $mode;
        } else {
            throw new \InvalidArgumentException('Argument must be a resource or a filename');
        }
    }

    public function open()
    {
        if (null !== $this->handle) {
            return $this->handle;
        }
        $this->handle = fopen($this->path, $this->mode);
        return $this->handle;
    }

    public function getStream()
    {
        return $this->handle;
    }

    public function close()
    {
        if ($this->path && (null !== $this->handle)) {
            fclose($this->handle);
        }
        $this->handle = null;
    }
}

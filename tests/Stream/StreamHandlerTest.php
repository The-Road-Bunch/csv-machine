<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Stream;

use PHPUnit\Framework\TestCase;

/**
 * Class StreamHandlerTest
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Stream
 */
class StreamHandlerTest extends TestCase
{
    protected $filename;

    public function setUp()
    {
        $this->filename = sprintf('%s.csv', uniqid());
    }

    public function tearDown()
    {
        if (is_file($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testResourceSetsHandle()
    {
        touch($this->filename);
        $resource = fopen($this->filename, 'r');
        $handler = new StreamHandlerSpy($resource);

        $this->assertInternalType('resource', $handler->getHandle());
    }

    public function testStringSetsPath()
    {
        $handler = new StreamHandlerSpy($this->filename);
        $this->assertEquals($this->filename, $handler->getPath());
    }
}

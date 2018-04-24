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
use RoadBunch\Csv\StreamHandler;

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
        $this->filename = sprintf('%s/%s.csv', __DIR__, uniqid());
    }

    public function tearDown()
    {
        if (is_file($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testResourceSetsHandleAndMode()
    {
        $streamHandler = new StreamHandlerSpy(fopen($this->filename, 'w'));
        $this->assertInternalType('resource', $streamHandler->getHandle());
        $this->assertEquals('w', $streamHandler->getMode());
    }

    public function testStringSetsPathAndMode()
    {
        $streamHandler = new StreamHandlerSpy($this->filename, 'a+');
        $this->assertEquals($this->filename, $streamHandler->getPath());
        $this->assertEquals('a+', $streamHandler->getMode());
    }

    public function testNonResourceThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new StreamHandler([]);
    }

    public function testGetStream()
    {
        $streamHandler = new StreamHandler(fopen($this->filename, 'w'));
        $this->assertInternalType('resource', $streamHandler->getStream());
    }

    public function testOpenFileStream()
    {
        $streamHandler = new StreamHandler($this->filename, 'w');
        $this->assertInternalType('resource', $streamHandler->open());
        $this->assertInternalType('resource', $streamHandler->getStream());
    }

    public function testCloseFileStream()
    {
        $streamHandler = new StreamHandler($this->filename, 'w');

        $handle = $streamHandler->open();
        $streamHandler->close();
        $this->assertNull($streamHandler->getStream());
        $this->assertFalse(is_resource($handle));
    }

    public function testAlreadyOpenedStreamReturnsResource()
    {
        $streamHandler = new StreamHandler(fopen($this->filename, 'w'));
        $this->assertInternalType('resource', $streamHandler->open());
        $this->assertInternalType('resource', $streamHandler->getStream());
    }

    public function testCloseProvidedStreamSetsNullAndLeavesHandleOpen()
    {
        $streamHandler = new StreamHandler(fopen($this->filename, 'w'));

        $handle = $streamHandler->getStream();
        $streamHandler->close();
        $this->assertNull($streamHandler->getStream());
        $this->assertTrue(is_resource($handle));
    }
}

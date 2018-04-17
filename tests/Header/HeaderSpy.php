<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Tests\Header;


use RoadBunch\Csv\Header\Header;

/**
 * Class HeaderSpy
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Tests\Header
 */
class HeaderSpy extends Header
{
    public function getFormatters()
    {
        return $this->formatters;
    }
}

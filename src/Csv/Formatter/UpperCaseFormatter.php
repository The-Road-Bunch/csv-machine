<?php declare(strict_types=1);

/**
 * This file is part of the Csv-Machine package.
 *
 * (c) Dan McAdams <danmcadams@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RoadBunch\Csv\Formatter;


/**
 * Class UpperCaseFormatter
 *
 * @author  Dan McAdams
 * @package RoadBunch\Csv\Formatter
 */
class UpperCaseFormatter extends Formatter
{
    /**
     * UpperCaseFormatter constructor.
     */
    public function __construct()
    {
        parent::__construct('mb_strtoupper');
    }
}

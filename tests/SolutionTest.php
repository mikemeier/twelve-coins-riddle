<?php

namespace Solution\Test;

use Riddle\Tradesman;
use Solution\Solution;

/**
 * Created by PhpStorm.
 * Project: twelve-coins-riddle
 * 
 * User: mikemeier
 * Date: 21.01.15
 * Time: 19:03
 */
class SolutionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSolution()
    {
        $marc = new Solution();
        $tradesman = new Tradesman();

        list($index, $intention) = $marc->getSolution();

        $this->assertTrue($tradesman->resolve($index, $intention), 'Wrong answer! - Please try again :-)');
    }
}
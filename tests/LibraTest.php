<?php

/**
 * Created by PhpStorm.
 * Project: twelve-coins-riddle
 * 
 * User: mikemeier
 * Date: 21.01.15
 * Time: 19:23
 */

namespace Solution\Test;

use Riddle\Libra;
use Riddle\Tradesman;

class LibraTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid index - use 0 to 11
     */
    public function testConstructIndex()
    {
        new Libra(12, Libra::COIN_HEAVY);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid intentation - use Libra::COIN_HEAVY or Libra::COIN_LIGHT
     */
    public function testConstructIntention()
    {
        new Libra(10, 'foo');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Running out of libras
     */
    public function testConstructInstances()
    {
        new Libra(1, Libra::COIN_HEAVY);
        new Libra(1, Libra::COIN_HEAVY);
    }

    public function testThreeAttempts()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);

        $libra->weigh();
        $libra->weigh();
        $libra->weigh();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Only 3 attempts!
     */
    public function testTooMuchAttempts()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);

        $libra->weigh();
        $libra->weigh();
        $libra->weigh();
        $libra->weigh();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Its not possible to weigh the same coins on the left and on the right side: (1, 5, 4)
     */
    public function testDuplicates()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);
        $libra->weigh(array(0, 1, 5, 10, 4), array(1, 2, 8, 5, 3, 4));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage There are invalid coins: (12, 15)
     */
    public function testInvalidCoins()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);
        $libra->weigh(array(0, 1, 12), array(5, 2, 8, 15));
    }

    public function testMoreCoinsOnLeft()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);
        $this->assertSame(Libra::WEIGH_LEFT_HEAVIER, $libra->weigh(array(0, 1), array(2)));
    }

    public function testMoreCoinsOnRight()
    {
        $libra = new Libra(0, Libra::COIN_HEAVY);
        $this->assertSame(Libra::WEIGH_LEFT_LIGHTER, $libra->weigh(array(0), array(1, 2)));
    }

    public function testLightCoin()
    {
        $libra = new Libra(5, Libra::COIN_LIGHT);

        $this->assertSame(Libra::WEIGH_EVEN, $libra->weigh(array(1, 2, 3), array(4, 6, 7)));
        $this->assertSame(Libra::WEIGH_LEFT_LIGHTER, $libra->weigh(array(1, 5, 3), array(4, 6, 7)));
        $this->assertSame(Libra::WEIGH_LEFT_HEAVIER, $libra->weigh(array(1, 6, 3), array(4, 5, 7)));
    }

    public function testHeavyCoin()
    {
        $libra = new Libra(5, Libra::COIN_HEAVY);

        $this->assertSame(Libra::WEIGH_EVEN, $libra->weigh(array(1, 2, 3), array(4, 6, 7)));
        $this->assertSame(Libra::WEIGH_LEFT_HEAVIER, $libra->weigh(array(1, 5, 3), array(4, 6, 7)));
        $this->assertSame(Libra::WEIGH_LEFT_LIGHTER, $libra->weigh(array(1, 6, 3), array(4, 5, 7)));
    }
}
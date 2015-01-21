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

class TradesmanTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid index - use 0 to 11
     */
    public function testResolveIndex()
    {
        $tradesman = new Tradesman();
        $tradesman->resolve(12, Libra::COIN_HEAVY);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid intentation - use Libra::COIN_HEAVY or Libra::COIN_LIGHT
     */
    public function testResolveIntentation()
    {
        $tradesman = new Tradesman();
        $tradesman->resolve(0, 'foo');
    }

    public function testThreeAttempts()
    {
        $tradesman = new Tradesman();
        $tradesman->resolve(1, Libra::COIN_HEAVY);
        $tradesman->resolve(2, Libra::COIN_HEAVY);
        $tradesman->resolve(3, Libra::COIN_LIGHT);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Maximum 3 attempts!
     */
    public function testTooMuchAttempts()
    {
        $tradesman = new Tradesman();
        $tradesman->resolve(1, Libra::COIN_HEAVY);
        $tradesman->resolve(2, Libra::COIN_HEAVY);
        $tradesman->resolve(3, Libra::COIN_LIGHT);
        $tradesman->resolve(4, Libra::COIN_LIGHT);
    }

    public function testCorrectAnswer()
    {
        $tradesman = new Tradesman();

        $reflection = new \ReflectionClass($tradesman);

        $prop = $reflection->getProperty('index');
        $prop->setAccessible(true);
        $prop->setValue($tradesman, 5);

        $prop = $reflection->getProperty('intention');
        $prop->setAccessible(true);
        $prop->setValue($tradesman, Libra::COIN_LIGHT);

        $attemptsProp = $reflection->getProperty('attempts');
        $attemptsProp->setAccessible(true);

        for ($index = 0; $index <= 11; $index++) {
            foreach (array(Libra::COIN_LIGHT, Libra::COIN_HEAVY) as $intention) {
                $attemptsProp->setValue($tradesman, 0);

                if ($index === 5 && $intention === Libra::COIN_LIGHT) {
                    $this->assertTrue($tradesman->resolve($index, $intention));
                } else {
                    $this->assertFalse($tradesman->resolve($index, $intention));
                }
            }
        }

    }
}
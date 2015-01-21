<?php

namespace Riddle;

/**
 * Created by PhpStorm.
 * Project: twelve-coins-riddle
 *
 * User: mikemeier
 * Date: 21.01.15
 * Time: 18:44
 */
final class Libra
{
    const
        // Coin is heavier
        COIN_HEAVY = 'heavy',

        // Coin is lighter
        COIN_LIGHT = 'light',

        // Both sides same weight
        WEIGH_EVEN = 'even',

        // Left side heavier
        WEIGH_LEFT_HEAVIER = 'left_heavier',

        // Left side lighter
        WEIGH_LEFT_LIGHTER = 'left_lighter';

    /**
     * @var int
     */
    private static $instances = 0;

    /**
     * @var int
     */
    private static $attempts = 0;

    /**
     * @var int
     */
    private $index;

    /**
     * @var string
     */
    private $intention;

    /**
     * @param int $index
     * @param string $intention
     * @throws \Exception
     */
    final public function __construct($index, $intention)
    {
        if (!is_int($index) || $index < 0 || $index > 11) {
            throw new \Exception("Invalid index - use 0 to 11");
        }

        if (!in_array($intention, array(Libra::COIN_HEAVY, Libra::COIN_LIGHT))) {
            throw new \Exception("Invalid intentation - use Libra::COIN_HEAVY or Libra::COIN_LIGHT");
        }

        $this->index = $index;
        $this->intention = $intention;

        self::$instances++;
        if (self::$instances > 1) {
            throw new \RuntimeException("Running out of libras");
        }
    }

    /**
     * @param array $left indexes (0-11)
     * @param array $right indexes(0-11)
     * @return string
     * @throws \Exception
     */
    final public function weigh(array $left = array(), array $right = array())
    {
        self::$attempts++;
        if (self::$attempts > 3) {
            throw new \Exception("Only 3 attempts!");
        }

        // Duplicates ?
        $duplicates = $this->getDuplicates(array_merge($left, $right));
        if (count($duplicates) > 0) {
            throw new \Exception("Its not possible to weigh the same coins on the left and on the right side: (" . implode(", ", $duplicates) . ")");
        }

        // Invalid coins
        $invalidCoins = array_diff(array_merge($left, $right), range(0, 11));
        if (count($invalidCoins) > 0) {
            throw new \Exception("There are invalid coins: (" . implode(", ", $invalidCoins) . ")");
        }

        $leftCount = count($left);
        $rightCount = count($right);

        // Left more coins then right
        if ($leftCount > $rightCount) {
            return self::WEIGH_LEFT_HEAVIER;
        }

        // Left less coins then right
        if ($leftCount < $rightCount) {
            return self::WEIGH_LEFT_LIGHTER;
        }

        // Special coin found on left side
        if(in_array($this->index, $left)){
            return $this->intention === self::COIN_LIGHT ? self::WEIGH_LEFT_LIGHTER : self::WEIGH_LEFT_HEAVIER;
        }

        // Special coin found on left side
        if(in_array($this->index, $right)){
            return $this->intention === self::COIN_LIGHT ? self::WEIGH_LEFT_HEAVIER : self::WEIGH_LEFT_LIGHTER;
        }

        return self::WEIGH_EVEN;
    }

    /**
     * @param array $coins
     * @return array
     */
    final private function getDuplicates(array $coins)
    {
        $dups = array();
        foreach (array_count_values($coins) as $val => $c) {
            if ($c > 1) {
                $dups[] = $val;
            }
        }
        return $dups;
    }
}
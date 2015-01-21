<?php

namespace Solution;

use Riddle\Libra;

/**
 * Created by PhpStorm.
 * Project: twelve-coins-riddle
 *
 * User: mikemeier
 * Date: 21.01.15
 * Time: 19:00
 */
class Solution
{
    /**
     * @param Libra $libra
     * @return array
     * @see Riddle\Libra for index and intention
     */
    public function getSolution(Libra $libra)
    {
        // Coin with index 0 is heavier
        return array(0, Libra::COIN_HEAVY);
    }
}
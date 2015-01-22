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
        $map = [
            'left_heavier' => 'l',
            'even' => 'n',
            'left_lighter' => 'r'
        ];

        $idx =  $map[$libra->weigh([0,4,7,10] , [3,6,11,9])];
        $idx .= $map[$libra->weigh([1,5,8,11] , [3,7,10,9])];
        $idx .= $map[$libra->weigh([2,5,10,11] , [4,6,8,9])];

        return [
            'lnn' => [0, Libra::COIN_HEAVY],
            'rnn' => [0, Libra::COIN_LIGHT],
            'nln' => [1, Libra::COIN_HEAVY],
            'nrn' => [1, Libra::COIN_LIGHT],
            'nnl' => [2, Libra::COIN_HEAVY],
            'nnr' => [2, Libra::COIN_LIGHT],
            'rrn' => [3, Libra::COIN_HEAVY],
            'lln' => [3, Libra::COIN_LIGHT],
            'lnr' => [4, Libra::COIN_HEAVY],
            'rnl' => [4, Libra::COIN_LIGHT],
            'nll' => [5, Libra::COIN_HEAVY],
            'nrr' => [5, Libra::COIN_LIGHT],
            'rnr' => [6, Libra::COIN_HEAVY],
            'lnl' => [6, Libra::COIN_LIGHT],
            'lrn' => [7, Libra::COIN_HEAVY],
            'rln' => [7, Libra::COIN_LIGHT],
            'nlr' => [8, Libra::COIN_HEAVY],
            'nrl' => [8, Libra::COIN_LIGHT],
            'rrr' => [9, Libra::COIN_HEAVY],
            'lll' => [9, Libra::COIN_LIGHT],
            'lrl' => [10, Libra::COIN_HEAVY],
            'rlr' => [10, Libra::COIN_LIGHT],
            'rll' => [11, Libra::COIN_HEAVY],
            'lrr' => [11, Libra::COIN_LIGHT]
        ][$idx];
    }
}
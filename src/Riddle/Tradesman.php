<?php

namespace Riddle;

/**
 * Created by PhpStorm.
 * Project: twelve-coins-riddle
 *
 * User: mikemeier
 * Date: 21.01.15
 * Time: 18:52
 */
final class Tradesman
{
    /**
     * @var int
     */
    private $attempts = 0;
    /**
     * @var Libra
     */
    private $libra;
    /**
     * @var int
     */
    private $index;
    /**
     * @var string
     */
    private $intention;

    final public function __construct()
    {
        $intentions = array(Libra::COIN_HEAVY, Libra::COIN_LIGHT);

        $this->index = mt_rand(0, 11);
        $this->intention = $intentions[mt_rand(0, 1)];

        $this->libra = new Libra($this->index, $this->intention);
    }

    /**
     * @return Libra
     */
    public function getLibra()
    {
        return $this->libra;
    }

    /**
     * @param int $index
     * @param string $intention
     * @return bool
     * @throws \Exception
     */
    final public function resolve($index, $intention)
    {
        if (!is_int($index) || $index < 0 || $index > 11) {
            throw new \Exception("Invalid index - use 0 to 11");
        }

        if (!in_array($intention, array(Libra::COIN_HEAVY, Libra::COIN_LIGHT))) {
            throw new \Exception("Invalid intentation - use Libra::COIN_HEAVY or Libra::COIN_LIGHT");
        }

        $this->attempts++;
        if ($this->attempts > 3) {
            throw new \Exception("Maximum 3 attempts!");
        }

        if ($index !== $this->index || $intention !== $this->intention) {
            return false;
        }

        return true;
    }
}
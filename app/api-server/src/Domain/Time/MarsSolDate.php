<?php


namespace App\Domain\Time;


/**
 * Class MarsSolDate
 * @package App\Domain\Time
 */
class MarsSolDate
{
    /**
     * @var float
     */
    public $msd = 0;

    /**
     * MarsSolDate constructor.
     * @param  float  $j2000
     */
    public function __construct(float $j2000)
    {
        $this->msd = ((($j2000 - 4.5) / 1.027491252) + 44796.0 - 0.00096);
    }


    /**
     * @return float
     */
    public function getMsd(): float
    {
        return $this->msd;
    }
}

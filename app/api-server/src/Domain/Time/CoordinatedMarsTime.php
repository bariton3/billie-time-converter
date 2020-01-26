<?php


namespace App\Domain\Time;


/**
 * Class CoordinatedMarsTime
 * @package App\Domain\Time
 */
class CoordinatedMarsTime
{
    /**
     * @var float
     */
    public $mtc = 0;

    /**
     * CoordinatedMarsTime constructor.
     * @param  float  $msd
     */
    public function __construct(float $msd)
    {
        $this->mtc = fmod((24 * $msd),24);
    }

    /**
     * @return string
     */
    public function getMtc(){

        $x = $this->mtc * 3600;
        $hh = floor($this->mtc);
        if($hh < 10) $hh =  '0' . $this->mtc;

        $y = $x % 3600;
        $mm = floor($y / 60);
        if ($mm < 10) $mm = '0' . $mm;

        $ss = floor($y % 60);
        if ($ss < 10) $ss = '0' . $ss;

        return $hh . ":" . $mm . ":" . $ss;
    }
}

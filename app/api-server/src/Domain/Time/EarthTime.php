<?php


namespace App\Domain\Time;


use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class EarthTime
 * @package App\Domain\Time
 */
class EarthTime
{

    /**
     * The number of milliseconds since 1 January 1970 00:00:00 UTC.
     *
     * @var float
     */
    public $milliseconds = 0;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * Julian Date (UT)
     * This number of days (rather than milliseconds) since a much older epoch than Unix time.
     *
     * @var float
     */
    public $jdUT = 0;

    /**
     * Julian Date (TT)
     * We actually need the Terrestrial Time (TT) Julian Date rather than the UTC-based one.
     * This means we basically just add the leap seconds which, since
     *
     * @var float
     */
    public $jdTT = 0;

    /**
     * Days since J2000 Epoch
     * @var float
     */
    public $j2000 = 0;

    /**
     * EarthTime constructor.
     * @param  \DateTime  $dateTime
     * @throws \Exception
     */
    public function __construct(\DateTime $dateTime)
    {
        $this->date = $dateTime;
    }

    /**
     * @return float
     */
    public function getMilliseconds(): float
    {
        return $this->milliseconds;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function setMilliseconds(): void
    {
        $this->milliseconds = round(($this->date->getTimestamp() . '.' . $this->date->format('u')) * 1000);
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }


    /**
     * @return float
     */
    public function getJdUT(): float
    {
        return $this->jdUT;
    }

    /**
     * @param  float  $milliseconds
     */
    public function setJdUT(float $milliseconds): void
    {
        $this->jdUT = 2440587.5 + ($milliseconds / (8.64 * (10**7)));
    }

    /**
     * @return float
     */
    public function getJdTT(): float
    {
        return $this->jdTT;
    }

    /**
     * @param  float  $jdTT
     */
    public function setJdTT(float $jdUT): void
    {
        $this->jdTT = $jdUT + (35 + 32.184) / 86400;
    }

    /**
     * @return float
     */
    public function getJ2000(): float
    {
        return $this->j2000;
    }

    /**
     * @param  float  $jdTT
     */
    public function setJ2000(float $jdTT): void
    {
        $this->j2000 = $jdTT - 2451545.0;
    }
}

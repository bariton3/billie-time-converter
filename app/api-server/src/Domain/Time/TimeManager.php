<?php

namespace App\Domain\Time;

/**
 * Class TimeManager
 * @package App\Domain\Time
 */
class TimeManager implements TimeManagerInterface
{

    /**
     * @var EarthTime
     */
    private EarthTime $earthTime;
    /**
     * @var MarsSolDate
     */
    private MarsSolDate $marsSolDate;
    /**
     * @var CoordinatedMarsTime
     */
    private CoordinatedMarsTime $coordinatedMarsTime;

    /**
     * @param  \DateTime  $dateTime
     * @throws \Exception
     */
    public function setDateTime( \DateTime $dateTime):void
    {
        $this->earthTime = new EarthTime($dateTime);
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function prepareEarthTimeFor(){

        $this->earthTime->setMilliseconds();
        $milliseconds = $this->earthTime->getMilliseconds();

        $this->earthTime->setJdUT($milliseconds);
        $jdUT = $this->earthTime->getJdUT();

        $this->earthTime->setJdTT($jdUT);
        $jdTT = $this->earthTime->getJdTT();

        $this->earthTime->setJ2000($jdTT);

        return $this->earthTime->getJ2000();
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getMarsSolDate(): float
    {
        $this->marsSolDate = new MarsSolDate($this->prepareEarthTimeFor());
        return $this->marsSolDate->getMsd();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCoordinatedMarsTime(): string
    {
        $msd = (new MarsSolDate($this->prepareEarthTimeFor()))->getMsd();
        $this->coordinatedMarsTime = new CoordinatedMarsTime($msd);
        return $this->coordinatedMarsTime->getMtc();
    }
}

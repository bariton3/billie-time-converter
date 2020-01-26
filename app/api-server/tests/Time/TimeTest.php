<?php
namespace App\Tests\Time;

use App\Domain\Time\TimeManager;
use App\Domain\Time\EarthTime;
use PHPUnit\Framework\TestCase;

/**
 * Class TimeTest
 * @package App\Tests\Time
 */
class TimeTest extends TestCase
{


    /**
     * @var TimeManager
     */
    public $timeManager;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        $this->date = new \DateTime('2020-02-26 20:00:00');
        $this->timeManager = new TimeManager();
        $this->timeManager->setDateTime($this->date);
        $this->timeManager->prepareEarthTimeFor();

    }

    /**
     * @throws \Exception
     */
    public function testMicroTime()
    {
        $earthTime = new EarthTime($this->date);
        $earthTime->setMilliseconds();
        $res = $earthTime->getMilliseconds();
        $this->assertEquals(1582747200000, $res);
    }

    /**
     * @throws \Exception
     */
    public function testJdUT()
    {
        $earthTime = new EarthTime($this->date);
        $earthTime->setJdUT(1582747200000);
        $res = $earthTime->getJdUT();
        $this->assertEquals(2458906.3333333335, $res);
    }

    /**
     * @throws \Exception
     */
    public function testJdTT()
    {
        $earthTime = new EarthTime($this->date);
        $earthTime->setJdTT(2458906.3333333335);
        $res = $earthTime->getJdTT();
        $this->assertEquals(2458906.334110926, $res);
    }

    /**
     * @throws \Exception
     */
    public function testJ2000()
    {
        $earthTime = new EarthTime($this->date);
        $earthTime->setJ2000(2458906.334110926);
        $res = $earthTime->getJ2000();
        $this->assertEquals(7361.334110925905, $res);
    }

    /**
     * @throws \Exception
     */
    public function testMsd()
    {
        $msd = $this->timeManager->getMarsSolDate();

        $this->assertEquals(51955.995873652755, $msd, '', 0.00000);
    }

    /**
     * @throws \Exception
     */
    public function testMtc()
    {
        $mct = $this->timeManager->getCoordinatedMarsTime();

        $this->assertEquals('23:54:03', $mct);
    }
}


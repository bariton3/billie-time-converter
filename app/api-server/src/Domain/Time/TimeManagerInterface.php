<?php


namespace App\Domain\Time;


interface TimeManagerInterface
{
    public function prepareEarthTimeFor();

    public function getMarsSolDate();

    public function getCoordinatedMarsTime();
}

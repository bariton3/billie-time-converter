<?php

namespace App\Controller;

use App\Domain\Time\TimeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class TimeController
 * @package App\Controller
 */
class TimeController extends AbstractController
{
    /**
     * @var TimeManager
     */
    public $timeManager;


    /**
     * TimeController constructor.
     * @param  TimeManager  $timeManager
     */
    public function __construct(TimeManager $timeManager)
    {
        $this->timeManager = $timeManager;
    }

    /**
     *
     * @Route("/api/v1/time/{date}", name="date")
     * @ParamConverter("date", options={"format": "Y-m-d H:i:s"})
     * @throws \Exception
     */
    public function index( \DateTime $date)
    {
        try {
            $this->timeManager->setDateTime($date);

            $msd = $this->timeManager->getMarsSolDate();

            $mct = $this->timeManager->getCoordinatedMarsTime();
        }
        catch (\Exception $exception){
            return $this->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ], 401);
        }
        return $this->json([
            'mars_sol_date' => $msd,
            'martian_coordinated_time' => $mct,
        ]);
    }
}

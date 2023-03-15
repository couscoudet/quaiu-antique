<?php

namespace MyProject\Controller;
use MyProject\Model\Availability;
use Doctrine\ORM\EntityManager;
use MyProject\View\ViewManager;


class BookManager 
{
    private EntityManager $em;

    private Availability $availability;

    private ViewManager $viewManager;

    public function __construct()
    {
        $this->availability = new Availability;
        $this->viewManager = new ViewManager;
    }

    public function addAvailability($data = null)
    {
        if ($data) {
            try {
                $this->availability->setStartSlot($data['startDateTime']);
                $this->availability->setEndSlot($data['endDateTime']);
                $this->availability->setpeopleNumber($data['peopleNumber']);
                $this->em->persist($this->availability);
                $this->em->flush();
            }
            catch(Exception $e) {
                exit($e);
            }
        }
    }

    public function addAvailabilityForYear($data = null)
    {
        if ($data) {
            $year = $data['year'];
            $days = $data['days'];
            $daysOfTheWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $startDate = date_create('01/01/'.$year);
            $endDate = date_create('12/31/'.$year);
            $count = intval(date_diff($startDate,$endDate)->format('%a'));
            $availability = new Availability;

            $date = $startDate;
            while ( $compteur >= 0) {
                foreach($days as $day) {
                    if ($day['dayOfTheWeek'] === date_format($date,"N")) {
                        foreach($day['slots'] as $slot) {
                            $this->addAvailability($slot);
                        }
                    }
                }

                $date = date_add($date,date_interval_create_from_date_string("1 day"));
                $compteur -= 1;
            }
        }
        else {
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'add-availability-for-year-view.php';
            $this->viewManager->renderAdmin($view);
        }

    }

    /**
     * Get the value of em
     */ 
    public function getEm()
    {
        return $this->em;
    }

    /**
     * Set the value of em
     *
     * @return  self
     */ 
    public function setEm($em)
    {
        $this->em = $em;

        return $this;
    }
}
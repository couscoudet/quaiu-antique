<?php

namespace MyProject\Controller;
use MyProject\Model\Availability;
use MyProject\Model\Booking;
use MyProject\Model\Visitor;
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

    public function checkIfAvailable($data)
    {
        $peopleNumber = $data['peopleNumber'];
        $date = date_create($data['date']);
        $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
        $availabilities = $availabilityRepository->createQueryBuilder('a')
        ->orderBy('a.startSlot', 'ASC')
        ->getQuery()
        ->getResult();
        foreach($availabilities as $availability) {
            if (date_format($date,"Y/m/d") === date_format($availability->getStartSlot(),"Y/m/d")) {
                $availabilityId = $availability->getId();
                $bookingRepository = $this->em->getRepository('MyProject\\Model\\Booking');
                $bookings = $bookingRepository->createQueryBuilder('b')
                ->where('b.availability = :availabilityId')
                ->setParameter('availabilityId', $availabilityId)
                ->getQuery()
                ->getResult();
                $bookingCount = 0;
                foreach($bookings as $booking) {
                    $bookingCount += $booking->getPeopleNumber();
                }
                if ($bookingCount + $peopleNumber < $availability->getPeopleNumber()) {
                    echo '<button type="button" class="time-slot btn btn-outline-primary m-1" id='.$availability->getId().'>'.
                    date_format($availability->getStartSlot(), "H:i").' - '.date_format($availability->getEndSlot(), "H:i").
                    '</button>';
                }
                else {
                    echo '<span class="badge text-bg-secondary">Complet :'.
                    date_format($availability->getStartSlot(), "H:i").' - '.date_format($availability->getEndSlot(), "H:i").
                    '</span>';
                }
            }
        }
        
        $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
        $availabilities = $availabilityRepository->findAll();
    }

    public function addAvailability($data = null)
    {
        if ($data) {
            try {
                $availability  = new Availability;
                $startDateTime = date_create($data['startDateTime'], timezone_open("Europe/Paris"));
                $endDateTime = date_create($data['endDateTime'], timezone_open("Europe/Paris"));
                $availability->setStartSlot($startDateTime);
                $availability->setEndSlot($endDateTime);
                $availability->setpeopleNumber($data['peopleNumber']);
                $this->em->persist($availability);
                $this->em->flush();
            }
            catch(Exception $e) {
                exit($e);
            }
        }
    }

    public function book($data = null) {
        if(!$data) {
            $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
            $availabilities = $availabilityRepository->findAll();
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'book-view.php';
            $this->viewManager->render($view, $availabilities);
        }
        else {
            try {
                $booking = new Booking;
                $booking->setTitle($data['title']);
                $booking->setPeopleNumber($data['peopleNumber']);
                $visitorEmail = $data['email'];
                $visitorRepository = $this->em->getRepository('MyProject\\Model\\Visitor');
                $visitor = $visitorRepository->findOneBy(['email' => $visitorEmail]);
                if (!$visitor) {
                    $visitor = new Visitor;
                    $visitor->setEmail($visitorEmail);
                    $this->em->persist($visitor);
                }
                $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
                $availability = $availabilityRepository->find($data['slotId']);
                $booking->setVisitor($visitor);
                $booking->setAvailability($availability);
                $this->em->persist($booking);
                $this->em->flush();
                header('Location: /');
            }
            catch(Exception $e) {
                exit($e);
            }
        }
    }

    public function addAvailabilityForYear($data = null)
    {
        if ($data) {
            // ini_set('xdebug.var_display_max_depth', -1);
            // ini_set('xdebug.var_display_max_children', -+1);
            // ini_set('xdebug.var_display_max_data', -1);
            // var_dump($data);
            // die();
            $year = $data['year'];
            $days = $data['days'];
            $peopleNumber = $data['peopleNumber'];
            $startDate = date_create('01/01/'.$year, timezone_open("Europe/Paris"));
            $endDate = date_create('12/31/'.$year, timezone_open("Europe/Paris"));
            $count = intval(date_diff($startDate,$endDate)->format('%a'));
            $availability = new Availability;

            $date = $startDate;
            while ( $count >= 0) {
                foreach($days as $key => $day) {
                    if ($key === intval(date_format($date,"N"))) {
                        foreach($day['slots'] as $slot) {
                            $slot['startDateTime'] = date_format($date,"Y/m/d") . ' ' . $slot['startDateTime'];
                            $slot['endDateTime'] = date_format($date,"Y/m/d") . ' ' . $slot['endDateTime'];
                            $slot['peopleNumber'] = $peopleNumber;
                            $this->addAvailability($slot);
                        }
                    }
                }

                $date = date_add($date,date_interval_create_from_date_string("1 day"));
                $count--;
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
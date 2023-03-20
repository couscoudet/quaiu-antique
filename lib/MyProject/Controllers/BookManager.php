<?php

namespace MyProject\Controller;
use MyProject\Model\Availability;
use MyProject\Model\Booking;
use MyProject\Model\Visitor;
use Doctrine\ORM\EntityManager;
use MyProject\View\ViewManager;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require_once(__DIR__.'/../services/security.php');

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
        if (checkNumber($data['peopleNumber'])) {
           $peopleNumber = secure($data['peopleNumber']);
        }
        if (checkIfDate($data['date'])) {
        $date = date_create(secure($data['date']));}
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
        if (checkIfAdmin()) {
            if ($data) {
                try {
                    $availability  = new Availability;
                    if (checkIfDate($data['startDateTime']) && checkIfDate($data['startDateTime'])) {
                        $startDateTime = date_create(secure($data['startDateTime']), timezone_open("Europe/Paris"));
                        $endDateTime = date_create(secure($data['endDateTime']), timezone_open("Europe/Paris"));
                        $availability->setStartSlot($startDateTime);
                        $availability->setEndSlot($endDateTime);
                        $availability->setpeopleNumber(secure($data['peopleNumber']));
                        $this->em->persist($availability);
                        $this->em->flush();
                    }
                }
                catch(Exception $e) {
                    exit($e);
                }
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
                $booking->setTitle(secure($data['title']));
                if (checkNumber($data['peopleNumber'])) {
                    $booking->setPeopleNumber(($data['peopleNumber']));
                }
                $visitorEmail = secure(checkIfMail($data['email']));
                $visitorRepository = $this->em->getRepository('MyProject\\Model\\Visitor');
                $visitor = $visitorRepository->findOneBy(['email' => $visitorEmail]);
                if (!$visitor) {
                    $visitor = new Visitor;
                    $visitor->setEmail($visitorEmail);
                    $this->em->persist($visitor);
                }
                $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
                $availability = $availabilityRepository->find(secure($data['slotId']));
                $booking->setVisitor($visitor);
                $booking->setAvailability($availability);
                $this->em->persist($booking);
                $this->em->flush();
                $this->sendBookConfirmation($visitorEmail, $availability->getStartSlot());
                $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'book-confirmation-view.php';
                $this->viewManager->render($view);
            }
            catch(Exception $e) {
                exit($e);
            }
        }
    }

    public function addAvailabilityForYear($data = null)
    {
        if ($data && checkIfAdmin()) {
            // ini_set('xdebug.var_display_max_depth', -1);
            // ini_set('xdebug.var_display_max_children', -+1);
            // ini_set('xdebug.var_display_max_data', -1);
            // var_dump($data);
            // die();
            $year = secure($data['year']);
            $days = secure($data['days']);
            $peopleNumber = secure($data['peopleNumber']);
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

    public function sendBookConfirmation($customerMail, $date) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.infomaniak.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ysoultane@ik.me';                     //SMTP username
            $mail->Password   = 'amni8UvHbJ@SKY4';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('ysoultane@ik.me', 'Quai Antique');     //Add a recipient
            $mail->addAddress($customerMail);               //Name is optional
            $mail->addReplyTo('ysoultane@ik.me', 'Quai Antique');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = mb_encode_mimeheader('Réservation confirmée');
            $mail->Body    = '
            <img src="https://le-quai-antique.herokuapp.com/assets/logo.png">
            <h1>Réservation confirmée</h1>
            <h2>le '.date_format($date,'d/m/Y').' à partir de '.date_format($date,'H:i').'</h2>
            ';
            $mail->AltBody = '
            Réservation confirmée - le '.date_format($date,'d/m/Y').' à partir de '.date_format($date,'H:i');
        
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function bookings() {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'display-booking-view.php';
        $this->viewManager->renderAdmin($view);
    }

    public function checkBookings($date) {
        $availabilityRepository = $this->em->getRepository('MyProject\\Model\\Availability');
        $availabilities = $availabilityRepository->findAll();
        foreach($availabilities as $availability) {
            if ($date === date_format($availability->getStartSlot(),"Y-m-d")) {
                echo '<div class="mb-3"><strong>'.date_format($availability->getstartSlot(), 'd/m/Y H:i')." - ".date_format($availability->getendSlot(), 'd/m/Y H:i').'</strong>';
                echo '<ul>';
                $bookingRepository = $this->em->getRepository('MyProject\\Model\\Booking');
                $bookings = $bookingRepository->findBy(['availability' => $availability]);
                $bookingsCount = 0;
                foreach($bookings as $booking) {
                    $bookingsCount += $booking->getPeopleNumber();
                    echo '<li>'.$booking->getTitle().' - Nb personnes : '.$booking->getPeopleNumber().
                    '</li>';
                }
                echo '</ul>';
                echo '<span class="badge bg-secondary m-1">Total :'.$bookingsCount.' personnes</span></div>';
            }
            
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
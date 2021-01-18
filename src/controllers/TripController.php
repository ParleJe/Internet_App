<?php

class TripController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages;
    private Repository $repo;

    public function __construct()
    {
        parent::__construct();
        $this->repo = new TripRepository();
    }

    public function create()
    {
        $tripRepo = new TripRepository();
        $userID = $this->getCurrentLoggedID();
        if ($this->isPost() && is_uploaded_file($_FILES['photo']['tmp_name']) && $this->validate($_FILES['photo'])) { // check photo
            $title = $_POST['trip_name'];
            if ( ! empty($tripRepo->getTripByName($title))) {
                return $this->render("create", ['messages' => ["Sorry, such a trip name already exists"]]);
            }

            //get destination
            $destination = $_POST['destination'];

            //get POIs
            $points_of_interest = $this->getPOIAsJSON();

            //get description
            $description = $_POST['description'];

            //get color
            $color = $_POST['color'];

            //get date
            $start = $_POST['start'];
            $end = $_POST['end'];

            //create VulpCode
            do {
                $vulp_code = bin2hex(random_bytes(3));
            } while ( ! $this->repo->checkVulpCode($vulp_code));

            // photo location
            $photoDIR = dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['photo']['name'];

            $trip = new Trip([
                'trip_name' => $title,
                'destination' => $destination,
                'description' => $description,
                'color' => $color,
                'date_start' => $start,
                'date_end' => $end,
                'points_of_interest' => $points_of_interest,
                'photo_directory' => $photoDIR,
                'role_id' => USER::USER,
                'mortal_id' => $userID,
                'vulp_code' => $vulp_code
            ]);

            if (!$tripRepo->setTripByTransaction($trip)) {
                var_dump($trip);
                die();
                return $this->render("create", ['messages' => ["Sorry, we have problem with connection"]]);
            }
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $photoDIR
            );


            return $this->trips();
        }

        return $this->render('create');
    }

    public function view()
    {
        $tripID = $_GET["id"];
        switch ($_GET["type"]) {
            case 'template':$trip = $this->repo->getTripById($tripID); break;
            case 'planned': $trip = $this->repo->fetchPlannedTripsByTripId($tripID, $this->getCurrentLoggedID()); break;
            case 'member':
                $trips = $this->repo->getMemberTripsByUserId($this->getCurrentLoggedID());
                foreach ($trips as $item) {

                    if ($item->getTripId() === (int)$tripID) {
                        $trip = $item;
                        break;
                    }
            }
            break;
        }
        if (is_null($trip)) {
            return Routing::run('trips');
        }
        return $this->render('trip_overview', ['trip' => $trip, 'type' => $_GET["type"]]);

    }

    public function trips($msg = null)
    {
        include('src/SessionHandling.php');
        $id = $this->getCurrentLoggedID();
        $trips = $this->repo->getTripsByUserId($id);
        $planned = $this->repo->fetchPlannedTripsByUserId($id);
        $members = $this->repo->getMemberTripsByUserId($id);
        $featured = $this->repo->fetchFeatureTrip($this->getCurrentLoggedID());
        if( is_null($msg)){
        return $this->render('trips', ['trips' => $trips, 'planned' => $planned, 'featured' => $featured, 'members' => $members]);
        }
        return $this->render('trips', ['trips' => $trips, 'planned' => $planned, 'featured' => $featured, 'members' => $members, 'messages' => $msg]);
    }

    public function PlanTrip()
    {
        $data = [];
        $data['mortal_id'] = $this->getCurrentLoggedID();
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $data['trip_id'] = $_POST['trip_id'];
        do {
            $data['vulp_code'] = bin2hex(random_bytes(3));
        } while ( ! $this->repo->checkVulpCode($data['vulp_code']));

        if ($this->repo->setPlannedTrip($data)) {
            return $this->render('trips');
        }
        return $this->trips(['messages' => 'Cannot plan more than one trip from one template']);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_EXTENSIONS)) {
            $this->messages[] = 'unsupported file type';
            return false;
        }

        return true;
    }

    private function parsePOI(): array
    {

        if (!isset($_COOKIE['POIs'])) {
            return ['POIs not set']; //empty array
        }
        $cookie = $_COOKIE['POIs'];
        $places = explode(',', $cookie); // [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX]
        foreach ($places as $i => $place) {
            $places[$i] = substr($place, 7, -1);
        }

        unset($_COOKIE['POI']);
        setcookie('POI', null, -1, '/');

        return $places;
    }

    private function getPOIAsJSON()
    {
        $POI = $this->parsePOI();

        $cookie = $_COOKIE['name'];
        $name = explode(',', $cookie); // [STRING] [STRING] [STRING]

        $cookie = $_COOKIE['desc'];
        $description = explode(',', $cookie); // [STRING] [STRING] [STRING]
        $JSONArray = [];

        foreach ($POI as $iterator => $place) {
            //TODO check if name[iterator] != null
            $JSONArray[] = [
                "name" => $name[$iterator],
                "location" => $POI[$iterator],
                "description" => $description[$iterator]
            ];
        }
        return json_encode($JSONArray);

    }

}

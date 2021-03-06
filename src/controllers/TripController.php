<?php

class TripController extends AppController
{
    private ?array $messages;
    private Repository $repo;

    public function __construct()
    {
        parent::__construct();
        $this->messages = null;
        $this->repo = new TripRepository();
    }

    public function create()
    {
        $tripRepo = new TripRepository();
        $userID = $this->getCurrentLoggedID();
        $photoController = new PhotoController();
        if ($this->isPost() && is_uploaded_file($_FILES['photo']['tmp_name']) && $photoController->validatePhoto($_FILES['photo'])) { // check photo
            $title = $_POST['trip_name'];
            if (!empty($tripRepo->getTripByName($title))) {
                $this->render("create", ['messages' => ["Sorry, such a trip name already exists"]]);
                return;
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
            } while (!$this->repo->checkVulpCode($vulp_code));

            // photo location
            $photoDIR = $photoController->getUploadDirectory($_FILES['photo']);

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
                $this->render("create", ['messages' => ["Sorry, we have problem with connection"]]);
                return;
            }
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                dirname(__DIR__).$photoDIR
            );


            $this->trips();
            return;
        }

        $this->render('create', ['messages' => $this->messages]);
    }


    private function getPOIAsJSON(): ?string
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
        $jsonObj = json_encode($JSONArray);
        $jsonObj = $jsonObj===false?null:$jsonObj;
        return $jsonObj;

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

    public function trips(?array $msg = null)
    {
        $id = $this->getCurrentLoggedID();
        $trips = $this->repo->getTripsByUserId($id);
        $planned = $this->repo->fetchPlannedTripsByUserId($id);
        $members = $this->repo->getMemberTripsByUserId($id);
        $featured = $this->repo->fetchFeatureTrip($this->getCurrentLoggedID());

        $this->render('trips', ['trips' => $trips, 'planned' => $planned, 'featured' => $featured, 'members' => $members, 'messages' => $msg]);
    }

    public function view()
    {
        $trip = null;
        $tripID = $_GET["id"];
        switch ($_GET["type"]) {
            case 'template':
                $trip = $this->repo->getTripById($tripID);
                break;
            case 'planned':
                $trip = $this->repo->fetchPlannedTripsByTripId($tripID, $this->getCurrentLoggedID());
                break;
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
            $this->trips();
            return;
        }

        $controller = new UserController();
        $permission = $controller->getUserPermission($trip->getTripId(), $_GET["type"]);
        $permission = strtolower($permission);
        $this->render('trip_overview', ['trip' => $trip, 'type' => $_GET["type"], 'permission' => $permission]);

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
        } while (!$this->repo->checkVulpCode($data['vulp_code']));

        if ($this->repo->setPlannedTrip($data)) {
            $this->trips();
            return;
        }
        $this->trips(['messages' => 'Cannot plan more than one trip from one template']);
    }

}

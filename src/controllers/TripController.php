<?php

class TripController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages;

    public function create()
    {
        $tripRepo = new TripRepository();
        $userID = $this->getCurrentLoggedID();
        if( $this->isPost() && is_uploaded_file( $_FILES['photo']['tmp_name'] ) && $this->validate( $_FILES['photo'] ) ){ // check photo
            $photoDIR = dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['photo']['name'];
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $photoDIR
            );

            $title = $_POST['trip_name'];
            if( empty($tripRepo->getTripByName( $title )) ) {
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

            $trip = Trip::initWithVariables( [
                'trip_name' => $title,
                'destination' => $destination,
                'description' => $description,
                'color' => $color,
                'date_start' => $start,
                'date_end' => $end,
                'points_of_interest' => $points_of_interest,
                'photo_directory' => $photoDIR,
                'role_id' => USER::USER,
                'mortal_id' => $userID
            ] );


            if( ! $tripRepo->setTripByTransaction( $trip ) ) {
                return $this->render("create", ['messages' => ["Sorry, we have problem with connection"]]);
            }

            return Routing::run('trips');
        }
       
        die('ajaj');
        return $this->render('create', ['messages' => $this->messages]);
    }
    public function view() {
        //TODO CHECK OWNERSHIP!!!
        $tripId = $_GET["tripId"];
        $repo = new TripRepository();
        $trip = $repo->getTripById($tripId);
        if( is_null($trip) ) {
            return Routing::run('trips');

        }
        $planned = $repo->fetchPlannedTripsByTripId($trip->getTripId());
        if ( ! is_null($planned)) {
            return $this->render('trip_overview', ['trip' => $planned, 'type' =>'planned trip']);
        }
        return $this->render('trip_overview', ['trip' => $trip, 'type' => 'template']);
    }
    public function trips() {
        include('src/SessionHandling.php');
        $repository = new TripRepository();
        $trips = $repository->getTripsByUserId($this->getCurrentLoggedID());
        $planned = $repository->fetchPlannedTripsByUserId($this->getCurrentLoggedID());
        $this->render('trips', ['trips'=> $trips, 'planned'=> $planned]);
    }

    public function ajaxTripDescription() {

        $tripID = $_GET["tripID"];
        $repo = new TripRepository();
        $trip = $repo->getTripById($tripID);

        header('Content-type: application/json');
        http_response_code(200);
        echo $trip->getPointsOfInterest();

    }
    public function ajaxGetTrips() {
        $string = $_GET['search'];
        $repo = new TripRepository();
        $trips = $repo->getTripByName($string);
        $json = null;
        foreach ($trips as $trip){
            $json[] = json_encode($trip);
        }

        echo json_encode($trips);
    }

    private function validate( array $file ): bool {
        if( $file['size'] > self::MAX_FILE_SIZE ) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if( ! isset($file['type']) && !in_array( $file['type'], self::SUPPORTED_EXTENSIONS ) ) {
            $this->messages[] = 'unsupported file type';
            return false;
        }

        return true;
    }
    private function parsePOI(): array {

        if(!isset($_COOKIE['POIs'])){
            return ['POIs not set']; //empty array
        }
        $cookie = $_COOKIE['POIs'];
        $places = explode(',', $cookie ); // [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX]
        foreach ( $places as $i => $place ){
            $places[$i] = substr( $place, 7, -1 );
        }

        unset( $_COOKIE['POI'] );
        setcookie( 'POI', null, -1, '/' );

        return $places;
    }
    private function getPOIAsJSON() {
        $POI = $this->parsePOI();

        $cookie = $_COOKIE['name'];
        $name = explode(',', $cookie ); // [STRING] [STRING] [STRING]

        $cookie = $_COOKIE['desc'];
        $description = explode(',', $cookie ); // [STRING] [STRING] [STRING]
        $JSONArray = [];

        foreach ( $POI as $iterator => $place ) {
            //TODO check if name[iterator] != null
            $JSONArray[] = [
                "name" => $name[$iterator],
                "location" => $POI[$iterator],
                "description" => $description[$iterator]
            ];
        }
        return json_encode($JSONArray);

    }
    private function isPlannedTrip(int $tripID) {
        $repo = new TripRepository();
        $planned = $repo->fetchPlannedTripsByTripId($tripID);

    }

}

<?php

class TripController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages;

    public function create()
    {
        if ( session_status() !== PHP_SESSION_ACTIVE ) {
            session_start();
        }

        $tripRepo = new TripRepository();
        $userID = $_SESSION['user_id'];
        if( $this->isPost() && is_uploaded_file( $_FILES['photo']['tmp_name'] ) && $this->validate( $_FILES['photo'] ) ){ // check photo
            $photoDIR = dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['photo']['name'];
            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $photoDIR
            );

            $title = $_POST['trip_name'];
            if( $tripRepo->getTripsByName( $title ) != null ) {
                return $this->render("create", ['messages' => ["Sorry, such a trip name already exists"]]);
            }

            //get destination
            $destination = $_POST['destination'];

            //get POIs
            $points_of_interest = $this->parsePOI();
            $points_of_interest = $this->getPOIAsJSON( $points_of_interest );

            //get description
            $description = $_POST['description'];

            //get color
            $color = $_POST['color'];

            $trip = Trip::initWithVariables( null, $title, $destination, $description,
                $points_of_interest, self::UPLOAD_DIRECTORY.$_FILES['photo']['name'], $color, $userID );

            if( ! $tripRepo->setTrip( $trip ) ) {
                return $this->render("create", ['messages' => ["Sorry, we have problem with connection"]]);
            }

            return Routing::run('trips');
        }
       

        return $this->render('create', ['messages' => $this->messages]);
    }

    public function view() {
        $tripId = $_GET["tripId"];
        $repo = new TripRepository();
        $trip = $repo->getTripById($tripId);
        if( is_null($trip) ) {
            return Routing::run('trips');
        }
        return $this->render('trip_overview', ['trip' => $trip]);
    }

    public function ajaxTripDescription() {

        $tripID = $_GET["tripID"];
        $repo = new TripRepository();
        $trip = $repo->getTripById($tripID);

        header('Content-type: application/json');
        http_response_code(200);
        echo $trip->getPointsOfInterest();

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

}

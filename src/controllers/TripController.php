<?php /** @noinspection ALL */
class TripController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages;

    public function create()
    {
        $tripRepo = new TripRepository();

        if( $this->isPost() && is_uploaded_file( $_FILES['photo']['tmp_name'] ) && $this->validate( $_FILES['photo'] ) ){ // check photo
            /*move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['photo']['name']
            );*/
            //TODO check if it's working
            $photo = file_get_contents( $_FILES['photo']['tmp_name'] );
            $photo = urlencode( $photo ); //photo to bytea

            //get title TODO check with DB if such title didnt exist yet
            $title = $_POST['name'];
            //get localization
            $localization = $_POST['where'];
            //get POIs
            $steps = $this->parsePOI();
            $steps = $this->getPOIAsJSON( $steps );
            //get description
            $desc = $_POST['desc'];
            //create object TODO pass it to DB
            $trip = new Trip( $title, $localization, $desc, $steps, $photo );

            if( ! $tripRepo->setTrip( $trip ) ) {
                return $this->render("create", ['messages' => ["Sorry, we have problem with connection"]]);
            }

            return $this->render('trips');
        }
       

        return $this->render('create', ['messages' => $this->messages]);
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

        if(!isset($_COOKIE['POI'])){
            return ['POIs not set']; //empty array
        }
        $cookie = $_COOKIE['POI'];

        $places = explode(',', $cookie ); // [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX)] [POINT (XX.XXX XX.XXXX]

        foreach ( $places as $i => $place ){
            $places[$i] = substr( $place, 7, -1 );
        }

        unset( $_COOKIE['POI'] );
        setcookie( 'POI', null, -1, '/' );

        return $places;
    }


    private function getPOIAsJSON(array $POI, array $name = null, array $description = null) {
        $JSONArray = [];

        foreach ( $POI as $iterator => $place ) {
            $JSONArray["POI ".($iterator+1)] = [
                "location" => $POI[$iterator],
                "name" => $name[$iterator],
                "description" => $description[$iterator]
            ];
        }
        return json_encode($JSONArray);

    }

}
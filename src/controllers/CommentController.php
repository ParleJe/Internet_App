<?php


class CommentController extends AppController
{
    private $repo;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->repo = new CommentRepository();
    }


    public function ajaxGetComments(): void {
        $repo = new TripRepository();
        $tripID = $_GET['tripID'];
        $loggedIn = $this->getCurrentLoggedID();
        $plannedTrip = $repo->fetchPlannedTripsByTripId((int)$tripID, $loggedIn);
        $repo = new CommentRepository();
        $plannedTripId = (int)$plannedTrip->getPlannedTripId();
        $comments = $repo->getCommentsByPlannedTripID($plannedTripId);
        echo json_encode($comments);
    }

    public function fetchComments():void {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            $TripRepo = new TripRepository();

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->repo->getCommentsByPlannedTripID(3));
        }
    }

}
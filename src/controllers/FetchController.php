<?php


class FetchController extends AppController
{
    const FILE_NOT_FOUND = 404;
    //...
    private Repository $repository;

    public function fetchData():void {

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            switch (strtolower($decoded['requestType'])) {
                case 'trip':
                    $this->fetchTrips($decoded['data']); break;
                case 'membership':
                    $this->participate($decoded['data']); break;
                case 'poi':
                    $this->fetchPOI($decoded['data']); break;
                case 'user':
                    $this->fetchUsers($decoded['data']); break;
                case 'comment':
                    $this->fetchComments($decoded['data']); break;
                default:
                    header('Content-type: application/json');
                    http_response_code(404);
                    echo 'Request not supported';
            }
            return;
        }

    }

    private function fetchUsers(?string $data)
    {
        $this->repository = new UserRepository();
        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->repository->getUsersByName($data));
    }

    private function fetchComments(int $data):void {
        $this->repository = new CommentRepository();
        header('Content-type: application/json');
        http_response_code(200);

        echo json_encode($this->repository->getCommentsByPlannedTripID($data));
    }

    private function fetchTrips($data)
    {
        $this->repository = new TripRepository();
        $trips = $this->repository->getTripByName($data);
        if (empty($trips)) {
            http_response_code(self::FILE_NOT_FOUND);
            return;
        }
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($trips);

    }

    private function participate(string $code)
    {
        $this->repository = new TripRepository();
        $planned_trip = $this->repository->bindUserWithPlannedTrip($code, $this->getCurrentLoggedID());
        if (is_null($planned_trip)) {
            http_response_code(404);
            return;
        }
        header('Content-type: application/json');
        http_response_code(201);
        echo json_encode($planned_trip);
    }

    private function fetchPOI(string $data)
    {
        $this->repository = new TripRepository();
        $trip = $this->repository->getTripById($data);
        if (is_null($trip)) {
            http_response_code(400);
            return;
        }

        header('Content-type: application/json');
        http_response_code(200);
        echo $trip->getPointsOfInterest();
    }
}
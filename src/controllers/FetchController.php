<?php


class FetchController extends AppController
{
    const FILE_NOT_FOUND = 404;
    const NO_CONTENT = 204;
    const REQUEST_NOT_SUPPORTED = 501;
    const REQUEST_OK = 200;
    const CREATED = 201;
    const I_TEAPOT = 418;

    private Repository $repository;


    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new BadMethodCallException($name . ' has shuffled the mortal coil');
        }
    }

    public function endPoint(): void
    {
        try {
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if ($contentType === "application/json") {
                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);
                $sendMethod = strtolower($_SERVER['REQUEST_METHOD']);
                switch (strtolower($decoded['dataType'])) {
                    case 'trip':
                        $method = $sendMethod . 'Trips';
                        $this->$method($decoded['data']);
                        break;
                    case 'membership':
                        $method = $sendMethod . 'Membership';
                        $this->$method($decoded['data']);
                        break;
                    case 'poi':
                        $method = $sendMethod . 'POI';
                        $this->$method($decoded['data']);
                        break;
                    case 'user':
                        $method = $sendMethod . 'User';
                        $this->$method($decoded['data']);
                        break;
                    case 'comment':
                        $method = $sendMethod . 'Comment';
                        $this->$method($decoded['data']);
                        break;
                    default:
                        header('Content-type: application/json');
                        http_response_code(self::REQUEST_NOT_SUPPORTED);
                        echo 'Request not supported';
                }
                return;
            }
        } catch (BadMethodCallException $e) {
            header('Content-type: application/json');
            http_response_code(self::FILE_NOT_FOUND);
            echo 'Request not supported';
        }

    }

    private function postTrips($data): void
    {
        $this->repository = new TripRepository();
        $trips = $this->repository->getTripByName($data);
        if (empty($trips)) {
            http_response_code(self::NO_CONTENT);
            echo '';
            return;
        }
        header('Content-type: application/json');
        http_response_code(self::REQUEST_OK);
        echo json_encode($trips);

    }

    private function putMembership(string $code): void
    {
        $this->repository = new TripRepository();
        $planned_trip = $this->repository->bindUserWithPlannedTrip($code, $this->getCurrentLoggedID());
        if (is_null($planned_trip)) {
            http_response_code(self::NO_CONTENT);
            return;
        }
        header('Content-type: application/json');
        http_response_code(self::CREATED);
        echo json_encode($planned_trip);
    }

    private function postPOI(string $data): void
    {
        $this->repository = new TripRepository();
        $trip = $this->repository->getTripById($data);
        if (is_null($trip)) {
            http_response_code(self::FILE_NOT_FOUND);
            return;
        }

        header('Content-type: application/json');
        http_response_code(self::REQUEST_OK);
        echo $trip->getPointsOfInterest();
    }

    private function postUser(?string $data): void
    {
        $this->repository = new UserRepository();
        $users = $this->repository->getUsersByName($data);

        if (empty($users)) {
            http_response_code(self::NO_CONTENT);
            return;
        }

        header('Content-type: application/json');
        http_response_code(self::REQUEST_OK);
        echo json_encode($users);
    }

    private function postComment(int $data): void
    {
        $this->repository = new TripRepository();
        $userID = $this->getCurrentLoggedID();
        $plannedTrip = $this->repository->fetchPlannedTripsByTripId($data, $userID);
        if (is_null($plannedTrip)) {
            $tripsArray = $this->repository->getMemberTripsByUserId($userID);
            foreach ($tripsArray as $pt) {
                if ($pt->getTripId() == $data) {
                    $plannedTrip = $pt;
                    break;
                }
            }
            if (is_null($plannedTrip)) {
                http_response_code(self::NO_CONTENT);
                return;
            }

        }
        $id = $plannedTrip->getPlannedTripId();
        $this->repository = new CommentRepository();
        $plannedTrips = $this->repository->getCommentsByPlannedTripID($id);
        if (empty($plannedTrips)) {
            http_response_code(self::NO_CONTENT);
            return;
        }

        header('Content-type: application/json');
        http_response_code(self::REQUEST_OK);
        echo json_encode($plannedTrips);
    }

    private function putComment(array $data): void
    {
        $this->repository = new TripRepository();
        $userID = $this->getCurrentLoggedID();
        $plannedTrip = $this->repository->fetchPlannedTripsByTripId($data['tripID'], $userID);
        if (is_null($plannedTrip)) {
            $tripsArray = $this->repository->getMemberTripsByUserId($userID);
            foreach ($tripsArray as $pt) {
                if ($pt->getTripId() == $data['tripID']) {
                    $plannedTrip = $pt;
                    break;
                }
            }
            if (is_null($plannedTrip)) {
                http_response_code(self::I_TEAPOT);
                return;
            }

        }
        $id = $plannedTrip->getPlannedTripId();
        $this->repository = new CommentRepository();
        $added = $this->repository->addComment($userID, $data['content'], $id);
        if (is_null($added)) {
            http_response_code(self::I_TEAPOT);
            return;
        }
        header('Content-type: application/json');
        http_response_code(self::CREATED);
        echo json_encode($added);
    }
}
<?php


class UserController extends AppController
{
    private $repo;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->repo = new UserRepository();
    }


    public function friends() {
        include('src/SessionHandling.php');
        $repository = new UserRepository();
        $friends = $repository->getFriendsOfUser($this->getCurrentLoggedID());
        $this->render('friends', ['friends'=> $friends]);
    }

    public function profile() {
        $id = $this->getCurrentLoggedID();
        $repo = new UserRepository();
        $profile = $repo->getUserById($id);
        $repo = new TripRepository();
        $trips = $repo->getTripsByUserId($id);
        $this->render('profile', ['profile' => $profile, 'trips' => $trips] );
    }

    public function ajaxGetUsers() {
        $searched = $_GET['name'];
        $repo = new UserRepository();
        echo json_encode( $repo->getUsersByName($searched) );
    }

    public function fetchUsers(?string $data) {
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->repo->getUsersByName($data));
    }

    public function getUserPermission($tripId, $type): ?string
    {
        $userID = $this->getCurrentLoggedID();
        if( ! $this->repo->owns($userID, $tripId, $type) )
        {
            if( $this->repo->isMember($userID, $tripId) )
            {
                return 'member';
            }
            return null;
        }
        return 'owner';
    }

}
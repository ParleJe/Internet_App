<?php


class UserController extends AppController
{
    private $repository;



    public function friends()
    {
        include('src/SessionHandling.php');
        $this->repository = new UserRepository();
        $friends = $this->repository->getFriendsOfUser($this->getCurrentLoggedID());
        $this->render('friends', ['friends' => $friends]);
    }

    public function profile()
    {
        $id = $this->getCurrentLoggedID();
        $repo = new UserRepository();
        $profile = $repo->getUserById($id);
        $repo = new TripRepository();
        $trips = $repo->getTripsByUserId($id);
        $this->render('profile', ['profile' => $profile, 'trips' => $trips]);
    }



    public function getUserPermission($tripId, $type): ?string
    {
        $this->repository = new UserRepository();
        $userID = $this->getCurrentLoggedID();
        try {
            if (!$this->repository->owns($userID, $tripId, $type)) {
                if ($this->repository->isMember($userID, $tripId)) {
                    return 'member';
                }
                return null;
            }
            return 'owner';
        } catch (Exception $e) {
            return null;
        }
    }

}
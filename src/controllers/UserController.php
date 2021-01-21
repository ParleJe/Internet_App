<?php


class UserController extends AppController
{
    private Repository $repository;



    public function friends()
    {
        $this->repository = new UserRepository();
        $friends = $this->repository->getFriendsOfUser($this->getCurrentLoggedID());
        $this->render('friends', ['friends' => $friends]);
    }

    public function profile()
    {
        $repo = new UserRepository();
        $type = 'other';
        $id = $_GET['id'];
        if($id === null) {
            $id = $this->getCurrentLoggedID();
            $type = 'own';
        } else {
            $friends = $repo->getFriendsOfUser($this->getCurrentLoggedID());
            foreach ($friends as $user) {
                if($user->getMortalId() == $id){
                    $type = 'friend';
                    break;
                }
            }
        }

        $profile = $repo->getUserById($id);
        $repo = new TripRepository();
        $trips = $repo->getTripsByUserId($id);
        $this->render('profile', ['profile' => $profile, 'trips' => $trips, 'type' => $type]);
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
<?php


class UserController extends AppController
{
    public function friends() {
        include('src/SessionHandling.php');
        $repository = new UserRepository();
        $friends = $repository->getFriendsOfUser($this->getCurrentLoggedID());
        $this->render('friends', ['friends'=> $friends]);
    }

    public function ajaxGetUsers() {
        $searched = $_GET['name'];
        $repo = new UserRepository();
        echo json_encode( $repo->getUsersByName($searched) );
    }

}
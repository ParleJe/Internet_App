<?php


    class DefaultController extends AppController {

        public function index() {
            $this->render('login');
        }

        public function search() {
            $this->render('search');
        }

        public function registration() {
            $this->render('registration');
        }

        public function trips() {
            include('src/SessionHandling.php');
            $repository = new TripRepository();
            $trips = $repository->getTripsByUserId($this->getCurrentLoggedID());
            $this->render('trips', ['trips'=> $trips]);
        }

        public function create() {
            $this->render('create');
        }

        public function friends() {
            include('src/SessionHandling.php');
            $repository = new UserRepository();
            $friends = $repository->getFriendsOfUser($this->getCurrentLoggedID());
            $this->render('friends', ['friends'=> $friends]);
        }

        public function settings() {
            $this->render('profile');
        }

        public function trip_overview() {
            $this->render('trip_overview');
        }
    }
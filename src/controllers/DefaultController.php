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

        public function create() {
            $this->render('create');
        }

        public function profile() {
            $id = $this->getCurrentLoggedID();
            $repo = new UserRepository();
            $profile = $repo->getUserById($id);
            $repo = new TripRepository();
            $trips = $repo->getTripsByUserId($id);
            $this->render('profile', ['profile' => $profile, 'trips' => $trips] );
        }

        public function test () {
            $this->render('test');
        }
    }
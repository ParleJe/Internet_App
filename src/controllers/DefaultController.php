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

        public function test () {
            $this->render('test');
        }
    }
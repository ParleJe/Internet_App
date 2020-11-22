<?php

    require 'AppController.php';

    class DefaultController extends AppController {

        public function index() {
            $this->render('login');
        }

        public function search() {
            $this->render('search');
        }
    }
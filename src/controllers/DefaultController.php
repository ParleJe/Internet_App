<?php

    /*spl_autoload_register('AutoLoader::classLoader');
    spl_autoload_register('AutoLoader::modelLoader()');*/

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
            $this->render('trips');
        }

        public function create() {
            $this->render('create');
        }
    }
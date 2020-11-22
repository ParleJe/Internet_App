<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
class LoginController extends AppController
{
    private static $mailRegex = "^[a-zA-Z0-9]+@[a-zA-Z0-9]+.[a-zA-Z0-9]+";
    public function login()
    {
        $user = new User("email@gmail.com", '', 'Jon');


        if(!$this->isPost()){
            return $this->login();
        }

        $mail = $_POST["email"];
        $passwd = $_POST["password"];

        if($user->getEmail() != $mail){
            return $this->render('login', [messeges => ['User does not exist']]);
        }

        if($user->getPassword() != $passwd){
            return $this->render('login', [messeges => ['Wrong password']]);
        }

        //$this->render('search');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/search");
    }
}
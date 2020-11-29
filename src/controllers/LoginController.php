<?php

   /* spl_autoload_register('AutoLoader::classLoader');
    spl_autoload_register('AutoLoader::modelLoader()');*/

class LoginController extends AppController
{
    private static $passwordRegex = '/"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"/'; //password no space
    private static $salt = "RainbowHair";

    public function login()
    {
        $user = new User("a@a", hash("sha512", self::$salt."passwd"), 'Jon');


        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $mail = $_POST["email"];
        $passwd = $_POST["password"];

        if($user->getEmail() !== $mail)
        {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if(preg_match(self::$passwordRegex, $passwd) or
            $user->getPassword() !== hash("sha512", self::$salt.$passwd))
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('trips');

        /*$url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/search");*/
    }

    public function registration()
    {
        if(!$this->isPost()){
            return $this->render('registration');
        }

        $mail = $_POST["email"];
        $login = $_POST["login"];
        $passwd = $_POST["password"];

        if($passwd != $_POST["reentered-password"])
        {
            return $this->render("registation", ['messages' => ["Passwords did not match"]]);
        }

        $newUser = new User($mail, $passwd, $login);

        //TODO: Save $newUser in DB

        return $this->render('login'); // bck to login page

    }
}
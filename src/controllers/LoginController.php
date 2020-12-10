<?php


class LoginController extends AppController {
    private $passwordRegex = '/"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"/'; //password no space
    private $options = [
        'cost' => 12,
    ];

    public function login() {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $mail = $_POST["email"];
        $passwd = $_POST["password"];

        $userDB = new UserRepository();
        try{
            $user = $userDB->getUser($mail);
        } catch (Exception $e) {
            return $this->render('login', ['messages' => [$e->getMessage()]]);
        }

        if( ! password_verify( $passwd, $user->getPassword() ) )
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('trips');
    }

    public function registration() {
        if(!$this->isPost()) {
            return $this->render('registration');
        }
        if($_POST["password"] != $_POST["reentered-password"]) {
            return $this->render("registration", ['messages' => ["Passwords did not match"]]);
        }

        $mail = $_POST["email"];
        $login = $_POST["login"];
        $passwd = password_hash( $_POST["password"], PASSWORD_ARGON2ID, $this->options );
        $newUser = new User( $mail, $passwd, $login, null, null );

        $userDB = new UserRepository();
        if( ! $userDB->setUser( $newUser ) ) {
            return $this->render("registration", ['messages' => ["Sorry, we have problem with connection"]]);
        }

        return $this->render('login'); // You made it! Back to login page
    }

    private function generateRandomString( $length = 10 ) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil($length/strlen($x)) )),
            1,$length);
    }

}
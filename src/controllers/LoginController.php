<?php


class LoginController extends AppController {
    private array $options = [
        'cost' => 12,
    ];

    public function login() {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $mail = $_POST["email"];
        $passwd = $_POST["password"];

        $userDB = new UserRepository();

        $user = $userDB->getUser($mail);
        $user = $user[0];

        if ( is_null( $user ) ) {
            return $this->render('login', ['messages' => ['Wrong mail!']]);
        }

        if( ! password_verify( $passwd, $user->getPassword() ) )
        {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        if( $user->isLog() ) {
            return $this->render('login', ['messages' => ['User already logged in']]);
        }

        if(session_start() && $userDB->setUserStatus($user->getMortalId())) {
            $_SESSION['user_id'] = $user->getMortalId();
            $_SESSION['isLoggedIn'] = true;
            return Routing::run('trips');
        }

        return $this->render('login', ['messages' => ['Something went wrong']]);
    }

    public function logout () {
        $repo = new UserRepository();
        if( $repo->setUserStatus( $this->getCurrentLoggedID(), 0) ){
            session_unset();
            session_destroy();
            return Routing::run('');
        }
        // TODO WHAT IF IT WONT WORK ???
    }

    public function registration() {
        if( ! $this->isPost() ) {
            return $this->render('registration');
        }
        if($_POST["password"] != $_POST["reentered-password"]) {
            return $this->render("registration", ['messages' => ["Passwords did not match"]]);
        }

        $mail = $_POST["email"];
        $login = $_POST["login"];
        $passwd = password_hash( $_POST["password"], PASSWORD_ARGON2ID, $this->options );
        $newUser = new User([
            'user_id' => null,
            'mail' => $mail,
            'password' => $passwd,
            'role_id' => User::USER,
            'nickname' => $login
        ]);

        $userDB = new UserRepository();
        if( ! $userDB->setUserByTransaction( $newUser ) ) {
            return $this->render("registration", ['messages' => ["Sorry, we have problem with connection"]]);
        }

        return $this->render('login'); // You made it! Back to login page
    }
}
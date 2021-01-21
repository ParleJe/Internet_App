<?php


class LoginController extends AppController {
    private array $options = [
        'cost' => 12,
    ];

    public function login() {

        if(!$this->isPost()) {
            $this->render('login');
            return;
        }

        $mail = $_POST["email"];
        $passwd = $_POST["password"];

        $userDB = new UserRepository();

        $user = $userDB->getUser($mail);

        if ( is_null( $user ) ) {
            $this->render('login', ['messages' => ['Wrong mail!']]);
            return;
        }

        if( ! password_verify( $passwd, $user->getPassword() ) )
        {
            $this->render('login', ['messages' => ['Wrong password!']]);
            return;
        }

        if( $user->isLog() ) {
            $this->render('login', ['messages' => ['User already logged in']]);
            return;
        }

        if(session_start() && $userDB->setUserStatus($user->getMortalId())) {
            $_SESSION['user_id'] = $user->getMortalId();
            $_SESSION['isLoggedIn'] = true;
            if($user->role_name === 'ADMIN') { // check if user is admin or not
                $this->admin();
                return;
            }
            Routing::run('trips');
            return;
        }

        $this->render('login', ['messages' => ['Something went wrong']]);
    }

    public function logout () {
        $repo = new UserRepository();
        if( !isset($_SESSION['isLoggedIn'])) {
            $this->render('login');
            return;
        }
        if( $repo->setUserStatus( $this->getCurrentLoggedID()) ){
            session_unset();
            session_destroy();
            $this->render('login');
            return;
        }
    }

    public function registration() {
        $photoController = new PhotoController();
        if( ! $this->isPost() ) {
            $this->render('registration');
            return;
        }
        if($_POST["password"] != $_POST["reentered-password"]) {
            $this->render("registration", ['messages' => ["Passwords did not match"]]);
            return;
        }

        if( !(is_uploaded_file($_FILES['photo']['tmp_name']) || $photoController->validatePhoto($_FILES['photo'])) ) {
            $this->render("registration", ['messages' => ["Invalid Photo!"]]);
            return;
        }

        $photoDIR = $photoController->getUploadDirectory($_FILES['photo']);
        $quote = $_POST["quote"];
        $login = $_POST["login"]; //can be multiple similar nicknames
        $mail = $_POST["email"];
        if ( !$this->checkEmail($mail) ){
            $this->render("registration", ['messages' => ["E-mail already registered!"]]);
            return;
        }


        $passwd = password_hash( $_POST["password"], PASSWORD_ARGON2ID, $this->options );
        $newUser = new User([
            'mail' => $mail,
            'password' => $passwd,
            'role_id' => User::USER,
            'nickname' => $login,
            'quote' => $quote,
            'photo_directory' => $photoDIR
        ]);

        $userDB = new UserRepository();
        if( ! $userDB->setUserByTransaction( $newUser ) ) {
            $this->render("registration", ['messages' => ["Sorry, we have problem with connection"]]);
            return;
        }
        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            dirname(__DIR__).$photoDIR
        );

        $this->render('login'); // You made it! Back to login page
    }

    public function admin () {
        $repo = new UserRepository();
        $users = $repo->getAllUsers();

        $repo = new TripRepository();
        $trips = $repo->getAllTrips();

        $repo = new CommentRepository();
        $comments = $repo->getAllComments();

        $this->render('admin_panel', ['users' => $users, 'trips' => $trips, 'comments' => $comments]);


    }

    /**
     * @param string $mail
     * @return bool true if email does not exist, false if email exists in db
     */
    private function checkEmail(string $mail):bool {
        $repo = new UserRepository();
        $user = $repo->getUser($mail);
        return is_null($user);
    }



}
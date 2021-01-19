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
            Routing::run('trips');
            return;
        }

        $this->render('login', ['messages' => ['Something went wrong']]);
    }

    public function logout () {
        $repo = new UserRepository();
        if( $repo->setUserStatus( $this->getCurrentLoggedID()) ){
            session_unset();
            session_destroy();
            Routing::run('');
            return;
        }
    }

    public function registration() {
        if( ! $this->isPost() ) {
            $this->render('registration');
            return;
        }
        if($_POST["password"] != $_POST["reentered-password"]) {
            $this->render("registration", ['messages' => ["Passwords did not match"]]);
            return;
        }

        if( !(is_uploaded_file($_FILES['photo']['tmp_name']) || $this->validatePhoto($_FILES['photo'])) ) {
            $this->render("registration", ['messages' => ["Invalid Photo!"]]);
            return;
        }

        $photoDIR = $this->getUploadDirectory($_FILES['photo']);
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
            $photoDIR
        );

        $this->render('login'); // You made it! Back to login page
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

    //TODO to photoController.php
    private function validatePhoto(array $file): bool
    {
        $MAX_FILE_SIZE =  1024 * 1024;
        $SUPPORTED_EXTENSIONS  = ['image/png', 'image/jpeg'];
        if ($file['size'] > $MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], $SUPPORTED_EXTENSIONS)) {
            $this->messages[] = 'unsupported file type';
            return false;
        }

        return true;
    }
    private function getUploadDirectory(array $file): ?string {
        $UPLOAD_DIRECTORY =  '/../public/uploads/';
        return dirname(__DIR__).$UPLOAD_DIRECTORY.$file['name'];
    }
}
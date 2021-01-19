<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>CREATE YOUR ACCOUNT</title>
</head>

<body>
<?PHP
if(isset($messages)) {
    include "error_message.php";
}
?>
    <div class="container">

        <div class="middle-line">
            <div class="logo-container">
                <img src="public/resources/logo-registration.svg" class="login-logo" alt="logo of the project">
            </div>
            <div class="login-container flex column">
                <form class="login flex column round" action="registration" method="post">
                    <input class="round" name="email" type="email" placeholder="enter your mail">
                    <input class="round" name="login" type="text" placeholder="choose your login">
                    <input class="round" name="password" type="password" placeholder="enter your password">
                    <input class="round" name="reentered-password" type="password" placeholder="confirm your password">
                    <button class="login-button" type="submit">
                        <i class="fas fa-spinner"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</body>
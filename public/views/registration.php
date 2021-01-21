<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script src="public/scripts/registerValidation.js" DEFER></script>
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
                <form class="login flex column round" action="registration" method="post" enctype="multipart/form-data">
                    <input class="highlight" name="email" type="email" placeholder="enter your mail" required="required">
                    <input class="highlight" name="login" type="text" placeholder="choose your nickname" required="required">
                    <input class="highlight" id="quote" name="quote" type="text" placeholder="choose your quote">
                    <input class="highlight" id="file-form" name="photo" type="file" value="Photo" placeholder="choose your profile picture" required="required">
                    <input class="highlight" name="password" type="password" placeholder="enter your password" required="required">
                    <input class="highlight" name="reentered-password" type="password" placeholder="confirm your password" required="required">
                    <button class="login-button" type="submit">
                        <i class="fas fa-spinner"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</body>
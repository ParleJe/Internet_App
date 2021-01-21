<!DOCTYPE html>

<head>
    <title>LOGIN PAGE</title>

    <!--stylesheets-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">

    <!--Icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">

        <div class="middle-line">
            <div class="logo-container">
                <img src="public/resources/logo.svg" class="login-logo" alt="logo of the project">
            </div>
            <div class="login-container flex column">

                <form class="login flex column round" action="login" method="post" >
                    <input class="round" name="email" type="email" placeholder="email@email.com">
                    <input class="round" name="password" type="password" placeholder="password">
                    <p> don't have an account? Click <a href="registration">HERE</a></p>
                    <button class="login-button" type="submit">
                        <i class="fas fa-spinner"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
    <?PHP
    if( isset($messages)) {
        include "error_message.php";
    }
    ?>
</body>
<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>CREATE YOUR ACCOUNT</title>
</head>

<body>
<?PHP

?>
    <div class="container">

        <div class="middle-line">
            <div class="logo-container">
                <img src="public/resources/logo-registration.svg" class="login-logo" alt="logo of the project">
            </div>
            <div class="login-container flex column">
                <form class="login flex column" action="registration" method="post" >
                    <input name="email" type="email" placeholder="enter your mail">
                    <input name="login" type="text" placeholder="choose your login">
                    <input name="password" type="password" placeholder="enter your password">
                    <input name="reentered-password" type="password" placeholder="confirm your password">
                    <div class="message">
                        <?php
                        if(isset($messages))
                        {
                            foreach ($messages as $message)
                            {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <button class="login-button" type="submit">
                        <i class="fas fa-spinner"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</body>
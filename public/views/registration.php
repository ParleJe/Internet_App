<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">

        <div class="middle-line">
            <div class="logo-container">
                <img src="public/resources/logo-registration.svg" class="login-logo" alt="logo of the project">
            </div>
            <div class="login-container">
                <form class="login" action="register" method="post" >
                    <input name="email" type="email" placeholder="enter your mail">
                    <input name="login" type="text" placeholder="choose your login">
                    <input name="password" type="password" placeholder="enter your password">
                    <input name="reentered-password" type="password" placeholder="confirm your password">
                    <button class="login-button" type="submit">
                        <i class="fas fa-spinner"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</body>
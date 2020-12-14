<?PHP
include('src/SessionHandling.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/friends-stylesheet.css">

    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Friends</title>
</head>

<body>
<nav id="navigation-bar">

    <div class="nav-logo-container">
        <img class="nav-logo" src="public/resources/logo.svg" alt="logo of the project"/>
    </div>

    <ol>
        <li class="button-container">
            <a class="new-button" href="create">
                Get to the Boat
                <img class="nav-add" src="public/resources/drakkar.svg" alt="click here to start new trip">
            </a>
        </li>

        <li>
            <a class="nav-button" href="trips">
                <i class="fas fa-spinner"></i>
                <pre>Your Trips</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="Calendar">
                <i class="far fa-calendar-alt"></i>
                <pre>Calendar</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="friends">
                <i class="fas fa-user-friends"></i>
                <pre>Friends</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="settings">
                <i class="fas fa-cog"></i>
                <pre>Settings</pre>
            </a>
        </li>

        <li>
            <a class="nav-button" href="search">
                <i class="fas fa-map-marker-alt"></i>
                <pre>Search</pre>
            </a>
        </li>
        <li>
            <div></div>
        </li>
    </ol>
</nav>

<section class="content-container">
    <div class="top-bar">
        <input name="search" type="text" placeholder="Search">
        <button>Search</button>
    </div>

    <div class="content">

        <?php
        if (isset($friends)) {
            foreach ($friends as $friend) {
                $id = $friend->getMortalId();
                $name = $friend->getName();
                $surname = $friend->getSurName();
                $nickname = $friend->getNickname();
                echo <<<EOL
                <div class="cell">
                    <div class="profile" id="$id">
                        <img src="public/resources/placeholder.jpg" alt="profile photo">
                        <div>
                            <h2>$name $surname</h2>
                            <h3>$nickname</h3>
                        </div>
                    </div>
                </div>
EOL;

            }
        }

        ?>
    </div>
</section>
</body>
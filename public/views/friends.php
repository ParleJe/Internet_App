<?PHP
include('src/SessionHandling.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/friends-stylesheet.css">

    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="public/scripts/friends.js" DEFER></script>
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Friends</title>
</head>

<body>
<nav class="flex column round">

    <div class="nav-logo-container">
        <img class="nav-logo" src="public/resources/logo.svg" alt="logo of the project" />
    </div>
    <div class="new-trip-container">
        <a class="new-trip-button flex round" href="create">
            <pre>Get to the Boat</pre>
            <img src="public/resources/drakkar.svg" alt="click here to start new trip">
        </a>
    </div>
    <div class="list flex">
        <ol>
            <li>
                <a class="nav-button flex" href="trips">
                    <i class="fas fa-spinner"></i>
                    <pre>Your Trips</pre>
                </a>
            </li>
            <li>
                <a class="nav-button flex" href="friends">
                    <i class="fas fa-user-friends"></i>
                    <pre>Friends</pre>
                </a>
            </li>
            <li>
                <a class="nav-button flex" href="profile">
                    <i class="fas fa-cog"></i>
                    <pre>Settings</pre>
                </a>
            </li>
            <li>
                <a class="nav-button flex" href="search">
                    <i class="fas fa-map-marker-alt"></i>
                    <pre>Search</pre>
                </a>
            </li>
            <li>
                <a class="nav-button flex" href="logout">
                    <i class="far fa-calendar-alt"></i>
                    <pre>Logout</pre>
                </a>
            </li>
        </ol>
    </div>
    <div class="placeholder">
        <div class="round"></div>
    </div>
</nav>

<section class="content-container flex column">
    <div class="top-bar round">
        <input id="search-input" type="text" placeholder="Search">
        <button class="round" id="search-btn">Search</button>
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
                <div class="flex round">
                    <div class="profile flex column round" id="$id">
                        <img class="round" src="public/resources/placeholder.jpg" alt="profile photo">
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
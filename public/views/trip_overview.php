<?PHP
include('src/SessionHandling.php');
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trip_overview-stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script src="public/scripts/script.js"></script>
    <title>Your Trips</title>
</head>

<body>

<nav id="navigation-bar">

    <div class="nav-logo-container">
        <img class="nav-logo" src="public/resources/logo.svg" alt="logo of the project" />
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

<div class="content-container">
    <section class="content"> <!-- grid layout 3 columns-->
        <div class="photo-background">
            <i class="fas fa-arrow-alt-circle-left"></i>
            <div>
                <h1>Name of The Trip</h1>
            </div>
        </div>
        <div class="trip">
            <div class="desc">
                <div class="POI-list">
                    <ol>
                        <li>

                        </li>
                    </ol>
                </div>
                <div class="description">
                    <h1>POI POI POI</h1>
                    <p> blablablablablala</p>
                </div>
            </div>
            <div>
                <h1>participants</h1>
                <div class="grid-friends">
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg">
                    </div>

                </div>
                <i class="fas fa-plus-circle"></i>
            </div>
        </div>
    </section>
</div>
</body>
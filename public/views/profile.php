<?PHP
include('src/SessionHandling.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile-stylesheet.css">

    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Create</title>
</head>

<body>

<?PHP

?>

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

<section class="content-container">

    <div class="content">

        <div class="profile">
            <div>
                <img src="public/resources/placeholder.jpg">
                <!--icon for add to friends or delete account-->
                <h2>NAME SURNAME</h2>
                <h3>LOGIN</h3>
            </div>



            <section class="trips-created">
                <!--here all created trips by user-->
                <div class="trip" id="trip-1">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>

                <div class="trip" id="trip-2">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>

                <div class="trip" id="trip-3">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>

                <div class="trip" id="trip-4">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>

                <div class="trip" id="trip-5">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>

                <div class="trip" id="trip-6">
                    <!--photo of the trip as background-->
                    <h2>NAME</h2>
                </div>
            </section>

        </div>

    </div>

</section>
</body>
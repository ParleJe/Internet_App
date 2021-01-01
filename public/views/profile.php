<?PHP
include('src/SessionHandling.php');
if (! isset( $trips ) || ! isset( $profile )) {
    die();
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile-stylesheet.css">

    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Create</title>
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

    <div class="content flex column">

        <div class="profile flex column round">
            <div class="flex column">
                <img src="public/resources/placeholder.jpg"  alt="profile photo">
                <!--icon for add to friends or delete account-->
                <h2><?PHP echo $profile->getName().' '.$profile->getSurname() ?></h2>
                <h3> <?PHP echo $profile->getNickname() ?> </h3>
            </div>



            <section class="round">
                <!--here all created trips by user-->
                <?PHP foreach ($trips as $trip): ?>
                <div class="trip round" id="<?PHP echo $trip->getTripId() ?>" style="background-image: url( ' <?PHP echo $trip->getPhotoDirectory() ?> ' );">
                    <!--photo of the trip as background-->
                    <h2><?PHP echo $trip->getTripName() ?></h2>
                </div>
                <?PHP endforeach; ?>

            </section>

        </div>

    </div>

</section>
</body>
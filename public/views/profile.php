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
                <img src="public/resources/placeholder.jpg"  alt="profile photo">
                <!--icon for add to friends or delete account-->
                <h2><?PHP echo $profile->getName().' '.$profile->getSurname() ?></h2>
                <h3> <?PHP echo $profile->getNickname() ?> </h3>
            </div>



            <section class="trips-created">
                <!--here all created trips by user-->
                <?PHP foreach ($trips as $trip): ?>
                <div class="trip" id="<?PHP echo $trip->getTripId() ?>" style="background-image: url( ' <?PHP echo $trip->getPhotoDirectory() ?> ' );">
                    <!--photo of the trip as background-->
                    <h2><?PHP echo $trip->getTripName() ?></h2>
                </div>
                <?PHP endforeach; ?>

            </section>

        </div>

    </div>

</section>
</body>
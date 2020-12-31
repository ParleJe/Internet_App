<?PHP
    include('src/SessionHandling.php');
    if( ! isset($trips) ){
        die("problem!");
    } elseif ( ! isset($planned) ) {
        die('another problem!');
    }
?>

<!DOCTYPE html>

<head>
    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trips-stylesheet.css">
    <!--JS-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="public/scripts/script.js" DEFER></script>
    <title>Your Trips</title>
</head>

<body>

<nav class="flex column">

    <div class="nav-logo-container">
        <img class="nav-logo" src="public/resources/logo.svg" alt="logo of the project" />
    </div>
    <div class="new-trip-container">
        <a class="new-trip-button flex" href="create">
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
        <div></div>
    </div>
</nav>

    <div class="content-container flex column">

        <section class="top-bar">
            <div>
            <h2>City of The Forgotten Kings</h2>
                <a>
                    invite people
                </a>
            </div>
            <div>
                <pre>Date</pre>
                <pre>XX.XX.XXXX</pre>
                <div class="trip-icons"><!--Icons-->
                    <i class="fas fa-comment-alt"></i>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
            </div>
        </section>

        <section class="content"> <!-- grid layout 3 columns-->

            <div class="flow"> <!--First column etc.-->
                <h2>Your Creations:</h2>
                <div class="trip-container">

                <?PHP  foreach($trips as $trip): ?>
                        <div class="trip flex column">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"> <?php echo $trip->getDestination() ?> </h4>
                            <h3><?php echo $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                            <div><input type="image"  alt="trip image" src="<?php echo $trip->getPhotoDirectory() ?>" ></div>
                            <input type="hidden" name="tripId" value="<?php echo $trip->getTripId() ?>">
                            <input type="hidden" name="type" value="template">
                            </form>
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>

                <?php endforeach; ?>

                </div>
            </div>

            <div class="flow">
                <h2>Planned:</h2>
                <div class="trip-container">

                    <?PHP  foreach($planned as $trip): ?>

                        <div class="trip flex column">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"><?php echo $trip->getDestination() ?></h4>
                            <h3><?php echo $trip->getTripId() ?></h3>
                            <form method="get" action="view">
                                <div><input type="image"  alt="trip image" src="<?php echo $trip->getPhotoDirectory() ?>" ></div>
                                <input type="hidden" name="tripId" value="<?php echo $trip->getTripId() ?>">
                                <input type="hidden" name="type" value="planned">
                            </form>
                            <div class="trip-icons">
                                <i class="fas fa-comment-alt"></i>
                            </div>
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="flow">
                <!--TODO empty columns-->
                <h2>Taking Part:</h2>
                <div class="trip-container">

                </div>
            </div>

        </section>
    </div>

</body>
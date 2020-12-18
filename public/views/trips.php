<?PHP
    include('src/SessionHandling.php');
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trips-stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
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
                <h2>TITLE OF TRIPS #1</h2>
                <div class="trip-container">
                <?PHP  foreach($trips as $trip): ?>
                        <div class="trip">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"> <?php echo $trip->getDestination() ?> </h4>
                            <h3> <?php echo $trip->getTripName() ?> </h3>
                            <form method="get" action="view">
                            <div><input type="image"  alt="trip image" src=" <?php echo $trip->getPhotoDirectory() ?> " ></div>
                            <input type="hidden" name="tripId" value=" <?php echo $trip->getTripId() ?> ">
                            </form>
                            <div class="trip-icons">
                                <i class="fas fa-paperclip"></i>
                                <i class="fas fa-comment-alt"></i>
                            </div>
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>

                <?php endforeach; ?>


                </div>
            </div>

            <div class="flow">
                <h2>TITLE OF TRIPS #2</h2>
                <div class="trip-container">

                </div>
            </div>

            <div class="flow">
                <!--TODO empty columns-->
                <h2>TITLE OF TRIPS #3</h2>
                <div class="trip-container">

                </div>
            </div>

        </section>
    </div>

    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="public/scripts/script.js"></script>
</body>
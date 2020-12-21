<?PHP
include('src/SessionHandling.php');

if( ! isset($trip)) {
    die('something went wrong');
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trip_overview-stylesheet.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script src="public/scripts/trip_overview.js" DEFER></script>
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
        <div class="photo-background" style="background-image: url(' <?PHP echo $trip->getPhotoDirectory() ?> ')">
        <i class="fas fa-arrow-alt-circle-left" style="color: <?PHP echo $trip->getColor().'90' ?>" onclick="window.history.back()"></i>
            <div style="background-color: <?PHP echo $trip->getColor().'50'?>">
                <h1><?PHP echo $trip->getTripName() ?></h1>
            </div>
        </div>
        <div class="trip">
            <div class="desc">
                <div class="POI-list">
                    <ol>
                        <?php
                        $decoded = json_decode( $trip->getPointsOfInterest(), true );
                        foreach ( $decoded as $position => $point ):
                        ?>
                            <li id="<?PHP echo $position ?>">
                                <i class="fas fa-map-pin"></i>
                                <p><?PHP echo $point['name'] ?></p>
                            </li>
                        <?PHP endforeach; ?>
                    </ol>
                </div>
                <div class="description">
                    <h1 class="trip-name"><?PHP echo $trip->getTripName() ?></h1>
                    <p class="trip-desc"> <?PHP echo $trip->getDescription() ?></p>
                </div>
            </div>
            <div class="option-menu">
                <!--<h1>participants</h1>
                <div class="grid-friends">
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>
                    <div>
                        <img src="public/resources/placeholder.jpg" alt="friend photo">
                    </div>

                </div>
                <i class="fas fa-plus-circle"></i>-->
                <h1 class="menu" id="participants">Participants</h1>
                <h1 class="menu" id="chat">Chat</h1>
                <h1 class="menu" id="map">Check Map</h1>
                <?PHP if($type === 'template')
                    echo '<h1 class="menu" id="create">Create Trip From This Template</h1>'
                ?>
                <h1 class="menu" id="delete">Delete <?PHP echo $type ?></h1>
            </div>
        </div>
    </section>
</div>
</body>
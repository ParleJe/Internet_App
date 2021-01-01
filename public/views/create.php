<?PHP
include('src/SessionHandling.php');
?>
<!DOCTYPE html>

<head>
    <title>Create</title>

    <!--stylesheets-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/create-stylesheet.css">

    <!-- HERE API -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <!--Scripts-->
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/hereAPI/map.js" DEFER></script>
    <!--icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>

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

        <div class="content round">
            <form class="flex column" action="create" method="POST" enctype="multipart/form-data">
                <h2>My New Trip</h2>
                <input name="trip_name" placeholder="Trip name" required="required"> <!--Title-->
                <input name="destination" placeholder="Where?" required="required"> <!--Destination-->
                <textarea name="description" rows="6" cols="30" maxlength="255" placeholder="What is about?"></textarea> <!--Description-->
                <div class="flex">
                    <input class="round" type="color" name="color" style="width: 10%;" value="#e66465">
                    <input class="button round" id="file-form" name="photo" type="file" value="Photo" required="required"> <!--Photo-->
                    <input class="button round" id="POI" name="points_of_interest" type="button" value="Add POI"> <!--Point Of Interest-->
                </div>
                <div class="flex">
                    <input name="start" placeholder="Start?" type="date" required="required" value="<?PHP echo date('Y-m-d'); ?>" min="<?PHP echo date('Y-m-d'); ?>">
                    <input name="end" placeholder="End?" type="date" required="required" value="<?PHP echo date('Y-m-d', strtotime('+1 week')); ?>" min="<?PHP echo date('Y-m-d'); ?>">
                </div>
                <button class="button round" id="submit" type="submit">Submit</button> <!--Submit All Form-->
            </form>
        </div>

        <div id="map-container">
            <i class="fas fa-times"">
            <div class="inner-city-field-container">
                        <div contenteditable="true" class="city-field"></div>
                        <div class="city-field-suggestion"></div>
                    </div>
            <div id="map"></div>
        </div>
    </section>

</body>
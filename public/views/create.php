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
    <script src="public/scripts/script.js" DEFER></script>
    <script type="module" src="public/scripts/hereAPI/map.js" DEFER></script>
    <!--icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>

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

<section class="content-container">

        <div class="content">
            <form action="create" method="POST" enctype="multipart/form-data">
                <h2>My New Trip</h2>
                <input name="trip_name" placeholder="Trip name" required="required"> <!--Title-->
                <input name="destination" placeholder="Where?" required="required"> <!--Destination-->
                <textarea name="description" rows="6" cols="30" placeholder="What is about?"></textarea> <!--Description-->
                <div>
                    <input type="color" name="color" style="width: 10%;" value="#e66465">
                    <input class="button" id="file-form" name="photo" type="file" value="Photo" required="required"> <!--Photo-->
                    <input class="button" id="POI" name="points_of_interest" type="button" value="Add POI"> <!--Point Of Interest-->
                </div>
                <button class="button" id="submit" type="submit">Submit</button> <!--Submit All Form-->
            </form>

        </div>

        <div id="map-container">
            <i class="fas fa-times""></i>
            <div class="inner-city-field-container">
                        <div contenteditable="true" class="city-field"></div>
                        <div class="city-field-suggestion"></div>
                    </div>
            <div id="map"></div>
        </div>
    </section>

</body>
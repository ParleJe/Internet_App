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
<?PHP include('public/views/navigation.php') ?>

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
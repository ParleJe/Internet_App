<!--TODO get User permissions to this trip-->
<?PHP
include('src/SessionHandling.php');

if( ! (isset($trip) && isset($type))) {
    die('something went wrong');
}
$controller = new UserController();
$permission = $controller->getUserPermission($trip->getTripId(), $type);
$permission = strtolower($permission);
if( is_null($permission) && $type !== 'template') //everyone can access to the template
{
    die('You do not have permission to see this page');
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trip_overview-stylesheet.css">

    <!-- HERE API -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <!-- SCRIPTS -->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/trip_overview.js" DEFER></script>
    <title>Your Trips</title>
</head>

<body>

<?PHP include('public/views/navigation.php') ?>

<div class="content-container flex column">
    <section class="content round"> <!-- grid layout 3 columns-->
        <div class="photo-background round" style="background-image: url(' <?PHP echo $trip->getPhotoDirectory() ?> ')">
        <i class="fas fa-arrow-alt-circle-left" style="color: <?PHP echo $trip->getColor().'90' ?>" onclick="window.history.back()"></i>
            <div class="round" style="background-color: <?PHP echo $trip->getColor().'50'?>">
                <h1><?PHP echo $trip->getTripName() ?></h1>
            </div>
        </div>
        <div class="trip">
            <div class="desc flex">
                <div class="POI-list round">
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
            <div class="option-menu flow column round">
                <h1 class="menu" id="participants">Participants</h1>
                <h1 class="menu" id="chat">Chat</h1>
                <h1 class="menu" id="map-toggle">Check Map</h1>
                <?PHP if($type === 'template')
                    echo '<h1 class="menu" id="create">Create Trip From This Template</h1>'
                ?>
                <?PHP if($permission === 'owner')
                echo '<h1 class="menu" id="delete">Delete</h1>'
                ?>
                <?PHP if($permission ==='owner' && $type !== 'template')
                echo '<h1 class="vulpcode">Copy vulpcode</h1>'
                ?>
            </div>
        </div>
    </section>
</div>
<div id="map-container">
    <i class="fas fa-times"> </i>
    <div class="inner-city-field-container">
        <div contenteditable="true" class="city-field"></div>
        <div class="city-field-suggestion"></div>
    </div>
    <div id="map"></div>
</div>
</body>
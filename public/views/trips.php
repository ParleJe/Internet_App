<?PHP
    if( !  (isset($trips) && isset($planned)) ){
        die("problem! Refresh");
    } elseif ( ! isset($featured) ) {
        $featured = new Trip();
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
    <script type="module" src="public/scripts/script.js" DEFER></script>
    <title>Your Trips</title>
</head>

<body>

<?PHP include('public/views/navigation.php') ?>

    <div class="content-container flex column">

        <section class="top-bar round">
            <div>
            <h2><?PHP echo $featured->getTripName() ?></h2>
                <a class="round" style="background: <?php echo $featured->getColor() ?> ">
                    <?php echo $featured->getDestination() ?>
                </a>
            </div>
            <div>
                <pre>Date:</pre>
                <pre><?php echo $featured->getDateStart() ?></pre>
                <div class="trip-icons"><!--Icons-->
                    <i class="fas fa-comment-alt"></i>
                </div>
            </div>
        </section>

        <section class="content"> <!-- grid layout 3 columns-->

            <div class="flow"> <!--First column etc.-->
                <h2>Your Creations:</h2>
                <div class="trip-container round">

                <?PHP  foreach($trips as $trip): ?>
                        <div class="trip flex column round">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"> <?php echo $trip->getDestination() ?> </h4>
                            <h3><?php echo $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                            <div><input type="image"  alt="trip image" src="<?php echo $trip->getPhotoDirectory() ?>" ></div>
                            <input type="hidden" name="id" value="<?php echo $trip->getTripId() ?>">
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

                        <div class="trip flex column round">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"><?php echo $trip->getDestination() ?></h4>
                            <h3><?php echo $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                                <div><input type="image"  alt="trip image" src="<?php echo $trip->getPhotoDirectory() ?>" ></div>
                                <input type="hidden" name="id" value="<?php echo $trip->getTripId() ?>">
                                <input type="hidden" name="type" value="planned">
                            </form>
                            <h4><?PHP echo $trip->getDateStart().' - '.$trip->getDateEnd() ?></h4>
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="flow">
                <!--TODO empty columns-->
                <h2>Taking Part:</h2>

                <div class="trip-container" id="members">
                    <?PHP if( isset($members) ) foreach ($members as $trip): ?>
                        <div class="trip flex column round">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"><?php echo $trip->getDestination() ?></h4>
                            <h3><?php echo $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                                <div><input type="image"  alt="trip image" src="<?php echo $trip->getPhotoDirectory() ?>" ></div>
                                <input type="hidden" name="id" value="<?php echo $trip->getTripId() ?>">
                                <input type="hidden" name="type" value="member">
                            </form>
                            <!--<h4><?PHP /*echo $trip->getDateStart().' - '.$trip->getDateEnd() */?></h4>-->
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>
                    <?PHP endforeach; ?>
                    <div class="trip flex column round" id="take-part">
                        <input placeholder="type unique vulp-code to join trip" type="text">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                </div>
            </div>

        </section>
    </div>

</body>

<template id="trip-template">
    <div class="trip flex column round" >
        <h4></h4>
        <h3></h3>
        <form method="get" action="view">
            <div><input type="image"  alt="trip image" src="" ></div>
            <input id="id" type="hidden" name="id" value="">
            <input id="type" type="hidden" name="type" value="member">
        </form>
        <h4></h4>
        <i class="fas fa-sort-down"></i>
    </div>
</template>
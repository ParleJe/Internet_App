<?PHP
    if( !  (isset($trips) && isset($planned)) ){
        die("problem! Refresh");
    }


?>

<!DOCTYPE html>

<head>
    <title>Your Trips</title>

    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trips-stylesheet.css">

    <!--Scripts-->
    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/script.js" DEFER></script>

    <!--Icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
</head>

<body>
<?PHP
if( isset($messages)) {
    include "error_message.php";
}
?>
<?PHP include('public/views/navigation.php') ?>

<div class="content-container flex column">
            <section class="top-bar round">
                <?PHP if(isset($featured)): ?>
                <div>
                <h2><?= $featured->getTripName() ?></h2>
                    <a href="/view?id=<?=$featured->getTripId()?>&type=planned" class="round" style="background: <?php echo $featured->getColor() ?> ">
                        <?= $featured->getDestination() ?>
                    </a>
                </div>
                <div>
                    <pre>Date:</pre>
                    <pre><?= $featured->getDateStart() ?></pre>
                </div>
                <?PHP endif; ?>
            </section>


        <section class="content">

            <div class="flow">
                <h2>Your Creations:</h2>
                <div class="trip-container round">

                <?PHP  foreach($trips as $trip): ?>
                        <div class="trip flex column round">
                            <h4 style="color: <?php echo $trip->getColor() ?> ;"> <?= $trip->getDestination() ?> </h4>
                            <h3><?= $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                            <div><input type="image"  alt="trip image" src="<?= $trip->getPhotoDirectory() ?>" ></div>
                            <input type="hidden" name="id" value="<?= $trip->getTripId() ?>">
                            <input type="hidden" name="type" value="template">
                            </form>
                            <i class="fas fa-sort-down" style="color: <?php echo $trip->getColor() ?> "></i>
                        </div>

                <?php endforeach; ?>
                        <div class="trip flex column round" id="create-new-mobile">
                            <h3>Create New Trip !!!</h3>
                            <a href="create">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </div>
                </div>
            </div>

            <div class="flow">
                <h2>Planned:</h2>
                <div class="trip-container">

                    <?PHP  foreach($planned as $trip): ?>

                        <div class="trip flex column round">
                            <h4 style="color: <?= $trip->getColor() ?> ;"><?= $trip->getDestination() ?></h4>
                            <h3><?= $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                                <div><input type="image"  alt="trip image" src="<?= $trip->getPhotoDirectory() ?>" ></div>
                                <input type="hidden" name="id" value="<?= $trip->getTripId() ?>">
                                <input type="hidden" name="type" value="planned">1
                            </form>
                            <h4><?PHP echo $trip->getDateStart().' - '.$trip->getDateEnd() ?></h4>
                            <i class="fas fa-sort-down" style="color: <?= $trip->getColor() ?> "></i>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="flow">
                <h2>Taking Part:</h2>

                <div class="trip-container" id="members">
                    <?PHP if( isset($members) ) foreach ($members as $trip): ?>
                        <div class="trip flex column round">
                            <h4 style="color: <?= $trip->getColor() ?> ;"><?= $trip->getDestination() ?></h4>
                            <h3><?php echo $trip->getTripName() ?></h3>
                            <form method="get" action="view">
                                <div><input type="image"  alt="trip image" src="<?= $trip->getPhotoDirectory() ?>" ></div>
                                <input type="hidden" name="id" value="<?= $trip->getTripId() ?>">
                                <input type="hidden" name="type" value="member">
                            </form>
                            <i class="fas fa-sort-down" style="color: <?= $trip->getColor() ?> "></i>
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
        <form id="to-display" method="get" action="view">
            <div><input type="image"  alt="trip image" src="" ></div>
            <input id="id" type="hidden" name="id" value="">
            <input id="type" type="hidden" name="type" value="member">
        </form>
        <h4></h4>
        <i class="fas fa-sort-down"></i>
    </div>
</template>
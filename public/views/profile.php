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

<?PHP include('public/views/navigation.php') ?>

<section class="content-container flex column">

    <div class="content flex column">

        <div class="profile flex column round">
            <div class="flex column">
                <img src="public/resources/placeholder.jpg"  alt="profile photo">
                <!--icon for add to friends or delete account-->
                <h2><?PHP echo $profile->getName().' '.$profile->getSurname() ?></h2>
                <h3> <?PHP echo $profile->getNickname() ?> </h3>
            </div>



            <section class="round">
                <!--here all created trips by user-->
                <?PHP foreach ($trips as $trip): ?>
                <div class="trip round" id="<?PHP echo $trip->getTripId() ?>" style="background-image: url( ' <?PHP echo $trip->getPhotoDirectory() ?> ' );">
                    <!--photo of the trip as background-->
                    <h2><?PHP echo $trip->getTripName() ?></h2>
                </div>
                <?PHP endforeach; ?>

            </section>

        </div>

    </div>

</section>
</body>
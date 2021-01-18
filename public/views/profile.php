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
                <div class="flex photo-container">
                    <i class="fas fa-plus-circle"></i>
                    <img class='profile-pic' src="public/resources/placeholder.jpg"  alt="profile photo">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <!--icon for add to friends or delete account-->
                <h2><?PHP echo $profile->getName().' '.$profile->getSurname() ?></h2>
                <h3> <?PHP echo $profile->getNickname() ?> </h3>
            </div>



            <section class="round">
                <?PHP foreach ($trips as $trip): ?>
                <a href="<?PHP echo '/view?id='.$trip->getTripId().'&type=template' ?>">
                    <div class="trip round" id="<?PHP echo $trip->getTripId() ?>" style="background-image: url( ' <?PHP echo $trip->getPhotoDirectory() ?> ' );">
                        <h2><?PHP echo $trip->getTripName() ?></h2>]
                    </div>
                </a>
                <?PHP endforeach; ?>

            </section>

        </div>

    </div>

</section>
</body>
<?PHP
if (! (isset( $trips ) && isset( $profile ) && isset( $type ))) {
    die('problem has occurred! ');
}
?>
<head>
    <title>Profile</title>

    <!--Stylesheets-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile-stylesheet.css">
    <!--Scripts-->
    <script src="public/scripts/profile.js" type="module"></script>
    <!--Icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
</head>

<body>

<?PHP include('public/views/navigation.php') ?>

<section class="content-container flex column">

    <div class="content flex column">

        <div class="profile flex column round">
            <div class="flex column">
                <div class="flex photo-container">
                    <?PHP if ($type === 'other'): ?>
                    <i class="fas fa-heart"  id="<?= $profile->getMortalId() ?>"></i>
                    <?PHP else: ?>
                    <i class="fas fa-heart" style="color: var(--main-color)" id="<?= $profile->getMortalId() ?>"></i>
                    <?PHP endif; ?>

                    <img class='profile-pic round' src="<?= $profile->getPhotoDirectory() ?>"  alt="profile photo">
                </div>
                <h2><?= $profile->getNickname() ?></h2>
                <h3><?= $profile->getQuote() ?></h3>
            </div>



            <section class="round">
                <?PHP foreach ($trips as $trip): ?>
                <a href="<?PHP echo '/view?id='.$trip->getTripId().'&type=template' ?>">
                    <div class="trip round" id="<?= $trip->getTripId() ?>" style="background-image: url( ' <?= $trip->getPhotoDirectory() ?> ' );">
                        <h2><?= $trip->getTripName() ?></h2>]
                    </div>
                </a>
                <?PHP endforeach; ?>

            </section>

        </div>

    </div>

</section>
</body>
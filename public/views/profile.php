<?PHP
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
                    <i class="fas fa-heart"></i>
                    <?PHP if( ! is_null($profile->getPhotoDirectory()) ) {
                        $photoDir = $profile->getPhotoDirectory();
                    } else {
                        $photoDir = 'public/resources/placeholder.jpg';
                    }
                    ?>
                    <img class='profile-pic' src="<?PHP echo $photoDir ?>"  alt="profile photo">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h2><?PHP echo $profile->getNickname() ?></h2>
                <h3> <?PHP echo $profile->getQuote() ?> </h3>
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
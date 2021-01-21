<head>
    <title>Friends</title>

    <!--Stylesheets-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/friends-stylesheet.css">

    <!--Scripts-->
    <script type="module" src="public/scripts/friends.js" DEFER></script>
    <!--Icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
</head>

<body>

<?PHP include('public/views/navigation.php') ?>

<section class="content-container flex column">

    <?PHP include('public/views/searchBar.php') ?>

    <div class="content">

        <?php
        if (isset($friends)) foreach ($friends as $friend):?>
            <a href="/profile?id=<?PHP echo $friend->getMortalId() ?>">
                <div class="flex round">
                    <div class="profile flex column round" id="<?PHP echo $friend->getMortalId() ?>">
                        <?PHP if( ! is_null($friend->getPhotoDirectory())) {
                            $photoDir = $friend->getPhotoDirectory();
                        } else {
                            $photoDir = 'public/resources/placeholder.jpg';
                        }
                        ?>
                        <img class="round" src="<?php echo $photoDir ?>" alt="profile photo">
                        <div>
                            <h2><?PHP echo $friend->getNickname() ?></h2>
                            <h3><?PHP echo $friend->getQuote() ?></h3>
                        </div>
                    </div>
                </div>
            </a>
        <?PHP endforeach; ?>

    </div>
</section>

</body>

<template id="profile-template">
    <a href="">
        <div class="round flex">
            <div class="profile flex column round" id="">
                <img class="round" src="" alt="profile photo">
                <div>
                    <h2></h2>
                    <h3></h3>
                </div>
            </div>
        </div>
    </a>
</template>

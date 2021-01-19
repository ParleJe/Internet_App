<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/friends-stylesheet.css">

    <script   src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/friends.js" DEFER></script>
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Friends</title>
</head>

<body>

<?PHP include('public/views/navigation.php') ?>

<section class="content-container flex column">

    <?PHP include('public/views/searchBar.php') ?>
    
    <div class="content">

        <?php
        if (isset($friends)) foreach ($friends as $friend):?>
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
        <?PHP endforeach; ?>

    </div>
</section>

</body>

<template id="profile-template">
    <div class="round flex">
        <div class="profile round" id="">
            <img class="round" src="" alt="profile photo">
            <div>
                <h2></h2>
                <h3></h3>
            </div>
        </div>
    </div>
</template>
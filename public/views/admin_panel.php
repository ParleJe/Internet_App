<?PHP
if( !(isset($trips) && isset($users) && isset($comments)) ) {
    die("refresh!");
}
?>

<!DOCTYPE html>

<head>
    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/trips-stylesheet.css">
    <!--JS-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/admin_panel.js" DEFER></script>
    <title>Admin Panel</title>
</head>

<body>

<div class="content-container flex column">

    <section class="content">

        <div class="flow">
            <h2>templates:</h2>
            <div class="trip-container">

                <?PHP foreach ($trips as $trip): ?>
                    <div class="template trip round flex column">
                        <h2><?= $trip->getTripName(); ?></h2>
                        <i class="trip-btn fas fa-minus-circle" id="<?= $trip->getTripId() ?>"></i>
                    </div>
                <?PHP endforeach; ?>

            </div>
        </div>

        <div class="flow">
            <h2>Users:</h2>
            <div class="trip-container">

                <?PHP foreach ($users as $u): ?>
                    <div class="user trip round flex column">
                        <h2><?PHP echo $u->getMail() ?></h2>
                        <i class="user-btn fas fa-minus-circle" id="<?PHP echo $u->getMortalId() ?>"></i>
                    </div>
                <?PHP endforeach ?>

            </div>
        </div>

        <div class="flow">
            <h2>Comments:</h2>
            <div class="trip-container" id="members">

                <?PHP foreach ($comments as $comment): ?>
                    <div class="comment trip round flex column">
                        <h2><?PHP echo $comment->getContent(); ?></h2>
                        <i class="comment-btn fas fa-minus-circle" id="<?PHP echo $comment->getCommentId(); ?>"></i>
                    </div>
                <?PHP endforeach; ?>

            </div>
        </div>


    </section>
    <a href="logout"><button class="button round">  Log Out  </button></a>
</div>

</body>
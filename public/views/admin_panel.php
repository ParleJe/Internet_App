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
    <title>Admin Panel</title>
</head>

<body>

<div class="content-container flex column">

    <section class="content">

        <div class="flow">
            <h2>templates:</h2>
            <div class="trip-container">

                <?PHP foreach ($trips as $trip): ?>
                    <div>
                        <h2><?PHP echo $trip->getTripName(); ?></h2>
                        <i class="trip-btn fas fa-minus-circle" id="<?PHP echo $trip->getTripId() ?>"></i>
                    </div>
                <?PHP endforeach; ?>

            </div>
        </div>

        <div class="flow">
            <h2>Users:</h2>
            <div class="trip-container">

                <?PHP foreach ($users as $user): ?>
                    <div>
                        <h2><?PHP echo $user->getNickName(); ?></h2>
                        <i class="user-btn fas fa-minus-circle" id="<?PHP echo $user->getUserId() ?>"></i>
                    </div>
                <?PHP endforeach; ?>

            </div>
        </div>

        <div class="flow">
            <h2>Comments:</h2>
            <div class="trip-container" id="members">

                <?PHP foreach ($comments as $comment): ?>
                    <div>
                        <h2><?PHP echo $comment->getContent(); ?></h2>
                        <i class="comment-btn fas fa-minus-circle" id="<?PHP echo $comment->geCommentId() ?>"></i>
                    </div>
                <?PHP endforeach; ?>

            </div>
        </div>

    </section>
</div>

</body>
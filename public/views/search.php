<?PHP
include('src/SessionHandling.php');
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/search-stylesheet.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/search.js" DEFER></script>
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Search</title>
</head>

<body>

    <?PHP include('public/views/navigation.php') ?>
    <div class="content-container flex column">
    <?PHP include('public/views/searchBar.php') ?>
    <div class="content">

    </div>
    </div>
</body>

<template id="search-template">
        <div class="search flex column" id="">
            <a href=""><img src="" alt="trip" class="search-img round"/></a>
            <div>
                <h2></h2>
                <p></p>
            </div>
        </div>
</template>

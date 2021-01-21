<!DOCTYPE html>

<head>
    <title>Search</title>

    <!--Stylesheets-->
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/search-stylesheet.css">

    <!--Scripts-->
    <script type="module" src="public/scripts/search.js" DEFER></script>

    <!--Icons-->
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
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
            <a class="flex column" href=""><img src="" alt="trip" class="search-img round"/></a>
            <div>
                <h2></h2>
                <p></p>
            </div>
        </div>
</template>

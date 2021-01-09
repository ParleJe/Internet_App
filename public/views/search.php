<?PHP
include('src/SessionHandling.php');
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/search-stylesheet.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"   integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="   crossorigin="anonymous"></script>
    <script type="module" src="public/scripts/searchAJAX.js" DEFER></script>
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Search</title>
</head>

<body>


<?PHP include('public/views/navigation.php') ?>

<div class="content-container flex column">
    <!--<div class="top-bar round">
        <input class="search-input" name="search" type="text" placeholder="Search">
        <button class="search-btn round">Search</button>
    </div>-->
    <?PHP include('public/views/searchBar.php') ?>
    <div class="content"></div>
</div>
</body>
        <!--<div class="search" id="search-1">
            <a><img src="public/resources/placeholder.jpg" alt="trip" class="search-img"/></a>
            <div>
                <h2>LOREM IPSUM</h2>
                <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
            </div>
        </div>-->

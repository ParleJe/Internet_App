<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="public/css/create-stylesheet.css">

    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <title>Create</title>
</head>

<body>
<nav id="navigation-bar">

    <div class="nav-logo-container">
        <img class="nav-logo" src="public/resources/logo.svg" alt="logo of the project" />
    </div>

    <ol>
        <li class="button-container">
            <div class="new-button">
                Get to the Boat
                <img class="nav-add" src="public/resources/drakkar.svg" alt="click here to start new trip">
            </div>
        </li>

        <li>
            <a class="nav-button" href="trips">
                <i class="fas fa-spinner"></i>
                <pre>Your Trips</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="Calendar">
                <i class="far fa-calendar-alt"></i>
                <pre>Calendar</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="friends">
                <i class="fas fa-user-friends"></i>
                <pre>Friends</pre>
            </a>
        </li>
        <li>
            <a class="nav-button" href="settings">
                <i class="fas fa-cog"></i>
                <pre>Settings</pre>
            </a>
        </li>

        <li>
            <a class="nav-button" href="search">
                <i class="fas fa-map-marker-alt"></i>
                <pre>Search</pre>
            </a>
        </li>
        <li>
            <div></div>
        </li>
    </ol>
</nav>

<div class="content-container">
    <div class="top-bar"></div>

    <div class="content">
        <form>
            <input placeholder="Trip name"> <!--Name-->
            <input placeholder="Where?"> <!--Localisation-->
            <textarea rows="6" cols="30" >What is about?</textarea> <!--Description-->
            <input> <!--Photo-->
            <div>
            <input> <!--Point Of Interest-->
                <button id="add-poi">+</button> <!--Submit only Point Of Interest-->
            </div>
            <button id="submit">Submit</button> <!--Submit All Form-->
        </form>
        <div>
            <img src="public/resources/placeholder.jpg">
        </div>
    </div>
</div>
</body>
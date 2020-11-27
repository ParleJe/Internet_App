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
            <a class="new-button" href="create">
                Get to the Boat
                <img class="nav-add" src="public/resources/drakkar.svg" alt="click here to start new trip">
            </a>
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
        <form action="create" method="post">
            <h2>My New Trip</h2>
            <input name="name" placeholder="Trip name"> <!--Name-->
            <input name="where" placeholder="Where?"> <!--Localisation-->
            <textarea name="desc" rows="6" cols="30" placeholder="What is about?"></textarea> <!--Description-->
            <input> <!--Photo-->
            <div>
            <input> <!--Point Of Interest-->
                <button id="add-poi">+</button> <!--Submit only Point Of Interest-->
            </div>
            <button id="submit" type="submit">Submit</button> <!--Submit All Form-->
        </form>
        <div>
            <img src="public/resources/placeholder.jpg">
            <div class="message">
                <?PHP
                if(isset($messages))
                {
                    foreach ($messages as $message)
                    {
                        echo $message;
                    }
                }
                ?>
            </div>
        </div>
    </div>

</div>
</body>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trips.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <!--<script src="../scripts/script.js"></script>-->
    <title>Your Trips</title>
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
        <section class="top-bar">
            <div>
            <h2>City of The Forgotten Kings</h2>
                <a>
                    invite people
                </a>
            </div>
            <div>
                <pre></pre>
                <div class="trip-icons"><!--Icons-->
                    <i class="fas fa-comment-alt"></i>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
            </div>
        </section>
        <section class="content"> <!-- grid layout 3 columns-->

            <div class="flow"> <!--First column etc.-->
                <h2>TITLE OF TRIPS #1</h2>
                <div class="trip" id="trip-1">
                    <h4>location - location</h4>
                    <h3>Title</h3>
                    <img src="public/resources/placeholder.jpg" alt="trip" />
                    <div class="trip-icons">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                </div>

                <div class="trip" id="trip-2">
                    <h4>location - location</h4>
                    <h3>Title</h3>
                    <img src="public/resources/placeholder.jpg" alt="trip" />
                    <div class="trip-icons">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                </div>
            </div>

            <div class="flow">
                <h2>TITLE OF TRIPS #2</h2>
                <div class="trip" id="trip-3">
                    <h4>location - location</h4>
                    <h3>Title</h3>
                    <img src="public/resources/placeholder.jpg" alt="trip" />
                    <div class="trip-icons">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                </div>

                <div class="trip" id="trip-4">
                    <h4>location - location</h4>
                    <h3>Title</h3>
                    <img src="public/resources/placeholder.jpg" alt="trip" />
                    <div class="trip-icons">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                </div>

                <div class="trip" id="trip-5">
                    <h4>location - location</h4>
                    <h3>Title</h3>
                    <img src="public/resources/placeholder.jpg" alt="trip" />
                    <div class="trip-icons">
                        <i class="fas fa-paperclip"></i>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                </div>

            </div>

            <div class="flow">
                <!--TODO empty columns-->
            </div>

        </section>
    </div>
</body>
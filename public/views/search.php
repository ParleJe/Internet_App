<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/search.css">
    <script src="https://kit.fontawesome.com/a19050df1f.js" crossorigin="anonymous"></script>
    <script src="../scripts/script.js"></script>
    <title>Search</title>
</head>

<body>
    <img id="toggle-button" src="public/resources/logo.svg" onclick="showMenu()" alt="Logo of the project" />
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
                <button class="nav-button">
                    <i class="fas fa-spinner"></i>
                    <div class="nav-text">Your Trips</div>
                </button>
            </li>
            <li>
                <button class="nav-button">
                    <i class="far fa-calendar-alt"></i>
                    <div class="nav-text">Calendar</div>
                </button>
            </li>
            <li>
                <button class="nav-button">
                    <i class="fas fa-user-friends"></i>
                    <div class="nav-text">Friends</div>
                </button>
            </li>
            <li>
                <button class="nav-button">
                    <i class="fas fa-cog"></i>
                    <div class="nav-text">Settings</div>
                </button>
            </li>
            <li>
                <button class="nav-button">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="nav-text">Search</div>
                </button>
            </li>
            <li>
                <div></div>
            </li>
        </ol>
    </nav>

    <div class="content-container">
        <div class="top-bar">
            <input name="search" type="text" placeholder="Search">
            <button>Search</button>
        </div>
        <div class="content">

            <div class="search" id="search-1">
                <img src="public/resources/placeholder.jpg" alt="trip" />
                <div>
                    <h2>LOREM IPSUM</h2>
                    <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                </div>
            </div>

            <div class="search" id="search-2">
                <img src="public/resources/placeholder.jpg" alt="trip" />
                <div>
                    <h2>LOREM IPSUM</h2>
                    <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                </div>
            </div>

            <div class="search" id="search-3">
                <img src="public/resources/placeholder.jpg" alt="trip" />
                <div>
                    <h2>LOREM IPSUM</h2>
                    <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                </div>
            </div>


        </div>
    </div>
</body>
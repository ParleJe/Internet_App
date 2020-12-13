<?php


session_start();

if( isset( $_SESSION['isLoggedIn'] ) ) {
    if($_SESSION['isLoggedIn'] == false){
        Routing::run('');
        exit();
    }
} else {
    Routing::run('');
    exit();
}
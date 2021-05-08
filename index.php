<?php
/*
 * Jean-Kenneth Antonio
 * April 23, 2021
 * 328/dating/views/home.html
 *
 * This is my controller for dating website
 * */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//Create an instance of the base class
$f3 = Base::instance();

//Define a default route
$f3 -> route('GET /', function() {
    //display the homepage
    $view = new Template();
    echo $view->render('views/home.html');
    }
);

// Create a profile Pages

// Personal Information
$f3 -> route("GET /personalInfo", function () {
    //display the personal information  page
    $view = new Template();
    echo $view->render('views/personalinfo.html');
});

// Profile
$f3 -> route("GET /profile", function () {
    //display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
});

// Interests
$f3 -> route("GET /interests", function () {
    //display the interests page
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Profile summary
$f3 -> route("GET /profileSummary", function () {
    //display the summary page
    $view = new Template();
    echo $view->render('views/profilesummary.html');
});

//Run fat free
$f3->run();
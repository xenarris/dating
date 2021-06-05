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

//start a session
session_start();

//instantiate classes
$f3 = Base::instance();
$con = new Controller($f3);

//Define a default route
$f3->route('GET /', function () {
    //display the homepage
    $view = new Template();
    echo $view->render('views/home.html');
}
);

// Create a profile Pages

// Personal Information
$f3->route("GET|POST /personalInfo", function () {
    $GLOBALS['con']->personalInfo();
});

// Profile
$f3->route("GET|POST /profile", function () {
    $GLOBALS['con']->profile();
});

// Interests
$f3->route("GET|POST /interests", function () {
    $GLOBALS['con']->interests();
});

// Profile summary
$f3->route("GET /profileSummary", function () {
    $GLOBALS['con']->summary();
});

//Run fat free
$f3->run();
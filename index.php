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
require_once("model/validation.php");
//TODO require controller.php

//start a session
session_start();

//instantiate classes
$f3 = Base::instance();
$con = new Controller($f3);
//TODO instantiate controller

//Define a default route
$f3->route('GET /', function () {
    //display the homepage
    $view = new Template();
    echo $view->render('views/home.html');
}
);

// Create a profile Pages

// Personal Information
$f3->route("GET|POST /personalInfo", function ($f3) {
    $GLOBALS['con']->personalInfo();
});

// Profile
$f3->route("GET|POST /profile", function ($f3) {
    $GLOBALS['con']->profile();
});

// Interests
$f3->route("GET|POST /interests", function ($f3) {

    //Indoor Interests
    $f3->set('indoorinterests', getIndoorInterests());

    //Outdoor Interests
    $f3->set('outdoorinterests', getOutdoorInterests());


    $_SESSION['indoorinterests'] = "No Indoor Interests";
    $_SESSION['outdoorinterests'] = "No Outdoor Interests";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //check interests
        if (validIndoor($_POST['indoorinterests'])) {
            if (is_array($_POST['indoorinterests'])) {
                $_SESSION['indoorinterests'] = implode(", ", $_POST['indoorinterests']);
            }
        }
        if (validOutdoor($_POST['outdoorinterests'])) {
            if (is_array($_POST['outdoorinterests'])) {
                $_SESSION['outdoorinterests'] = implode(", ", $_POST['outdoorinterests']);
            }
        }
        header('location: profileSummary');
    }

    //display the interests page
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Profile summary
$f3->route("GET /profileSummary", function () {
    //display the summary page
    $view = new Template();
    //print_r($_SESSION);
    echo $view->render('views/profilesummary.html');
});

//Run fat free
$f3->run();
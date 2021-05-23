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

//start a session
session_start();

//Require autoload file
require_once('vendor/autoload.php');
require_once("model/validation.php");

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
$f3 -> route("GET|POST /personalInfo", function () {
    //If the form has been submitted, add the data to session
    // and send the user to the next order form
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];

        header('location: profile');
    }

    //display the personal information  page
    $view = new Template();
    echo $view->render('views/personalinfo.html');

});

// Profile
$f3 -> route("GET|POST /profile", function () {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        header('location: interests');
    }

    //display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
    //var_dump($_POST);

});

// Interests
$f3 -> route("GET|POST /interests", function ($f3) {

    //Indoor Interests
    $f3->set('indoorinterests', getIndoorInterests());

    //Outdoor Interests
    $f3->set('outdoorinterests', getOutdoorInterests());





    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $_SESSION['indoorinterests'] = "No Indoor Interests";
        $_SESSION['outdoorinterests'] = "No Outdoor Interests";

        if($_POST['indoorinterests'] != null) {
            $_SESSION['indoorinterests'] = implode(", ", $_POST['indoorinterests']);
        }
        if ($_POST['outdoorinterests'] != null) {
            $_SESSION['outdoorinterests'] = implode(", ", $_POST['outdoorinterests']);
        }

        if ($_SESSION['indoorinterests'] != null && $_SESSION['outdoorinterests'] != null) {
            header('location: profileSummary');
        }



    }

    //display the interests page
    $view = new Template();
    echo $view->render('views/interests.html');
});

// Profile summary
$f3 -> route("GET /profileSummary", function () {
    //display the summary page
    $view = new Template();
    //print_r($_SESSION);
    echo $view->render('views/profilesummary.html');
});

//Run fat free
$f3->run();
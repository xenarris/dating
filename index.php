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
$f3->route('GET /', function () {
    //display the homepage
    $view = new Template();
    echo $view->render('views/home.html');
}
);

// Create a profile Pages

// Personal Information
$f3->route("GET|POST /personalInfo", function ($f3) {
    //If the form has been submitted, add the data to session
    // and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isValidName = false;
        $isValidAge = false;
        $isValidPhone = false;

        //check first name
        if (validName($_POST['fname'])) {
            $_SESSION['fname'] = $_POST['fname'];

            $isValidName = true;
        }
        else {
            $f3->set('errors[name0]', 'Name must only contain letters');
        }

        //check last name
        if (validName($_POST['lname'])) {
            $_SESSION['lname'] = $_POST['lname'];
        }
        else {
            $f3->set('errors[name1]', 'Name must only contain letters');
        }
        //check age
        if (validAge($_POST['age'])) {
            $_SESSION['age'] = $_POST['age'];
            $isValidAge = true;
        } else {
            $f3->set('errors[age]', 'Must be 18+! Max: 118');
        }
        //check phone
        if (validPhone($_POST['phone'])) {
            $_SESSION['phone'] = $_POST['phone'];
            $isValidPhone = true;
        } else {
            $f3->set('errors[phone]', 'Phone number must only contain numbers and between 10-13 digits long');
        }

        //var_dump($_POST);
        $_SESSION['gender'] = $_POST['gender'];

        if ($isValidPhone && $isValidAge && $isValidName) {
            header('location: profile');
        }

    }

    //display the personal information  page
    $view = new Template();
    echo $view->render('views/personalinfo.html');

});

// Profile
$f3->route("GET|POST /profile", function ($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        $isValidEmail = false;

        //check email
        if (validEmail($_POST['email'])) {
            $_SESSION['email'] = $_POST['email'];
            $isValidEmail = true;
        }
        else {
            $f3->set('errors[email]', 'Must be a valid email');
        }


        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        if ($isValidEmail) {
            header('location: interests');
        }

    }

    //display the profile page
    $view = new Template();
    echo $view->render('views/profile.html');
    //var_dump($_POST);

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
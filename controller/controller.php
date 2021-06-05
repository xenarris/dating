<?php

class Controller
{
    private $_f3; //router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function personalInfo()
    {
        //Reinitialize session array
        $_SESSION = array();

        //If the form has been submitted, add the data to session
        // and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['membership'] = $_POST['membership'];


            // make form sticky
            if(!empty($_POST['fname'])) {
                $this->_f3->set('fnameSticky',$_POST['fname']);
            }
            if(!empty($_POST['lname'])) {
                $this->_f3->set('lnameSticky',$_POST['lname']);
            }
            if(!empty($_POST['age'])) {
                $this->_f3->set('ageSticky',$_POST['age']);
            }
            if(!empty($_POST['phone'])) {
                $this->_f3->set('phoneSticky',$_POST['phone']);
            }

            //validation
            $isValidName = false;
            $isValidAge = false;
            $isValidPhone = false;

            //check first name
            if (validName($_POST['fname'])) {
                $_SESSION['fname'] = $_POST['fname'];


                $isValidName = true;
            } else {
                $this->_f3->set('errors[name0]', 'Name must only contain letters');
            }

            //check last name
            if (validName($_POST['lname'])) {
                $_SESSION['lname'] = $_POST['lname'];

            } else {
                $this->_f3->set('errors[name1]', 'Name must only contain letters');
            }

            //check age
            if (validAge($_POST['age'])) {
                $_SESSION['age'] = $_POST['age'];
                $isValidAge = true;
            } else {
                $this->_f3->set('errors[age]', 'Must be 18+! Max: 118');
            }

            //check phone
            if (validPhone($_POST['phone'])) {
                $_SESSION['phone'] = $_POST['phone'];
                $isValidPhone = true;
            } else {
                $this->_f3->set('errors[phone]', 'Phone number must only contain numbers and between 10-13 digits long');
            }

            //var_dump($_POST);

            if ($isValidPhone && $isValidAge && $isValidName) {
                //instantiate class
                //instantiate the required class
                if ($_SESSION['membership'] === "on") {
                    $_SESSION['profileMember'] = new PremiumMember();
                } else {
                    $_SESSION['profileMember'] = new Member();
                }

                //set variables
                $_SESSION['profileMember']->setFname($_POST['fname']);
                $_SESSION['profileMember']->setLname($_POST['lname']);
                $_SESSION['profileMember']->setAge($_POST['age']);
                $_SESSION['profileMember']->setPhone($_POST['phone']);
                if ($_POST['gender'] !== null){
                    $_SESSION['profileMember']->setGender($_POST['gender']);
                }

                //move to next page
                header('location: profile');
            }
        }

        //display the personal information page
        $view = new Template();
        echo $view->render('views/personalinfo.html');
    }

    function profile()
    {
        $this->_f3->set('states', getStates());
        var_dump($_SESSION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //make form sticky
            if(!empty($_POST['email'])) {
                $this->_f3->set('emailSticky',$_POST['email']);
            }

            $isValidEmail = false;

            //check email
            if (validEmail($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['profileMember']->setEmail($_POST['email']);
                $isValidEmail = true;
            }
            else {
                $this->_f3->set('errors[email]', 'Must be a valid email');
            }

            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];

            $_SESSION['profileMember']->setState($_POST['state']);
            $_SESSION['profileMember']->setSeeking($_POST['seeking']);
            $_SESSION['profileMember']->setBio($_POST['bio']);

            if ($isValidEmail) {
                if ($_SESSION['membership'] === "on"){
                    header('location: interests');
                } else {
                    $_SESSION['indoorinterests'] = "Premium Feature";
                    $_SESSION['outdoorinterests'] = "Join to access!";
                    header('location: profileSummary');
                }

            }

        }

        //display the profile page
        $view = new Template();
        echo $view->render('views/profile.html');
        //var_dump($_POST);
    }

    function interests()
    {

        //Indoor Interests
        $this->_f3->set('indoorinterests', getIndoorInterests());

        //Outdoor Interests
        $this->_f3->set('outdoorinterests', getOutdoorInterests());


//        $_SESSION['indoorinterests'] = "No Indoor Interests";
//        $_SESSION['outdoorinterests'] = "No Outdoor Interests";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            //check interests
            if (validIndoor($_POST['indoorinterests'])) {
                if (is_array($_POST['indoorinterests'])) {
                    $_SESSION['profileMember']->setInDoorInterests($_SESSION['indoorinterests']);
                    $_SESSION['indoorinterests'] = implode(", ", $_POST['indoorinterests']);
                }
            }
            if (validOutdoor($_POST['outdoorinterests'])) {
                if (is_array($_POST['outdoorinterests'])) {
                    $_SESSION['profileMember']->setOutDoorInterests($_SESSION['outdoorinterests']);
                    $_SESSION['outdoorinterests'] = implode(", ", $_POST['outdoorinterests']);
                }
            }
            header('location: profileSummary');
        }

        //display the interests page
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        //display the summary page
        $view = new Template();
        //print_r($_SESSION);
        echo $view->render('views/profilesummary.html');
    }


}
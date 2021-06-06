<?php

/**
 * Class Controller does all the directing
 * @author Jean-Kenneth Antonio
 * @version 0.001
 */
class Controller
{
    private $_f3; //router

    /**
     * Controller constructor.
     * @param $f3 mixed
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Redirects to the home page
     */
    function home()
    {
        //Display the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * the personal info page and does data handling and directs to
     * profile when form is valid
     */
    function personalInfo()
    {
        //Reinitialize session array
        $_SESSION = array();

        //If the form has been submitted, add the data to session
        // and send the user to the next order form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
            if (Validation::validName($_POST['fname'])) {

                $isValidName = true;
            } else {
                $this->_f3->set('errors[name0]', 'Name must only contain letters');
            }

            //check last name
            if (!Validation::validName($_POST['lname'])) {
                $this->_f3->set('errors[name1]', 'Name must only contain letters');
            }

            //check age
            if (Validation::validAge($_POST['age'])) {
                $isValidAge = true;
            } else {
                $this->_f3->set('errors[age]', 'Must be 18+! Max: 118');
            }

            //check phone
            if (Validation::validPhone($_POST['phone'])) {
                $isValidPhone = true;
            } else {
                $this->_f3->set('errors[phone]', 'Phone number must only contain numbers and between 10-13 digits long');
            }

            //var_dump($_POST);

            if ($isValidPhone && $isValidAge && $isValidName) {
                //instantiate class
                //instantiate the required class
                if ($_POST['membership'] == "on") {
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

    /**
     * the profile page and handles data handling and directs to interests
     * if premium or straight to summary if regular member
     */
    function profile()
    {
        $this->_f3->set('states', Validation::getStates());

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //make form sticky
            if(!empty($_POST['email'])) {
                $this->_f3->set('emailSticky',$_POST['email']);
            }

            $isValidEmail = false;

            //check email
            if (Validation::validEmail($_POST['email'])) {
                $_SESSION['profileMember']->setEmail($_POST['email']);
                $isValidEmail = true;
            }
            else {
                $this->_f3->set('errors[email]', 'Must be a valid email');
            }

            $_SESSION['profileMember']->setState($_POST['state']);
            $_SESSION['profileMember']->setSeeking($_POST['seeking']);
            $_SESSION['profileMember']->setBio($_POST['bio']);

            if ($isValidEmail) {
                if (get_class($_SESSION['profileMember']) == 'PremiumMember'){
                    header('location: interests');
                } else {
                    header('location: profileSummary');
                }
            }
        }

        //display the profile page
        $view = new Template();
        echo $view->render('views/profile.html');
        //var_dump($_POST);
    }

    /**
     * the interests page with data handling and directs to summary
     */
    function interests()
    {
        //Indoor Interests
        $this->_f3->set('indoorinterests', Validation::getIndoorInterests());

        //Outdoor Interests
        $this->_f3->set('outdoorinterests', Validation::getOutdoorInterests());


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //check interests
            if (Validation::validIndoor($_POST['indoorinterests'])) {
                if (is_array($_POST['indoorinterests'])) {
                    $_SESSION['profileMember']->setInDoorInterests($_POST['indoorinterests']);
                }
            }
            if (Validation::validOutdoor($_POST['outdoorinterests'])) {
                if (is_array($_POST['outdoorinterests'])) {
                    $_SESSION['profileMember']->setOutDoorInterests($_POST['outdoorinterests']);
                }
            }

           header('location: profileSummary');
        }

        //display the interests page
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     * shows a summary of all the data inputted
     */
    function summary()
    {
   /*     echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";*/
        //display the summary page
        $view = new Template();
        echo $view->render('views/profilesummary.html');
    }


}
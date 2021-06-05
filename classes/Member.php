<?php

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor containing first and last name, age, gender, and phone.
     *
     * @param $_fname
     * @param $_lname
     * @param $_age
     * @param $_gender
     * @param $_phone
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * Grabs the first name of the member
     * @return String first name
     */
    public function getFname() : String
    {
        return $this->_fname;
    }

    /**
     * Grabs the last name of the member
     * @return String last name
     */
    public function getLname() : String
    {
        return $this->_lname;
    }

    /**
     * Grabs the age of the member
     * @return int age
     */
    public function getAge() : int
    {
        return $this->_age;
    }

    /**
     * Grabs the gender of the member
     * @return String gender
     */
    public function getGender() : String
    {
        return $this->_gender;
    }

    /**
     * Grabs the phone of the member
     * @return String phone number
     */
    public function getPhone() : String
    {
        return $this->_phone;
    }

    /**
     * Grabs the email of the member
     * @return String email
     */
    public function getEmail() : String
    {
        return $this->_email;
    }

    /**
     * Grabs the state where the member is
     * @return String state
     */
    public function getState() : String
    {
        return $this->_state;
    }

    /**
     * Grabs the gender of the member
     * @return String seeking gender
     */
    public function getSeeking() : String
    {
        return $this->_seeking;
    }

    /**
     * Grabs the bio of the member
     * @return String bio
     */
    public function getBio() : String
    {
        return $this->_bio;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @param mixed $lname
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }



}
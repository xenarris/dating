<?php


/**
 * Class Validation checks if data is correct
 *
 * @author Jean-Kenneth Antonio
 * @version 0.001
 */
class Validation
{
    /**
     * checks if string is all alphabetic
     * @param $name mixed the name to be checked
     * @return bool true if all letters
     */
    public static function validName($name): bool
    {
        return ctype_alpha($name);

    }

    /**
     * checks age is numeric and between 18-118
     * @param $age mixed the age to be checked
     * @return bool true if any number between 18-118 inclusive
     */
    public static function validAge($age) : bool
    {
        return ctype_digit($age) && $age <= 118 && $age >= 18;
    }

    /**
     * checks if number is 10-13 digits
     * @param $phone mixed the number to be checked
     * @return bool true if all numbers and length is 10-13 digits
     */
    public static function validPhone($phone) : bool
    {
        return ctype_digit($phone) && strlen($phone) <= 13 && strlen($phone) >= 10;
    }



    /**
     * checks email if contains "@" and "."
     * @param $email mixed the email to be checked
     * @return bool true if contains @ and .
     */
    public static function validEmail($email) : bool
    {
        if (strpos($email, "@") !== false && strpos($email, ".")) {
            return true;
        }
        return false;
    }

    /**
     * checks indoor interests
     * @param $interests mixed the array of interests to be checked
     * @return bool true if all is contained in the array of indoor interests
     */
    public static function validIndoor($interests) : bool
    {
        if ($interests == "No Indoor Interests") {
            return true;
        }

        $count = 0;
        //list of interests
        $listOfIndoorInterests = Validation::getIndoorInterests();
        if (is_array($interests)){
            while ($count < count($interests)) {
                if (!(in_array($interests[$count], $listOfIndoorInterests))) {
                    return false;
                }
                $count++;
            }
        }

        return true;
    }


    /**
     * checks outdoor interests
     * @param $interests mixed the array to be checked
     * @return bool true if it is in the list of outdoor interests
     */
    public static function validOutdoor($interests) : bool
    {
        if ($interests == "No Outdoor Interests") {
            return true;
        }
        $count = 0;
        //check list of interests
        $listOfOutdoorInterests = Validation::getOutdoorInterests();
        if (is_array($interests)){
            while ($count < count($interests)) {
                if (!(in_array($interests[$count], $listOfOutdoorInterests))) {
                    return false;
                }
                $count++;
            }
        }
        return true;
    }

    /**
     * contains and grabs an array of indoor interests
     * @return string[] an array of indoor interests
     */
    public static function getIndoorInterests(): array
    {
        return array(
            "tv" => "tv",
            "movies" => "movies",
            "cooking" => "cooking",
            "boardGames" => "board games",
            "puzzles" => "puzzles",
            "reading" => "reading",
            "playingCards" => "playing cards",
            "videoGames" => "video games"
        );
    }

    /**
     * contain and grabs an array of outdoor interests
     * @return string[] an array of outdoor interests
     */
    public static function getOutdoorInterests(): array
    {
        return array(
            "hiking" => "hiking",
            "biking" => "biking",
            "swimming" => "swimming",
            "collecting" => "collecting",
            "walking" => "walking",
            "climbing" => "climbing"
        );
    }

    /**
     * contains and grabs an array of US states
     * @return string[] an array of US states
     */
    public static function getStates() : array
    {
        return array(
            "Alabama",
            "Alaska",
            "Arizona",
            "Arkansas",
            "California",
            "Colorado",
            "Connecticut",
            "Delaware",
            "District Of Columbia",
            "Florida",
            "Georgia",
            "Hawaii",
            "Idaho",
            "Illinois",
            "Indiana",
            "Iowa",
            "Kansas",
            "Kentucky",
            "Louisiana",
            "Maine",
            "Maryland",
            "Massachusetts",
            "Michigan",
            "Minnesota",
            "Mississippi",
            "Missouri",
            "Montana",
            "Nebraska",
            "Nevada",
            "New Hampshire",
            "New Jersey",
            "New Mexico",
            "New York",
            "North Carolina",
            "North Dakota",
            "Ohio",
            "Oklahoma",
            "Oregon",
            "Pennsylvania",
            "Rhode Island",
            "South Carolina",
            "South Dakota",
            "Tennessee",
            "Texas",
            "Utah",
            "Vermont",
            "Virginia",
            "Washington",
            "West Virginia",
            "Wisconsin",
            "Wyoming"
        );
    }
}

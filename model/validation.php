<?php

//checks if string is all alphabetic
function validName($name): bool
{
    return ctype_alpha($name);

}

//checks age is numeric and between 18-118
function validAge($age) : bool
{
    return ctype_digit($age) && $age <= 118 && $age >= 18;
}

//checks if number is 10-13 digits
function validPhone($phone) : bool
{
    return ctype_digit($phone) && strlen($phone) <= 13 && strlen($phone) >= 10;
}

//checks email if contains "@" and "."
function validEmail($email) : bool
{
    if (strpos($email, "@") !== false && strpos($email, ".")) {
        return true;
    }
    return false;
}

//checks indoor interests
function validIndoor($interests) : bool
{
    if ($interests == "No Indoor Interests") {
        return true;
    }

    $count = 0;
    //list of interests
    $listOfIndoorInterests = getIndoorInterests();
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

function getIndoorInterests(): array
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

//checks outdoor interests
function validOutdoor($interests) : bool
{
    if ($interests == "No Outdoor Interests") {
        return true;
    }
    $count = 0;
    //check list of interests
    $listOfOutdoorInterests = getOutdoorInterests();
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

function getOutdoorInterests(): array
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

function validation($name, $age, $phone, $email) : bool
{
    return $name && $age && $phone && $email;
}
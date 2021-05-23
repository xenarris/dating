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
    //check if empty
    if ($interests !== null) {
        return true;
    }

    $count = 0;
    //list of interests
    $listOfIndoorInterests = getIndoorInterests();
    while ($count < count($interests)) {
     if (!(in_array($interests[$count], $listOfIndoorInterests))) {
         return false;
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
    //check if empty
    if ($interests !== null) {
        return true;
    }
    $count = 0;
    //check list of interests
    $listOfOutdoorInterests = getOutdoorInterests();
    while ($count < count($interests)) {
        if (!(in_array($interests[$count], $listOfOutdoorInterests))) {
            return false;
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
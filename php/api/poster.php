<?php
require_once(dirname(__DIR__)."/api/util/db_util.php");
include("user.php");

function PosterCreate($login, $name, $descr, $place, $date, $img)
{
    $user_id = UserGetByName($login);
    $result = ExecuteUpdateQuery("INSERT INTO event (name, description, place, date, img_ref, user_id) VALUES('$name', '$descr', '$place', '$date', '$img', '$user_id')");
    return $result;
}

function PostersGetByCurrentUser($login) {
    $user_id = UserGetByName($login);
    $result = ExecuteSelectQuery("SELECT * FROM event WHERE user_id = '$user_id'");
    return $result;
}

function PostersGetByUserName($user_name) {
    $user_id = UserGetByName($user_name);
    $result = ExecuteSelectQuery("SELECT * FROM event WHERE user_id = '$user_id'");
    return $result;
}

function PosterGetByDate($date) {
    $result = ExecuteSelectQuery("SELECT * FROM event WHERE date >= '$date' AND date < '$date' + INTERVAL 1 DAY");
    return $result;
}

function PosterGetAll() {
    $result = ExecuteSelectQuery("SELECT * FROM event");
    return $result;
}

?>
<?php
require_once(dirname(__DIR__)."/api/util/db_util.php");

function PosterCreate($name, $descr, $place, $date, $img)
{
    $user_id = UserGetByName($_SESSION('login'));
    $result = ExecuteQuery("INSERT INTO event VALUES($name, $descr, $place, $date, $img, $user_id)");
    return $result;
}

function PostersGetByCurrentUser($login) {
    $user_id = UserGetByName($login);
    $result = ExecuteQuery("SELECT * FROM event WHERE user_id = '$user_id'");
    return $result;
}

function PostersGetByUserName($user_name) {
    $user_id = UserGetByName($user_name);
    $result = ExecuteQuery("SELECT * FROM event WHERE user_id = '$user_id'");
    return $result;
}

function PosterGetByDate($date) {
    $result = ExecuteQuery("SELECT * FROM event WHERE date >= '$date' AND date < '$date'+1");
    return $result;
}

?>
<?php
require_once(dirname(__DIR__)."/api/util/db_util.php");
include("user.php");

function PosterCreate($login, $name, $descr, $place, $date, $img) { //API method
    $result_array = array(
        "content" => null,
        "error" => null,
    );

    $user_id = UserGetByName($login);
    if ( ! $user_id) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $rows = ExecuteUpdateQuery("INSERT INTO event (name, description, place, date, img_ref, user_id) VALUES('$name', '$descr', '$place', '$date', '$img', '$user_id')");
    if( ! $rows ) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $result_array["content"] = $rows;
    return $result_array;
}

function PostersGetByCurrentUser($login, $page) { //API method
    $rec_limit = 1;
    if( ! isset($page)) {
        $page = 0;
    }
    $offset = $rec_limit * $page ;

    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    $user_id = UserGetByName($login);
    if ( ! $user_id) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $row_count = ExecuteSelectGetCount("SELECT count(1) FROM event WHERE user_id = '$user_id'");
    if( ! $row_count ) {
        $result_array["error"] = 'Can not find any posters';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT * FROM event WHERE user_id = '$user_id'
                                LIMIT $offset, $rec_limit");
    if( ! $rows ) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}

function PosterGetAll($page) { //API method
    $rec_limit = 1;
    if( ! isset($page)) {
        $page = 0;
    }
    $offset = $rec_limit * $page ;

    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    $row_count = ExecuteSelectGetCount("SELECT count(1) FROM event");

    if( ! $row_count ) {
        $result_array["error"] = 'Can not find any posters';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT * FROM event
                                LIMIT $offset, $rec_limit");

    if( ! $rows ) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}

function PosterGetByDate($date, $page, $period) { //API method
    $rec_limit = 1;
    if( ! isset($page)) {
        $page = 0;
    }
    $offset = $rec_limit * $page ;

    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    $row_count = ExecuteSelectGetCount("SELECT count(1) FROM event WHERE date >= '$date' AND date < '$date' + INTERVAL 1 $period");

    if( ! $row_count ) {
        $result_array["error"] = 'Can not find any posters';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT * FROM event WHERE date >= '$date' AND date < '$date' + INTERVAL 1 $period
                                LIMIT $offset, $rec_limit");
    if( ! $rows ) {
        $result_array["error"] = 'Could not get data: ' . mysql_error();
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}
?>
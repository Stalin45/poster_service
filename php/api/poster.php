<?php

function PosterCreate($login, $name, $descr, $place, $date, $img) { //API method
    $result_array = array(
        "content" => null,
        "error" => null,
    );

    if ( ! isset($login) ||
        strlen($login) < 4 ||
        strlen($login) > 20 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $login)) {
        $result_array["error"] = 'Validation error: login value is incorrect';
        return $result_array;
    }

    if ( ! isset($name) ||
        strlen($name) < 4 ||
        strlen($name) > 100 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $name)) {
        $result_array["error"] = 'Validation error: poster name value is incorrect';
        return $result_array;
    }

    if ( ! isset($descr) ||
        empty($descr) ||
        strlen($descr) > 255 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $descr)) {
        $result_array["error"] = 'Validation error: description value is incorrect';
        return $result_array;
    }

    if ( ! isset($place) ||
        strlen($place) < 4 ||
        strlen($place) > 100 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $descr)) {
        $result_array["error"] = 'Validation error: place value is incorrect';
        return $result_array;
    }

    if ( ! isset($date) ||
        is_date($date) ||
        is_in_past($date)) {
        $result_array["error"] = 'Validation error: date value is incorrect';
        return $result_array;
    }

    $user_id = UserGetByName($login);
    if ( ! $user_id) {
        $result_array["error"] = 'Could not get data';
        return $result_array;
    }

    $rows = ExecuteUpdateQuery("INSERT INTO event (name, description, place, date, img_ref, user_id) VALUES('$name', '$descr', '$place', '$date', '$img', '$user_id')");
    if( ! $rows ) {
        $result_array["error"] = 'Could not get data';
        return $result_array;
    }

    $result_array["content"] = $rows;
    return $result_array;
}

function PostersGetByCurrentUser($login, $page) { //API method
    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    if ( ! isset($login) ||
        strlen($login) < 4 ||
        strlen($login) > 20 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $login)) {
        $result_array["error"] = 'Validation error: login value is incorrect';
        return $result_array;
    }

    if (isset($page)) {
        if ( ! is_int($page) ||
             $page < 0) {
            $result_array["error"] = 'Validation error: page value is incorrect';
            return $result_array;
        }
    } else {
        $page = 0;
    }

    $rec_limit = 1;
    $offset = $rec_limit * $page ;

    $user_id = UserGetByName($login);
    if ( ! $user_id) {
        $result_array["error"] = 'Could not get data';
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
        $result_array["error"] = 'Could not get data';
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}

function PosterGetAll($page) { //API method
    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    if (isset($page)) {
        if ( ! is_int($page) ||
            $page < 0) {
            $result_array["error"] = 'Validation error: page value is incorrect';
            return $result_array;
        }
    } else {
        $page = 0;
    }

    $rec_limit = 1;
    $offset = $rec_limit * $page ;

    $row_count = ExecuteSelectGetCount("SELECT count(1) FROM event");

    if( ! $row_count ) {
        $result_array["error"] = 'Can not find any posters';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT * FROM event
                                LIMIT $offset, $rec_limit");

    if( ! $rows ) {
        $result_array["error"] = 'Could not get data';
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}

function PosterGetByDate($date, $page, $period) { //API method
    $result_array = array(
        "content" => null,
        "count" => null,
        "error" => null,
    );

    if ( ! isset($date) ||
        is_date($date) ||
        is_in_past($date)) {
        $result_array["error"] = 'Validation error: date value is incorrect';
        return $result_array;
    }

    if (isset($page)) {
        if ( ! is_int($page) ||
            $page < 0) {
            $result_array["error"] = 'Validation error: page value is incorrect';
            return $result_array;
        }
    } else {
        $page = 0;
    }

    if (!isset($period) ||
        !in_array($period, ["DAY", "MONTH"])
    ) {
        $result_array["error"] = 'Validation error: period value is incorrect';
        return $result_array;
    }

    $rec_limit = 1;
    $offset = $rec_limit * $page ;

    $row_count = ExecuteSelectGetCount("SELECT count(1) FROM event WHERE date >= '$date' AND date < '$date' + INTERVAL 1 $period");

    if( ! $row_count ) {
        $result_array["error"] = 'Can not find any posters';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT * FROM event WHERE date >= '$date' AND date < '$date' + INTERVAL 1 $period
                                LIMIT $offset, $rec_limit");
    if( ! $rows ) {
        $result_array["error"] = 'Could not get data';
        return $result_array;
    }

    $result_array["content"] = $rows;
    $result_array["count"] = $row_count;
    return $result_array;
}
?>
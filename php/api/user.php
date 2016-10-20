<?php

function UserGetByName($user_name) {
    if ( ! isset($user_name) ||
        strlen($user_name) < 4 ||
        strlen($user_name) > 20 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $user_name)) {
        return false;
    }

    $result = ExecuteSelectQuery("SELECT user_id FROM user WHERE login = '$user_name'");
    if (count($result) > 0) {
        return $result[0]['user_id'];
    } else {
        return false;
    }
}

function UserGetRolesByName($user_name) { //API method
    $result_array = array(
        "content" => null,
        "error" => null,
    );

    if ( ! isset($user_name) ||
        strlen($user_name) < 1 ||
        strlen($user_name) > 20 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $user_name)) {
        $result_array["error"] = 'Validation error: user name value is incorrect';
        return $result_array;
    }

    $query_result = ExecuteSelectQuery("SELECT role.role_name 
                                  FROM role 
                                  INNER JOIN user_role ON (role.role_id = user_role.role_id)
                                  INNER JOIN user      ON (user_role.user_id = user.user_id) 
                                  WHERE login = '$user_name'");
    if (!$query_result) {
        $result_array["error"] = "Error. Can occured while retrieving roles";
        return $result_array;
    }

    $role_array = array();
    foreach ($query_result as $row) {
        $role_array[] = $row["role_name"];
    }
    $result_array["content"] = $role_array;

    return $result_array;
}


function UserCreateRegistered($login, $pass, $email) { //API method
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

    //TODO: make MD5 value instead
    if ( ! isset($pass) ||
        strlen($pass) < 7 ||
        strlen($pass) > 30 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $pass)) {
        $result_array["error"] = 'Validation error: password value is incorrect';
        return $result_array;
    }

    if ( ! isset($email) ||
        strlen($email) < 4 ||
        strlen($email) > 50 ||
        preg_match(EMAIL_PATTERN, $email)) {
        $result_array["error"] = 'Validation error: poster name value is incorrect';
        return $result_array;
    }

    $query_user = "INSERT INTO user (login, pass, email) VALUES ('$login', '$pass', '$email')";
    $is_user_created = ExecuteUpdateQuery($query_user);
    if (!$is_user_created) {
        $result_array["error"] = "Can not create new user with parameters: login [$login], email: [$email]";
        return $result_array;
    }

    $user_id = UserGetByName($login);
    $query_user_role = "INSERT INTO user_role (role_id, user_id) VALUES (1, '$user_id')";
    $is_role_appointed = ExecuteUpdateQuery($query_user_role);
    if (!$is_role_appointed) {
        $result_array["error"] = "Error. Can not appoint role to created user. ";
        return $result_array;
    }

    $result_array["content"] = true;
    return $result_array;
}

function UserIsRegistered($login, $pass) { //API method
    $result_array = array(
        "registered" => null,
        "error" => null,
    );

    if ( ! isset($login) ||
        strlen($login) < 1 ||
        strlen($login) > 20 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $login)) {
        $result_array["error"] = 'Validation error: login value is incorrect';
        return $result_array;
    }

    //TODO: make MD5 value instead
    if ( ! isset($pass) ||
        strlen($pass) < 1 ||
        strlen($pass) > 30 ||
        preg_match(FORBIDDEN_CHARACTER_PATTERN, $pass)) {
        $result_array["error"] = 'Validation error: password value is incorrect';
        return $result_array;
    }

    $rows = ExecuteSelectQuery("SELECT user_id FROM user WHERE login = '$login' AND pass = '$pass'");

    if (count($rows) > 0) {
        $result_array["registered"] = true;
    } else {
        $result_aa05rray["registered"] = false;;
    }

    return $result_array;
}
?>
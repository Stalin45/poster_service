<?php
/**
 * Created by PhpStorm.
 * User: Vlastelin
 * Date: 09.10.2016
 * Time: 2:16
 */
require_once(dirname(__DIR__)."/api/util/db_util.php");

function UserGetByName($user_name) {
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

    $query_result = ExecuteSelectQuery("SELECT role.role_name 
                                  FROM role 
                                  INNER JOIN user_role ON (role.role_id = user_role.role_id)
                                  INNER JOIN user      ON (user_role.user_id = user.user_id) 
                                  WHERE login = '$user_name'");
    if (!$query_result) {
        $result_array["error"] = "Error. Can occured while retrieving roles. ". mysql_error();
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

    $query_user = "INSERT INTO user (login, pass, email) VALUES ('$login', '$pass', '$email')";
    $is_user_created = ExecuteUpdateQuery($query_user);
    if (!$is_user_created) {
        $result_array["error"] = "Can not create new user with parameters: login [" . $login . "], email: [" . $email . "]. "
            . mysql_error();
        return $result_array;
    }

    $user_id = UserGetByName($login);
    $query_user_role = "INSERT INTO user_role (role_id, user_id) VALUES (1, '$user_id')";
    $is_role_appointed = ExecuteUpdateQuery($query_user_role);
    if (!$is_role_appointed) {
        $result_array["error"] = "Error. Can not appoint role to created user. ". mysql_error();
        return $result_array;
    }

    $result_array["content"] = true;
    return $result_array;
}

function UserIsRegistered($login, $password) { //API method
    $result_array = array(
        "registered" => null,
    );

    $rows = ExecuteSelectQuery("SELECT user_id FROM user WHERE login = '$login' AND pass = '$password'");

    if (count($rows) > 0) {
        $result_array["registered"] = true;
    } else {
        $result_array["registered"] = false;;
    }

    return $result_array;
}
?>
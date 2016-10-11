<?php
/**
 * Created by PhpStorm.
 * User: Vlastelin
 * Date: 09.10.2016
 * Time: 2:16
 */
require_once(dirname(__DIR__)."/api/util/db_util.php");

function UserGetByName($user_name)
{
    $result = ExecuteSelectQuery("SELECT user_id FROM user WHERE login = '$user_name'");
    return $result;
}

function UserCreateRegistered($login, $pass, $email)
{
    $query_user = "INSERT INTO user (login, pass, email) VALUES ('$login', '$pass', '$email')";
    $is_user_created = ExecuteUpdateQuery($query_user);
    if ($is_user_created) {
        $user_arr = UserGetByName($login);
        $user_id = $user_arr['user_id'];
        $query_user_role = "INSERT INTO user_role (role_id, user_id) VALUES (1, '$user_id')";
        $is_role_appointed = ExecuteUpdateQuery($query_user_role);
        if ($is_role_appointed) {
            return true;
        } else {
            $error = "Error. Can not appoint role to created user!";
            return $error;
        }
    } else {
        $error = "Can not create new user with parameters: login [".$login."], email: [".$email."]";
        return $error;
    }
}
?>
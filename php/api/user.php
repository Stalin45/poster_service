<?php
/**
 * Created by PhpStorm.
 * User: Vlastelin
 * Date: 09.10.2016
 * Time: 2:16
 */

function UserGetByName($user_name)
{
    $result = ExecuteQuery("SELECT user_id FROM user WHERE login = '$user_name'");
    return $result;
}

function UserCreateRegistered($login, $pass, $email)
{
    $query_user = "INSERT INTO user VALUES ('$login', '$pass', '$email')";
    $is_user_created = ExecuteQuery($query_user);
    if ($is_user_created) {
        $user_id = UserGetByName($login);
        $query_user_role = "INSERT INTO user_role (user_id, role_id) VALUES ($user_id, 1)";
        $is_role_appointed = ExecuteQuery($query_user_role);
        if ($is_role_appointed) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>
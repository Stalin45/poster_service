<?php
require_once(dirname(__DIR__)."/api/util/db_util.php");
include("user.php");
include("poster.php");

$json = file_get_contents('php://input');
$request = json_decode($json, true);

if (isset($request["method"])) {
    $method = $request["method"];
} else {
  //TODO: add server error handling with responces
}

if (isset($request["params"])) {
    $params = $request["params"];
} else {
    //TODO: add server error handling with responces
}

$result = call_user_func_array($method, $params);
if (!$result) {
    //TODO: add server error handling with responces
}

$json_response = json_encode($result);

echo $json_response;
?>
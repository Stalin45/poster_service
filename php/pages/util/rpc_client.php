<?php
function SendRPCQuery($method, $args)
{
    $request = array(
        'method' => $method,
        'params' => $args,
    );
    $request = json_encode($request);

    $context  = stream_context_create(
        array('http' => array (
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $request
    )));

    $url = "http://".$_SERVER['SERVER_NAME']."/".APPLICATION_URL_PREFIX."/php/api/rpc_server.php";

    if ($fp = fopen($url, 'r', false, $context)) {
        $response = '';
        while($row = fgets($fp)) {
            $response.= trim($row)."\n";
        }

        $response = json_decode($response, true);
    } else {
        return false;
    }

    return $response;
}
?>
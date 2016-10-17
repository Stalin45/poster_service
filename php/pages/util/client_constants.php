<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'poster_service_db');
define('APPLICATION_URL_PREFIX', 'poster_service');
define('BASE_URL', "http://$_SERVER[HTTP_HOST]/".APPLICATION_URL_PREFIX);
$request_url = "http://$_SERVER[HTTP_HOST]".strtok($_SERVER["REQUEST_URI"],'?');
?>
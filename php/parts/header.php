<?php
    require_once(dirname(__DIR__)."/pages/util/rpc_client.php");
    require(dirname(__DIR__)."/pages/util/client_constants.php");
    ob_start();
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <title>Poster service</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/resources/css/style.css" type="text/css" media="screen"/>
</head>

<body>

<div class="wrapper">
    <div class="header">
        <div class="header-text">
            <p>Find or post your own posters!</p>
            <div style = "vertical-align: bottom", align="right">
                <?php
                    if (isset($_SESSION["authenticated"])) {
                        echo "<p>Hello, ".$_SESSION['login']."</p>";
                    }
                ?>
            </div>
        </div>
    </div>

                    

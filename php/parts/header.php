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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/resources/css/style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/resources/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/resources/css/dashboard.css">
    <script src="<?php echo BASE_URL; ?>/resources/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Find or post your own posters!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><?php
                    if (isset($_SESSION["authenticated"])) {
                        echo "<p>Hello, ".$_SESSION['login']."</p>";
                    }
                    ?>
                </li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

                    

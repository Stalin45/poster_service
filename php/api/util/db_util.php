<?php
error_reporting(1);

function ExecuteUpdateQuery($SQL)
{
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("poster_service_db", $con);

    $result = mysql_query($SQL);

    mysql_close();

    return $result;
}

function ExecuteSelectQuery($SQL)
{
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("poster_service_db", $con);

    $rows = mysql_query($SQL);

    mysql_close();

    return mysql_fetch_array($rows);
}
?>
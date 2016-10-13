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

    $resultArray = array();

    while( $row = mysql_fetch_assoc($rows)){
        $resultArray[] = $row;
    }

    return $resultArray;
}

function ExecuteSelectGetCount($SQL)
{
    $con = mysql_connect("localhost", "root", "");
    mysql_select_db("poster_service_db", $con);

    $count = mysql_query($SQL);

    mysql_close();

    $resultArray = array();

    if( ! $count ) {
        return false;
    } else {
        return mysql_fetch_array($count, MYSQL_NUM )[0];
    }
}
?>
<?php
require ("api_constants.php");
error_reporting(1);

function ExecuteUpdateQuery($SQL)
{
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    mysqli_real_escape_string($SQL);
    $result = mysqli_query($con, $SQL);
    mysqli_close($con);
    return $result;
}

function ExecuteSelectQuery($SQL)
{
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $rows = mysqli_query($con, $SQL);
    mysqli_close($con);
    $resultArray = array();
    while( $row = mysqli_fetch_assoc($rows)){
        $resultArray[] = $row;
    }

    return $resultArray;
}

function ExecuteSelectGetCount($SQL)
{
    $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $count = mysqli_query($con, $SQL);
    mysqli_close($con);
    $resultArray = array();
    if( ! $count ) {
        return false;
    } else {
        return mysqli_fetch_array($count, MYSQLI_NUM )[0];
    }
}
?>
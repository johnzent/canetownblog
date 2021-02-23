<?php
$serverName="127.0.0.1";
$userName="root";
$password="";
$dbName="'cane_wd3_b3";

$mysqli = new mysqli($serverName, $userName, $password, $dbName);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
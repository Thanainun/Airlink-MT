<?php

/* @var $link PDO */
//$link->

$hostname = "localhost";
$username = "root";
$password = "duydui190930";
$database = "air_db";

try {
    $link = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $link->exec("SET NAMES UTF8");
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

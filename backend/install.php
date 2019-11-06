<?php

require_once("config.example.php");

$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($con->connect_error) {
	echo("<b>Failed to access database: </b>" . $con->connect_error);
} else {
    $con->query("");
	$con->query("");               //CREATE THE TABLE
	echo("<b>done.</b>");
}
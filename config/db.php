<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$mysqli = new mysqli("localhost", "root", "", "php-invoice");
// Check for connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
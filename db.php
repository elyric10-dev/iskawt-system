<?php
// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "register";

$usernameLogin = false;
$emailLogin = false;

$conn = mysqli_connect($hostname, $username, $password, $database);

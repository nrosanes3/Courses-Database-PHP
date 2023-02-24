<?php

$server = "localhost";
$username = "nrosanes3";
$password = "password";
$database = "nrosanes3";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}

//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($conn,$value);
}
//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysqli_real_escape_string($conn,$value);
}

if (!defined("BASE_URL")) {
    define("BASE_URL", "http://nrosanes3.dmitstudent.ca/dmit2025/lab4/");
}

?>
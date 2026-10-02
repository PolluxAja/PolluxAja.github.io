<?php
session_start();
$hostname = "127.0.0.1";
$username = "root";
$password = "root";
$database_name = "Register_Web";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error) {
  echo "gagal";
  die();
}

?>
<?php
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['number'];
    $pass = $_POST['password'];
  $comp->validatelogin($phone,$pass);
  }//VALIDATE LOGIN
?>
<?php
session_start();
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $account = $_POST['acc'];
    $password = $_POST['password'];
    $img = $_FILES['image']['name'];

    // Call the register() method to insert data into the database
    $comp->register($user_id, $fname, $lname, $phone, $account, $password, $img);
    echo 'Registration successful!';
}//reg/
?>
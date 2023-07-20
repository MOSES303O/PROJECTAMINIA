<?php 
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesa = $_POST['ntt'];
    $comp->withdraw($pesa,$_SESSION['id']);
    header('Location:list.php');
}//JUST TO LOAD USERS AMOUNT
?>
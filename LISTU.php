<?php 
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesa = $_POST['PESA'];
    $comp->loadamount($pesa,$_SESSION['id']);
    header('Location:list.php');
}//JUST TO LOAD USERS AMOUNT
?>
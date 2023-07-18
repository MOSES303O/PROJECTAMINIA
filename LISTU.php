<?php 
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesa = $_POST['PESA'];
    $comp->loadamount($pesa,$_SESSION['id']);

}//JUST TO LOAD USERS AMOUNT
?>
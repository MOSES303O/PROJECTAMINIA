<?php
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesa = $_POST['nt'];
    $days=$compy->getdate($_POST['day']);
    $phoney=$_POST['phone']; 
    $query = "SELECT*FROM users WHERE phone='$phoney'";
    $result = mysqli_query($comp->connection, $query);
    $row = mysqli_fetch_assoc($result);
     $am = $row['user_id'];
     $ses=$_SESSION['id'];
     $query = "SELECT*FROM users WHERE id='$ses'";
    $resul = mysqli_query($comp->connection, $query);
    $roow = mysqli_fetch_assoc($resul);
     $ph = $roow['phone'];
     mysqli_free_result($resul);
    $comp->lendmoney($pesa,$_SESSION['id'],$am,$days,$pesa,$ph,$phoney);

}//lend money
?>
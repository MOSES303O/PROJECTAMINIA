<?php
include'inclusive.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pesa = $_POST['loans'];
  $sult = mysqli_query($comp->getConnection(), "SELECT*FROM Transaction WHERE liability='$pesa'");
  $row = mysqli_fetch_assoc($sult);
      mysqli_free_result($sult);
  $comp->repay($row['date'],$pesa,$_SESSION['id']);
}
?>
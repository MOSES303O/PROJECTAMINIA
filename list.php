<?php 
  session_start();
require_once'assets/companydata.php';
 require_once'assets/dbclass.php';
$comp=new dbclass('localhost','root','','customer');
  $comp->getConnection();
  if(!isset($_SESSION['id'])){
    header("location: lndex.php");
  }
  $idd=$_SESSION['id'];
  // Execute the query
  $sult = mysqli_query($comp->getConnection(), "SELECT*FROM users WHERE id='$idd'");
  $row = mysqli_fetch_assoc($sult);
      mysqli_free_result($sult);
  ?> 
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" href="css/stylo.css">
</head>
<body>
  <div class="wrapper">
    <div><h1>WELCOME <?php echo $row['fname']; ?>, what would you like to do?</h1></div>
   <ol>
    <li><a href="#" onclick="showForm('myForm1')">Load Money</a></li>
    <li><a href="#" onclick="showForm('myForm2')">Lend Money</a></li>
    <li><a href="#" onclick="showForm('myForm3')">Withdraw</a></li>
    <li><a href="#" onclick="showForm('myForm4')">Financial Statements</a></li>
    <li><a href="#" onclick="showForm('myForm5')">Pull Out</a></li>
    <li><a href="#" onclick="showForm('myForm6')">Repay Loan</a></li>
   </ol> 
 </div>
   <form id="myForm2" method='POST' action="LISTUU.php" style="display: none;">
    <input type="number" name="nt" placeholder="Enter amount">
    <input type="number" name="day" placeholder="days to repay">
    <input type="number" name="phone" placeholder="Enter phone number">
    <input type="submit" value="Lend">
  </form>

  <form id="myForm1"  method='POST' action="LISTU.php"  style="display: none;">
    <input type="number" name="PESA" placeholder="Enter amount">
    <input type="submit" value="Deposit">
  </form>

  <form id="myForm3" method='POST' action="LST.php" style="display: none;">
    <input type="number" name="ntt" placeholder="Enter amount">
    <input type="submit" value="Withdraw">
  </form>
  <?php
   $userid = $row['user_id'];
   $simu = $row['phone'];
if (mysqli_num_rows(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone2='$simu'and user_id='$userid'")) > 0) {
  $rowsCount = mysqli_num_rows(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone2='$simu'and user_id='$userid'"));
$count_result = mysqli_query($comp->getConnection(), "SELECT COUNT(liability) as count FROM Transaction");
$count_row = mysqli_fetch_assoc($count_result);
$count = $count_row['count'];
?>
    <form id="myForm5"  style="display: none;">
    <p>
     <label><h2>Lended</h2></label><br>
     <?php
    // Fetch rows one by one and create radio buttons
    $counter = 0;
    while ($row = mysqli_fetch_assoc(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone2='$simu' and user_id='$userid'"))) {  
        if ($counter < $count) {
          $amount = $row['liability'];
          // Generate a unique ID for each radio button
          $radioId = 'loan_' . $amount;
          // Create the radio button
          echo '<input type="radio" name="loans" value="' . $amount . '" id="' . $radioId . '">';
          echo '<label for="' . $radioId . '">' . $amount . '</label><br>';
          $counter++;
      } else {
          break;
      }
    }
    echo '</p>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
  }
  ?>
  <?php
if (mysqli_num_rows(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone1='$simu'")) > 0) {
  $rowsCount = mysqli_num_rows(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone1='$simu'"));
$count_result = mysqli_query($comp->getConnection(), "SELECT COUNT(liability) as count FROM Transaction WHERE phone1='$simu'");
$count_row = mysqli_fetch_assoc($count_result);
$count = $count_row['count'];
?>
   <form id="myForm6" method='POST' action="LISTO.php" style="display: none;">
    <?php
    // Fetch rows one by one and create radio buttons
    $counter = 0;
    while ($ruw = mysqli_fetch_assoc(mysqli_query($comp->getConnection(), "SELECT liability FROM transaction WHERE phone1='$simu'"))) {  
      $ganja = $ruw['liability'];
        if ($counter < $count && $ganja>0) {
            echo '<p>';
          echo '<label><h2>Lended</h2></label><br>';
          // Generate a unique ID for each radio button         
          $radioId = 'loan_' . $ganja;
          // Create the radio button
          echo '<input type="radio" name="loans" value="' . $ganja . '" id="' . $radioId . '">';
          echo '<label for="' . $radioId . '">' . $ganja . '</label><br>';
        $counter++;
        echo '</p>';
        echo '<input type="submit" value="Repay">';
        echo '</form>';
          
      } else {
          break;
      }
    }
  }
  ?>
  <?php
  $st = mysqli_query($comp->getConnection(), "SELECT*FROM Transaction WHERE phone1='$simu' XOR phone2='$simu'");
  $rw = mysqli_fetch_assoc($st);
      mysqli_free_result($st);
    ?>
  <table id="myForm4" style="display: none;">
    <thead>
        <th>User ID</th>
        <th>Date</th>
        <th>Liability</th>        
        <th>AmountStatus</th>
        <th>Phone1</th>
        <th>Phone2</th> 
        <th>payStatus</th>      
    </thead>
    <tbody>
        <td><?php echo $rw['user_id']?></td>
        <td><?php echo $rw['date']?></td>
        <td><?php echo $rw['liability']?></td>
        <td><?php echo $rw['status']?></td>
        <td><?php echo $rw['phone1']?></td>
        <td><?php echo $rw['phone2']?></td>
        <td><?php echo $rw['paystatus']?></td>
    </tbody>
  </table>
<script>
function showForm(formId) {
  var forms = document.getElementsByTagName('form');
  for (var i = 0; i < forms.length; i++) {
    forms[i].style.display = 'none';
  }
  document.getElementById(formId).style.display = 'block';
  setTimeout(function() {
    document.getElementById(formId).style.display = 'none';
  }, 30000);
}
</script>
</body>
</html>

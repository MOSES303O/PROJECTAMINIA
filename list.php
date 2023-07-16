<?php 
  session_start();
  if(!isset($_SESSION['id'])){
    header("location: lndex.php");
  }
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
    <div><h1>WELCOME ochieng, what would you like to do?</h1></div>
   <ol>
    <li><a href="#" onclick="showForm('myForm1')">Load Money</a></li>
    <li><a href="#" onclick="showForm('myForm2')">Lend Money</a></li>
    <li><a href="#" onclick="showForm('myForm3')">Withdraw</a></li>
    <li><a href="#" onclick="showForm('myForm4')">Financial Statements</a></li>
    <li><a href="#" onclick="showForm('myForm5')">Pull Out</a></li>
    <li><a href="#" onclick="showForm('myForm6')">Repay Loan</a></li>
   </ol> 
 </div>
   <form id="myForm2" method='POST' action="LISTO.php" style="display: none;">
    <input type="number" name="nt" placeholder="Enter amount">
    <input type="number" name="day" placeholder="days to repay">
    <input type="number" name="phone" placeholder="Enter phone number">
    <input type="submit" value="Submit">
  </form>

  <form id="myForm1" style="display: none;">
    <input type="number" name="PESA" placeholder="Enter amount">
    <input type="submit" value="Submit">
  </form>

  <form id="myForm3" style="display: none;">
    <input type="number" name="nt" placeholder="Enter amount">
    <input type="submit" value="Submit">
  </form>
  <form id="myForm5" style="display: none;">
  <p>                  
    <label><h2>Lended</h2></label><br>
    <input type="radio" name="lended"  value="5000"/>5000
    <input type="radio" name="lended"  value="2000"/>2000
    <input type="radio" name="lended" value="30000"/>30000
  </p>
    <input type="submit" value="Submit">
  </form>
  <form id="myForm6" style="display: none;">
  <p>                  
    <label><h2>Loans</h2></label><br>
    <input type="radio" name="loans"  value="99999"/>99999
    <input type="radio" name="loans"  value="88888"/>88888
    <input type="radio" name="loans" value="77777"/>77777
  </p>
    <input type="submit" value="Submit">
  </form>
  <table id="myForm4" style="display: none;">
    <thead>
        <th>User ID</th>
        <th>Date</th>
        <th>Liability</th>
        <th>Account Number</th>
        <th>Amount Status</th>
        <th>Phone1</th>
        <th>Phone2</th>        
    </thead>
    <tbody>
        <td>40248761</td>
        <td>2023-07-11</td>
        <td>50000</td>
        <td>123456</td>
        <td>Debt</td>
        <td>0769764619</td>
        <td>0717909471</td>
    </tbody>
  </table>
 </div>
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

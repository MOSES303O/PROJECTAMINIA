<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMEPAGE</title>
</head>
<body>
    <div><h1>WELCOME ochieng,what would you like to do?</h1></div>
   <ol>
    <li><a href="#"onclick="showform1()">Load Money</li>
    <li><a href="#"onclick="showform2()">Lend Money</li>
    <li><a href="#"onclick="showform3()">Withdraw</li>
    <li><a href="#"onclick="showform4()">Financial Statements</li>
    <li><a href="#"onclick="showform5()">Pull Out</li>
    <li><a href="#"onclick="showform6()">Repay Loan</li>
   </ol> 
   <form id="myForm2" style="display: block;">
    <input type="number" name="amount" placeholder="Enter amount">
    <input type="number" name="phone" placeholder="Enter phone number">
    <input type="submit" value="Submit">
  </form>

  <form id="myForm1" style="display: block;">
    <input type="number" name="amount" placeholder="Enter amount">
    <input type="submit" value="Submit">
  </form>

  <form id="myForm3" style="display: block;">
    <input type="number" name="amount" placeholder="Enter amount">
    <input type="submit" value="Submit">
  </form>
  <form id="myForm5" style="display: block;">
  <p>                  
    <label><h2>lended</h2></label><br>
    <input type="radio" name="lended"  value="5000"/>50000
    <input type="radio" name="lended"  value="2000"/>2000
    <input type="radio" name="lended" value="30000"/>30000
  </p>
    <input type="submit" value="Submit">
  </form>
  <form id="myForm6" style="display: block;">
  <p>                  
    <label><h2>loans</h2></label><br>
    <input type="radio" name="loans"  value="99999"/>99999
    <input type="radio" name="loans"  value="88888"/>88888
    <input type="radio" name="loans" value="77777"/>77777
  </p>
    <input type="submit" value="Submit">
  </form>
  <table id="form4" style="display:block;">
    <thead>
        <th>user id</th>
        <th>date</th>
        <th>liability</th>
        <th>account number</th>
        <th>amount status</th>
        <th>phone1</th>
        <th>phone2</th>        
    </thead>
    <tbody>
        <td>40248761</td>
        <td>2023-7-11</td>
        <td>50000</td>
        <td>123456</td>
        <td>debt</td>
        <td>0769764619</td>
        <td>0717909471</td>
    </tbody>
  </table>
<script>
function showForm1() {
  document.getElementById("myForm1").style.display = "none;";
}

function showForm2() {
  document.getElementById("myForm2").style.display = "none;";
}

function showForm3() {
  document.getElementById("myForm3").style.display = "none;";
}
function showForm1() {
  document.getElementById("myForm4").style.display = "none;";
}

function showForm2() {
  document.getElementById("myForm5").style.display = "none;";
}

function showForm3() {
  document.getElementById("myForm6").style.display = "none;";
}
</script>
</body>
</html>
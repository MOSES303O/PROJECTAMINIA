<?php
declare(strict_types=1);
require_once'assets/companydata.php';
require_once'assets/dbclass.php';
$company=new companydata(99,88,'20/3/2023','musa',50);
/*$company->fuliza=4000;
$company->loan=50000;
$company->paidloan=500;
$company->loanbalance(5006);
$company->repaymentdate='20/3/2023';
*/
$comp=new dbclass('localhost','root','','customer');
echo '<br>';
$comp->getConnection();
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
}
//$comp->register(123456,'moses','juma',07179094,111111,'moses123','juma');
//var_dump($company->loanbalance(5006).$company->checkpaymentmade());
//var_dump($company->booldays('2023-07-10'));
//var_dump($company->calculaterate('pulloutt'));
//echo companydata::getdate(5);


?>
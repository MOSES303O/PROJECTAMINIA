<?php
declare(strict_types=1);
require_once'companydata.php';
$company=new companydata(99,88,'20/3/2023','musa',50);
$company->fuliza=4000;
$company->loan=50000;
$company->paidloan=500;
$company->loanbalance(5006);
$company->repaymentdate='20/3/2023';

//var_dump($company->loanbalance(5006).$company->checkpaymentmade());
//var_dump($company->booldays('2023-07-10'));
echo '<br>';
//var_dump($company->calculaterate('pulloutt'));
//echo companydata::getdate(5);


?>
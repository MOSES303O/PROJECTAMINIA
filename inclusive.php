<?php
declare(strict_types=1);
session_start();
  if(!isset($_SESSION['id'])){
    header("location: index.pp");
  }
require_once'assets/companydata.php';
require_once'assets/dbclass.php';
$comp=new dbclass('localhost','root','','customer');
$compy=new companydata();
$comp->getConnection();
?>

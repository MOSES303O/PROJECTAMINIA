<?php
declare(strict_types=1);
class companydata {
    private string $user;
    private $accountbalance=60000;
    public int $amount;
    private int $totalpaid=5000;
    public $currentDate, $setDate, $initialDate,$fuliza,$loan;
    public string $repaymentdate;
    public int $paidloan;
    protected  $name,$emailid,$phone_no,$address,$city,$state,$pin;
    /*public function __construct(int $loan,int $amount,string $repaymentdate,string $amountstatus,int $paidloan){
        $this->$amount = $amount;
        $this->$repaymentdate = $repaymentdate;
        $this->$paidloan = $paidloan;
        $this->$amountstatus = $amountstatus;
        $this->$loan =$loan ;
        
    }  */    
    protected function calculaterate($amountstatus) {
        //working
        $reschedule = false;
        
        if (!$reschedule) {
            switch ($amountstatus) {
                case 'pullout':
                    $rate = 10;
                    return $rate;
                    break;
                case 'delay':
                    $rate = 10;
                    return $rate;
                    break;
                default:
                    $rate = 5;
                    return $rate;
                    break;
            }
        }
    }
    
    public function getrepaymentdate(){
        //working
        return $this->repaymentdate;
    }
    
    public function checkpaymentmade(){  
        //WORKING      
        return $this->loan-$this->loanbalance($this->paidloan);
    }
    public function loanbalance($paidloan){
        //WORKING
        if($this->loan==$this->totalpaid){
            echo "You have cleared ur loan";exit();
        }else{
           // print("Still Paying Loan...");echo "<br>";
            return $this->loan-$paidloan;
        }
    }
    public function superchargefuliza(){
        //working
        if($this->fuliza>0.00)return $this->fuliza=$this->fuliza+$this->loan;
    }
     public function getdate($number) {
    // working
    $currentDate = date('Y-m-d');
    $newDate = date('Y-m-d', strtotime($currentDate . ' + ' . $number . ' days'));

    return $newDate;
    }
    public function booldays($setdate){
        //working
        $currentdatee=date('Y-m-d');
        if((strtotime($setdate)-strtotime($currentdatee))<1){
            return false;
        }else{
            return true;
        }
    }   
}
//echo companydata::getdate(55);
?>
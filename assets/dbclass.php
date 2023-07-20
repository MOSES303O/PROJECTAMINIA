<?php
class dbclass extends companydata {
    private $host;
    private $username;
    private $password;
    private $database;
    public $connection;
    private $companyid=111111;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->password = $password;
        $this->username = $username;
        $this->database = $database;

        // Establish the database connection
        $this->connection = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function getConnection() {       
        return $this->connection;
    }

    public function closeConnection() {
        mysqli_close($this->connection);
    }
    public function validatelogin($phoneyy,$passs){    
        //WORKING    
        $phone = mysqli_real_escape_string($this->connection, $phoneyy);
    $pass = mysqli_real_escape_string($this->connection, $passs);
    if(!empty($phone) && !empty($pass)){
        $sql = mysqli_query($this->connection, "SELECT * FROM users WHERE phone = '{$phone}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($pass);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                header("Location:list.php");
                $_SESSION['id'] = $row['id'];
            }else{
                echo "phone or Password is Incorrect!";
            }
        }else{
            echo "$phone - This phone does not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
    }

    public function loanvaldation($phoneNumber) {
        $startTime = time(); 
        while (true) {
            $query = "SELECT * FROM your_table WHERE phone_number = '{$phoneNumber}'";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $entryTime = time('Y-m-d');
                if ($entryTime - $startTime <= 120) {
                header("Location: passwording.php");
                break;
            }else{
                echo "<script>alert('You have exceeded the maximum number of attempts.');</script>";
                break;
             }
         }
            sleep(1);
        }
        $this->closeConnection();
    } 
    private function getamount($id){
        //working f
        $query = "SELECT amount FROM users WHERE id='$id'";
    // Execute the query
    $result = mysqli_query($this->connection, $query);
    $row = mysqli_fetch_assoc($result);

        // Retrieve the value of $amount from the row
        $amount = $row['amount'];
        // Free the result set
        mysqli_free_result($result);
        // Return the value of $amount
        return $amount;
    }
    private function getamountt($phone){
        //WORKING
        $query ="SELECT amount FROM users WHERE phone='$phone'";
        $result=mysqli_query($this->connection, $query);
    $row = mysqli_fetch_assoc($result);

        // Retrieve the value of $amount from the row
        $amount = $row['amount'];
        // Free the result set
        mysqli_free_result($result);
        // Return the value of $amount
        return $amount;
    }
    private function getcompanyamount($roow){
        //working
        $query = "SELECT*FROM companydata WHERE id='$this->companyid'";
    // Execute the query
    $result = mysqli_query($this->connection, $query);
    $row = mysqli_fetch_assoc($result);

        // Retrieve the value of $amount from the row
        $amount = $row[$roow];
        // Free the result set
        mysqli_free_result($result);
        // Return the value of $amount
        return $amount;
    }
    public function loadamount($amount,$id){
        //WORKING
        //update amount in database here... 
        //create a fuction that extract the value from the database and then updates it
        $pesa=$this->getamount($id);
        $mbesa=$pesa+$amount;
        $sql = "UPDATE users SET amount= '$mbesa' WHERE id='$id'";
        mysqli_query($this->connection,$sql);
        
    }
    private function updatelendeeamount($user_id,$date,$liability,$phone1,$phone2){
        //working
        //update amount in database here...  
        $status='loan';
        $paystatus=false;
        $sql = "INSERT INTO Transaction (user_id, date, liability,status,phone1,phone2,paystatus)
        VALUES('$user_id','$date','$liability','$status','$phone1','$phone2','$paystatus')";
        mysqli_query($this->connection,$sql);
        //work on the rates your desire
        $pesa=$this->getamountt($phone2);
        $mbesa=$pesa+$liability;
        $sqll = "UPDATE users SET amount= '$mbesa' WHERE phone='$phone2'";
        mysqli_query($this->connection,$sqll);
    }public function lendmoney($amount,$id,$user_id,$date,$liability,$phone1,$phone2){
        //working
        if($this->getamount($id)>$amount){
            $this->updatelendeeamount($user_id,$date,$liability,$phone1,$phone2);
            $pesa=$this->getamount($id);
            $mbesa=$pesa-$amount;
            $sqll = "UPDATE users SET amount= '$mbesa' WHERE id='$id'";
            mysqli_query($this->connection,$sqll);
        }else{
            echo"insufficient balance to loan.";
        }
    }
    public function withdraw($amount,$id){
        //working
            $mbesa=$this->getamount($id)-$amount;
            $sqll = "UPDATE users SET amount= '$mbesa' WHERE id='$id'";
            mysqli_query($this->connection,$sqll);
    }public function pullout($amount,$id,){
        
        //get all assets from the database
        $amountstatus='loan';
        $sql = mysqli_query($this->connection, "SELECT*FROM transaction WHERE status = '{$amountstatus}'");
        //check
        $pesas=mysqli_query($this->connection,$sql);
        $roow = mysqli_fetch_assoc($pesas);
        //loop through the database
        foreach($roow['liability'] as $pesa){
            if($pesa==$amount){  
              //pull 90% from company database           
             $ratee=$this->calculaterate('pullout');
             $totalbalance=$this->getamount($id);
               $totalbalance+=$pesa*$ratee['rate'];
               //update the lenders database
               $sqll="UPDATE users SET ,amount='$totalbalance' where id='$id'";
               mysqli_query($this->connection,$sqll);
               //update table transaction               
               $phoney='';
               $query = "SELECT*FROM transaction WHERE amount='$amount'";
               // Execute the query
               $result = mysqli_query($this->connection, $query);
               $row = mysqli_fetch_assoc($result);              
               $sqll = "UPDATE transaction SET user_id='$this->companyid,phone1='$phoney' WHERE ,phone2='{$row['phone2']}'";
               mysqli_query($this->connection,$sqll);
               //update company database
                $m='accbalance';
               $newcomapnybalace=$this->getcompanyamount($m)-($pesa*$ratee['rate']);
               $y='assets';
               $newassetcount=$this->getcompanyamount($y)+($pesa-($pesa*$ratee['rate']));
               //update company database
               $sql = mysqli_query($this->connection, "UPDATE companydata SET assets='$newassetcount',accbalance='$newcomapnybalace'");
               $pesas=mysqli_query($this->connection,$sql);
            }
        }                       
    }
    public function repay($setdate,$amount,$dd){
        //repay
        //check repayment  date
        if($this->booldays($setdate)===false){   
            //fetch amount status from the database            
                $query = "SELECT*FROM transaction WHERE liability='$amount'";
                // Execute the query
                $result = mysqli_query($this->connection, $query);
                $row = mysqli_fetch_assoc($result);            
                    // Retrieve the value of $amount from the row
                        $rr=($row['liability']*(1+$this->calculaterate('delay')/100))-$amount;
                        $statu=false;
                        $sqll = "UPDATE transaction SET liability='$rr',paystatus='$statu' WHERE liability='{$amount}'";
                         mysqli_query($this->connection,$sqll);                                                                    
               //reduce asses,increase accbalance,resetdate
               $q = "SELECT*FROM companydata";
               // Execute the query
               $reslt = mysqli_query($this->connection, $q);
               $roww = mysqli_fetch_assoc($reslt);            
                   // Retrieve the value of $amount from the row
                       $rrt=$roww['accbalance']+$rr;
                       $rrk=$roww['assets']-$amount;
                       $s = "UPDATE companydata SET date='date('Y-m-d')' liability='$rrt',assets='{$rrk}'";
                        mysqli_query($this->connection,$s);
                        //get amount from users db and subtract
                        $newbalance=$this->getamount($dd)-$amount;
               $sl = "UPDATE users SET  amount='{$newbalance}' WHERE id='{$dd}'";
               mysqli_query($this->connection,$sl);           
        }else{
            $sult = mysqli_query($this->connection, "SELECT*FROM Transaction WHERE liability='$amount'");
            $row = mysqli_fetch_assoc($sult);
            $mula=$row['liability']-$amount;   
            $statuu=true;       
            $qll = "UPDATE Transaction SET liability='$mula',paystatus='$statuu'WHERE liability='{$amount}'";
            mysqli_query($this->connection,$qll);
            //reduce asses,increase accbalance,resetdate        
            $reslt = mysqli_query($this->connection, "SELECT * FROM companydata ");
            if($reslt){
            //mysqli_free_result($reslt);
            $roww = mysqli_fetch_assoc($reslt);            
                // Retrieve the value of $amount from the row
                    $rrt=$roww['accbalance']+$amount;
                    $rrk=$roww['assets']-$amount;
                    $tarehe=date('Y-m-d');                   
                     mysqli_query($this->connection,"UPDATE companydata SET date='$tarehe',liability='$rrt',assets='$rrk'");
                     //get amount from users db and subtract
                     $newbalance=$this->getamount($dd)-$amount;                
            mysqli_query($this->connection, "UPDATE users SET  amount='$newbalance' WHERE id='{$dd}'");
            }
        }
        //show all the owned amount
        //get all the money plus lenders id
        //check balance
        //subtract from the lendees database
        //update amount to the lender
    }
    public function register( $user_id,$fname, $lname, $phone,$account, $password, $img) {
        //working
        $fname = mysqli_real_escape_string($this->connection, $fname);
        $user_id = mysqli_real_escape_string($this->connection, $user_id);
        $lname = mysqli_real_escape_string($this->connection, $lname);        
        $accno = mysqli_real_escape_string($this->connection, $account);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $password = mysqli_real_escape_string($this->connection, $password);
        $image = mysqli_real_escape_string($this->connection, $img);
        $hashedPassword = md5($password);;
        $ran_id = rand(time(), 100000000);     
        $fuliza=0;
        $amount=0;
        $query = "INSERT INTO users (id,user_id,fname, lname, phone,account, password, img,amount,fuliza) 
                  VALUES ('$ran_id','$user_id','$fname', '$lname', '$phone', '$accno', '$hashedPassword','$image','$amount','$fuliza')";
        $result = mysqli_query($this->connection, $query);
        if ($result) {            
            if(mysqli_num_rows(mysqli_query($this->connection,"SELECT*FROM users WHERE phone='{$phone}'"))>0){            
                $rest=mysqli_fetch_assoc(mysqli_query($this->connection,"SELECT*FROM users WHERE phone='{$phone}'"));
                if($rest){
                session_start();
                $_SESSION['id'] = $rest['id']; 
                }               
            }            
            header('Location: list.php');
                exit();      
            
        } else {
            header('Location:lndex.php');
            exit();
        }
        mysqli_close($this->connection);
    }
    
}

?>
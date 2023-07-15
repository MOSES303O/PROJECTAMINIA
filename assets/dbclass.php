<?php
class dbclass extends companydata {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
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
        echo 'connection made successfully';
        return $this->connection;
    }

    public function closeConnection() {
        mysqli_close($this->connection);
    }
    public function validatelogin($phone,$pass){
        $phone = mysqli_real_escape_string($this->connection, $_POST['phone']);
    $pass = mysqli_real_escape_string($this->connection, $_POST['password']);
    if(!empty($phone) && !empty($pass)){
        $sql = mysqli_query($this->connection, "SELECT * FROM users WHERE phone = '{$phone}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($pass);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                header("Location: home.php");
                echo 'moses hi';
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
                $entryTime = time();
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
    private function getcompanyamount($row){
        $query = "SELECT*FROM companydata WHERE id='$this->companyid'";
    // Execute the query
    $result = mysqli_query($this->connection, $query);
    $row = mysqli_fetch_assoc($result);

        // Retrieve the value of $amount from the row
        $amount = $row[$row];
        // Free the result set
        mysqli_free_result($result);
        // Return the value of $amount
        return $amount;
    }
    public function loadamount($amount,$id){
        //update amount in database here... 
        //create a fuction that extract the value from the database and then updates it
        $pesa=$this->getamount($id);
        $mbesa=$pesa+$amount;
        $sql = "UPDATE user SET amount= '$mbesa' WHERE id='$id'";
        mysqli_query($this->connection,$sql);
    }
    private function updatelendeeamount($id,$user_id,$date,$liability,$assets,$account,$status,$phone1,$phone2){
        //update amount in database here... 
        $sql = "INSERT INTO Transaction (id, user_id, date, accbalance, liability,assets,account,status,phone1,phone2)
        VALUES('$id','$user_id','$date','$liability','$assets','$account','$status','$phone1','$phone2')";
        mysqli_query($this->connection,$sql);
        //work on the rates your desire
        $pesa=$this->getamount($id);
        $mbesa=$pesa+$liability;
        $sqll = "UPDATE users SET amount= '$mbesa' WHERE phone'$phone2'";
        mysqli_query($this->connection,$sqll);
    }public function lendmoney($amount,$phone,$id,$user_id,$date,$liability,$assets,$account,$status,$phone1,$phone2){
        if($this->getamount($id)>$amount){
            $this->updatelendeeamount($id,$user_id,$date,$liability,$assets,$account,$status,$phone1,$phone2);
            $pesa=$this->getamount($id);
            $mbesa=$pesa-$amount;
            $sqll = "UPDATE users SET amount= '$mbesa' WHERE phone'$phone'";
            mysqli_query($this->connection,$sqll);
        }else{
            echo"insufficient balance to loan.";
        }
    }
    public function withdraw($amount,$id,$phone){
            $mbesa=$this->getamount($id)-$amount;
            $sqll = "UPDATE users SET amount= '$mbesa' WHERE phone='$phone'";
            mysqli_query($this->connection,$sqll);
    }public function pullout($amount,$id,){
        //get all assets from the database
        $amountstatus='lender';
        $sql = mysqli_query($this->connection, "SELECT assets FROM transaction WHERE amountstatus = '{$amountstatus}'");
        //check
        $pesas=mysqli_query($this->connection,$sql);
        $roow = mysqli_fetch_assoc($pesas);
        //loop through the database
        foreach($roow as $pesa){
            if($pesa==$amount){  
              //pull 90% from company database           
             $ratee=$this->calculaterate('pullout');
             $totalbalance=$this->getamount($id);
               $totalbalance+=$pesa*$ratee['rate'];
               //update the lenders database
               $sqll="UPDATE users SET ,amount='$totalbalance' where id='$id'";
               mysqli_query($this->connection,$sqll);
               //update table transaction

               $asets=0;
               $phoney='';
               $query = "SELECT assets FROM transaction WHERE amount='$amount'";
               // Execute the query
               $result = mysqli_query($this->connection, $query);
               $row = mysqli_fetch_assoc($result);              
               $sqll = "UPDATE transaction SET user_id='$this->companyid assets='$asets',phone1='$phoney' WHERE assets='{$amount}',phone2='{$row['phone2']}'";
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
    public function repay($setdate,$amount,$databseamont){
        //check repayment  date
        if($this->booldays($setdate)===false){   
            //fetch amount status from the database
            if($amount<$databseamont||$amountstate===true){
                $query = "SELECT liability FROM transaction WHERE id='$dd',liability='$amount'";
                // Execute the query
                $result = mysqli_query($this->connection, $query);
                $row = mysqli_fetch_assoc($result);            
                    // Retrieve the value of $amount from the row
                        $rr=($row['liability']*(1+$this->calculaterate('delay')/100))-$amount;
                        $sqll = "UPDATE transaction SET liability='$rr' WHERE liability='{$amount}'";
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
            } 
        }else{
            $sult = mysqli_query($this->connection, "SELECT liability FROM transaction WHERE id='$dd',liability='$amount'");
            $row = mysqli_fetch_assoc($sult);
            $mula=$row['liability']-$amount;          
            $qll = "UPDATE transaction SET liability='$mula' WHERE liability='{$amount}'";
            mysqli_query($this->connection,$qll);
            //reduce asses,increase accbalance,resetdate
            $ql="SELECT * FROM companydata ";
            $reslt = mysqli_query($this->connection, $ql);
            $roww = mysqli_fetch_assoc($reslt);            
                // Retrieve the value of $amount from the row
                    $rrt=$roww['accbalance']+$amount;
                    $rrk=$roww['assets']-$amount;
                    $s = "UPDATE companydata SET date='date('Y-m-d')' liability='$rrt',assets='{$rrk}'";
                     mysqli_query($this->connection,$s);
                     //get amount from users db and subtract
                     $newbalance=$this->getamount($dd)-$amount;                
            $sql = "UPDATE users SET  amount='$newbalance' WHERE id='{$dd}'";
            mysqli_query($this->connection,$sql);
        }
        //show all the owned amount
        //get all the money plus lenders id
        //check balance
        //subtract from the lendees database
        //update amount to the lender
    }
    public function register( $user_id,$fname, $lname, $phone,$account, $password, $img) {
        $fname = mysqli_real_escape_string($this->connection, $fname);
        $user_id = mysqli_real_escape_string($this->connection, $user_id);
        $lname = mysqli_real_escape_string($this->connection, $lname);        
        $accno = mysqli_real_escape_string($this->connection, $account);
        $phone = mysqli_real_escape_string($this->connection, $phone);
        $password = mysqli_real_escape_string($this->connection, $password);
        $image = mysqli_real_escape_string($this->connection, $img);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $ran_id = rand(time(), 100000000);
        $fuliza=0;
        $amount=0;
        $query = "INSERT INTO users ( $user_id,$fname, $lname, $phone,$account, $password, $img) 
                  VALUES ('$ran_id','$user_id','$fname', '$lname', '$phone', '$accno', '$hashedPassword','$image','$amount','$fuliza')";
        $result = mysqli_query($this->connection, $query);
        if ($result) {
        session_start();
        $_SESSION['id'] = $ran_id;
            header('Location:list.php');
            exit();
        } else {
            header('Location:lndex.php');
            exit();
        }
        mysqli_close($this->connection);
    }
    
}

?>
<body style="background-color: #a5c339;">
<center style="color:#fff;"><br/>
<br/>
<?php
$con = mysqli_connect('localhost', 'root', 'phppoets', 'ucciudai_ucci');
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="e5iIg1jwi8";

$sql = "SELECT * FROM certificate_origins where transaction_id='".$txnid."'";
$query = mysqli_query($con, $sql);
while($row=mysqli_fetch_array($query)){
	$id= $row['id'];
}

$sql1="UPDATE `certificate_origins` SET payment_status='".$status."' WHERE id='".$id."'";
  
$query = mysqli_query($con, $sql1);


If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          echo "<h3>Thank You. Your transaction status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". </h4>";
           
		   }         
?>	
</center>
</body>
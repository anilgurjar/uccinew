 
 <br/> <br/><center> <h3 style="color:#fff;"> Dont close window <br/> <br/>
 Please Wait. Loading... </h3>
 </center>
 <?php 

//$con = mysqli_connect('localhost', 'root', 'phppoets', 'ucciudai_ucci');
//$sql 	= 'SELECT * FROM certificate_origins';
 
// Merchant key here as provided by Payu
//$MERCHANT_KEY = "rjQUPktU";
$MERCHANT_KEY = "AotSe7Ye"; // actual 

// Merchant Salt as provided by Payu
//$SALT = "e5iIg1jwi8";
$SALT = "7BbsMBTziM";  // actual

// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
 // pr($_POST); exit;
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
 // $sql="UPDATE `certificate_origins` SET transaction_id='".$txnid."' WHERE id='".$id."'";
  
 // $query = mysqli_query($con, $sql);

} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) { 
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
         
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {  
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


     $hash = strtolower(hash('sha512', $hash_string));
     $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
foreach($InvoiceAttestations as $InvoiceAttestation){
	
	$payment_amount=$InvoiceAttestation['payment_amount'];
	$payment_tax_amount=$InvoiceAttestation['payment_tax_amount'];
	$amount=$payment_amount+$payment_tax_amount;
	
	$exporter=$InvoiceAttestation['exporter'];
}
?>
<body style="background-color: #a5c339;">
 <form action="<?php echo $action; ?>" method="post" name="payuForm" id="myForm">

	  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="udf1" value="<?php echo $id ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	  <input type="hidden" name="email" value="<?php echo $Users->email; ?>" />
      <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
      <input type="hidden" name="firstname" value="<?php echo $Users->member_name; ?>" /> 
	  <input type="hidden" name="phone" value="<?php echo $Users->mobile_no; ?>" />
	  <input type="hidden" name="productinfo" value="<?php echo $exporter; ?>" />
	  <input type="hidden" name="service_provider" value="payu_paisa" />
	  
	  <input type="hidden" name="surl" value="<?php echo $sul; ?>" />
	   <input type="hidden" name="furl" value="<?php echo $furl; ?>" />
	  

</form>
</body>
<script>
    /* var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      var payuForm = document.forms.payuForm;
      payuForm.submit();
	  alert();
    }
	 var payuForm = document.forms.payuForm;
      payuForm.submit(); */
	 document.getElementById('myForm').submit();
	  //alert();
</script>
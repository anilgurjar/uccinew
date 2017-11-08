<div>
<p> Dear <?php echo $member_name; if(empty($member_name)){ echo"Sir";  } ?>,</p>

<p><?php foreach($code as $cod){
	echo $cod.'<br/>';
	} ?> 
</p>

<br/>
<p>Regards
<br/>
UCCI </p>
</div>

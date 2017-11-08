<div>
<p> Dear <?php echo $member_name; if(empty($member_name)){ echo"Sir";  } ?>,</p>

<p><?php $i=1; foreach($code as $cod){
	echo $i.'.&nbsp;&nbsp;'.$cod.'<br/>';
	$i++;} ?> 
</p>

<br/>
<p>Regards
<br/>
UCCI </p>
</div>

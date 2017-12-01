<div>
<p> Dear <?php echo $member_name; if(empty($member_name)){ echo"Sir";  } ?>,</p>

<p>We are pleased to inform you that following exporters has applied for Certificate of Origin which is pending for approval. </p>
<?php  
foreach($urls as $url){ ?>
<p> <?php echo $url['exporter_name']; ?> &nbsp; <a href='<?php echo $url['url']; ?>'> click here </a> </p>

<?php } ?>
<p>Regards <br/>
Secretariat Staff,UCCI
 </p>
</div>
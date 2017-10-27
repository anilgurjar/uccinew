<div class="col-sm-12" >
	<div class="col-sm-6">
		<div id="calendar_div" ></div>
	</div>
</div>


  
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function() {
	var url="<?php echo $this->Url->build(['controller'=>'FacilityBookings','action'=>'calendar']); ?>";
	$.ajax({
	   type: "POST",
	   url: url,
		success: function(data){
		 $("#calendar_div").html(data);
	   }  
	}); 
	
});

$(document).on('click', '.next', function(e){
	var d=$(this).attr('result');
		
		 var url="<?php echo $this->Url->build(['controller'=>'FacilityBookings','action'=>'calendar']); ?>/"+d;
		$.ajax({
		   type: "POST",
		   url: url,
			success: function(data){
			 $("#calendar_div").html(data);
		   }  
		}); 
});
</script>

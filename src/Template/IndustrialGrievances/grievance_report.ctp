<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Grievance Report</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
				<div class="col-md-12 pad">
					<?php
					
					$i=0;
					 foreach ($IndustrialDepartments as $IndustrialDepartment):  ?>
						
							<?= $this->Form->button(__($IndustrialDepartment->department_name) ,['class'=>'btn btn-flat bg-orange','type'=>'button','value'=>$IndustrialDepartment->id,'name'=>'department'])
						  ?>
						
					<?php  $i++ ; endforeach; ?>
				</div>
				<div class="col-md-12" id="report">
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 
$('button[name="department"]').on( 'click',function() { 
		var id=$(this).attr('value');
		
		$.ajax({
		url:"grievance_report_ajax?id="+id,
		success:function(data) {
			
		 $('#report').html(data); 
		}
	  });
	  
	});
});
</script>
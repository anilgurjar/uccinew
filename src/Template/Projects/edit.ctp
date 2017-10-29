<div class="col-md-12">
<?php echo $this->Form->create($project, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Project Edit </h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
					
					<textarea id="description" name="description" hidden=""><?php echo $project->description; ?></textarea>
						<div class="col-md-12 ">
						
								<div class="box-body  pad">
									<label class="control-label">Description</label>
									<textarea class="txtEditor"></textarea>
									
								</div>
							
						</div>
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).__(' Submit') ,['class'=>'btn btn-success','type'=>'Submit']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>

				
              
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>



<script>

	
$(document).ready(function() { 
$('.Editor-editor').html($('#description').text());
	$("button:submit").click(function(){  
	
		$('#description').text($('.txtEditor').Editor("getText"));
	}); 
	
	$("#registratiomForm").validate({
		rules: {
			
			title: {
				required: true
			},
			
					
		},
		submitHandler: function () {
				
				$("#create_notice").attr('disabled','disabled');
				
				 form.submit();
			},
		messages: {
			member_type_id: {
					required: "Please select a member type."
				}
		}
	});
	
	
	
	
});
</script> 





<div class="col-md-12">
<?php echo $this->Form->create($event, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Event Edit</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-8">
								<div class="form-group">
									<label class="control-label">Event Name</label>
									<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Event Name','class'=>'form-control']); ?>
								</div>
							</div>
							
							 <div class="col-md-4">
								<div class="form-group">
								<label class="control-label">Category</label>
									<?php 
									echo $this->Form->input('event_category_id', ['empty'=> '--Select--','data-placeholder'=>'Select a category','label' => false,'class'=>'form-control master_purpose_id','options'=>$eventCategories]); ?>

								</div>
							</div>	
					</div>
					
					<div class="col-md-12 pad">
						
							  <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Date</label>
									<?php echo $this->Form->input('date', ['label' => false,'placeholder'=>'Date','data-date-format'=>'dd-mm-yyyy','type'=>'text','data-date-start-date'=>''.date('d-m-Y').'','class'=>'form-control date-picker']); ?>
								</div>
							</div>
							
							
							 <div class="col-md-4">
								<div class="form-group bootstrap-timepicker">
									<label class="control-label">Time</label>
									<?php echo $this->Form->input('time', ['label' => false,'placeholder'=>'Time','value'=>''.date("h:i A",strtotime($event->time)).'','type'=>'text','class'=>'form-control timepicker']); ?>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Location</label>
									<?php echo $this->Form->input('location', ['label' => false,'placeholder'=>'Location','rows'=>'2','class'=>'form-control']); ?>
								</div>
							</div>
							
							
							
					</div>
					
					<div class="col-md-12 ">
					
							
					
						<table id="file_table" style="line-height:2.5">
							<tr>
								<td>
								<label class="control-label">Coverage Image</label>
								
								<?= $this->Form->file('cover_image[]',['multiple'=>'multiple']); ?>
								
								
								<?php
								if(!empty($event->cover_image)){
										echo $this->Html->image('/'.$event->cover_image,['width'=>'100px','height'=>'100px']);
									}	
									?>
								
								</td>
								<td></td>
								<td></td>
							</tr>
						</table>
						
					</div>
					
					
					<textarea id="description" name="description" hidden=""><?php echo $event->description; ?> </textarea>
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
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-edit']) .__(' Update'),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
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
			
			name: {
				required: true
			},
			event_category_id: {
				required: true
			},
			date: {
				required: true
			},
			time: {
				required: true
			},
			location: {
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
<div class="col-md-12">
<?php echo $this->Form->create($newsLetter, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add News Letter</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Title</label>
									<?php echo $this->Form->input('title', ['label' => false,'placeholder'=>'News Letter Title','class'=>'form-control']); ?>
								</div>
							</div>
							<div class="col-md-4">
								<table id="file_table">
									<tr>
										<td>
											<label class="control-label">Attachment(pdf)</label>
												<?= $this->Form->file('pdf_attachment'); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
							 <div class="col-md-4">
								<table id="file_table">
									<tr>
										<td>
											<label class="control-label">Coverage Image</label>
												<?= $this->Form->file('cover_image[]',['multiple'=>'multiple']); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
					</div>
					
					<textarea id="description" name="description" hidden=""></textarea>
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
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).__(' Save') ,['class'=>'btn btn-success','type'=>'Submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>

				
              
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>



<script>

	
$(document).ready(function() { 
	$("button:submit").click(function(){  
	
		$('#description').text($('.txtEditor').Editor("getText"));
	}); 
	
	$("#registratiomForm").validate({
		rules: {
			
			title: {
				required: true
			},
			cover_image: {
				required: true
			},
			pdf_attachment: {
				accept: 'pdf'
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
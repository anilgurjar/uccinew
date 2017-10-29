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
												<?= $this->Form->file('attachment'); ?>
												<?php echo $this->Form->input('hidden_pdf', ['value'=>$newsLetter->attachment,'type'=>'hidden']); ?>
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
												<?= $this->Form->file('cover_image'); ?>
												<?php echo $this->Form->input('hidden_img', ['value'=>$newsLetter->cover_image,'type'=>'hidden']); ?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</table>
							</div>	
					</div>
					<textarea id="description" name="description" hidden=""><?php echo $newsLetter->description;?></textarea>
						<div class="col-md-12 ">
						
								<div class="box-body  pad">
									<label class="control-label">Description</label>
									<textarea class="txtEditor"><?php echo $newsLetter->description;?></textarea>
									
								</div>
							
						</div>
					
			
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']). __(' Save as draft'),['class'=>'btn btn-success','type'=>'Submit','id'=>'create_notice']) ?>
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
			}
					
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
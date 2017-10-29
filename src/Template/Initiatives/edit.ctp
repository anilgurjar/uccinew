<div class="col-md-12">
<?php echo $this->Form->create($initiative, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add Initiative</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Title</label>
									<?php echo $this->Form->input('title', ['label' => false,'placeholder'=>'Title','class'=>'form-control']); ?>
								</div>
							</div>
							
							 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Category</label>
									<?php 
									echo $this->Form->input('initiative_category_id', ['empty'=> '--Select Category--','label' => false,'class'=>'form-control select2','options'=>$InitiativeCategories]); ?>
								</div>
							</div>
							
							
					</div>
					<div class="col-md-12 pad">
						<textarea id="description" name="description" hidden="hidden"><?php echo $initiative->description; ?></textarea>
						<div class="col-md-12 ">
							<div class="box-body  pad">
								<textarea class="txtEditor"></textarea>

							</div>

						</div>
					
					
			
					</div>
					
					<div class="col-md-12 pad">
							<div class="col-md-6">
								<div class="form-group">
								<label class="control-label">Icon Photo</label>
									<?= $this->Form->file('photo',['multiple'=>'multiple']); ?>

								</div>
								<div>
									<?= $this->Html->Image('/'.$initiative->icon_photo,['width'=>'100px','height'=>'100px'])  ?>
								</div>
							</div>	
					
						<div class="col-md-6">
							<div class="form-group">
							<label class="control-label">Description Photo</label>
								<?= $this->Form->file('description_photo',['multiple'=>'multiple']); ?>

							</div>
							<div>
								<?= $this->Html->Image('/'.$initiative->description_photo,['width'=>'100px','height'=>'100px'])  ?>
							</div>
						</div>
			
					</div>
					
					
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
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
});	
</script>
	
<div class="col-md-12">

<?php  echo $this->Form->create($certificateOriginAuthorized, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add Certificate Origin Authorized</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
						
							
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Member</label>
									<?php echo $this->Form->input('user_id', ['empty'=> '--Select--','data-placeholder'=>'Select a category','label' => false,'class'=>'form-control select2','options'=>$users,'value'=>$certificateOriginAuthorized->user_id]); ?>
								</div>
							</div>
							
							
							 <div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Signature</label>
									
									<?= $this->Form->file('signature'); ?>
								</div>
							</div>
							
							
							
					</div>
					
				</div>
			</div>
				<div class="box-footer">
					
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>

<div class="col-md-12">
	<div class="box box-primary">
    <?= $this->Form->create($gallery,['type' => 'file']) ?>
	
		<div class="box-header with-border">
			<h3 class="box-title">Add Gallery</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				<div class="col-md-12 pad">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Title</label>
							<?php echo $this->Form->input('name', ['label' => false,'placeholder'=>'Title','class'=>'form-control']); ?>
						</div>
					</div>
					
					<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Cover Image</label>
									<?= $this->Form->file('cover_image',['multiple'=>'multiple']); ?>

								</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button( $this->Html->tag('i', '', ['class'=>'fa fa-plus']). __(' Submit') ,['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	
    <?= $this->Form->end() ?>
	
	</div>
	
</div>
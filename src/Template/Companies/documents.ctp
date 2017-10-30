<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

</style>
<div class="col-md-12">
<?php echo $this->Form->create($company, ['type' => 'file','id'=>'registratiomForm']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Company Documents</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-12 pad">
						 
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Company PAN Card</label><br/>
								<?= $this->Form->file('pan_card') ?>
								</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Company Registration</label><br/>
								<?= $this->Form->file('company_registration',['class'=>'second']) ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">IEC Code</label><br/>
								<?= $this->Form->file('ibc_code') ?>
								</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 pad">
						&nbsp; 
					</div>
				</div>
			</div>
			<div class="box-footer">
				<center>
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit']);
				?>
				</center>
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
</div>
		 
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
		<h3 class="box-title"> Documents View</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
			 
 			
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Company PAN Card</label><br/>
						<?php echo $this->Html->Image('/'.$companies_data->pan_card,['height'=>'180px','width'=>'180px']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Company Registration</label><br/>
						<?php echo $this->Html->Image('/'.$companies_data->company_registration,['height'=>'180px','width'=>'180px']); ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">IEC Code</label><br/>
						<?php echo $this->Html->Image('/'.$companies_data->ibc_code,['height'=>'180px','width'=>'180px']); ?>
					</div>
				</div>
				 
				
			</div>
		</div>
	</div>
</div>
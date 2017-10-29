<div class="col-md-12">
<?php echo $this->Form->create($certificateOriginAuthorized, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
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
									<?php echo $this->Form->input('user_id', ['empty'=> '--Select--','data-placeholder'=>'Select a category','label' => false,'class'=>'form-control select2','options'=>$users]); ?>
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


<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Certificate Origin Authorized Member</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
               <tr>
                <th scope="col"><?= $this->Paginator->sort('Sr no.') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Company/Organisation') ?></th>
				 <th scope="col"><?= $this->Paginator->sort('Address') ?></th> <th scope="col"><?= $this->Paginator->sort('Basic Number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Contact Number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Actions') ?></th>
               
            </tr>
        </thead>
        <tbody> 
            <?php $i=0; foreach ($certificateOrigins as $certificateOrigin): $i++; ?>
            <tr>
                 <td><?= $i ?></td>
                <td><?= h($certificateOrigin->user->member_name) ?></td>
                <td><?= h($certificateOrigin->user->company->company_organisation) ?></td>
				 <td><?= h($certificateOrigin->user->company->address) ?></td>
				  <td><?= h($certificateOrigin->user->company->office_telephone) ?></td>
                <td><?= h($certificateOrigin->user->mobile_no) ?></td>
				<td><?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $certificateOrigin->id],['class' => 'btn btn-warning btn-sm','escape'=>false]) ; ?></td>
				
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   
  </div>
 </div>




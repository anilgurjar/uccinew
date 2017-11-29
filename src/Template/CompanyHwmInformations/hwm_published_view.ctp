<div class="col-md-12">
  <div class="box box-primary">
    <h3><?= __('HWM Published View') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('S.No') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_organisation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Member name') ?></th>  
                <th scope="col"><?= $this->Paginator->sort('E-mail') ?></th>  
                <th scope="col"><?= $this->Paginator->sort('Products Manufactured') ?></th>   
                <th scope="col"><?= $this->Paginator->sort('company_type') ?></th>  
                <!--<th scope="col">Remarks</th> --> 
                <th scope="col" class="actions"><?= __('Actions') ?></th>
				
            </tr>
        </thead>
        <tbody>
            <?php
			//pr($CompanyHwmInformations->toArray()); 
			$i=0;  foreach ($CompanyHwmInformations as $company):			 
			$user_data=$company->company->users;
			$i++; ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= h($company->company->company_organisation) ?></td>
                <td><?= h(@$user_data[0]['member_name']) ?></td>  
				<td><?= h(@$user_data[0]['email']) ?></td> 
				<td><?= h($company->company->end_products_item_dealing_in) ?></td>
				<td><?= h($company->company->company_type) ?></td>
				<!--<td><?= h($company->authorised_remarks) ?></td>---->
				<td>
				<form method="post">
					<input type="hidden" value="<?= h($user_data[0]['id']) ?>" name="user_id"/>
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __('') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify'.$company->id,'value'=>$company->id]);
					?>
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __('') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify'.$company->id,'value'=>$company->id]);
					?>
					<div class="modal fade" id="verify<?php echo $company->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left !important">Do you want to verify</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">
 								</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'hwm_approve_submit','value'=>$company->id]);
									 
								?>	 
							  </div>
							</div>
						  </div>
						</div>
					<div class="modal fade" id="notverify<?php echo $company->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to not verify </h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad">
											<div class="col-md-12">
												<div class="form-group">
													<label class=" control-label" style="text-align:left !important">Remarks</label>
														<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Remarks','class'=>'form-control ', 'name'=>'verify_remarks']); ?>
												</div>
											</div>
										</div>

									</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'hwm_notapprove_submit','value'=>$company->id]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
					</form>
				</td>
				
               
            </tr>
            
			<?php endforeach; ?>
        </tbody>
    </table>
   
</div>   
</div>


<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>Draft Business Visa Recommendations</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	<div class="box-body">
	 <?= $this->Form->create() ?>
	  <div class="col-sm-12 no-print">
				<div class="table-responsive no-padding">
				<table class="table table-bordered" id="parant_table" style="width:100%;">
					<thead>
						<tr>
							<th>Sr.No.</th><th>Company/Organisation</th><th>Origin No</th><th>Company Manufacture</th><th>Visitor Name</th><th>Visit Country</th><th>Visit Month</th><th>Visit Reason</th><th>Passport No</th><th>Issue Date</th><th>Issue Place</th><th>Expiry Date</th><th>View</th>
						</tr>
					</thead>
					<tbody>
						
									
					<?php $sr=0; foreach ($bussiness_vissas as $bussiness_vissa): ?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $bussiness_vissa['company']['company_organisation'] ?></td>
						<td><?= $bussiness_vissa['origin_no'] ?></td>
						<td><?= $bussiness_vissa['company_manufacture'] ?></td>
						<td><?= $bussiness_vissa['visitor_name'] ?></td>
						<td><?= $bussiness_vissa['visit_country'] ?></td>
						<td><?= $bussiness_vissa['visit_month'] ?></td>
						<td><?= $bussiness_vissa['visit_reason'] ?></td>
						<td><?= $bussiness_vissa['passport_no'] ?></td>
						<td><?= date('d-m-Y', strtotime($bussiness_vissa['issue_date'])) ?></td>
						<td><?= $bussiness_vissa['issue_place'] ?></td>
						<td><?= date('d-m-Y', strtotime($bussiness_vissa['expiry_date'])) ?></td>
						<td><?= $this->Form->button(__('Publish') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-success btn-sm','formaction'=>'business_vissa_draft_view/'.$bussiness_vissa->id.'','type'=>'Submit','name'=>'view']);   ?> </td>
						
						
						<?php
						
						if($role_id==1 || $role_id==4){	
						echo"<td>";
							//echo $this->Form->button( __('Move') ,['class'=>'btn btn-danger btn-sm','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify'.$certificate_origin->id.'','value'=>$certificate_origin->id]);
							
						?>  
						
						<div class="modal fade" id="notverify<?php echo $certificate_origin->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Why Do you want to move to verification screen ?</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad" >
											 
											<div class="col-md-12">
												<div class="form-group">
													<label class=" control-label" style="text-align:left !important">Reason</label>
														<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Reason','class'=>'form-control ', 'name'=>'reason_move'.$certificate_origin->id.'']); ?>
												</div>
											</div>
										</div>

									</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button(__('Move') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'certificate_move_submit','value'=>$certificate_origin->id]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
						
						
						
						</td>
						<?php } ?>
						</tr>

					
					<?php endforeach; ?>
					
				
						
					
				 	
					</tbody>
				</table>
				</div>
			</div>
		 <?php echo $this->Form->end(); ?>
	 
    </div>
  </div>
</div>
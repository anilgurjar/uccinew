<?php
//use Cake\View\Helper\UrlHelper::build();
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

?>
<style>
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
  #certificate_form, #certificate_form * {
    visibility: visible;
  }
  #certificate_form {
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
	top:0;
  }
}
.value_padding{
	margin: 0px;padding: 0px !important;
}
</style>
<div class="col-md-12" id="certificate_form">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	<center>
	  <h3 class="box-title"><strong>Business Visa Recommendations  View</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
		<div class="box-body">
			<?= $this->Form->create($BusinessVisas) ?>
			<?php
			foreach($bussiness_vissas as $businessVisa)
			{ ?>
				<table class="vertical-table" style="width:100%;">
					 <tr>
						<td style="width:30%;">UCCI/VISA-<?= h($businessVisa['origin_no'])?>/R-9457/2016-17</td>
						<td style="text-align:right;"><b><?= h(date('jS F, Y',strtotime($businessVisa['date_current']))) ?></b></td>
						<td  align='right'>
							<?php if(!empty($businessVisa['authorised_remarks'])){ ?>	
							<label style="color:red;">Return Reason</label>
							<?php
								echo $businessVisa['authorised_remarks'];   
							} ?>
						</td>
					</tr>
					<tr>
						<th colspan="2"><br/>To</br><b><?= h($businessVisa['sender_name']) ?>&nbsp;-&nbsp;<?=  h($businessVisa['sender_country'])  ?></b><b><?= $this->Text->autoParagraph($businessVisa['sender_address']) ?></b></th>
					</tr>
					 <tr>
						<td colspan="2"><br/>Sub &nbsp;:&nbsp;<b><?= h($businessVisa['subject']) ?></b>.</td>
					</tr>
					 <tr>
						<td colspan="2"><br/>Dear Sir,</td>
					</tr>
					<tr>
						<td colspan="2"><p>The Udaipur Chamber of Commerce & Industry presents its compliments to <b><?= h($businessVisa['sender_type']) ?></b>.<b><?= h($businessVisa['sender_name']) ?></b> in <b><?= h($businessVisa['sender_country']) ?></b>.</p></td>
					</tr>
					
					<tr>
						<td colspan="2"><br/><p>This is to inform you that M/s  &nbsp;<b><?= h($businessVisa['company']['company_organisation']) ?></b>&nbsp; is a company having its office  &nbsp; <b><?= h($businessVisa['company']['address']) ?>,&nbsp; <?= h($businessVisa['company']['city']) ?> &nbsp;- <?= h($businessVisa['company']['pincode']) ?></b><?php if($membertype==1){  ?>&nbsp;and is also a member of Udaipur Chamber of Commerce & Industry.<?php  }  ?>.</p></td>
					</tr>
					<?php if($businessVisa['category_type']==2){  ?>
					<tr>
						<td colspan="2"><br/><p>M/s &nbsp;<b><?= h($businessVisa['company']['company_organisation']) ?></b>&nbsp;have invited<b>&nbsp;<?= h($businessVisa['visitor_name']) ?></b>&nbsp;<b><?= h($businessVisa['sender_address']) ?>&nbsp;</b>to visit their &nbsp;<b><?= h($businessVisa['issue_place']) ?></b>&nbsp;in&nbsp;<b><?= h($businessVisa['visit_country']) ?></b>&nbsp;from&nbsp;<b><?= h(date('d-m-Y',strtotime($businessVisa['issue_date']))) ?></b>&nbsp;to&nbsp;<b><?= h(date('d-m-Y',strtotime($businessVisa['expiry_date']))) ?></b>
						.</p></td>
					</tr>
					<?php } else{ ?>
					<tr>
						<td colspan="2"><br/><p>We hereby request you to issue business visa to&nbsp;<b><?= h($businessVisa['visitor_name']) ?></b>&nbsp;<b><?= h($businessVisa['visitor_designation']) ?></b>&nbsp;of&nbsp;<b><?= h($businessVisa['company']['company_organisation']) ?></b>&nbsp; to visit&nbsp; <b><?= h($businessVisa['issue_place']) ?></b>&nbsp;in&nbsp;<b><?= h($businessVisa['visit_country']) ?></b>&nbsp;from&nbsp;<b><?= h(date('d-m-Y',strtotime($businessVisa['issue_date']))) ?></b>&nbsp;to&nbsp;<b><?= h(date('d-m-Y',strtotime($businessVisa['expiry_date']))) ?></b>
						.</p></td>
					</tr>
					<?php   }  ?>
					<tr>
						<td colspan="2"><p>The necessary particulars are given below: -  </p></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('1. Name.') ?></th>
						<td style="text-align:left;"><br/><b> <?= h($businessVisa['visitor_name']) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('2. Passport No.') ?></th>
						<td style="text-align:left;"><br/><b><?= h($businessVisa['passport_no']) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('3. Date of Issue') ?></th>
						<td style="text-align:left;"><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['issue_date']))) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('4. Date of Expiry') ?></th>
						<td style="text-align:left;"><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['expiry_date']))) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('5. Date of Birth') ?></th>
						<td style="text-align:left;"><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['date_of_birth']))) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:left;"><br/><?= __('6. Place of Birth') ?></th>
						<td style="text-align:left;"><br/><b><?= h($businessVisa['birth_place']) ?></b></td>
					</tr>
					<?php if($businessVisa['category_type']==2)  {  ?>
					<tr>
						<td colspan="2" ><br/><p>We recommend that the above individual can be invited to &nbsp; <b><?= h($businessVisa['issue_place']) ?></b>&nbsp; in &nbsp; <b><?= h($businessVisa['visit_country']) ?></b>&nbsp; on behalf of &nbsp; <b><?= h($businessVisa['company']['company_organisation']) ?></b>&nbsp; for &nbsp;<b><?= h($businessVisa['visit_reason']) ?></b></p></td>
					</tr>
					<?php }  else{   ?>
					<tr>
						<td colspan="2"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
					</tr>
					<tr>
						<td colspan="2"><br/><p>It is requested that business visa for visit to &nbsp;<b><?= h($businessVisa['visitor_name']) ?></b>&nbsp; for &nbsp; <b><?= h($businessVisa['issue_place']) ?>&nbsp; in &nbsp; <?= h($businessVisa['visit_country']) ?></b>&nbsp; for &nbsp;<b><?= h($businessVisa['visit_reason']) ?></b></p></td>
					</tr>
					
					<?php }   ?>
					<tr>
						<td colspan="2"><p>Thanking you </p></td>
					</tr>
					<tr>
						<td colspan="2"><p>Yours Sincerely,</p></td>
					</tr>
					<tr>
						<th colspan="2"><p>For Udaipur Chamber of Commerce & Industry,</p></th>
					</tr>
					<tr>
						<th colspan="2"><br/><br/><p>Authorised Signatory</p></th>
					</tr>
				</table>
			
				
				<div class="col-sm-12 no-print">
					<center>
					<?php
					 
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify','value'=>$businessVisa['id']]);
					?>
					
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify','value'=>$businessVisa['id']]);
					?>
						
					</center>
					<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left !important">Do you want to verify this COO</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">
								<?php if($DocumentCheck>0){ ?>
									<div class="col-md-12 pad" >
										<div class="col-md-12">
											<div class="form-group">
												<label class=" control-label" style="text-align:left !important">
												
												Documents are still panding, do you wish to continue 
												</label>
												
													 
												
											</div>
										</div>
									</div>
								<?php }?>
								</div>
							  </div>
							  <div class="modal-footer">
							  <div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'bussiness_vissa_approve_submit','value'=>$businessVisa['id']]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
					<div class="modal fade" id="notverify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to not verify this COO</h4>
							  </div>
							  <div class="modal-body">
								<div class="row">

									<div class="col-md-12 pad" >
											 
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
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'bussiness_vissa_notapprove_submit','value'=>$businessVisa['id']]);
								?>	 
							  </div>
							</div>
						  </div>
						</div>
				</div>
				
			 <?php
			}
			echo $this->Form->end(); 
			?>
    </div>
	</div>
</div>
 
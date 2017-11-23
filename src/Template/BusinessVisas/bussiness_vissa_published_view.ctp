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
	  <h3 class="box-title"><strong>BUSSINESS VISSA  VIEW</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
		<div class="box-body">
			<?= $this->Form->create($BusinessVisas) ?>
			<?php
			 
			foreach($bussiness_vissas as $businessVisa)
			{      
			if($membertype==1){
			?>
				<table class="vertical-table" style="width:100%;">
					 <tr>
						<td style="width:30%;">UCCI/VISA-41/R-9457/2016-17</td>
						<td style="text-align:right;"><?= h(date('jS F, Y',strtotime($businessVisa['date_current']))) ?></td>
					</tr>
					<tr>
						<th colspan="2"><br/><b><?= h($businessVisa['sender_address']) ?></b></th>
					</tr>
					 <tr>
						<td colspan="2"><br/>Sub:<b><?= h($businessVisa['subject']) ?></b></td>
					</tr>
					 <tr>
						<td colspan="2"><br/>Dear Sir,</td>
					</tr>
					<tr>
						<td colspan="2"><br/><p>This is to inform you that M/s <b><?= h($businessVisa['company']['company_organisation']) ?>, <?= h($businessVisa['company']['address']) ?>, <?= h($businessVisa['company']['city']) ?> - <?= h($businessVisa['company']['pincode']) ?></b> is our member. The company is manufacturer of <b> <?= h($businessVisa['company_manufacture']) ?></b>.</p></td>
					</tr>
					<tr>
						<td colspan="2"><p>We hereby request you to issue Business Visa to <b> <?= h($businessVisa['visitor_name']) ?>, <?= h($businessVisa['visitor_designation']) ?></b> of <b><?= h($businessVisa['company']['company_organisation']) ?></b> to visit <b><?= h($businessVisa['visit_country']) ?></b> during the month of <b><?= date('M Y',strtotime('01-'.$businessVisa['visit_month'])) ?></b> for <b><?= h($businessVisa['visit_reason']) ?></b>. </p></td>
					</tr>
					<tr>
						<td colspan="2"><p>The particulars of his passport are given below: </p></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><?= __('1. Passport No.') ?></th>
						<td><?= h($businessVisa['passport_no']) ?></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('2. Date of Issue') ?></th>
						<td ><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['issue_date']))) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('3. Place of Issue') ?></th>
						<td><br/><b><?= h($businessVisa['issue_place']) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('4. Date of Expiry') ?></th>
						<td><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['expiry_date']))) ?></b></td>
					</tr>
					<tr>
						<td colspan="2"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
					</tr>
					<tr>
						<td colspan="2"><p>It is requested that Multiple Business Visa to visit <b><?= h($businessVisa['visit_country']) ?></b> may kindly be issued.</p></td>
					</tr>
					<tr>
						<td colspan="2"><p>Thanking you in anticipation,</p></td>
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
			<?php   } 
			else{?>
				<!--non member vissa  start-->
				<table class="vertical-table" style="width:100%;">
					 <tr>
						<td style="width:30%;">UCCI/VISA-41/R-9457/2016-17</td>
					</tr>
					<tr>	
						<td style="text-align:left;"><b><?= h(date('jS F, Y',strtotime($businessVisa['date_current']))) ?></b></td>
					</tr>
					<tr>
						<th colspan="2"><br/><b><?= h($businessVisa['sender_address']) ?></b></th>
					</tr>
					 <tr>
						<td colspan="2"><br/>Sub:<b><?= h($businessVisa['subject']) ?></b></td>
					</tr>
					 <tr>
						<td colspan="2"><br/>Dear Sir,</td>
					</tr>
					
					<tr>
						<td colspan="2"><p>We hereby request you to issue Multiple Visits Entry Business Visa to Mr.<b><?= h($businessVisa['visitor_name']) ?>, <?= h($businessVisa['visitor_designation']) ?></b> of <b><?= h($businessVisa['company']['company_organisation']) ?></b>  having there registered office at <b><?= h($businessVisa['company']['address']) ?>, <?= h($businessVisa['company']['city']) ?> - <?= h($businessVisa['company']['pincode'])?></b> to travel  during <b><?= h($businessVisa['visit_place']) ?> </b> for <b><?= h($businessVisa['visit_reason']) ?></b>. </p></td>
					</tr>
					<tr>
						<td colspan="2"><p>The particulars of his passport are given below: </p></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><?= __('1. Passport No.') ?></th>
						<td><b><?= h($businessVisa['passport_no']) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('2. Date of Issue') ?></th>
						<td ><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['issue_date']))) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('3. Place of Issue') ?></th>
						<td><br/><b><?= h($businessVisa['issue_place']) ?></b></td>
					</tr>
					<tr>
						<th scope="row" style="text-align:center;"><br/><?= __('4. Date of Expiry') ?></th>
						<td><br/><b><?= h(date('d-m-Y',strtotime($businessVisa['expiry_date']))) ?></b></td>
					</tr>
					<tr>
						<td colspan="2"><br/><p>We wish him all the success, as this visit be beneficial to both the countries.</p></td>
					</tr>
					<tr>
						<td colspan="2"><p>It is requested that Multiple Visits Entry Business Visa for visit  <b><?= h($businessVisa['visit_country']) ?></b> may kindly be issued.</p></td>
					</tr>
					<tr>
						<td colspan="2"><p>Thanking you in anticipation,</p></td>
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
			<?php  } ?>
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
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Verify') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'certificate_approve_submit','value'=>$businessVisa['id']]);
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
									echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Verify') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'certificate_notapprove_submit','value'=>$businessVisa['id']]);
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
 
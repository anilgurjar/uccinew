<style>
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data {
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
  }
}
</style>
<div class="col-md-12">
   <div class="box box-primary">
		<div class="box-header with-border no-print">
			<h3 class="box-title">Proforma Invoice Report</h3>
		</div>
		<div class="box-body">
		<form method="get">
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-3">
			  <label class="">Company/Organisation</label>
			 	<?php // pr($master_member->toArray());
						$options=array();
						foreach($master_member as $master_member_data){
							$options[$master_member_data->id] = $master_member_data->company_organisation;
						}
                        echo $this->Form->input('member_id', ['empty'=> 'Select a Company/Organisation','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Financial Year</label>
				<?php 
						$options=array();
							$options[1] = "2016-2017";
						
                        echo $this->Form->input('financial_year', ['empty'=> '---SELECT---','data-placeholder'=>'Select a Year','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Send/Unsend</label>
				<?php 
						$options=array();
							$options['2'] = "Send";
							$options['0'] = "Unsend";
						    $options['3'] = "All";
                        echo $this->Form->input('send_unsend', ['empty'=> '---SELECT---','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','value'=>'0']); ?>
			</div>
			<div class="form-group col-sm-3">
				<label>Date range:</label>
					<div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
						<?php echo $this->Form->input('from', ['label' => false,'class'=>'form-control','type'=>'text']); ?>
						<span class="input-group-addon" style="background-color:e5e5e5 !important;">
						To </span>
						<?php echo $this->Form->input('to', ['label' => false,'class'=>'form-control','type'=>'text']); ?>
					</div>
					<span class="help-block">
					Select date range </span>
				 
			  </div>
		</div>
		<div class="no-print">
		<center>
			<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text'])  .  ' Report' ,['class'=>'btn btn-info','type'=>'submit','style'=>'margin-right:5px;','name'=>'invoice_receipt_report','value'=>'invoice_receipt_report']); ?>
			
			
		</center>
		</div>
	</form>
	<?php 
	if(!empty($member_fee))
	{ 
		?>
	<div class="col-sm-12" id="fee_data">
	<div class="col-sm-12">
	<form method="post">
	<div class="table-responsive no-padding">
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Date</th>
					<th>Proforma Invoice No.</th>
					<th>Name</th>
					<th>Amount</th>
					<th>Status</th>
					<th><center>Send Mail</center><center><input type="checkbox" class="mail_check_all"></center></th>
					<th><center>Send SMS</center><center><input type="checkbox" class="sms_check_all"></center></th>
					<th style="text-align:center">View</th>
					<th style="text-align:center">Edit</th>
				</tr>
			</thead>
			<tbody>
<?php		$sr_no=0;
			$grand_total=0;
			
			foreach($member_fee as $data)
			{
				$member_id=$data->company_id;
				$status=$data->mail_send;
				$total=0;
				$sr_no++;
				?>
					<tr>
					<td><?php echo $sr_no; ?></td>
					<td><?php echo date('d-m-Y',strtotime($data->date)); ?></td>
					<td style="text-align:center"><?php echo sprintf("%04d", $data->performa_invoice_no); ?></td>
					<td><?php foreach($master_member as $master_member_data){
						if($data->company_id==$master_member_data->id){
							echo $master_member_data->company_organisation;
							$email=$master_member_data->email;
						}}  ?>
					</td>
					<td><?php echo $total=$data->grand_total; ?></td>
					<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
					<td><center>
					
					<input type="checkbox" class="mail_check" name="mail[]" value="<?php echo $data->id; ?>"></center>
					</td>
					<td><center><input type="checkbox" class="sms_check" name="sms[]" value="<?php echo $data->performa_invoice_no; ?>"></center>
					</td>
					<td><center>
					<?php //echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text']) . ' View',['class'=>'btn btn-success btn-xs','type'=>'submit','formtarget'=>'_blank','value'=>$data->performa_invoice_no,'name'=>'view_performa','formaction'=>'performa_invoice_pdf']); ?>
					
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text']) . ' View',['class'=>'btn btn-success btn-xs','type'=>'submit','formtarget'=>'_blank','value'=>$data->performa_invoice_no,'name'=>'view_performa','formaction'=>'performa_invoice_new_pdf']); ?>
					
					</center></td>
					<td><center>
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-pencil']) . ' Edit',['class'=>'btn btn-warning btn-xs','type'=>'submit','formtarget'=>'_self','value'=>$data->performa_invoice_no,'name'=>'edit_performa','formaction'=>'MemberPerformaInvoiceEdit']); ?>
					
					</center></td>
					</tr>
	<?php $grand_total+=$total;    }   ?></tbody>
					<tfoot>
					<tr>
					<th colspan="4" style="text-align:right;"><strong>Sub Total</strong></th>
					<th colspan="4"><strong><?php echo $grand_total; ?></strong></th>
					</tr>
					<tr>
					<td colspan="8">
					<center>
					
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-mail-forward'])  .  ' Send Mail' ,['class'=>'btn btn-success','type'=>'submit','style'=>'margin-right:5px;','name'=>'invoice_receipt_send','value'=>'invoice_receipt_send']); ?>
					</center>
				</td>
				</tr>
			</tfoot>
		</table>
	</div>
	</form>
	</div>
	<?php } ?>
	</div>
	<?php if(!empty($member_fee)) { ?>
	<div  class="col-sm-12 no print">
		<div class="pull-left">
			<div style="margin-top: 20px;white-space: nowrap;font-weight: 600;">
			Showing &nbsp; <?= $this->Paginator->counter(); ?></div>
		</div>
		<div class="pull-right" style="float:right;">
			<div class="paginator" style="float:right;">
				<ul class="pagination">
					<?= $this->Paginator->prev(__('Previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('Next')) ?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
	</div>
   </div>
</div>
	
  <!-- /.box -->
  <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
 <script>
$(document).ready(function(){

		$('.mail_check_all').on('change',function(){
			if($(this).is(':checked'))
			{
				$('.mail_check').prop('checked',true);
			}
			else
			{
				$('.mail_check').prop('checked',false);
			}
		});
		$('.sms_check_all').on('change',function(){
			if($(this).is(':checked'))
			{
				$('.sms_check').prop('checked',true);
			}
			else
			{
				$('.sms_check').prop('checked',false);
			}
		});
});
</script>
 
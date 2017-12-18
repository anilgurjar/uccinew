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
	  <h3 class="box-title">Invoice And Receipt Report</h3>
	</div>
	 <div class="box-body">
	 <?php echo $this->Form->create($receipt, ['type' => 'get']); ?>
	  <div class="col-sm-12 no-print">
			<div class="form-group col-sm-3">
			  <label class="">Company/Organisation</label>
			  	<?php 
						$options=array();
						foreach($master_member as $master_member_data){
							$options[$master_member_data->id] = $master_member_data->company_organisation;
						}
                        echo $this->Form->input('member_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2 company_id','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<!--<div class="form-group col-sm-3">
			  <label class="">Financial Year</label>
					<?php 
						$options=array();
							$options[1] = '2017-2018';
						
                        echo $this->Form->input('financial_year', ['empty'=> 'Select a Year','data-placeholder'=>'Select a Year','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>-->
			<div class="form-group col-sm-3">
			  <label class="">Mode of Payment</label>
					<?php 
						$options=array();
						$options['Cash'] = 'Cash';
						$options['Cheque No.'] ='Cheque';
						$options['D.D. No.'] = 'D.D.';
						$options['NEFT/RTGS'] = 'NEFT/RTGS';
						$options['Payumoney'] = 'Payumoney';
						
                        echo $this->Form->input('amount_type', ['empty'=> 'Select a Year','data-placeholder'=>'Select a Mode of Payment','label' => false,'class'=>'form-control select2 payment_mode','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
			  <label class="">Send/Unsend</label>
				<?php 
						$options=array();
							$options[2] = 'Send';
							$options[0] = 'Unsend';
							$options[3] = 'All';
                        echo $this->Form->input('send_unsend', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2  sendtype','options'=>$options,'style'=>'width:100%;','value'=>0]); ?>
			</div>
			<div class="form-group col-sm-3">
				<label>&nbsp;</label>
				<div class="col-sm-12">
					<?php
						$options=array();
							
							$options['Invoice'] = 'Invoice';
							$options['Receipt'] = 'Receipt';
					echo $this->Form->input('receipt_type', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div  reciept_type">{{label}}</div>'],'id'=>'reciept_type','type' => 'radio','label' => false,'options' => $options,'hiddenField' => false,'value'=>'Invoice')); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-3">
			  <label>Purpose</label>
				<?php 
						$options=array();
						foreach($master_purpose as $master_purpose_data){
							$options[] = 
						['text' =>$master_purpose_data->purpose_name,'value' => $master_purpose_data->id]; }
 echo $this->Form->input('purpose_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control select2 purpose_id','options'=>$options,'style'=>'width:100%;']);  ?>
			</div>
			<div class="form-group col-sm-3">
			  <label>Our Bank</label>
			<?php 
						$options=array();
						foreach($master_bank as $master_bank_data){
							$options[$master_bank_data->id] = $master_bank_data->bank_name;
						}
                        echo $this->Form->input('bank_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Bank','label' => false,'class'=>'form-control select2 bank_id','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			<div class="form-group col-sm-3">
				<label>Date range:</label>
					<div class="input-group input-large date-picker input-daterange" data-date-format="dd-mm-yyyy">
						<?php echo $this->Form->input('from', ['label' => false,'class'=>'form-control datefrom']); ?>
						<span class="input-group-addon" style="background-color:e5e5e5 !important;">
						To </span>
						<?php echo $this->Form->input('to', ['label' => false,'class'=>'form-control dateto']); ?>
					</div>
					<span class="help-block">
					Select date range </span>
				 
			  </div>
		</div>
		<div class="no-print">
		<center>
			<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text']) . ' Report',['class'=>'btn btn-info btn-flat go','type'=>'button','value'=>'invoice_receipt_report','name'=>'invoice_receipt_report']); ?>
			
			<?php  
				echo $this->Html->link('<i class="fa fa-download"></i> Export',
					['controller' => 'MemberReceipts', 'action' => 'MemberRecieptsViewListExcel'],
					['class' => 'btn btn-primary btn-sm btn-flat pull-right','id'=>'excl','style'=>'margin-right:30px',
					'escape' => false]
				); 
			?>
		</center>
		</div>
	<?php
	if(!empty($member_receipt)){
		$member_receipt = $member_receipt->toArray();
	}if(!empty($general_receipt)){
		
		$general_receipt = $general_receipt->toArray();
	}
	
	
	if(!empty($member_receipt) || !empty($general_receipt))
	{ 

		?>
		


	<div class="col-sm-12" id="fee_data">
	<div class="col-sm-12">
	<form method="post">
	<div class="table-responsive no-padding show_div">

		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Date</th>
					<?php
					if(!empty($member_receipt)){
						?>
						<th>Invoice No.</th>
						<?php
					}
					?>
					<th>Receipt No.</th>
					<th>Company</th>
					<th>Mode of Payment</th>
					<th>Amount</th>
					<th>Status</th>
					<th><center>Send Mail/SMS</center><center>
				<?php echo $this->Form->checkbox('accc', ['hiddenField' => false,'class'=>'mail_check_all']);  ?>	
				</center></th>
					<th style="text-align:center">View</th>
					<th style="text-align:center">Edit</th>
					<!--<th style="text-align:center">Delete</th>-->
				</tr>
			</thead>
			<tbody >
			<?php
			$sr_no=0;
			$grand_total=0;
			if(!empty($member_receipt)){
				//pr($member_receipt);
			foreach($member_receipt as $data){
				$member_fee_member_receipts=$data->member_fee_member_receipts;
				foreach($member_fee_member_receipts as $member_fee_member_receipt){
				$status=$data->mail_send;
					$total=0;
					$sr_no++;
					?>
					<tr>
					<td><?php echo $sr_no; ?></td>
					<td><?php echo date('d-m-Y', strtotime($data->date_current)); ?></td>
					<td><?php echo sprintf("%04d", $member_fee_member_receipt->member_fee->invoice_no); ?></td>
					<td><?php echo sprintf("%04d", $data->receipt_no); ?></td>
					<td><?php echo $data->company->company_organisation; ?></td>
					<td><?php echo $data->amount_type; ?></td>
					<td><?php echo $total=$data->amount; ?></td>
					<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
					<td><center>
				
				<?php  echo $this->Form->checkbox('published', ['hiddenField' => false,'class'=>'mail_check','name'=>'mail[]','value'=>$data->receipt_id]);  ?>
					
					</center>
					</td>
					
					<td><center>
				
					<?php 
					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'member_receipt_pdf',$data->receipt_id,$member_fee_member_receipt->member_fee_id),['class' => 'btn btn-sm btn-primary btn-flat pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
					
					</center>
					</td>
					<td><center>
					<?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller' => 'MemberReceipts', 'action' => 'EditMemberReceipt',$member_fee_member_receipt->member_fee->invoice_no,$data->receipt_id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]) ?>
					</center></td>
					<!--<td><center><?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i> Delete'),
							['action' => 'delete_member_receipt', $data->receipt_id],
							[
								'block' => true,
								'class' => 'btn btn-danger btn-sm btn-flat',
								'escape' => false,
								'confirm' => __('Are you sure you want to delete?')
							]
						)
					?>
					</center></td>-->
					</tr>
					<?php
					$grand_total+=$total;
				
				
			} 
			}
			}
			
			if(!empty($general_receipt)){
			foreach($general_receipt as $general_data)
			{
				
				$status=$general_data->mail_send;
					$total=0;
					$sr_no++;
				
					?>
					<tr>
					<td><?php echo $sr_no; ?></td>
					<td><?php echo date('d-m-Y', strtotime($general_data->date_current)); ?></td>
					<td><?php echo sprintf("%04d", $general_data->receipt_no); ?></td>
					<td><?php echo $general_data->company->company_organisation; ?></td>
					<td><?php echo $general_data->amount_type; ?></td>
					<td><?php echo $total=$general_data->amount; ?></td>
					<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
					<td><center>
					<?php  echo $this->Form->checkbox('published', ['hiddenField' => false,'class'=>'mail_check','name'=>'mail[]','value'=>$general_data->receipt_id]);  ?>
					</center></td>
					<td><center>
					<?php 
					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'MemberReceipts', 'action' => 'general_receipt_pdf',$general_data->receipt_id),['class' => 'btn btn-sm btn-primary btn-flat pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
					</center></td>
					<td><center>
					<?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', array('controller' => 'MemberReceipts', 'action' => 'EditGeneralReceipt',$general_data->receipt_id),['class' => 'btn btn-sm btn-warning btn-flat', 'target' => '_self','escape'=>false]) ?>
					</center></td>
					<!--<td><center><?= $this->Form->postLink(__('<i class="fa fa-trash-o"></i> Delete'),
							['action' => 'delete_member_receipt', $general_data->receipt_id],
							[
								'block' => true,
								'class' => 'btn btn-danger btn-sm btn-flat',
								'escape' => false,
								'confirm' => __('Are you sure you want to delete?')
							]
						)
					?>
					</center></td>-->
					</tr>
					<?php
					$grand_total+=$total;
				
			}  }
			?>
			<tfoot>
				<tr>
				<th colspan="5" style="text-align:right;"><strong>Sub Total</strong></th>
				<th colspan="4"><strong><?php echo $grand_total; ?></strong></th>
				</tr>
				<tr>
				<td colspan="9">
				<center>
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-mail-forward']) . ' Send Mail',['class'=>'btn btn-success btn-flat','type'=>'submit','name'=>'invoice_receipt_send']); ?>
				</center>
				</td>
				</tr>
			</tbody>
		</table>
	</div>
	</form>
	</div>
	
	<?php
	}
	//echo $this->fetch('postLink');
	?>
	</div>
	<?php

	
	if(!empty($member_receipt) || !empty($general_receipt))
	{
		?>
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
	<?php
	} ?>
	</div>
   </div>
</div>
 <?php echo $this->Html->script('/assets/plugins/jQuery/jquery-2.2.3.min.js');  ?>
<script>
$(document).ready(function(){
		$('.mail_check_all').on('change',function(){
			if($(this).is(':checked')){
				$('.mail_check').prop('checked',true);
			}else{
				$('.mail_check').prop('checked',false);
			}
		});
		
		var company_id = $('.company_id').val();
		var payment_mode = $('.payment_mode').val();
		var sendtype = $('.sendtype').val();
		var reciept_type = $('input[name="receipt_type"]:checked').val();
		var purpose_id = $('.purpose_id').val();
		var bank_id = $('.bank_id').val();
		var datefrom = $('.datefrom').val();
		var dateto = $('.dateto').val();
		
		$('#excl').attr("href","MemberRecieptsViewListExcel?company_id="+company_id+"&payment_mode="+payment_mode+"&sendtype="+sendtype+"&reciept_type="+reciept_type+"&purpose_id="+purpose_id+"&bank_id="+bank_id+"&datefrom="+datefrom+"&dateto="+dateto);
		
		
		$('.go').click(function(){
		var company_id = $('.company_id').val();
		var payment_mode = $('.payment_mode').val();
		var sendtype = $('.sendtype').val();
		var reciept_type = $('input[name="receipt_type"]:checked').val();
		var purpose_id = $('.purpose_id').val();
		var bank_id = $('.bank_id').val();
		var datefrom = $('.datefrom').val();
		var dateto = $('.dateto').val();
		
		$('#excl').attr("href","MemberRecieptsViewListExcel?company_id="+company_id+"&payment_mode="+payment_mode+"&sendtype="+sendtype+"&reciept_type="+reciept_type+"&purpose_id="+purpose_id+"&bank_id="+bank_id+"&datefrom="+datefrom+"&dateto="+dateto);
		var url="<?php echo $this->Url->build(['controller'=>'MemberReceipts','action'=>'filterdata']);?>";
		
		url=url+'?member_id='+company_id+'&amount_type='+payment_mode+'&send_unsend='+sendtype+'&reciept_type='+reciept_type+'&purpose_id='+purpose_id+'&bank_id='+bank_id+'&from='+datefrom+'&to='+dateto;
		
		$.ajax({ 
				url:url,
				type:"GET",
			}).done(function(response){
				
				$('.show_div').html(response);
				
			});
	});	
});
</script>
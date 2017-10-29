<style>
@media print {
 img
	   {
		   top: 28px !important;
		   left: 40px !important;
	   }
	   #main_table{
		   width:100% !important;
	   }
 .print
  {
	  display:none;
  }
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	  <h3 class="box-title">Invoice & Receipt</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
	  <div class="box-body">
	    <?= $this->Form->create($member_receipts,['id'=>'configform'])?> 
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-4">
			  <label>Company/Organisation</label>
			  <?php 
				$options=array();
				foreach($master_member as $master_member_data){
				$options[$master_member_data->id] = $master_member_data->company_organisation;
				}
				echo $this->Form->input('member_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
				
				</div>
			
				<div class="form-group col-sm-4" id="member_type">
					<label>Member Type</label>
					<?php $options=array();
				echo $this->Form->input('company_member_type_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Member Type','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
				</div>

			
		</div>
			<div class="col-sm-12 no-print">
				<div class="form-group col-sm-4">
					<label>Purpose</label>
					<?php 
						$options=array();
						foreach($master_purpose as $master_purpose_data){
						$options[$master_purpose_data->id] = $master_purpose_data->purpose_name;
						}
						echo $this->Form->input('purpose_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
					</div>
					
					
					<div class="form-group col-sm-4">
					<label>Mode of Payment</label>
					<?php
								$options=array();
								$options['Cash'] = 'Cash';
								$options['Cheque No.'] = 'Cheque';
								$options['D.D. No.'] = 'D.D.';
								$options['NEFT/RTGS'] = 'NEFT/RTGS';
								
								echo $this->Form->input('amount_type', array('templates' => ['radioWrapper' => '<div class="radio inline " style="margin-left: 8px !important;">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false,'value'=>'Cheque No.')); ?>
					</div>
			</div>
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-4 display-data neft_data" style="line-height:1.3">
			  <label>Our Bank</label>
			  <?php 
						$options=array();
						foreach($master_bank as $master_bank_data){
							$options[$master_bank_data->id] = $master_bank_data->bank_name;
						}
                        echo $this->Form->input('bank_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Bank','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
		
			<div class="form-group col-sm-4 display-data">
				<label class="cheque">Cheque No.</label>
				<label class="dd" style="display:none;">D.D. No.</label>
				<?php echo $this->Form->input('cheque_no', ['label' => false,'placeholder'=>'No.','class'=>'form-control','type'=>'text']); ?>
			</div>
			<div class="form-group col-sm-4 display-data neft_data">
				<label class="cheque">Cheque Date</label>
				<label class="dd" style="display:none;">D.D. Date</label>
				<label class="neft" style="display:none;">NEFT/RTGS</label>
				<?php echo $this->Form->input('cheque_date', ['label' => false,'placeholder'=>'Date','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','type'=>'text']); ?>
				 
			</div>
			<div class="form-group col-sm-4 display-data">
				<label>Drawn on</label>
				<?php echo $this->Form->input('drawn_bank', ['label' => false,'placeholder'=>'Bank Name','class'=>'form-control','type'=>'text']); ?>
				 
			</div>
			<div class="form-group col-sm-4">
				<label>Due Amount</label>
			  <?php echo $this->Form->input('due_amount', ['label' => false,'placeholder'=>'Due Amount','class'=>'form-control','type'=>'text','id'=>'due_amount','readonly']); ?>
			 
			</div>
			<div class="form-group col-sm-4">
				<label>Received Amount</label>
			 <?php echo $this->Form->input('amount', ['label' => false,'placeholder'=>'Received Amount','class'=>'form-control','type'=>'text']); ?>
			 
			</div>
			
			<div class="form-group col-sm-4">
				<label>TDS Amount</label>
			<?php echo $this->Form->input('tds_amount', ['label' => false,'placeholder'=>'TDS Amount','class'=>'form-control','type'=>'text']); ?>
			 
			</div>
			
			<div class="form-group col-sm-4">
				<label>Narration</label>
			<?php echo $this->Form->input('narration', ['label' => false,'placeholder'=>'Narration of Amount','class'=>'form-control','type'=>'text']); ?>
			 
			</div>
		</div>
		
		<!-- /.box-body -->
	  <div class="col-sm-12 no-print">
		<center>
		  <?php
			echo $this->Form->button(__('Generate ') . $this->Html->tag('i', '', ['class'=>'fa fa-arrow-circle-down']),['class'=>'btn btn-success','type'=>'Submit','id'=>'member_receipt']);
		  ?>
		 </center>
	  </div>
		
	  <?php echo $this->Form->end(); ?>
	    <!-- /.box-footer -->
	 <div class="row" id="fee_data">
	  </div>
	
  </div>
  <?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');
?>
  <script>
$(document).ready(function(){
	$('select[name="member_id"]').on('change',function() {
		var member_id=$(this).val();
		var m_data = new FormData();
		m_data.append('member_id',member_id);
		$.ajax({
			url:"<?php echo $this->Url->build(['controller'=>'MemberReceipts','action'=>'member_receipt_amount_ajax']); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			async: false,
			type: 'POST',
			dataType:'text',
			success:function(data){
				 $('#due_amount').val(data);
			}
		});
	});
	

$('select[name="member_id"]').on('change',function() {
		var member_id=$(this).val();
		var m_data = new FormData();
		m_data.append('member_id',member_id);
		$.ajax({
			url:"<?php echo $this->Url->build(['controller'=>'MemberReceipts','action'=>'member_receipt_ajax_type']); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			async: false,
			type: 'POST',
			dataType:'text',
			success:function(data){ 
				$("#member_type").html(data);
				$('select[name="company_member_type_id[]"]').select2();
			}
		});
	});
	



	/*$('input[name="amount"]').on('keyup',function() {
		if(parseFloat($(this).val()) > parseFloat($('#due_amount').val()))
		{
			var empty='';
			$(this).val(empty);
		}
	});*/
	$('input[name="amount_type"]').on('change',function() {
		var amount_type=$(this).val();
		if(amount_type=='Cheque No.' || amount_type=='D.D. No.')
		{
			$('select[name="bank_id"]').removeAttr('disabled');
			$('input[name="drawn_bank"]').removeAttr('disabled');
			$('input[name="cheque_no"]').removeAttr('disabled');
			$('input[name="cheque_date"]').removeAttr('disabled');
			$('.display-data').css('display','block');
		}
		else
		{
			$('select[name="bank_id"]').attr('disabled','disabled');
			$('input[name="drawn_bank"]').attr('disabled','disabled');
			$('input[name="cheque_no"]').attr('disabled','disabled');
			$('input[name="cheque_date"]').attr('disabled','disabled');
			$('.display-data').css('display','none');
		}
		if(amount_type=='NEFT/RTGS')
		{
			$('select[name="bank_id"]').removeAttr('disabled');
			$('input[name="cheque_date"]').removeAttr('disabled');
			$('.neft_data').css('display','block');
		}
		if(amount_type=='Cheque No.' || amount_type=='D.D. No.' || amount_type=='NEFT/RTGS')
		{
			if(amount_type=='Cheque No.')
			{
				$('.dd').css('display','none');
				$('.neft').css('display','none');
				$('.cheque').css('display','block');
			}
			if(amount_type=='D.D. No.')
			{
				$('.cheque').css('display','none');
				$('.neft').css('display','none');
				$('.dd').css('display','block');
			}
			if(amount_type=='NEFT/RTGS')
			{
				$('.cheque').css('display','none');
				$('.dd').css('display','none');
				$('.neft').css('display','block');
			}
		}
		else
		{
			$('.cheque').css('display','none');
			$('.dd').css('display','none');
			$('.neft').css('display','none');
		}
		
	});
	$("#configform").validate({
		rules: {
			member_id: {
				required: true
			},
			purpose_id: {
				required: true
			},
			bank_id: {
				required: true
			},
			company_member_type_id: {
				required: true
			},
			drawn_bank: {
				required: true
			},
			cheque_no: {
				required: true
			},
			cheque_date: {
				required: true
			},
			amount: {
				required: true,
				number:true
			}
		},
		submitHandler: function () {
				
				$("#member_receipt").attr('disabled','disabled');
				
				 form.submit();
			}
		
	});
	
});
</script>
  
 
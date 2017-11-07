<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

.select2-container--default .select2-results__option[aria-disabled=true] {
    display: none;
}
.error{
	display: inline !important;
}
 p{
	    margin-bottom: 0px !important;
}
 h2{
  
  margin:0 0 0 0px !important;
  }
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
   
  .content-wrapper, .right-side, .main-footer
  {
	  margin-left:0px;
	  -moz-box-sizing: border-box;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data {
  
	-moz-margin-left: -230px;
	margin-right: auto;
	left: 0;
	right: 0;
	top:0;
  }
  table{
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  }
   div{
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  }
  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    line-height: 0.5
}
  
}
@media print and (-webkit-min-device-pixel-ratio:0) {
    
	#fee_data {
		margin-left: -230px;
	}
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	  <h3 class="box-title">General Receipt</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	  <div class="box-body">
	 <?php echo $this->Form->create($member_receipts, ['id'=>'configform']); ?>
		<div class="col-sm-12 no-print">
			<!--<div class="form-group col-sm-5">
				<label>Member Type</label>
				<?php
				$options=array();
					foreach($member_type as $member_type_data){
						$member_type_id=$member_type_data->id;
						$options[]=['text'=>$member_type_data->member_type,'value'=>$member_type_data->id];
					}
				echo $this->Form->input('member_type_id', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false,'value'=>$member_type_id)); ?>
				<label id="member_type_id-error" class="error" for="member_type_id"></label>
				
			</div>-->
			<div class="form-group col-sm-3">
			  <label>Company/Organisation</label>
				<?php  
				$options=array();
				foreach($master_member as $master_member_data)
				{
						$options[] = ['text' => $master_member_data->company_organisation, 'value' => $master_member_data->id , 'state' => $master_member_data->master_state_id]; 
					
				}

				echo $this->Form->input('member_id', ['empty'=> '--Select--','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2 state changecompany','options'=>$options,'style'=>'width:100%;','value'=>$member_receipts->company_id]);  ?>
				<label id="member_id-error" class="error" for="member_id"></label>
			</div>
			<div class="form-group col-sm-4">
				<label>Mode of Payment</label>
				
					<?php
				$options=array();
					$options['Cash'] = 'Cash';
					$options['Cheque No.'] ='Cheque';
					$options['D.D. No.'] = 'D.D.';
					$options['NEFT/RTGS'] = 'NEFT/RTGS';
					
				echo $this->Form->input('amount_type', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false)); ?>				
				
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
				<label id="bank_id-error" class="error" for="bank_id"></label>
			</div>
			<div class="form-group col-sm-4 display-data">
				<label class="cheque">Cheque No.</label>
				<label class="dd" style="display:none;">D.D. No.</label>
			
			<?php echo $this->Form->input('cheque_no', ['label' => false,'placeholder'=>'No.','class'=>'form-control']); ?>
			</div>

			
			<div class="form-group col-sm-4 display-data  neft_data">
				<label class="cheque">Cheque Date</label>
				<label class="dd" style="display:none;">D.D. Date</label>
				<label class="neft" style="display:none;">NEFT/RTGS</label>
				<?php $cheque_date=$member_receipts->cheque_date; echo $this->Form->input('cheque_date', ['label' => false,'placeholder'=>'Date','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','type'=>'text','value'=>date('d-m-Y', strtotime($cheque_date))]); ?>
			</div>
			<div class="form-group col-sm-4 display-data">
				<label>Drawn on</label>
				<?php echo $this->Form->input('drawn_bank', ['label' => false,'placeholder'=>'Bank Name','class'=>'form-control']); ?>
			</div>
		
			<div class="form-group col-sm-4">
				<label>Narration</label>
				<?php echo $this->Form->input('narration', ['label' => false,'placeholder'=>'Narration of Amount','class'=>'form-control','rows'=>2]); ?>
			</div>
			<div class="form-group col-sm-2">
				<label>Tax</label>
				<?php  
						$optionsTax=array();
						
						$optionsTax[] = ['text' => 'Tax', 'value' => 'Tax']; 
						$optionsTax[] = ['text' => 'WithoutTax', 'value' => 'WithoutTax']; 
						if(!empty($member_receipts->tax_amounts))
						{
							$value='Tax';
						}
						else
						{
							$value='WithoutTax';
						}
						echo $this->Form->input('tax_applicable', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $optionsTax,'hiddenField' => false,'value'=>$value)); ?>
			</div>
			<div class="form-group col-sm-2">
				<label>TDS Amount</label>
			<?php echo $this->Form->input('tds_amount', ['label' => false,'placeholder'=>'TDS Amount','class'=>'form-control tds_value','type'=>'text']); ?>
			 
			</div>
			
		</div>
		<div class="col-sm-12 no-print" style="margin-top:20px;" id="main">		
			<table class="table table-bordered">	
			<thead style="">
				<tr>
					<th width="25%">Purpose</th>
					<th width="20%">Quantity</th>
					<th width="25%">Amount per Quantity</th>
					<th width="24%">Total</th>
					<th width="6%"></th>
				</tr>
			</thead>
            <tbody>
			<?php
			$i=0;
			foreach($member_receipts->general_receipt_purposes as $purpose_data)
			{
				?>
			<tr>
			<td>
				<?php 
				$options=array();
				foreach($master_purpose as $master_purpose_data){
					if(!empty($master_purpose_data->purpose_tax))
					{
						$tax_applicable='Tax';
						if($value!=$tax_applicable)
						{
							$disabled='disabled';
						}
						else
						{
							$disabled='';
						}
						$options[] = ['text' => $master_purpose_data->purpose_name, 'value' =>  $master_purpose_data->id, 'tax_applicable'=>$tax_applicable,$disabled];
					}
					else
					{
						$tax_applicable='WithoutTax';
						if($value!=$tax_applicable)
						{
							$disabled='disabled';
						}
						else
						{
							$disabled='';
						}
						$options[] = ['text' => $master_purpose_data->purpose_name, 'value' =>  $master_purpose_data->id, 'tax_applicable'=>$tax_applicable,$disabled];
					}
				
				}
				echo $this->Form->input('general_receipt_purposes[0][purpose_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control select2 purpose_id calculate','options'=>$options,'id'=>'genaral_receipt_purposes-0-purpose_id','value'=>$purpose_data->purpose_id]); ?>
				<label id="genaral_receipt_purposes-0-purpose_id-error" class="error bbb" for="genaral_receipt_purposes-0-purpose_id" style="display:none;"></label>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[0][quantity]', ['label' => false,'placeholder'=>'Quantity','class'=>'form-control quantity calculate','id'=>'genaral_receipt_purposes-0-quantity','autocomplete'=>'off','value'=>$purpose_data->quantity]); ?>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[0][amount]', ['label' => false,'placeholder'=>'Amount Per Quntity','class'=>'form-control amount calculate','id'=>'genaral_receipt_purposes-0-amount','autocomplete'=>'off','value'=>$purpose_data->amount]); ?>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[0][total]', ['label' => false,'placeholder'=>'Total','class'=>'form-control total','readonly','value'=>$purpose_data->total]); ?>
			</td>
			<td>
		
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
<?php if($i!=0){ echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); } ?>
			</td>
		</tr>
		<?php
		$i++;	}
			?>
		</tbody>

		<tfoot id="tax_view">
			
			<tr>
			<td colspan="3" align="right">Grant Total</td>
			<td id="grand_total"> <input type="hidden" name="amount" value="0"><strong>0</strong></td>
			</tr>
			
		</tfoot>			
			</table>
		</div>
	
		
		<div class="col-sm-12 no-print">
		<center>
		<?php echo $this->Form->button('Generate' . $this->Html->tag('i', '', ['class'=>'fa fa-arrow-circle-down']),['class'=>'btn btn-success','type'=>'submit','id'=>'general_receipt']); ?>
		</center>
	   </div>
	   <?= $this->Form->end() ?>
	  <div class="row" id="fee_data">
	  </div>
	  <!-- /.box-footer -->
	
	</div>
  </div>
  </div>
  
  <table id="sample" style="display:none;">
	<tbody>
		<tr>
			<td>
				<?php 
				$options=array(); $i=0;
				foreach($master_purpose as $master_purpose_data){
				if(!empty($master_purpose_data->purpose_tax))
					{
						$tax_applicable='Tax';
						$options[] = ['text' => $master_purpose_data->purpose_name, 'value' =>  $master_purpose_data->id, 'tax_applicable'=>$tax_applicable];
					}
					else
					{
						$tax_applicable='WithoutTax';
						$options[] = ['text' => $master_purpose_data->purpose_name, 'value' =>  $master_purpose_data->id, 'tax_applicable'=>$tax_applicable,'disabled'=>'disabled'];
					}
				}
				echo $this->Form->input('general_receipt_purposes[][purpose_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control purpose_id calculate','options'=>$options]); ?>
				<label id="genaral_receipt_purposes-0-purpose_id-error" class="error bbb" for="genaral_receipt_purposes-0-purpose_id" style="display:none;"></label>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[][quantity]', ['label' => false,'placeholder'=>'Quantity','class'=>'form-control quantity calculate','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[][amount]', ['label' => false,'placeholder'=>'Amount Per Quntity','class'=>'form-control amount calculate','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('general_receipt_purposes[][total]', ['label' => false,'placeholder'=>'Total','class'=>'form-control total','readonly']); ?>
			</td>
			<td>
		
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
			</td>
		</tr>
	</tbody>
</table>

  
  	
<!-- Modal -->

  
  <!-- /.box -->
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function(){

// onload call script
	
	calculate(); 
	var i=0;
	$("#main tbody tr").each(function(){ 
		$(this).find("td select.purpose_id").attr({name:'general_receipt_purposes['+i+'][purpose_id]',id:'general_receipt_purposes-'+i+'-purpose_id'});
		$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});

		$(this).find("td input.quantity").attr({name:'general_receipt_purposes['+i+'][quantity]',id:'general_receipt_purposes-'+i+'-quantity'});
		$(this).find("td input.amount").attr({name:'general_receipt_purposes['+i+'][amount]',id:'general_receipt_purposes-'+i+'-amount'});
		$(this).find("td input.total").attr({name:'general_receipt_purposes['+i+'][total]',id:'general_receipt_purposes-'+i+'-total'});
		i++;
	});
 
 
	function calculate()
	{   
		var purpose_array=new Array();
			
			var tds =$(".tds_value").val();
			var state_id =$(".state").find('option:selected').attr('state');
			
			var grand_total=0;
			$("#main tbody tr").each(function(){
			var total_amount =parseFloat($(this).find("td input.total").val());
			grand_total+=total_amount;
			
			});
			grand_total=grand_total.toFixed(2)
			
			if($('input[name="tax_applicable"]:checked').val()=='WithoutTax')
			{
				
				$('#grand_total').find('input').val(grand_total);
				$('#grand_total').find('strong').html(grand_total);
			}
			else
			{
				var m_data = new FormData();
				m_data.append('total_amount',grand_total);
				m_data.append('tds_amount',tds);
				m_data.append('state_id',state_id);
				
				$.ajax({
				url:"<?php echo $this->Url->build(['controller'=>'MemberReceipts','action'=>'CalculateTaxGeneralReceipt']); ?>",
					data: m_data,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType:'text',
					success:function(data){
						
						 $('#tax_view').html(data); 
						}
			  });
			}
	}
	$(document).on("keyup",".calculate,.tds_value",function()
	{ 
		var qty=$(this).closest('tr').find('td input.quantity').val();
		var amt=$(this).closest('tr').find('td input.amount').val();
		var total = qty*amt;
		total =parseFloat(total).toFixed(2);
		$(this).closest('tr').find('td input.total').val(total);
		calculate();
	});
	
	function add_row()
	{
		var new_line=$("#sample tbody").html();
		$("#main tbody").append(new_line);
		$('#main tbody tr:last select.purpose_id').select2();
	}
	
	$(document).on("click",".add_row",function(){ 
		add_row();
		var i =0;
		$("#main tbody tr").each(function(){
			$(this).find("td select.purpose_id").attr({name:'general_receipt_purposes['+i+'][purpose_id]',id:'general_receipt_purposes-'+i+'-purpose_id'});
			$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});
			
			$(this).find("td input.quantity").attr({name:'general_receipt_purposes['+i+'][quantity]',id:'general_receipt_purposes-'+i+'-quantity'});
			$(this).find("td input.amount").attr({name:'general_receipt_purposes['+i+'][amount]',id:'general_receipt_purposes-'+i+'-amount'});
			$(this).find("td input.total").attr({name:'general_receipt_purposes['+i+'][total]',id:'general_receipt_purposes-'+i+'-total'});
		i++;
		});
		$("[name^=general_receipt_purposes]").each(function () { 
			$(this).rules("add", {
				required: true,
				number: true
			});
			});
		
	});
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
		var i =0;
		$("#main tbody tr").each(function(){
			$(this).find("td select.purpose_id").attr({name:'general_receipt_purposes['+i+'][purpose_id]',id:'general_receipt_purposes-'+i+'-purpose_id'});
			$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});
			$(this).find("td input.quantity").attr({name:'general_receipt_purposes['+i+'][quantity]',id:'general_receipt_purposes-'+i+'-quantity'});
			$(this).find("td input.amount").attr({name:'general_receipt_purposes['+i+'][amount]',id:'general_receipt_purposes-'+i+'-amount'});
			$(this).find("td input.total").attr({name:'general_receipt_purposes['+i+'][total]',id:'general_receipt_purposes-'+i+'-total'});
		i++;
		});
		calculate();
		
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
			drawn_bank: {
				required: true
			},
			cheque_no: {
				required: true
			},
			cheque_date: {
				required: true
			},
			purpose_amount: {
				required: true,
				number:true
			},
			'general_receipt_purposes[0][purpose_id]': {
				required: true
			},
			'general_receipt_purposes[0][quantity]': {
				required: true,
				number: true
			},
			'general_receipt_purposes[0][amount]': {
				required: true,
				number: true
			}
			
		},
		submitHandler: function () {
				
				$("#general_receipt").attr('disabled','disabled');
				
				 form.submit();
			}
	});
	
	var amount_type=$('input[name="amount_type"]:checked').val();
	
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
	
	$('input[name="member_type_id"]').on('change',function() {
		var member_type_id=$(this).val();
		$('select[name="member_id"]').find('.select2-selection__rendered').text('');
		$('select[name="member_id"] option').each(function(){
			
			if($(this).attr('member_type_id') != member_type_id)
			{
				$(this).prop('disabled', true);
			}
			else
			{
				$(this).prop('disabled', false);
			}
		});
		
		$('select[name="member_id"]').select2({ allowClear: true });
		
		
	});
	$('input[name="tax_applicable"]').on('change',function() {
		var tax_applicable=$(this).val();
		
		$('.Tax').remove();
		$('.purpose_id').find('.select2-selection__rendered').text('');
		var value='';
		$('.calculate').val(value);
		$('.total').val(value);
		$('#grand_total').find('strong').text(value);
		$('#grand_total').find('input').val(value);
	
		var select_name='';
		var len=$('select[name^="general_receipt_purposes"]').length;
		var count=0;
		$('select[name^="general_receipt_purposes"]').each(function(){
			count++;
			select_name=$(this).attr('name');
			$('option',this).each(function()
			{
				if($(this).attr('tax_applicable') != tax_applicable)
				{
					$(this).prop('disabled', true);
				}
				else
				{
					$(this).prop('disabled', false);
				}
			});
			if(count!=len)
			{
				$('select[name="'+select_name+'"]').select2({ allowClear: true });
			}
		});
		
		
	});
	
});
</script>
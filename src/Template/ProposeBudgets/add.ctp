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
input {
	margin-bottom: 0px !important;
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
	  <h3 class="box-title">Propose Budget</h3>
 	</div>
	<!-- /.box-header -->
	<!-- form start -->
	  <div class="box-body">
	 <?php echo $this->Form->create($proposeBudget, ['id'=>'configform']); ?>
 		<div class="col-sm-12 no-print">
 			<div class="form-group col-sm-4 display-data">
				<label>Financial Year</label>
              <?php  
                $options=array();
				foreach($master_financial_years as $master_purpose_data){
					$from=date('Y', strtotime($master_purpose_data->financial_year_from));
					$to=date('Y', strtotime($master_purpose_data->financial_year_to));
					$fromdate=date('Y-m-d', strtotime($master_purpose_data->financial_year_from));
					$todate=date('Y-m-d', strtotime($master_purpose_data->financial_year_to));
					
					$options[] = ['text' => $from .'-'.$to , 'value' =>  $master_purpose_data->id , 'fromdate' =>$fromdate , 'todate' => $todate];
				}
				echo $this->Form->input('financial_year_from', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control select2 finance_value','options'=>$options]); ?>	
			</div>
 		</div>
        
		<div class="col-sm-12 no-print" style="margin-top:20px;" id="main">		
			<table class="table table-bordered">	
			<thead style="">
				<tr>
					<th width="30%">Purpose</th>
					<th width="30%">Recipt Amount</th>
					<th width="30%">Expenditure Amount</th>
 					<th width="10%"></th>
				</tr>
			</thead>
            <tbody>
			 
			</tbody>

		<tfoot id="tax_view">
 		</tfoot>			
			</table>
		</div>
	 
		<div class="col-sm-12 no-print">
		<center>
		<?php echo $this->Form->button('Submit' . $this->Html->tag('i', '', ['class'=>'fa fa-arrow-circle-down']),['class'=>'btn btn-success','type'=>'submit','id'=>'general_receipt']); ?>
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
				echo $this->Form->input('propose_budgets[][master_purpose_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Purpose','label' => false,'class'=>'form-control master_purpose_id','options'=>$masterPurposes]); ?>
                <?php echo $this->Form->input('propose_budgets[][financial_year_from]', ['type' => 'hidden' , 'label' => false , 'class'=>'financial_year_from']); ?>
    			<?php echo $this->Form->input('propose_budgets[][financial_year_to]', ['type' => 'hidden' , 'label' => false , 'class'=>'financial_year_to']); ?>
                <?php echo $this->Form->input('propose_budgets[][user_id]', ['type' => 'hidden' , 'label' => false , 'value'=>$user_id ,'class'=>'user_id']); ?>
 			</td>
			<td>
				<?php echo $this->Form->input('propose_budgets[][receipt_amount]', ['label' => false,'placeholder'=>'Recipt Amount','class'=>'form-control receipt_amount','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('propose_budgets[][expenditure_amount]', ['label' => false,'placeholder'=>'Expenditure Amount','class'=>'form-control expenditure_amount','autocomplete'=>'off']); ?>
			</td>
			<td>
		
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
			</td>
		</tr>
	</tbody>
</table>
   
  <!-- /.box -->
 <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).ready(function(){

	  
	add_row();
	function add_row()
	{
		var new_line=$("#sample tbody").html();
		$("#main tbody").append(new_line);
		$('#main tbody tr:last select').select2();		
		rename_rows();
		insert_value()
	}
	
	function rename_rows()
	{
		var i =0;
		$("#main tbody tr").each(function(){
			$(this).find("td select.master_purpose_id").attr({name:'propose_budgets['+i+'][master_purpose_id]',id:'propose_budgets-'+i+'-master_purpose_id'});
 			$(this).find("td input.receipt_amount").attr({name:'propose_budgets['+i+'][receipt_amount]',id:'propose_budgets-'+i+'-receipt_amount'});
 			$(this).find("td input.expenditure_amount").attr({name:'propose_budgets['+i+'][expenditure_amount]',id:'propose_budgets-'+i+'-expenditure_amount'});
			
			$(this).find("td input.financial_year_from").attr({name:'propose_budgets['+i+'][financial_year_from]',id:'propose_budgets-'+i+'-financial_year_from'});
			$(this).find("td input.financial_year_to").attr({name:'propose_budgets['+i+'][financial_year_to]',id:'propose_budgets-'+i+'-financial_year_to'});
			$(this).find("td input.user_id").attr({name:'propose_budgets['+i+'][user_id]'});
			
  		i++;
		});
		$("[name^=general_receipt_purposes]").each(function () { 
			$(this).rules("add", {
				required: true,
				number: true
			});
		});
	}
	function insert_value()
	{
		var fromdate = $('.financial_year_from').val();
		var todate = $('.financial_year_to').val();
		
		$('.financial_year_from').val(fromdate);
		$('.financial_year_to').val(todate);
	}
	
	$(document).on("click",".add_row",function(){ 
		add_row();
	});
	
	$(document).on("change",".finance_value",function(){ 
		var fromdate = $('option:selected', this).attr('fromdate');
		var todate = $('option:selected', this).attr('todate');
		$('.financial_year_from').val(fromdate);
		$('.financial_year_to').val(todate);
 		 
	});
	
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
		var i =0;
		$("#main tbody tr").each(function(){
			$(this).find("td select.master_purpose_id").attr({name:'propose_budgets['+i+'][master_purpose_id]',id:'propose_budgets-'+i+'-master_purpose_id'});
 			$(this).find("td input.receipt_amount").attr({name:'propose_budgets['+i+'][receipt_amount]',id:'propose_budgets-'+i+'-receipt_amount'});
			$(this).find("td input.expenditure_amount").attr({name:'propose_budgets['+i+'][amount]',id:'propose_budgets-'+i+'-expenditure_amount'});
 		i++;
		});
 	});
	
	 $("#configform").validate({
		rules: {
			financial_year_from: {
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
	
	
	 $("form#form_non_member").validate({
		rules: {
			company_organisation: {
				required: true
			},
			email: {
				email: true,
				required: false
			},
			mobile_no: {
				number: true
			},
			
			
		},
		submitHandler: function(form,e) {
			e.preventDefault();
				$.ajax({
				 url:"<?php echo $this->Url->build(['controller'=>'MemberReceipts','action'=>'general_receipt_ajax_non_member']); ?>",
						type: 'POST',
						data: $('#form_non_member').serialize(), 
						success:function(data){ 
						 $('#myModal').removeClass( "in" );
							$('#myModal').hide(); 
							$('.modal-backdrop').remove();
							$('select[name="member_id"]').append(data);
						}
				});
		}  
	});
	
	
 	
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
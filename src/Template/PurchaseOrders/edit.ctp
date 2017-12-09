
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
	  <h3 class="box-title">Purchase Order Edit</h3>
	 
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	  <div class="box-body">
	  <?= $this->Form->create($purchaseOrder,['id'=>'configform']) ?>
		<div class="col-sm-12 no-print">
			
			<div class="form-group col-sm-4">
			  <label>Supplier name</label>
				<?php  
				
				$options=array();
				foreach($suppliers as $supplier)
				{
					$options[] = ['text' => $supplier['name'], 'value' => $supplier['id'], 'state' => $supplier['master_state_id']]; 
				}
					
				echo $this->Form->input('supplier_id', ['empty'=> '--Select--','data-placeholder'=>'Select a supplier','label' => false,'options'=>$options,'class'=>'form-control select2  suppliercompany supplier state','style'=>'width:100%;']);  ?>
				<label id="supplier-id-error" class="error" for="supplier-id"></label>
			</div>
			
			<div class="form-group col-sm-4">
				<label>Payment Type</label>
								
										<?php
									$options=array();

									$options['Cheque'] ='Cheque';
									$options['Cash'] = 'Cash';
									$options['NEFT/RTGS'] = 'NEFT/RTGS';
										
									echo $this->Form->input('payment_type', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'value'=>$purchaseOrder->payment_type,'hiddenField' => false)); ?>				
					
			</div>
			
			<div class="form-group col-sm-4">
				<label>Delivery</label>
					<?php echo $this->Form->input('delivery', ['label' => false,'placeholder'=>'delivery','class'=>'form-control','autocomplete'=>'off']); ?>		
				
			</div>
			
		</div>
		
		
		<div class="col-sm-12 no-print">
			
			<div class="form-group col-sm-3">
				<label>Date</label>
					<?php  echo $this->Form->input('date', ['label' => false,'class'=>'form-control  date-picker','autocomplete'=>'off','data-date-format'=>'dd-mm-yyyy','type'=>'text']); ?>	
				
			</div>
			
			<div class="form-group col-sm-3">
				<label>Time</label>
					<div class="form-group bootstrap-timepicker">
						<?php echo $this->Form->input('time', ['label' => false,'class'=>'form-control  timepicker ','autocomplete'=>'off']); ?>	
					
					</div>
			</div>
			
			
			
			<div class="form-group col-sm-3">
			  <label>TIN No</label>
				<?php  
						
				echo $this->Form->input('tin_no', ['label' => false,'placeholder'=>'TIN No','class'=>'form-control']);  ?>
				
			</div>
			
			<div class="form-group col-sm-3">
				<label>Freight</label>
					<?php echo $this->Form->input('freight', ['label' => false,'placeholder'=>'Freight','class'=>'form-control','autocomplete'=>'off']); ?>		
				
			</div>
			
			
			
			
			
		</div>
		
		
		
		
		<div class="col-sm-12 no-print main1" style="margin-top:20px;" id="main">		
			<table class="table table-bordered">	
			<thead style="">
				<tr>
					<th width="40%" >Item</th>
					
					<th >Quantity</th>
					<th >Rate</th>
					<th >Discount</th>
					<th >Total</th>
					<th ></th>
				</tr>
			</thead>
            <tbody class="main">
			<?php 
			$i=0;
			foreach($purchaseOrder->purchase_order_rows as $purchase_order_row)
			{
				?>
			<tr class="new">
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][item_name]', ['label' => false,'placeholder'=>'Item Name','class'=>'form-control item_name','id'=>'purchase_order_rows-0-item_name','autocomplete'=>'off','type'=>'textarea','rows'=>'3','value'=>$purchase_order_row->item_name]); ?>
			</td>
			
			<!--<td>
				<?php  $this->Form->input('purchase_order_rows[0][date]', ['label' => false,'class'=>'form-control date_new date-picker','id'=>'purchase_order_rows-0-date','autocomplete'=>'off','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y',strtotime($purchase_order_row->date))]); ?>
			</td>
			<td>
				<div class="form-group bootstrap-timepicker">
				<?php  $this->Form->input('purchase_order_rows[0][time]', ['label' => false,'class'=>'form-control time timepicker ','id'=>'purchase_order_rows-0-time','autocomplete'=>'off','value'=>$purchase_order_row->time]); ?>
				<div>
			</td>-->
			
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][quty]', ['label' => false,'placeholder'=>'Quantity','class'=>'form-control quantity calculate','id'=>'purchase_order_rows-0-quty','autocomplete'=>'off','value'=>$purchase_order_row->quty]); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][rate]', ['label' => false,'placeholder'=>'Rate','class'=>'form-control amount calculate','id'=>'purchase_order_rows-0-rate','autocomplete'=>'off','value'=>$purchase_order_row->rate]); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][discount]', ['label' => false,'placeholder'=>'Discount %','class'=>'form-control calculate discount','id'=>'purchase_order_rows-0-discount','autocomplete'=>'off','value'=>$purchase_order_row->discount]); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][amount]', ['label' => false,'placeholder'=>'Total','class'=>'form-control total','readonly','value'=>$purchase_order_row->amount]); ?>
			</td>
			<td>
		
<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
<?php if($i!=0){ echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); } ?>
			</td>
		</tr>
			<?php $i++; } ?>
			</tbody>

		<tfoot id="tax_view">
			
			<tr>
			<td colspan="4" align="right">Grant Total</td>
			<td id="grand_total"> <input type="hidden" name="amount" value="0"><strong>0</strong></td>
			</tr>
			
		</tfoot>			
			</table>
		</div>
	
		
		<div class="col-sm-12 no-print">
		<center>
		<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-arrow-circle-down']). ' Generate'  ,['class'=>'btn btn-success','type'=>'submit','id'=>'general_receipt']); ?>
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
		<tr class="new">
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][item_name]', ['label' => false,'placeholder'=>'Item Name','class'=>'form-control item_name','id'=>'purchase_order_rows-0-item_name','autocomplete'=>'off','type'=>'textarea','rows'=>'3']); ?>
			</td>
			<!--<td>
				<?php  $this->Form->input('purchase_order_rows[0][date]', ['label' => false,'class'=>'form-control date_new date-picker ','id'=>'purchase_order_rows-0-date','autocomplete'=>'off','data-date-format'=>'dd-mm-yyyy']); ?>
			</td>
			<td>
				<div class="form-group bootstrap-timepicker">
				<?php  $this->Form->input('purchase_order_rows[0][time]', ['label' => false,'class'=>'form-control time timepicker','id'=>'purchase_order_rows-0-time','autocomplete'=>'off']); ?>
				<div>
			</td>-->
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][quty]', ['label' => false,'placeholder'=>'Quantity','class'=>'form-control quantity calculate','id'=>'genaral_receipt_purposes-0-quantity','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][rate]', ['label' => false,'placeholder'=>'Rate','class'=>'form-control amount calculate','id'=>'genaral_receipt_purposes-0-amount','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][discount]', ['label' => false,'placeholder'=>'Discount %','class'=>'form-control calculate discount  calculatetax','autocomplete'=>'off']); ?>
			</td>
			<td>
				<?php echo $this->Form->input('purchase_order_rows[0][amount]', ['label' => false,'placeholder'=>'Total','class'=>'form-control total','readonly']); ?>
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

	var i =0;
		$("#main tbody tr.new").each(function(){ 
			$(this).find("td textarea.item_name").attr({name:'purchase_order_rows['+i+'][item_name]',id:'purchase_order_rows-'+i+'-item_name'});
			//$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});
			
			//$(this).find("td input.date_new").attr({name:'purchase_order_rows['+i+'][date]',id:'purchase_order_rows-'+i+'-date'}).datepicker();
			
			//$(this).find("td input.time").attr({name:'purchase_order_rows['+i+'][time]',id:'purchase_order_rows-'+i+'-time'});
			
			$(this).find("td input.quantity").attr({name:'purchase_order_rows['+i+'][quty]',id:'purchase_order_rows-'+i+'-quty'});
			
			$(this).find("td input.amount").attr({name:'purchase_order_rows['+i+'][rate]',id:'purchase_order_rows-'+i+'-rate'});
			$(this).find("td input.discount").attr({name:'purchase_order_rows['+i+'][discount]',id:'purchase_order_rows-'+i+'-discount'});
			$(this).find("td input.total").attr({name:'purchase_order_rows['+i+'][amount]',id:'purchase_order_rows-'+i+'-amount'});
		i++;
			
		});
			
	calculate();

calculate2();
function calculate2()
	{    
		var purpose_array=new Array();
			
			var state_id =$(".state").find('option:selected').attr('state');

			var grand_total=0;
			
			$(".main1 tbody tr").each(function(){
				var total_amount =parseFloat($(this).find("td input.total").val());
				grand_total+=total_amount;
			});
			
			
			var grand_total1=grand_total.toFixed(2)
			
			var m_data = new FormData();
				m_data.append('total_amount',grand_total1);
				m_data.append('state_id',state_id);
				
				
			$.ajax({
			url:"<?php echo $this->Url->build(['controller'=>'PurchaseOrders','action'=>'CalculateTaxPurchaseOrders']); ?>",
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
	
	

	
	
	
	
	function calculate()
	{ 
		var purpose_array=new Array();
			
			var tds =$(".tds_value").val();
			//alert(tds);
			var grand_total=0;
			$("#main tbody tr.new").each(function(){
			var total_amount =parseFloat($(this).find("td input.total").val());
			grand_total+=total_amount;
			
			});
			grand_total=grand_total.toFixed(2)
				
				$('#grand_total').find('input').val(grand_total);
				$('#grand_total').find('strong').html(grand_total);
			
			
	}
	$(document).on("keyup",".calculate,.tds_value",function()
	{ 
		var qty=$(this).closest('tr').find('td input.quantity').val();
		if(qty==''){ qty=0;  }
		var amt=$(this).closest('tr').find('td input.amount').val();
		if(amt==''){ amt=0;  }
		var totalvalue = qty*amt;
		var discount=$(this).closest('tr').find('td input.discount').val();
		if(discount==''){ discount=0;  }
		var discount1=totalvalue*discount/100;
		var total=totalvalue-discount1;
		total =parseFloat(total).toFixed(2);
		$(this).closest('tr').find('td input.total').val(total);
		calculate2();
		calculate();
	});
	
	function add_row()
	{
		var new_line=$("#sample tbody").html();
		$("#main tbody.main").append(new_line);
		calculate2();
		calculate();
		//$('#main tbody tr:last select.purpose_id').select2();
	}
	
	$(document).on("click",".add_row",function(){ 
		add_row();
		var i =0;
		$("#main tbody tr.new").each(function(){
			$(this).find("td textarea.item_name").attr({name:'purchase_order_rows['+i+'][item_name]',id:'purchase_order_rows-'+i+'-item_name'});
			//$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});
			
			//$(this).find("td input.date_new").attr({name:'purchase_order_rows['+i+'][date]',id:'purchase_order_rows-'+i+'-date'}).datepicker();
			
			//$(this).find("td input.time").attr({name:'purchase_order_rows['+i+'][time]',id:'purchase_order_rows-'+i+'-time'}).timepicker({ showInputs: false });
			
			
			$(this).find("td input.quantity").attr({name:'purchase_order_rows['+i+'][quty]',id:'purchase_order_rows-'+i+'-quty'}).rules("add", {
					required: true,
					number: true
				});
			
			$(this).find("td input.amount").attr({name:'purchase_order_rows['+i+'][rate]',id:'purchase_order_rows-'+i+'-rate'}).rules("add", {
					required: true,
					number: true
				});
			$(this).find("td input.discount").attr({name:'purchase_order_rows['+i+'][discount]',id:'purchase_order_rows-'+i+'-discount'}).rules("add", {
					required: false,
					number: true
				});
			
			$(this).find("td input.total").attr({name:'purchase_order_rows['+i+'][amount]',id:'purchase_order_rows-'+i+'-amount'});
		i++;
			
		});
		
			$(".item_name").each(function () { 
				$(this).rules("add", {
					required: true
					
				});
			});
	
		calculate2();
		calculate();
	});
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
		var i =0;
		$("#main tbody tr.new").each(function(){
			$(this).find("td textarea.item_name").attr({name:'purchase_order_rows['+i+'][item_name]',id:'purchase_order_rows-'+i+'-item_name'});
			//$(this).find("td label.bbb").attr({for:'general_receipt_purposes-'+i+'-purpose_id',id:'general_receipt_purposes-'+i+'-purpose_id-error'});
			
			$(this).find("td input.date_new").attr({name:'purchase_order_rows['+i+'][date]',id:'purchase_order_rows-'+i+'-date'}).datepicker();
			
			$(this).find("td input.time").attr({name:'purchase_order_rows['+i+'][time]',id:'purchase_order_rows-'+i+'-time'});	
			
			
			$(this).find("td input.quantity").attr({name:'purchase_order_rows['+i+'][quty]',id:'purchase_order_rows-'+i+'-quty'}).rules("add", {
					required: true,
					number: true
				});
			
			$(this).find("td input.amount").attr({name:'purchase_order_rows['+i+'][rate]',id:'purchase_order_rows-'+i+'-rate'}).rules("add", {
					required: true,
					number: true
				});
			$(this).find("td input.discount").attr({name:'purchase_order_rows['+i+'][discount]',id:'purchase_order_rows-'+i+'-discount'}).rules("add", {
					required: false,
					number: true
				});
			
			$(this).find("td input.total").attr({name:'purchase_order_rows['+i+'][amount]',id:'purchase_order_rows-'+i+'-amount'});
		i++;
			
		});
		calculate();
		calculate2();
	});
	
	 $("#configform").validate({
		rules: {
			supplier_id: {
				required: true
			},
			tin_no: {
				//required: true
			},
			freight: {
				//required: true
			},
			'purchase_order_rows[0][item_name]': {
				required: true
			},
			
			'purchase_order_rows[0][quty]': {
				required: true,
				number: true
			},
			'purchase_order_rows[0][rate]': {
				required: true,
				number: true
			}
			
		},
		submitHandler: function () {
				
				$("#general_receipt").attr('disabled','disabled');
				
				 form.submit();
			}
		
	});
	
	
});
</script>

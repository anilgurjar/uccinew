 <style>
input[type="radio"]
{
	margin-right: 8px;
	margin-left: 6px;
	margin-top: 6px;
}
 </style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>CERTIFICATE OF ORIGIN</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
			]); 
		?>
		<div class="box-body">
		 <?= $this->Form->create($certificate_origin_good,['method'=>'post','class'=>'form-horizontal','id'=>'certificate_form','enctype' => 'multipart/form-data','onsubmit' => 'return file_submit();'])?> 
					<div class="col-sm-12 no-print">
					<div class="col-sm-6">
						<div class="form-group">
						  <label class="col-sm-4 control-label">Exporter</label>
						   <div class="col-sm-8">
						<?php
						 echo $this->Form->input('exporter',['label'=>false,'class'=>'form-control valid','name'=>'exporter','type'=>'text','value'=>$company_organisation,'style'=>'border:none; border-bottom: 1px dotted #ccc; background-color: #FFF;','readonly'=>'readonly']);
						 ?>
						 </div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-4 control-label">Consignee</label>
						   <div class="col-sm-8">
						<?php  
						echo $this->Form->input('consignee',['label'=>false,'class'=>'form-control','type'=>'text','name'=>'consignee','style'=>'border:none; border-bottom: 1px dotted #ccc;']);  
						?>
						</div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-4 control-label">Invoice No. & Date</label>
						   <div class="col-sm-4">
				       <?php  
						echo $this->Form->input('invoice_no',['label'=>false,'class'=>'form-control','type'=>'text','name'=>'invoice_no','style'=>'border:none; border-bottom: 1px dotted #ccc;','placeholder'=>'Invoice No.']);  
						?>
						 </div>
						 <div class="col-sm-4">
						<?php
						echo $this->Form->input('invoice_date',['label'=>false,'class'=>'form-control date-picker','type'=>'text','name'=>'invoice_date','style'=>'border:none; border-bottom: 1px dotted #ccc;','placeholder'=>'Invoice Date','data-date-format'=>'dd-mm-yyyy']);
						
						
						
						?>
						</div>
						  
						</div>
						<div class="form-group">
						  <label class="col-sm-4 control-label">Manufacturer</label>
						   <div class="col-sm-8">
						<?php
						echo $this->Form->input('manufacturer',['label'=>false,'class'=>'form-control','type'=>'text','name'=>'manufacturer','style'=>'border:none; border-bottom: 1px dotted #ccc;']);  
						?> 
						 </div>
						</div>
						<div class="form-group">
						  <label class="col-sm-4 control-label">Despatched by :</label>
						    <div class="col-sm-8">
					     <?php
						 $options[]='Sea';
						 $options[]='Air';
						 $options[]='Road';
			           
						echo $this->Form->input('despatched_by', array('type' => 'radio','label' => false,'options' => $options,'value'=>'Sea','hiddenField' => false)); 
						 unset($options);
						 ?>
						 <br/>
						 <label id="despatched_by-error" class="error" for="despatched_by" style="display: none;"></label>
						  </div>
						  
						  
						  
						
					</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
						  <label class="col-sm-4 control-label">Port of Loading</label>
						   <div class="col-sm-8">
						 <?php
						 echo $this->Form->textarea('port_of_loading',['label'=>false,'class'=>'form-control','name'=>'port_of_loading','style'=>'resize:none;','rows'=>'2']);
						 ?>
						 </div>
						 
						</div>
						<div class="form-group">
						  <label class="col-sm-4 control-label">Final Destination</label>
						   <div class="col-sm-8">
						 <?php
						 echo $this->Form->textarea('final_destination',['label'=>false,'class'=>'form-control','name'=>'final_destination','style'=>'resize:none;','rows'=>'2']);
						 ?> 
						 
						 </div>
						</div>
						
						<div class="form-group">
						  <label class="col-sm-4 control-label">Port of Discharge</label>
						   <div class="col-sm-8">
						  <?php
						 echo $this->Form->textarea('port_of_discharge',['label'=>false,'class'=>'form-control','name'=>'port_of_discharge','style'=>'resize:none;','rows'=>'2']);
						 ?>  
						   </div>
						</div>
						
						<div class="form-group">
						<div class="col-sm-8 ">
						  <label >Do you want to show value in pdf ?</label>
						   <br/>
						  <?php
						 $options['Yes']='Yes';
						 $options['No']='No';
			           
						echo $this->Form->input('show_amount', array('type' => 'radio','label' => false,'options' => $options,'value'=>'Yes','hiddenField' => false)); 
						 unset($options);
						 ?>
						 </div>
						</div>
						
					</div>
					
					<div class="col-sm-6 ">
						<div class="form-group">
							<label class="col-sm-4 control-label">Other Information</label>
							<div class="col-sm-8">
							<?php
								 echo $this->Form->textarea('other_info',['label'=>false,'class'=>'form-control','type'=>'text']);
								 ?> 
						   </div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label">Invoice Attachment</label>
							<table id="file_table" style="line-height:2.5">
								<tr>
									<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?></td>
									<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>
									<td></td>
								</tr>
							</table>
						</div>	
					</div>	
					
				</div>
				
			
			
			
			
			<table id="copy_row" style="display:none;">	
			<tbody>
				<tr>
					<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?></td>
					<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
					</td>
					<td>
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
				</tr>
			</tbody>
			</table>
			
				
				
				<div class="col-sm-12 no-print">
					<div class="table-responsive no-padding">
					<table class="table table-bordered  maintable" id="parant_table" style="width:100%;">
						<thead>
							<tr>
								<th colspan="7" style="text-align:center;"><h4><strong>PARTICULARS OF GOODS<strong></h4></th>
							</tr>
							<tr>
								<th>Marks</th><th>Container No.</th><th>No. & kind of packings</th><th>Description of Goods</th><th>Quantity<?php
								 foreach($MasterCurrencies as $MasterCurrencie)
								{
									$MasterCurrency[]=['text'=>$MasterCurrencie->currency_type,'value'=>$MasterCurrencie->currency_type];
								} 
								?>
								
								<label id="certificate-origin-goods-0-unit-id-error" class="error" for="certificate-origin-goods-0-unit-id" style="display: none;"></label></th><th>Value<br/>
								<?= $this->Form->input('currency', ['empty'=> '--Select Currency name--','label' => false,'class'=>'form-control select2','options'=>$MasterCurrency,'style'=>''])  ?>
								<label id="currency-error" class="error" for="currency"></label>
								</th><th></th>
							</tr>
						</thead>
						<tbody class="maintbody">
							<tr class="maintr">
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][marks]',['label'=>false,'class'=>'form-control marks','type'=>'text','placeholder'=>'Marks']);
								?>
								</td>
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][container_no]',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Container No.']);
								?>
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][no_and_packing]',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'No. Of Packing']);
								?>
								</td>
								
								<td>
							   <?php
								 echo $this->Form->input('certificate_origin_goods[0][description_of_goods]',['label'=>false,'class'=>'form-control','type'=>'text','placeholder'=>'Description Of Goods']);
								?>
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][quantity]',['label'=>false,'class'=>'form-control','type'=>'text','style'=>'','placeholder'=>'Quantity']);
								?>
								
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][value]',['label'=>false,'class'=>'form-control  totaladd Value','type'=>'text','placeholder'=>'Currency Value']);
								?>
								
								</td>
								
								<td style="width: 10%;">
								
								
								<?php
								echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-info btn-sm add_row','type'=>'button']);
								?>
							   </td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
				
				<div class="col-sm-12 no-print">
					<div class="form-group">
						<label class="col-sm-9 control-label">Total</label>
						<div class="col-sm-2">
						 <?php
						echo $this->Form->input('total_before_discount',['label'=>false,'class'=>'form-control total','type'=>'text','name'=>'total_before_discount','readonly','style'=>' ']);  
						?> 
						</div>
					</div>
				</div>
				<div class="col-sm-12 no-print">
					<div class="form-group">
						<label class="col-sm-9 control-label">Discount</label>
						<div class="col-sm-2">
						 <?php
						echo $this->Form->input('discount',['label'=>false,'class'=>'form-control discount','type'=>'text','name'=>'discount','style'=>' ']);  
						?> 
						</div>
					</div>
				</div>
				<div class="col-sm-12 no-print">
					<div class="form-group">
						<label class="col-sm-9 control-label">Freight Amount</label>
						<div class="col-sm-2">
						 <?php
						echo $this->Form->input('freight_amount',['label'=>false,'class'=>'form-control freighttotal','type'=>'text','name'=>'freight_amount','style'=>' ']);  
						?> 
						</div>
					</div>
				</div>
				<div class="col-sm-12 no-print">
					<div class="form-group">
						<label class="col-sm-9 control-label">Total Amount</label>
						<div class="col-sm-2">
						 <?php
						echo $this->Form->input('total_amount',['label'=>false,'class'=>'form-control totalamount','readonly','type'=>'text','name'=>'total_amount','style'=>' ']);  
						?> 
						</div>
					</div>
				</div>
				<div class="col-sm-12 no-print">
					<center>
						<?php
						echo $this->Form->button(__('Save as Draft') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'certificate_origin_submit','id'=>'certificate_origin']);
						?>
					</center>
					
				</div>
		  <?php echo $this->Form->end(); ?>
    </div>
	 
 
  <!-- /.box -->
  <table id="sample" style="display:none;">
		<tbody>
			<tr>
				<td>
			   <?php
					echo $this->Form->input('marks1',['class'=>'form-control marks','type'=>'text','label'=>false,'placeholder'=>'Marks']);
				?>	
			   </td>
			   <td>
				<?php
					echo $this->Form->input('container_no1',['class'=>'form-control','type'=>'text','label'=>false,'placeholder'=>'Container No.']);
				?>
				</td>
				<td>
				 <?php
					echo $this->Form->input('no_and_packing1',['class'=>'form-control','type'=>'text','label'=>false,'placeholder'=>'No. Of Packing']);
				?>
				</td>
				<td>
			   <?php
				echo $this->Form->input('description_of_goods1',['class'=>'form-control','type'=>'text','label'=>false,'placeholder'=>'Description Of Goods']);
				?>
				</td>
				<td>
				<?php
				echo $this->Form->input('quantity1',['class'=>'form-control','type'=>'text','label'=>false,'placeholder'=>'Quantity']);
				?>
				<td>
				<?php
				echo $this->Form->input('value1',['class'=>'form-control totaladd Value','type'=>'text','label'=>false,'placeholder'=>'Currency Value']);
				?>
				
				</td>
				<td style="width: 10%;">
				<?php
				echo $this->Form->button(('') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-info btn-sm add_row','type'=>'button','name'=>'add_row']);
				?>
				
				<?php
				echo $this->Form->button(('') . $this->Html->tag('i', '', ['class'=>'fa fa-trash']),['class'=>'btn btn-danger btn-sm remove_row','type'=>'button']);
				?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>

function file_submit(){
	
	var x =$('.invoice_attachment').val();
	
	if(x){
			var ext = x.substring(x.lastIndexOf('.') + 1);
			if(ext == "pdf" || ext == "PDF")
			{
				return true;
			} 
			else
			{
				alert("Upload pdf files only");
				
				return false;
			}

		
	}else{
		
		return true;
	}
	
}

$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
		
});

$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
});

//jQuery.validator.addMethod("accept", function(value, element, param) { return value.match(new RegExp("." + param + "$"));});rules: { fileupload: { accept: "(docx?|doc|pdf)" }}



$(document).ready(function(){ 

	$(document).on('keyup','input.totaladd',function() {
		calculation();
		calculate2();
	});
	
	
	
	$('.discount').on('keyup',function() {
		calculate2();
	});	
	$('.freighttotal').on('keyup',function() {
		calculate2();
	});	
	
	
	function calculate2(){    
		total1=parseFloat($('.total').val());
		if(total1==''){ total1=0; }
		totalamount=parseFloat($('.totalamount').val());
		if($.isNumeric(totalamount)==false){ totalamount=0; }
		 
		
		var discount1=parseFloat($('.discount').val());
		if($.isNumeric(discount1)==false){ discount1=0; }
		var freighttotal1=parseFloat($('.freighttotal').val());
		if($.isNumeric(freighttotal1)==false){ freighttotal1=0; }
		
		total_amount=total1-discount1+freighttotal1;
		$('input[name="total_amount"]').val(total_amount.toFixed(2));
	}
	
	function calculation(){
		var total=0;
		$(".totaladd").each(function(){  
			 total1=parseFloat($(this).val());
			
			if($.isNumeric(total1)==false){ total1=0; }
			
			total+=total1; 
			totalamount=total; 
			
				
		});
		
		$('input[name="total_before_discount"]').val(total.toFixed(2));
		$('input[name="total_amount"]').val(totalamount.toFixed(2));
		
		calculate2();
		
	}
	
	
	
	

	// Add Row certificate_origin_goods
	$( document ).on( 'click', '.add_row', function() {
		var new_line=$('#sample tbody').html();
		$("#parant_table tbody").append(new_line);
		var i=0;
		var name=[];
		name.push('marks','container_no','no_and_packing','description_of_goods','quantity','value');
		
		$("#parant_table tbody tr").each(function(){
			var j=0; 
			$(this).find('td').each(function(){
				
				$(this).find('input').attr('name','certificate_origin_goods['+i+']['+name[j]+']');
				$(this).find('input').attr('id','certificate-origin-goods-'+i+'-'+name[j]);
				
				
				j++;
			});
			
			i++;
		
		});
		var i=0;
		$("[name^=certificate_origin_goods]").each(function () {
			if(!$(this).hasClass('marks'))
			{
				$(this).rules("add", {
					required: true
				});
			}
			if($(this).hasClass('Value'))
			{
				$(this).rules("add", {
					number: true
				});
			}
		});
			
		
	});
	// Remove Row
	$( document ).on( 'click', '.remove_row', function() {
		$(this).closest("#parant_table tr").remove();
		var i=0;
		var name=[];
		name.push('marks','container_no','no_and_packing','description_of_goods','quantity','value');
		
		$("#parant_table tbody tr").each(function(){
			var j=0;
			$(this).find('td').each(function(){
				$(this).find('input').attr('name','certificate_origin_goods['+i+']['+name[j]+']');
			
				j++;
			});
			i++;
		});
	});
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	$("#certificate_form").validate({
		rules: {
			exporter: {
				//required: true
			},
			consignee: {
				required: true
			},
			invoice_no: {
				required: true
			},
			invoice_date: {
				required: true
			},
			manufacturer: {
				required: true
			},
			despatched_by: {
				required: true
			},
			port_of_loading: {
				required: true
			},
			final_destination: {
				required: true
			},
			port_of_discharge: {
				required: true
			},
			
			'certificate_origin_goods[0][container_no]': {
				required: true
			},
			'certificate_origin_goods[0][no_and_packing]': {
				required: true
			},
			'certificate_origin_goods[0][description_of_goods]': {
				required: true
			},
			'certificate_origin_goods[0][quantity]': {
				required: true
				
			},
			unit_id: {
				required: true
			},
			'certificate_origin_goods[0][value]': {
				required: true,
				number: true
			},
			currency: {
				required: true
			},
			discount:{
				number: true
			},
			freight_amount:{
				number: true
			}
			
			
		},
		submitHandler: function () {
				
				//$("#certificate_origin").attr('disabled','disabled');
				form.submit();
			}
		
	});
	
	
});
</script>	
	
 
				
				
   
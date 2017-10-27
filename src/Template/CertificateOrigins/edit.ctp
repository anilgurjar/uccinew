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
	  <h3 class="box-title"><strong>CERTIFICATE OF ORIGIN Edit</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
			]); 
		?>
		<div class="box-body">
		 <?= $this->Form->create($certificate_origin_good,['method'=>'post','class'=>'form-horizontal','id'=>'certificate_form','enctype' => 'multipart/form-data'])?> 
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
							if($certificate_origin_good['despatched_by']==0){$despatch=0;}
							else if ($certificate_origin_good['despatched_by']==1){ $despatch=1; }
							else{ $despatch=2; } 
							 
							echo $this->Form->input('despatched_by', array('type' => 'radio','label' => false,'options' => $options,'value'=>$despatch,'hiddenField' => false)); 
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
					
				
					
					
				</div>
				
			
			
			<div class="col-sm-12">
				<div class="col-sm-6">
					<div class="form-group">
			
					 <label class="col-sm-4 control-label">Invoice Attachment</label>
						<table id="file_table" style="line-height:2.5">
						<tr>
						<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
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
					<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
					<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
					</td>
					<td>
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
				</tr>
			</tbody>
			</table>				
				
				<div class="col-sm-12 no-print">
					<div class="table-responsive no-padding">
					<table class="table table-bordered" id="parant_table" style="width:100%;">
						<thead>
							<tr>
								<th colspan="7" style="text-align:center;"><h4><strong>PARTICULARS OF GOODS<strong></h4></th>
							</tr>
							<tr>
								<th>Marks</th><th>Container No.</th><th>No. & kind of packings</th><th>Description of Goods</th><th>Quantity<?php
								/* foreach($MasterUnits as $MasterUnit)
								{
									$units_options[]=['text'=>$MasterUnit->unit_name,'value'=>$MasterUnit->id];
								} 
								?>
								<?= $this->Form->input('unit_id', ['empty'=> '--Select--','label' => false,'class'=>'form-control ','options'=>$units_options,'style'=>'']) */ ?>
								<label id="certificate-origin-goods-0-unit-id-error" class="error" for="certificate-origin-goods-0-unit-id" style="display: none;"></label></th><th>Value
								<?= $this->Form->input('currency', ['empty'=> '--Select--','label' => false,'class'=>'form-control ','style'=>'','value'=>'INR']) ?></th><th></th>
							</tr>
						</thead>
						<tbody>
							<?php   foreach($certificate_origins as $data){  
									foreach($data['certificate_origin_goods'] as $dataa)  {  ?>	
							<tr>	
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][marks]',['label'=>false,'class'=>'form-control marks','type'=>'text','value'=>$dataa['marks']]);
								?>
								</td>
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][container_no]',['label'=>false,'class'=>'form-control','type'=>'text','value'=>$dataa['container_no']]);
								?>
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][no_and_packing]',['label'=>false,'class'=>'form-control','type'=>'text','value'=>$dataa['no_and_packing']]);
								?>
								</td>
								
								<td>
							   <?php
								 echo $this->Form->input('certificate_origin_goods[0][description_of_goods]',['label'=>false,'class'=>'form-control','type'=>'text','value'=>$dataa['description_of_goods']]);
								?>
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][quantity]',['label'=>false,'class'=>'form-control','type'=>'text','value'=>$dataa['quantity']]);
								?>
								
								</td>
								
								<td>
								<?php
								 echo $this->Form->input('certificate_origin_goods[0][value]',['label'=>false,'class'=>'form-control','type'=>'text','value'=>$dataa['value']]);
								?>
								
								</td>
								
								<td style="width: 10%;">
								
								
								<?php
								echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-info btn-sm add_row','type'=>'button']);
								?>
							   </td>
								
							</tr>
							<?php  }   } ?>
						</tbody>
					</table>
					</div>
				</div>
				
				<div class="col-sm-12 no-print">
					<center>
					<?php
					echo $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'certificate_origin_submit','id'=>'certificate_origin']);
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
					echo $this->Form->input('marks1',['class'=>'form-control marks','type'=>'text','label'=>false]);
				?>	
			   </td>
			   <td>
				<?php
					echo $this->Form->input('container_no1',['class'=>'form-control','type'=>'text','label'=>false]);
				?>
				</td>
				<td>
				 <?php
					echo $this->Form->input('no_and_packing1',['class'=>'form-control','type'=>'text','label'=>false]);
				?>
				</td>
				<td>
			   <?php
				echo $this->Form->input('description_of_goods1',['class'=>'form-control','type'=>'text','label'=>false]);
				?>
				</td>
				<td>
				<?php
				echo $this->Form->input('quantity1',['class'=>'form-control','type'=>'text','label'=>false]);
				?>
				<td>
				<?php
				echo $this->Form->input('value1',['class'=>'form-control','type'=>'text','label'=>false]);
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

$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
		
});

$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
});

$(document).ready(function(){ 
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
			}
			
			
		},
		submitHandler: function () {
				
				$("#certificate_origin").attr('disabled','disabled');
				form.submit();
			}
		
	});
	
	
});
</script>	
	
 
				
				
   
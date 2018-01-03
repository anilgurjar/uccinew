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
			<h3 class="box-title"><strong>INVOICE ATTESTATION</strong></h3>
		</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
		]); 
	?>
	<div class="box-body">
		<?= $this->Form->create($invoiceAttestation,['method'=>'post','class'=>'form-horizontal','id'=>'certificate_form','enctype' => 'multipart/form-data','onsubmit' => 'return file_submit();'])?> 
		<div class="col-sm-12 no-print">
			<div class="col-sm-12">
				<div class="col-sm-6"> 
					<div class="form-group">
						
						<div class="col-sm-8">
							 <?php
							 $options['Invoice Attestation']='Invoice upload';
							 $options['Documents Attestation']='General Documents upload';
							
						   
							echo $this->Form->input('invoice_type', array('type' => 'radio','label' => false,'options' => $options,'value'=>'Invoice Attestation','hiddenField' => false)); 
							 unset($options);
							 ?>
						 <br/>
						
						 </div>
											
					</div>
				</div>
				<div class="col-sm-6"> 
					<div class="form-group">
						<label class="col-sm-4 control-label">Exporter</label>
						<div class="col-sm-8">
							<?php
							 echo $this->Form->input('exporter',['label'=>false,'class'=>'form-control valid','name'=>'exporter','type'=>'text','value'=>$company_organisation,'style'=>'border:none; border-bottom: 1px dotted #ccc; background-color: #FFF;','readonly'=>'readonly']);
							 ?>
						</div>
					</div>
				</div>
			</div>
		
			<div class="col-sm-6 invoice_types">
				
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
			
			<div class="col-sm-6 invoice_types">
				<div class="form-group">
				  <label class="col-sm-4 control-label">Port of Loading</label>
				   <div class="col-sm-8">
				 <?php
				 echo $this->Form->textarea('port_of_loading',['label'=>false,'class'=>'form-control','name'=>'port_of_loading','style'=>'resize:none;','rows'=>'2']);
				 ?>
				 </div>
				 
				</div>
				<div class="form-group">
				  <label class="col-sm-4 control-label">Shipment</label>
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
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<label class="col-sm-3 control-label attachment">Invoice Attachment</label>
					<table id="file_table" style="line-height:2.5">
						<tr>
							<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?><h6>Upload PDF of Invoice in A4 size format<h6></td>
							<!--<td><?php //$this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>-->
							<td></td>
						</tr>
					</table>
				</div>	
			</div>	
			<div class="col-sm-8 ">
				<div class="form-group">
					<label class="col-sm-3 control-label other">Other Information</label>
					<div class="col-sm-6">
					<?php
						 echo $this->Form->textarea('other_info',['label'=>false,'class'=>'form-control','type'=>'text']);
						 ?> 
				   </div>
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
					<center>
						<?php
						echo $this->Form->button(__('Save as Draft') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'invoice_invoice_submit','id'=>'certificate_origin']);
						?>
					</center>
					
				</div>
		  <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>

$(document).on('click','input[name="invoice_type"]',function() {
	var type=$(this).val();
		if(type=="Invoice Attestation"){
			 $(".invoice_types").show(); 
			 $(".attachment").html('Invoice Attachment');
			 $(".other").html('Other Information');
		}else{
			 $(".invoice_types").hide();		
			 $(".attachment").html('Document Attachment');
			 $(".other").html('Mention Documents Name');
		}
});


function file_submit(){
	
	var x =$('.invoice_attachment').val();
	var file_size = $('.invoice_attachment')[0].files[0].size;
	
	if(x){
			var ext = x.substring(x.lastIndexOf('.') + 1);
			if(ext == "pdf" ||  ext == "PDF")
			{
				if(file_size>5242880) {
					alert("File size is greater than 5MB");
					return false;
				}else{
					return true;
				
				}
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
			'file[]': {
				required: true
			},
			port_of_discharge: {
				required: true
			}
		},
		submitHandler: function () {
				
				//$("#certificate_origin").attr('disabled','disabled');
				form.submit();
			}
		
	});
	
	
});
</script>	
	
 
				
				
   

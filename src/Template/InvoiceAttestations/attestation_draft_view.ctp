 <?php
//use Cake\View\Helper\UrlHelper::build();
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

?>
 <style>
input[type="radio"]
{
	margin-right: 8px;
	margin-left: 6px;
	margin-top: 6px;
}
.control-label{
	text-align:left !important;
}
 </style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>REVIEW INVOICE ATTESTATION</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $this->Form->templates([
				'inputContainer' => '{{content}}'
			]); 
	?>
		<div class="box-body">
		 <?= $this->Form->create($invoice_attestation,['method'=>'post','class'=>'form-horizontal','id'=>'certificate_form','enctype' => 'multipart/form-data','onsubmit' => 'return file_submit();'])?> 
					<div class="col-sm-12 no-print">
					
						<div class="col-sm-12">
							<!--<div class="col-sm-6"> 
								<div class="form-group">
									
									<div class="col-sm-8">
										 <?php
										 $options['Invoice Attestation']='Invoice upload';
										 $options['Documents Attestation']='General Documents upload';
										
									   
										//echo $this->Form->input('invoice_type', array('type' => 'radio','label' => false,'options' => $options,'value'=>$invoice_attestation->invoice_type,'hiddenField' => false)); 
										 unset($options);
										 ?>
									 <br/>
									
									 </div>
														
								</div>
							</div>-->
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
						
						<div class="form-group ">
							<label class="col-sm-4 control-label">Consignee</label>
							<div class="col-sm-8">
								<?php  echo $this->Form->input('consignee',['label'=>false,'class'=>'form-control','type'=>'text','name'=>'consignee','style'=>'border:none; border-bottom: 1px dotted #ccc;']); ?>
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
							if($invoice_attestation['despatched_by']==0){$despatch=0;}
							else if ($invoice_attestation['despatched_by']==1){ $despatch=1; }
							else{ $despatch=2; } 
							 
							echo $this->Form->input('despatched_by', array('type' => 'radio','label' => false,'options' => $options,'value'=>$despatch,'hiddenField' => false)); 
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
						
						
						
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-4 control-label attachment">Invoice Attachment</label>
							<table id="file_table" style="line-height:2.5">
								<tr>
									<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?></td>
									<!--<td><?php //$this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>-->
									<td></td>
								</tr>
							</table>
						</div>	
					</div>	
					<div class="col-sm-10 ">
						<div class="form-group">
							<label class="col-sm-3 control-label other">Other Information</label>
							<div class="col-sm-5">
							<?php
								 echo $this->Form->textarea('other_info',['label'=>false,'class'=>'form-control','type'=>'text']);
								 ?> 
						   </div>
						</div>
					</div>
			
					
				</div>
				<div class="col-md-12">
					<?php if(!empty($invoice_attestation['verify_remarks'])){ ?>	
					<div class="col-sm-6 ">
						<div class="form-group">
							<label class="col-sm-4 control-label" style="color:red">Return Reason</label>
							<div class="col-sm-8">
							<?php
								echo $invoice_attestation['verify_remarks'];   
								 ?> 
						   </div>
						</div>
					</div>
					
				<?php } ?>
				</div>
			
			<div class="col-sm-12">
					
					<?php
				//	pr($certificate_origin);
						if($invoice_attestation['invoice_attachment']=='true'){
							
							echo"<div class='col-sm-4'>";
							echo '<iframe src="'.$this->Url->build('/img/coo_invoice_attestation/'.$invoice_attestation['id'].'/'.$invoice_attestation['file_name']).'" title="your_title" align="top" height="300" width="100%" frameborder="0" scrolling="auto" target="Message"></iframe>';
							echo'</div>'; 
						}
					
					
					
					?>
					
					
					
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
						echo $this->Form->button(__('Edit') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-warning','button type'=>'button','id'=>'edit_button']);
					?>
					<?php
						echo $this->Form->button(__('Save as Draft') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-primary','button type'=>'Submit','name'=>'invoice_attestation_draft','id'=>'certificate_origin']);
					?>
					<?php
						echo $this->Form->button(__('Publish') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'invoice_attestation_publish','id'=>'certificate_origin_publish']);
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


if('<?php echo $invoice_attestation->invoice_type; ?>'=="Invoice Attestation"){
	 $(".invoice_types").show(); 
	 $(".attachment").html('Invoice Attachment');
	 $(".other").html('Other Information');
}else{
	 $(".invoice_types").hide();		
	 $(".attachment").html('Document Attachment');
	 $(".other").html('Mention Documents Name');
}




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

$(document).ready(function(){ 

	
	$('input').prop('readonly', true);
	$('textarea').prop('readonly', true);
	
	$('#edit_button').on('click',function(){
		$('input').prop('readonly', false);
		$('textarea').prop('readonly', false);
		
	});
	//--
	
	
	
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
			}
			
		},
		submitHandler: function () {
				
				//$("#certificate_origin").attr('disabled','disabled');
				form.submit();
			}
		
	});
	
	
});
</script>	
	
 
				
				
   
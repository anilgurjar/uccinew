
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<center>
	<?php if($role_id==1 or $role_id==4 ){  ?>
	<div class="box-header with-border no-print ">
		<div class="col-sm-2">
			<?php	 echo $this->Form->input('exporter',['label'=>false,'class'=>'form-control exporter','name'=>'exporter','type'=>'text','placeholder'=>'Exporter Name']);  ?>
		</div>	
		<div class="col-sm-2">
			<?php echo $this->Form->input('origin_no',['label'=>false,'class'=>'form-control origin_no','name'=>'origin_no','type'=>'text','placeholder'=>'Origin No']);  ?>
		</div>	
		<div class=" col-sm-3  ">
			<div class=" input-group input-large  input-daterange date-picker" data-date-format="dd-mm-yyyy">	
				<?php  echo $this->Form->input('from', ['label' => false,'class'=>'form-control from ', 'placeholder'=>'Date From']); ?>
				<span class="input-group-addon" style="background-color:e5e5e5 !important;">
				To </span>
				<?php    echo $this->Form->input('to', ['label' => false,'class'=>'form-control to ','format'=>"yyyy/mm/dd",'placeholder'=>'Date To']); ?>
			</div>	
		</div>
		<div class="col-sm-2">
			<input type="button"  class="go  btn btn-info btn-sm" value="GO">
		</div>
		
	</div>
	
	 <?php   }  ?>
	</center>
	<div class="box-header with-border no-print">
		<center>
		  <h3 class="box-title"><strong>Invoice Attestation List</strong></h3>
		</center>
	</div>
	
	<!-- /.box-header -->
	<!-- form start -->
	<?php  
		echo $this->Html->link('<i class="fa fa-download"></i> Export',
			['controller' => 'InvoiceAttestations', 'action' => 'InvoiceAttestationViewListexcel'],
			['class' => 'btn btn-primary btn-sm btn-flat pull-right','style'=>'margin-right:30px',
				'escape' => false]
		);
		?>
	<div class="box-body">
	 <?= $this->Form->create() ?>
	  <div class="col-sm-12 no-print">
				<div class="table-responsive no-padding">
				<table class="table table-bordered" id="parant_table" style="width:100%;">
					<thead>
						<tr>
							<th>Sr.No.</th><th>Exporter</th><th>Origin No</th><th>Date</th><th>Consignee</th><th>Invoice No.</th><th>Invoice Date</th><th>Manufacturer</th><th>Despatched by</th><th>View</th>
						</tr>
					</thead>
					<tbody class="show_div">
						
									
					<?php $sr=0; foreach ($invoice_attestation as $invoice_attestatio): ?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $invoice_attestatio->exporter ?></td>
						<td><?= $invoice_attestatio->origin_no ?></td>
						<td><?= $invoice_attestatio->date_current ?></td>
						<td><?= $invoice_attestatio->consignee ?></td>
						<td><?= $invoice_attestatio->invoice_no ?></td>
						<td><?= date('d-m-Y', strtotime($invoice_attestatio->invoice_date)) ?></td>
						<td><?= $invoice_attestatio->manufacturer ?></td>
						<td><?php if($invoice_attestatio->despatched_by==0){ echo 'Sea'; }else if($invoice_attestatio->despatched_by==1){ echo 'Air'; }else{ echo 'Road'; } ?></td>
						<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formtarget'=>'_blank','value'=>$invoice_attestatio->id,'type'=>'Submit','name'=>'view']);   ?> </td>
						</tr>

					
					<?php endforeach; ?>
					
				
						
					
				 	
					</tbody>
				</table>
				</div>
			</div>
		 <?php echo $this->Form->end(); ?>
	 
    </div>
  </div>
</div>
<?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>
$(document).ready(function(){ 
//alert();
	
	$('.go').click(function(){
		var exporter = $('.exporter').val();
		var originno = $('.origin_no').val();
		var datefrom = $('.from').val();
		var dateto = $('.to').val();
		
		if(exporter !=''  || originno!='' || datefrom!='' || dateto!=''){
			var url="<?php echo $this->Url->build(['controller'=>'InvoiceAttestations','action'=>'filterdata']);?>";
			url=url+'?exporter='+exporter+'&originno='+originno+'&datefrom='+datefrom+'&dateto='+dateto;
			
			$.ajax({ 
					url:url,
					type:"GET",
				}).done(function(response){
					
					$('.show_div').html(response);
					
				});
				
		}
	
	});	
		
	
	
});
</script>	
	
 
				
				
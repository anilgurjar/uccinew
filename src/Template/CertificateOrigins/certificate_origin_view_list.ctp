
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
		<div class=" col-sm-2  " data-date-format="dd-mm-yyyy">
			<div class=" input-group input-large  input-daterange date-picker">	
				<?php  echo $this->Form->input('from', ['label' => false,'class'=>'form-control from','format'=>"yyyy/mm/dd",'placeholder'=>'Date From']); ?>
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
		  <h3 class="box-title"><strong>CERTIFICATE OF ORIGIN</strong></h3>
		</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	
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
						
									
					<?php $sr=0; foreach ($certificate_origins as $certificate_origin): ?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $certificate_origin->exporter ?></td>
						<td><?= $certificate_origin->origin_no ?></td>
						<td><?= $certificate_origin->date_current ?></td>
						<td><?= $certificate_origin->consignee ?></td>
						<td><?= $certificate_origin->invoice_no ?></td>
						<td><?= date('d-m-Y', strtotime($certificate_origin->invoice_date)) ?></td>
						<td><?= $certificate_origin->manufacturer ?></td>
						<td><?php if($certificate_origin->despatched_by==0){ echo 'Sea'; }else if($certificate_origin->despatched_by==1){ echo 'Air'; }else{ echo 'Road'; } ?></td>
						<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'certificate_origin_performa_view','formtarget'=>'_blank','value'=>$certificate_origin->id,'type'=>'Submit','name'=>'view']);   ?> </td>
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
			var url="<?php echo $this->Url->build(['controller'=>'CertificateOrigins','action'=>'filterdata']);?>";
			url=url+'?exporter='+exporter+'&originno='+originno+'&datefrom='+datefrom+'&dateto='+dateto;
			alert(url);
			$.ajax({ 
					url:url,
					type:"GET",
				}).done(function(response){
					alert(response);
					$('.show_div').html(response);
					
				});
				
		}
	
	});	
		
	
	
});
</script>	
	
 
				
				
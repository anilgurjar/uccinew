
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<center>
	<?php if($role_id==1 or $role_id==4 ){  ?>
	<div class="box-header with-border no-print ">
		<div class="col-sm-2">
			<?php	 echo $this->Form->input('visitor_name',['label'=>false,'class'=>'form-control exporter','name'=>'visitor_name','type'=>'text','placeholder'=>'Visitor Name']);  ?>
		</div>
		<div class="col-sm-2">
			<?php 
				$sendor_type=array('Embassy '=>"Embassy ",'Consulate'=>"Consulate");
				
				echo $this->Form->input('sender_type', ['empty'=>'---Select---','label' => false,'placeholder'=>'Select Sender Type','class'=>'form-control select2me sender_type','options'=>$sendor_type]); ?>
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
	
	 <?php  }  ?>
	</center>
	<div class="box-header with-border no-print">
		<center>
		  <h3 class="box-title"><strong>Business Visa Recommendations</strong></h3>
		</center>
	</div>
	
	<!-- /.box-header -->
	<!-- form start -->
	<?php  
		echo $this->Html->link('<i class="fa fa-download"></i> Export',
			['controller' => 'BusinessVisas', 'action' => 'BussinessVissaViewListexcel'],
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
							<th>Sr.No.</th><th>Company/Organisation</th><th>Origin No</th><th>Company Manufacture</th><th>Visitor Name</th><th>Visit Country</th><th>Visit Month</th><th>Visit Reason</th><th>Passport No</th><th>Issue Date</th><th>Issue Place</th><th>Expiry Date</th><th>View</th>
						</tr>
					</thead>
					<tbody class="show_div">
						
									
					<?php $sr=0; foreach ($bussiness_vissas as $bussiness_vissa): 
					?>
					<tr>
					    <td><?= ++$sr ?></td>
						<td><?= $bussiness_vissa['company']['company_organisation'] ?></td>
						<td><?= $bussiness_vissa['origin_no'] ?></td>
						<td><?= $bussiness_vissa['company_manufacture'] ?></td>
						<td><?= $bussiness_vissa['visitor_name'] ?></td>
						<td><?= $bussiness_vissa['visit_country'] ?></td>
						<td><?= $bussiness_vissa['visit_month'] ?></td>
						<td><?= $bussiness_vissa['visit_reason'] ?></td>
						<td><?= $bussiness_vissa['passport_no'] ?></td>
						<td><?= date('d-m-Y', strtotime($bussiness_vissa['issue_date'])) ?></td>
						<td><?= $bussiness_vissa['issue_place'] ?></td>
						<td><?= date('d-m-Y', strtotime($bussiness_vissa['expiry_date'])) ?></td>
						<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'bussiness_vissa_performa_view','formtarget'=>'_blank','value'=>$bussiness_vissa['id'],'type'=>'Submit','name'=>'view']);   ?> </td>
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
		var sender_type = $('.sender_type').val();
		var originno = $('.origin_no').val();
		var datefrom = $('.from').val();
		var dateto = $('.to').val();
		
		
			var url="<?php echo $this->Url->build(['controller'=>'CertificateOrigins','action'=>'filterdata']);?>";
			url=url+'?exporter='+exporter+'&originno='+originno+'&datefrom='+datefrom+'&dateto='+dateto+'&sender_type='+sender_type;
			
			$.ajax({ 
					url:url,
					type:"GET",
				}).done(function(response){
					
					$('.show_div').html(response);
					
				});
				
		
	
	});	
		
	
	
});
</script>	
	
 
				
				

<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>BUSSINESS VISSA</strong></h3>
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
							<th>Sr.No.</th><th>Company/Organisation</th><th>Origin No</th><th>Company Manufacture</th><th>Visitor Name</th><th>Visit Country</th><th>Visit Month</th><th>Visit Reason</th><th>Passport No</th><th>Issue Date</th><th>Issue Place</th><th>Expiry Date</th><th>View</th>
						</tr>
					</thead>
					<tbody>
						
									
					<?php $sr=0; foreach ($business_vissas as $bussiness_vissa): ?>
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
						<td><?= $this->Form->button(__('View') . $this->Html->tag('i', '', ['class'=>'fa fa-book']),['class'=>'btn btn-info btn-sm','formaction'=>'bussiness_vissa_approve_view','value'=>$bussiness_vissa->id,'type'=>'Submit','name'=>'view']);
					   ?></td>
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
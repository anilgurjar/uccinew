<style>
@media print { 
.print_screen { display: none !important; } 
}
</style>
<div class="col-md-12">
	<!-- Horizontal Form -->
	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="print_screen" style="float:right;"> 
				<div style="float:left;margin-right:6px"><button class="btn btn-block btn-primary " type="button"  style="margin-bottom: 2px;" onclick="window.print();"><b>Print </b></button>  </div>
				<div style="float:right;"> <?php 
					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'IndustrialGrievances', 'action' => 'grievance_pdf',$id),['class' => 'btn btn-block btn-primary hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?> </div>
			</div>
			<h3 class="box-title">Grievance Details </h3>
		</div>
		<table class="vertical-table table">
			<tr>
				<th width="40%"><?= __('Grievance Number') ?></th>
				<td><?php  echo str_pad($industrialGrievance->grievance_number, 4, "0", STR_PAD_LEFT); ?></td>
			</tr>
			<tr>
				<th width="40%"><?= __('Member Name') ?></th>
				<td><?= $industrialGrievance->user->member_name ?></td>
			</tr>
			<tr>
				<th><?= __('Name of Member Organisation ') ?></th>
				<td><?= $industrialGrievance->user->company->company_organisation ?></td>
			</tr>
			<tr>
				<th><?= __('Company Address ') ?></th>
				<td><?= $industrialGrievance->user->company->address.' '.$industrialGrievance->user->company->city.' '.$industrialGrievance->user->company->pincode ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Grievance Area') ?></th>
				<td><?= h($industrialGrievance->location) ?><br/><?= h($industrialGrievance->contact_details) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Department type') ?></th>
				<td>
				<?php
					echo $industrialGrievance->company->company_organisation; 
					?>
				</td>
			</tr>
			<tr>
				<th scope="row"><?= __('Grievance Category') ?></th>
				<td><?= h($industrialGrievance->grievance_category->name) ?><br/><?= h($industrialGrievance->contact_details) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Grievance issues :') ?></th>
				 <td><?= h($industrialGrievance->grievance_issue->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Grievance issues related') ?></th>
				<td><?= h($industrialGrievance->grievance_issue_related->name) ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Description') ?></th>
				<td><?= $this->Text->autoParagraph(h($industrialGrievance->description)); ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('How long you are facing this problem ? ') ?></th>
				<td><?php echo $industrialGrievance->grievance_age.' '. $industrialGrievance->grievance_period; ?></td>
			</tr>
			<tr>
				<th scope="row"><?= __('Have you lodge same grievance earlier with chamber ') ?></th>
				<td><?php echo $industrialGrievance->lodge_same_grievance; ?></td>
			</tr>
			<?php if($industrialGrievance->file=="true"){ ?>
			<tr>
				<th scope="row"><?= __('Attachment') ?></th>
				<td><?php
						foreach($files as $data){
							
							echo $data."<br/>" ;
					}  ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th scope="row"><?= __('Created on') ?></th>
				<td><?= h(date('d-m-Y', strtotime($industrialGrievance->created_on))) ?></td>
			</tr>
		</table>
		<div class="col-sm-12">
			<?php
			if(!empty($industrialGrievance->document)){
					echo"<div class='col-sm-4'>";	
					echo $this->Html->image('/'.$industrialGrievance->document, ['style'=>'width:300px; height:300px;']);
					echo'</div>'; 
				}  ?>
		</div>
		<!--	 <h3 class="box-title"> <center>Grievance Action </center></h3>
		<div class="row" style="margin-right:0px;margin-left:0px;">
		<div class="col-md-12 pad follow_view">
		<?php	 foreach($industrialGrievance->industrial_grievance_follows as $industrial_grievance_follow)
		{ 
			$date=$industrial_grievance_follow->follow_date; ?>
			<div class="col-md-12" style="border:1px solid #a6a5ad;margin: 4px;padding: 4px;">
				<div class="modal-header" style="border-bottom:none;">
									
					<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"><strong> Date <?php echo date("d-m-Y",strtotime($date)); ?> </strong></h4>
				</div>
				<div style="float:left;" class="col-md-6">
				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>Departmant </strong></h4>
				<?= h($industrial_grievance_follow->department_content) ?>
				</div>
				<div style="float:right;" class="col-md-6">
				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>UCCI </strong></h4>
				<?= h($industrial_grievance_follow->ucci_content) ?>
				</div>
			</div>
		<?php } ?>
		</div>
		</div>-->
		<div class="row" style="margin-right:0px;margin-left:0px;">
			<div class="col-md-12 pad follow_view">
				<h3 class="box-title"> <center>Grievance Action </center></h3>	
				<table class="table table-bordered">
					<tr>
						<td>Sr no.</td>
						<td width="85">Date</td>
						<td>Departmant</td>
						<td>UCCI</td>
						<td>Member</td>
					</tr>
					<?php 	$i=0;
					foreach($industrialGrievance->industrial_grievance_follows as $industrial_grievance_follow)
					{ $i++; ?>
						<tr>
							<td><?= h($i) ?></td>
							<td><?= h(date("d-m-Y",strtotime($industrial_grievance_follow->follow_date))) ?></td>
							<td><?= h($industrial_grievance_follow->department_content) ?></td>
							<td><?= h($industrial_grievance_follow->ucci_content) ?></td>
							<td><?= h($industrial_grievance_follow->member_content) ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>	
		</div>
		<div class="row" style="margin-right:0px;margin-left:0px;">
			<div class="col-md-12 pad follow_view">
				<h3 class="box-title"> <center>Grievance History </center></h3>	
				<table class="table table-bordered">
					<tr>
						<td>Sr no.</td>
						<td>Date</td>
						<td>Status</td>
						<td>Description</td>
					</tr>
					<?php 	$i=0;
					foreach($industrialGrievance->industrial_grievance_statuses as $industrial_grievance_status)
					{ $i++; ?>
					<tr>
						<td><?= h($i) ?></td>
						<td><?= h(date("d-m-Y",strtotime($industrial_grievance_status->action_date))) ?></td>
						<td><?= h($industrial_grievance_status->status) ?></td>
						<td><?php if($industrial_grievance_status->status=='hold'){
								echo $industrial_grievance_status->comment; 
							}else{
								echo $industrial_grievance_status->reopen_reason; 
							}	?>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>	
		</div>	
	</div>
</div>

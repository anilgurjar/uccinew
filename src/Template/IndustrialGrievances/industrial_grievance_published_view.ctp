<?php
//use Cake\View\Helper\UrlHelper::build();
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

?>
<style>
@media print { 
.print_screen { display: none !important; } 
}
</style>
<div class="col-md-12">
	<!-- Horizontal Form -->
	<div class="box box-primary">
		<div class="box-body">
			<?= $this->Form->create($industrialGrievance) ?>
			<div class="box-header with-border">
				<!--<div class="print_screen" style="float:right;"> 
					<div style="float:left;margin-right:6px"><button class="btn btn-block btn-primary " type="button"  style="margin-bottom: 2px;" onclick="window.print();"><b>Print </b></button>  </div>
					<div style="float:right;"> <?php 
							//echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'IndustrialGrievances', 'action' => 'grievance_pdf',$id),['class' => 'btn btn-block btn-primary hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?> </div>
				</div>-->
			  <h3 class="box-title">Grievance Details </h3>
			</div>
			<table class="vertical-table table">
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
							}
						?></td>
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
					}
				?>
			</div>
			<div class="col-sm-12 no-print">
				<center>
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Accept') ,['class'=>'btn btn-success','type'=>'button','data-toggle'=>'modal','data-target'=>'#verify','value'=>$industrialGrievance->id]);
					?>
					<?php
					echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Accept') ,['class'=>'btn btn-danger','type'=>'button','data-toggle'=>'modal','data-target'=>'#notverify','value'=>$industrialGrievance->id]);
					?>
				</center>
				<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left !important">Do you want to accept this Industrial Grievance</h4>
							</div>
							<div class="modal-footer">
							<div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
								echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Accept') ,['class'=>'btn btn-success','type'=>'Submit','name'=>'grievance_accept_submit','value'=>$industrialGrievance->id]);		?>	 
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="notverify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel" style="text-align:left">Do you want to not accept this Industrial Grievance</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12 pad" >
										<div class="col-md-12">
											<div class="form-group">
												<label class=" control-label" style="text-align:left !important">Remarks</label>
													<?php echo $this->Form->textarea('ucci_content', ['label' => false,'placeholder'=>'Remarks','class'=>'form-control ', 'name'=>'verify_remarks']); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
							<div class="related_issue"></div>
								<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
								<?php
								echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-check-circle-o']) . __(' Not Accept') ,['class'=>'btn btn-danger','type'=>'Submit','name'=>'grievance_notaccept_submit','value'=>$industrialGrievance->id]);
								?>	 
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php   echo $this->Form->end();   ?>
		</div>	
	</div>
</div>
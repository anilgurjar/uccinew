<div class="col-md-12">
	<div class="pull-right ">
	<?php echo $this->Form->input('search', ['label' => false,'placeholder'=>'Search','class'=>'form-control search']); ?>
	</div> 
</div>
			<?php if (!empty($IndustrialGrievances)): ?>
		
			<table cellpadding="0" cellspacing="0" class="table table-bordered" id="table">
				<thead>
					<tr style="background-color:#3C8DBC; color:#fff">
						<th scope="col"><?= __('Sr no.') ?></th>
						<th scope="col"><?= __('Departmant') ?></th> 
						<th scope="col"><?= __('Grievance Description') ?></th>
						<th scope="col"><?= __('Complaint') ?></th>
						<!--<th scope="col"><?= __('Action Taken By Department') ?></th>-->
						<th scope="col"><?= __('Action Taken By UCCI') ?></th>
						<th scope="col"><?= __('Created on') ?></th>
						<th scope="col"><?= __('Pending on') ?></th>
						
						<th scope="col" width="80"><?= __('Action') ?></th>
					</tr>
				</thead>
				<tbody>
				<?php $i=0;  foreach ($IndustrialGrievances as $industrial_grievance): $i++; $complete_status=$industrial_grievance->complete_status; $class='';  ?>
				
						<tr <?php if($complete_status=="hold"){ $class="font_color"; ?> style="background-color:rgba(255, 0, 0, 0.7);" <?php } ?>>
						
							<td class="<?php echo $class; ?> font_cl"><?= h($i) ?></td>
							<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->company->company_organisation) ?></td>
						<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->description) ?></td>
						<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->user->company_organisation) ?></td> 
						<?php  if (!empty($industrial_grievance->industrial_grievance_follows)){  ?>
						<?php
						foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
						{ ?>
						<!--<td class="<?php echo $class; ?> font_cl department"><?= h($industrial_grievance_follow->department_content) ?></td>-->
						<td class="<?php echo $class; ?> font_cl ucci"><?= h($industrial_grievance_follow->ucci_content) ?></td>
						
						<?php
						goto a;
						}
						a:
						}
						else{ 
							echo '<td class="ucci"></td>';
						}
						?>
						<td class="<?php echo $class; ?> font_cl"><?= h(date('d-m-Y', strtotime($industrial_grievance->created_on))) ?></td>
						<td class="<?php echo $class; ?> font_cl"><?php echo $industrial_grievance->grievance_age .' '. $industrial_grievance->grievance_period?></td>
						<td class="actions">
											
							<?php
							echo $this->Html->link(' <i class="fa fa-list"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#allfollow'.$industrial_grievance->id,'class' => 'orange',
							'escape' => false]);
							
								echo $this->Html->link(' <i class="fa fa-wheelchair"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#follw'.$industrial_grievance->id,
							'in_d'=>$industrial_grievance->id,'class'=>'en_hn','escape' => false]);
							
							
								//echo $this->Html->link(' <i class="fa fa-pencil"></i>', ['action' => 'edit', $industrial_grievance->id],['escape' => false]);
							
							echo $this->Html->link(' <i class="fa fa-book"></i>', ['action' => 'view', $industrial_grievance->id],['escape' => false]) ;
							if($complete_status!="hold"){
							echo $this->Html->link(' <i class="fa fa-exclamation"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#cancel'.$industrial_grievance->id,'class' => 'orange hold',
							'escape' => false]);
							
							}
							if($complete_status=="hold"){
							echo $this->Html->link(' <i class="fa fa-folder-open-o"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#reopen'.$industrial_grievance->id,'class' => 'orange re_open',
							'escape' => false]);
							}
							?>
							<div class="modal fade" id="allfollow<?php echo $industrial_grievance->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Industrial Grievance Follow</h4>
									  </div>
									  <div class="modal-body" style="overflow-y: auto;height: 400px;">
										<div class="row">
		
												<div class="col-md-12 pad follow_view">
													<?php 	foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
															{  $date=$industrial_grievance_follow->follow_date; ?>
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
														
											</div>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
											
									  </div>
									</div>
								  </div>
								</div>
								<?php  echo $this->Form->create($industrialGrievance, ['type' => 'post','id'=>'validationForm'.$industrial_grievance->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="follw<?php echo $industrial_grievance->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Industrial Grievance Follow</h4>
									  </div>
									  <div class="modal-body">
										<div class="row">
		
											<div class="col-md-12 pad" >
													<div class="col-md-12" >
													<div id='translControl<?php echo $industrial_grievance->id; ?>' class='transl'></div>
														<div class="form-group">
															<label class=" control-label"> Department </label>
	<input type="hidden" name="industrial_grievance_id" value="<?php echo $industrial_grievance->id ; ?>">
															<?php echo $this->Form->input('department_content', ['label' => false,'placeholder'=>'Department','class'=>'form-control dep transl2']); ?>
															
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class=" control-label"> UCCI </label>
															
																<?php echo $this->Form->input('ucci_content', ['label' => false,'placeholder'=>'UCCI','class'=>'form-control transl2']); ?>
															
														</div>
													</div>
												</div>
		
											</div>
									  </div>
									  <div class="modal-footer">
									   <div class="related_issue"></div>
										<button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
											<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).__(' Submit') ,['class'=>'btn btn-success submit','type'=>'Submit','g_id'=>$industrial_grievance->id]);
											?>
									  </div>
									</div>
								  </div>
								</div>
							 <?= $this->Form->end() ?>	


<?php  echo $this->Form->create($industrialGrievance, ['type' => 'post','id'=>'validationForm1'.$industrial_grievance->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="cancel<?php echo $industrial_grievance->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Are you sure you want to close this grievance ?</h4>
									  </div>
									  <div class="modal-body">
										<div class="row">
		
											<div class="col-md-12 pad" >
													<div class="col-md-12" >
														<div class="form-group">
															<label class=" control-label"> Comment </label>
													<input type="hidden" name="industrial_grievance_id" value="<?php echo $industrial_grievance->id ; ?>">
															<?php echo $this->Form->textarea('comment', ['label' => false,'placeholder'=>'Comment','class'=>'form-control dep']); ?>
															
															
														</div>
													</div>
													
												</div>
		
											</div>
									  </div>
									  <div class="modal-footer">
										<div class="related_issue1"> </div>
											<?= $this->Form->button(__('Yes') . $this->Html->tag('i', ''),['class'=>'btn btn-success cancel','type'=>'submit','g_id'=>$industrial_grievance->id]);
											?>
											<button type="button" class="btn btn-default cls" data-dismiss="modal">No</button>
											
									  </div>
									</div>
								  </div>
								</div>
							 <?= $this->Form->end() ?>	

<?php  echo $this->Form->create($industrialGrievance, ['type' => 'post','id'=>'validationForm2'.$industrial_grievance->id,'enctype' => 'multipart/form-data']); ?>					
								<div class="modal fade" id="reopen<?php echo $industrial_grievance->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to reopen this grievance ?</h4>
									  </div>
									  <div class="modal-body">
										<div class="row">
		
											<div class="col-md-12 pad" >
													<div class="col-md-12" >
														<div class="form-group">
															<label class=" control-label" style="color:black;"> Reason  </label>
													<input type="hidden" name="industrial_grievance_id" value="<?php echo $industrial_grievance->id ; ?>">
															<?php echo $this->Form->textarea('reopen_reason', ['label' => false,'placeholder'=>'Reason','class'=>'form-control dep']); ?>
															
															
														</div>
													</div>
													
												</div>
		
											</div>
									  </div>
									  <div class="modal-footer">
										<div class="related_issue2"> </div>
											<?= $this->Form->button(__('Yes') . $this->Html->tag('i', ''),['class'=>'btn btn-success reopen','type'=>'submit','g_id'=>$industrial_grievance->id]);
											?>
											<button type="button" class="btn btn-default cls" data-dismiss="modal">No</button>
											
									  </div>
									</div>
								  </div>
								</div>
							 <?= $this->Form->end() ?>	

							 
							</td>
						</tr>
						
						
					<?php
						 endforeach; ?>
				</tbody>
			</table>
			<?php endif; ?>
			
<script>
			
var $rows = $('#table tbody tr'); 
$('input[name="search"]').keyup(function() { 

	var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
	$rows.show().filter(function() {
		var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
		return !~text.indexOf(val);
				
	}).hide();

});
	
</script>
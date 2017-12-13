<style>
@media print { 
.print_screen { display: none !important; } 
}
</style>
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="print_screen" style="float:right;"> 
				<div style="float:left;margin-right:6px"><button class="btn btn-block btn-primary " type="button"  style="margin-bottom: 2px;" onclick="window.print();"><b>Print </b></button>  </div>
				
			</div>
			<h3 class="box-title">Grievance Report</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
				<?php  if($role_id==1 || $role_id==4)  {  ?>
				<div class="print_screen">
					<div class="col-md-2 pad">
						<?php
						echo $this->Form->input('industrial_department_id', ['empty'=> '--Select Departmant--','label' => false,'class'=>'form-control select2','name'=>'department','options'=>$IndustrialDepartments,'style'=>'width:100%;']); ?>
					</div>
					<div class="col-md-2 pad">
						<?php
						echo $this->Form->input('from', ['placeholder'=>'From','label' => false,'class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','name'=>'from','style'=>'width:100%;']); ?>
					</div>
					<div class="col-md-2 pad">
						<?php
						echo $this->Form->input('to', ['placeholder'=>'To','label' => false,'class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','name'=>'to','style'=>'width:100%;']); ?>
					</div>
					<div class="col-md-2 pad">
						<?php
						echo $this->Form->input('title', ['placeholder'=>'Title','label' => false,'class'=>'form-control title','type'=>'text','name'=>'title','style'=>'width:100%;']); ?>
					</div>
					<div class="col-md-2 pad">
						<?php
							$options=array();
								$options['Close'] = 'Close';
								$options['running'] = 'running';
							
							echo $this->Form->input('category_type',['empty'=>'----select----','label' =>false,'options'=>$options,'class'=>'form-control select2me']); ?>
					</div>
					<div class="col-md-1 pad">
						<?= $this->Form->button(__('Go') ,['class'=>'btn btn-primary btn-sm go','type'=>'button','name'=>'go','style'=>'margin-bottom: 2px;']) ?>
					</div>
				</div>
				<?php    }  ?>
				<div id="loading" class="col-md-12"></div>
				<div class="col-md-12" id="report">
					<div class="related">
						<?php  if (!empty($IndustrialGrievances)):  ?>
						<table cellpadding="0" cellspacing="0" class="table table-bordered" >
							<thead>
								<tr style="background-color:#3C8DBC; color:#fff">
									<th scope="col"><?= __('Sr no.') ?></th>
									<th scope="col"><?= __('Departmant') ?></th> 
									<th scope="col"><?= __('Created on') ?></th>
									<th scope="col"><?= __('Title') ?></th>
									<th scope="col"><?= __('Grievance Description') ?></th>
									<th scope="col"><?= __('Complaint') ?></th>
									<th scope="col"><?= __('Action Taken By UCCI') ?></th>
									<th scope="col"><?= __('Pending on') ?></th>
									<th scope="col" width="80" class="print_screen"><?= __('Action') ?></th>
									
								</tr>
							</thead>
							<tbody>
							<?php $i=0;  foreach ($IndustrialGrievances as $departments):  ?>
							
								<?php
								$k=1; 
								foreach($departments->industrial_grievances as $industrial_grievance)
								{ $class="";
									$complete_status=$industrial_grievance->complete_status;
									?>
									<tr <?php if($complete_status=="hold"){ $class="font_color"; ?> style="background-color:rgba(255, 0, 0, 0.7); " <?php } ?>>
									<?php
									if($k==1)
									{  $i++; 
										?>
										<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>" class="<?php echo $class; ?> font_cl"><?= h($i) ?></td>
										
									
										<td rowspan="<?php echo sizeof($departments->industrial_grievances); ?>" class="<?php echo $class; ?> font_cl"><?= h($departments->company_organisation) ?></td>
										<?php
									}
									?>
									<td class="<?php echo $class; ?> font_cl"><?= h(date('d-m-Y', strtotime($industrial_grievance->created_on))) ?></td>
									<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->title) ?></td>
									<td class="<?php echo $class; ?> font_cl"><?= $this->Text->autoParagraph($industrial_grievance->description) ?></td>
									<td class="<?php echo $class; ?> font_cl"><?= h($industrial_grievance->user->company->company_organisation) ?></td> 
									
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
									<td class="<?php echo $class; ?> font_cl"><?php echo $industrial_grievance->grievance_age .' '. $industrial_grievance->grievance_period?></td>
									
										<td class="actions  print_screen">
														
											<?php
											echo $this->Html->link(' <i class="fa fa-list"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#allfollow'.$industrial_grievance->id,'class' => 'orange',
											'escape' => false]);
										
											echo $this->Html->link(' <i class="fa fa-wheelchair"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#follw'.$industrial_grievance->id,'class' => 'orange en_hn','in_d'=>$industrial_grievance->id,
											'escape' => false]);
										
										
										
											//echo $this->Html->link(' <i class="fa fa-pencil"></i>', ['action' => 'edit', $industrial_grievance->id],['escape' => false]);	
											 echo $this->Html->link(' <i class="fa fa-book"></i>', ['action' => 'view', $industrial_grievance->id],['escape' => false]) ;
											if($role_id==4 || $role_id==1){ 
											if($complete_status!="hold"){
												echo $this->Html->link(' <i class="fa fa-exclamation"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#cancel'.$industrial_grievance->id,'class' => 'orange hold',
												'escape' => false]);
											}
											
											if($complete_status=="hold"){
												echo $this->Html->link(' <i class="fa fa-folder-open-o"></i> ',['action'=>'#'],['data-toggle'=>'modal','data-target'=>'#reopen'.$industrial_grievance->id,'class' => 'orange re_open',
												'escape' => false]);
											}
											 }
											?>
											<div class="modal fade" id="allfollow<?php echo $industrial_grievance->id ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Industrial Grievance Follow </h4>
														</div>
														<div class="modal-body" style="overflow-y: auto;height: 400px;">
															<div class="row">
																<div class="col-md-12 pad follow_view">
																	<?php	foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
																		{ $date=$industrial_grievance_follow->follow_date; ?>
																		<div class="col-md-12" style="border:1px solid #a6a5ad;margin: 4px;padding: 4px;">
																			<div class="modal-header" style="border-bottom:none;">
																								
																				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"><strong> Date <?php echo date("d-m-Y",strtotime($date)); ?> </strong></h4>
																			</div>
																			<div style="float:left;" class="col-md-4">
																				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>Departmant </strong></h4>
																				<?= h($industrial_grievance_follow->department_content) ?>
																			</div>
																			<div style="float:center;" class="col-md-4">
																				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>UCCI </strong></h4>
																				<?= h($industrial_grievance_follow->ucci_content) ?>
																			</div>
																			<div style="float:right;" class="col-md-4">
																				<h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>Member </strong></h4>
																				<?= h($industrial_grievance_follow->member_content) ?>
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
														<div id='translControl<?php echo $industrial_grievance->id; ?>' class='transl'></div>
																<?php if($role_id==5 || $role_id==1){   ?>
																<div class="col-md-12" >
																	
																	<div class="form-group">
																		<label class=" control-label"> Department </label>
																		
																		<?php echo $this->Form->input('department_content', ['label' => false,'placeholder'=>'Department','class'=>'form-control dep transl2']); ?>
																	</div>
																</div>
																<?php  }   if($role_id==4 || $role_id==1){  ?>
																<div class="col-md-12">
																	<div class="form-group">
																		<label class=" control-label"> UCCI </label>
																		<?php echo $this->Form->input('ucci_content', ['label' => false,'placeholder'=>'UCCI','class'=>'form-control transl2']); ?>
																	</div>
																</div>
																<?php  }   if($role_id==2 || $role_id==1){  ?>
																<div class="col-md-12">
																	<div class="form-group">
																		<label class=" control-label"> Member </label>
																		<?php echo $this->Form->input('member_content', ['label' => false,'placeholder'=>'Member','class'=>'form-control transl2']); ?>
																	</div>
																</div>
																<?php  }    ?>
															</div>
															<input type="hidden" name="industrial_grievance_id" value="<?php echo $industrial_grievance->id ; ?>">
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
															<h4 class="modal-title" id="myModalLabel" style="color:black;">Are you sure you want to close this grievance ?</h4>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-md-12 pad" >
																	<div class="col-md-12" >
																		<div class="form-group">
																			<label class=" control-label" style="color:black;"> Comment </label>
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
									$k++;
								}
								?>
							<?php endforeach; ?>
							</tbody>
						</table>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!---<div class="col-md-12 pad" >
	<div class="col-md-12" >
		<table cellpadding="0" cellspacing="0" class="table table-bordered follow_view">
			<thead>
				<tr style="background-color:#3C8DBC; color:#fff">
					<th scope="col"><?= __('Action Taken By Department') ?></th>
					<th scope="col"><?= __('Action Taken By UCCI') ?></th>
					<th scope="col"><?= __('Action Taken By Member') ?></th>
				</tr> 
			</thead> 
			<tbody>
				<?php
				foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow)
				{ ?>
				<tr>
					<td><?= h($industrial_grievance_follow->department_content) ?></td>
					<td><?= h($industrial_grievance_follow->ucci_content) ?></td>
					<td><?= h($industrial_grievance_follow->member_content) ?></td>
				</tr>
				<?php  }  ?>
			</tbody>
		</table>
	</div>

</div>--->

<div id="hello"> </div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jsapi.js'); ?>
<script>

$(document).on('click', '.transl', function(e){ 
		var c = $(this).find('.inputapi-transliterate-button').attr('aria-pressed');
		
		if(c=="true"){
			$('.inputapi-transliterate-img').html('English');
		}else{
			$('.inputapi-transliterate-img').html('Hindi');
		}
	});
	
	$(document).on('click', '.en_hn', function(e){
		$('.transl').html('');
		var x=$(this).attr('in_d');
		onLoad(x);
	});
	

	   // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

     function onLoad(t) {
		
        var options = {
          sourceLanguage: 'en', // or google.elements.transliteration.LanguageCode.ENGLISH,
          destinationLanguage: ['hi'], // or [google.elements.transliteration.LanguageCode.HINDI],
          shortcutKey: 'ctrl+g',
          transliterationEnabled: true
        };
        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textfields with the given ids.
      //  var ids = [ "transl1", "transl2" ];
      //  control.makeTransliteratable(ids);
	  
			var elements1 =  $("#follw"+t).find('.transl2');
			//var elements = document.getElementsByClassName('transl2');
			control.makeTransliteratable(elements1);
			
        // Show the transliteration control which can be used to toggle between
        // English and Hindi.
        control.showControl('translControl'+t+'');
		$('.inputapi-transliterate-img').html('English');
		$('.inputapi-transliterate-button-inner-box').addClass('btn btn-success');
      }
     

$(document).ready(function() { 



	$('.go').on( 'click',function() { 	

	$("#loading").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		 var from=$('input[name="from"]').val();
		var to=$('input[name="to"]').val();
		var id=$('select[name="department"]').val();
		var title=$('input[name="title"]').val();
		var category_type=$('select[name="category_type"]').val();
		
		if(from==""){
			from=0;
			
		}
		if(to==""){
			to=0;
		}
		if(id==""){
			
			id=0;
		}
		if(title==""){
			
			title='';
		}
		if(category_type==""){
			
			category_type=0;
		}
		
		
		var url="<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'industrial_grievance_ajax']); ?>";
		url=url+'/'+id+'/'+from+'/'+to+'/'+category_type+'/'+title;
		$.ajax({
			url:url,
			success:function(data) {
				$("#loading").html('');
				$('#report').html(data); 
				
	  
			}
		});
		 
		
	});
	
	
});
   

$(document).on('click', '.submit', function(e)
	{
		e.preventDefault();
		var grievance_id=$(this).attr('g_id');
		$(".related_issue").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var department=$(this).closest('tr').find('textarea[name=department_content]').val();
		var ucci=$(this).closest('tr').find('textarea[name=ucci_content]').val();
		var member=$(this).closest('tr').find('textarea[name=member_content]').val();
		
		if(!ucci){
			ucci='';	
		}
		if(!department){
			department='';	
		} 
		if(!member){
			member='';	
		}
		
		$(this).closest('tr').find('.department').html(department);
		$(this).closest('tr').find('.ucci').html(ucci);
		$(this).closest('tr').find('.member').html(member);
		$(this).closest('tr').find('.follow_view').prepend('<div class="col-md-12" style="border:1px solid #a6a5ad;margin: 4px;padding: 4px;"><div class="modal-header" style="border-bottom:none;"><h4 class="modal-title" id="myModalLabel" style="color:#0c2992"><strong>Date <?php echo date("d-m-Y"); ?> </strong></h4></div><div style="float:left;" class="col-md-4"><h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>Departmant </strong></h4>'+department+'</div><div class="col-md-4"><h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>UCCI </strong></h4>'+ucci+'</div><div style="float:right;" class="col-md-4"><h4 class="modal-title" id="myModalLabel" style="color:#0c2992"> <strong>Member </strong></h4>'+member+'</div></div>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'grievance_follow']); ?>",
			data: $("#validationForm"+grievance_id).serialize(), 
			
			success: function(data){
				
				$("#hello").html(data);
				$(".cls").click();
				$("#validationForm"+grievance_id).trigger("reset");
				$(".related_issue").html(''); 
				}  
		}); 
	});
	
	
	$(document).on('click', '.cancel', function(e)
	{
		e.preventDefault();
		var grievance_id=$(this).attr('g_id');
		var cl=$(this).closest('tr');
		$(".related_issue1").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		$(this).closest('tr').find('.font_cl').css({"color":"white"});
		$.ajax({
		   type: "POST",
		   url: "<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'grievance_cancel']); ?>",
		   data: $("#validationForm1"+grievance_id).serialize(), 
		   success: function(data){
			   
			  cl.find('.hold').remove();
			  $(".cls").click();
			  $("#validationForm1"+grievance_id).trigger("reset");
			  cl.css({"background-color":"rgba(255, 0, 0, 0.7)"});
			  $(".related_issue1").html('');
		   }  
		}); 
	});
	
	
	$(document).on('click', '.reopen', function(e)
	{
		e.preventDefault();
		var grievance_id=$(this).attr('g_id');
		var cl=$(this).closest('tr');
		$(".related_issue2").html('<div align="center"><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		$(this).closest('tr').find('.font_cl').css({"color":"black"});
		$.ajax({
		   type: "POST",
		   url: "<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'grievance_reopen']); ?>",
		   data: $("#validationForm2"+grievance_id).serialize(), 
		   success: function(data){
				cl.find('.re_open').remove();
				$(".cls").click();
				$("#validationForm1"+grievance_id).trigger("reset");
				cl.css({"background-color":""});
				$(".related_issue2").html('');
			}  
		});
	});

	

</script>
<style>
.font_color{
	color:white;
}
</style>

<style>
  .inputapi-transliterate-img {
    background-image: url('') !important;
    background-repeat: no-repeat;
	width:50px !important;
	
}

.inputapi-transliterate-button-inner-box{
	width:60px !important;
	height:25px !important;
}
</style>
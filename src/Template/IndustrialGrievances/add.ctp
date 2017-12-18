<style>
legend {
    display: block;
    padding: 0;
    margin-bottom: 0px !important;
    font-size: 17px;
    line-height: inherit;
    color: #333;
    border: 0;
    border-bottom: 0px  !important;
}
fieldset{
	border: 1px solid silver !important;
	padding: .35em .625em .75em !important;
}
</style>
<div class="col-md-12">
	<?php echo $this->Form->create($industrialGrievance, ['type' => 'post','id'=>'validationForm','enctype' => 'multipart/form-data']); ?>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Industrial Grievance</h3>
		</div>
		<div class="box-body" style="display: block;">
			<div class="row">
						
				
				<div class="col-md-12 ">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Department Type :</label>
							<?php
							
							echo $this->Form->input('industrial_department_id', ['empty'=> '--Select--','data-placeholder'=>'Select Department','label' => false,'class'=>'form-control select2','options'=>$IndustrialDepartments,'style'=>'width:100%;']); ?>
							</div>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Grievance Category :</label>
							<?php
							
							echo $this->Form->input('grievance_category_id', ['data-placeholder'=>'Select Category','label' => false,'class'=>'form-control select2','options'=>$grievancecategorys,'style'=>'width:100%;']); ?>
							<label id="grievance-category-id-error" class="error" for="grievance-category-id"></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class=" control-label">Location</label>
							
								<?php echo $this->Form->input('location', ['label' => false,'placeholder'=>'Location','class'=>'form-control','rows'=>'3']); ?>
							
						</div>
					</div>	
					
					
				</div>
				<div class="col-md-12 ">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">How long you are facing this problem ? </label>
										
							<?php
								$options=array();
								
								$options['Week'] = 'Last Week';
								$options['OneWeek'] = 'Greater One  Week';
								$options['ThreeWeek'] = 'Greater Three Week';
								$options['FiveWeek'] = 'Greater Five Week';
								$options['MoreWeek'] = 'More Then Eight Week';
								
								echo $this->Form->input('grievance_period', ['empty'=> '--Select--','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
							
						</div>
					</div>
					<!--<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Grievance Age:</label>
							<?php //echo $this->Form->input('grievance_age', ['label' => false,'placeholder'=>'Grievance Age','class'=>'form-control ','type'=>'text']); ?>
						</div>
					</div>-->
					
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label">Have you lodged same grievance earlier with chamber</label><br/>
						
						<?php
						$options=array();
							$options['Yes'] = 'Yes';
							$options['No'] = 'No';
						
						echo $this->Form->input('lodge_same_grievance', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false)); ?>
							
						</div>
					</div>
					<div id="title_check" >
					</div>
					
						
				</div>
				
				
				<div class="col-md-12 pad" >
					<?php if($role_id==4 || $role_id==1){ ?>	
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Company/Organisation :</label>
							<?php
							
							echo $this->Form->input('company_id', ['empty'=> '--Select--','data-placeholder'=>'Select Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$companys,'style'=>'width:100%;']); ?>
							</div>
					</div>
					<?php } ?>	
						<div class="col-md-4">
								<div class="form-group">
									<label class=" control-label">Grievance Issue/Problem</label>
									
										<?php
										
										
										echo $this->Form->input('grievance_issue_id', ['empty'=> '--Select--','data-placeholder'=>'Select Grievance Issue','label' => false,'class'=>'form-control issue select2 issue','options'=>$GrievanceIssues,'style'=>'width:100%;']); ?>
									<label id="grievance-issue-id-error" class="error" for="grievance-issue-id"></label>
								</div>
						</div>
						
						<div id="related_issue" >
						
						</div>
						
					
										
				</div>
				<div class="col-md-12 pad" >
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Title Of Grievance :</label>
							<?php
							echo $this->Form->input('title', ['placeholder'=>'Title Of Grievance maximum length 30','label' => false,'class'=>'form-control ','type'=>'text','style'=>'width:100%;','maxlength'=>30]); ?>
							</div>
					</div>	
				</div>	
				<div class="col-md-12 pad" >
					<div class="col-md-12" >
						<div id='translControl'></div>
						<input type='hidden' id="transl1"/>
						<div class="form-group">
							<label class=" control-label">Grievance Description:</label>
							
							<?php 
							
							echo $this->Form->input('description', ['label' => false,'placeholder'=>'Grievance Description','class'=>'form-control','id'=>'transl2']); ?>
							
						</div>
						<div class=""> <strong> <span> <i class="fa fa-warning text-yellow"></i> Note: </span> Please insert space key after formation of every new word in order to convert the Language mode from English to Hindi </strong> </div>
					</div>
					
				</div>
				<div class="col-md-12 ">
					<table id="file_table" style="line-height:2.5">
						<tr>
						<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
						<td></td>
						<td></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="box-footer">
				<center>
				
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']). __(' Submit') ,['class'=>'btn btn-success','type'=>'Submit']);
					   ?>
				</center>
			</div>
	</div>
    <?= $this->Form->end() ?>
</div>
<table id="copy_row" style="display:none;">	
<tbody>
<tr>
	<td><?= $this->Form->file('file[]',['multiple'=>'multiple']); ?></td>
	<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
	</td>
	<td>
	<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
	</tr>
	</tbody>
</table>

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

	<!-- Trigger the modal with a button -->
<button type="button" id="model" style="display:none" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="">Grievance Submission & Tracking System</h4>
	</div>
      <div class="modal-body">
       
        <h4 style="color:blue;">Terms & Conditions</h4>
		<h5 style=""><b>1.</b> UCCI is an apex body of trade and industry in South Rajasthan. Representations submitted by it's member organizations to UCCI are forwarded to relevant departments as a part fulfillment of its duty towards the trade and industry community as a whole.
		<br/><br/>
		<b>2.</b> UCCI is purely acting as a third party in the matters and holds no personal interest in the resolution of the grievances. 
		<br/><br/>
		<b>3.</b> This Grievance Submission and Tracking System is a part of the Grievance Redressal Camps that are organized by UCCI every month to facilitate resolution of issues of the industry through direct interaction with various Government Departments.
		<br/><br/>
		<b>4.</b> UCCI will try to actively followup on the grievances, however, it shall be the responsibility of the affected member organization(s) to track and update their matters from time to time.
		<br/><br/>
		<b>5.</b> In no way, UCCI shall stand liable for any loss of business/property/person arising due any proceedings of the Grievance Redressal Camps or any of the causes resulting from the resolution or non-resolution of grievances submitted on this system.
		<br/><br/>
		<b>6.</b> Representatives from Government Departments are expected to honour the timelines for resolving the grievances. However, it will be up to them to apprise the affected party of the status of the grievance.
		<br/><br/>
		<b>7.</b> UCCI may filter/refine/edit the grievances submitted to the system before forwarding them to the concerned department.
		<br/><br/>
		<b>8.</b> UCCI does not endorse the remarks, comments, suppositions and suggestions expressed in the grievance descriptions or the resolution status submitted either by any of its member organizations or Government representatives through this system.
		<br/><br/>
		<b>9.</b> The code of conduct for using this system will include (but not be limited to) basic decency, use of parliamentary language and spam-free behavior. Any submission or communication involving profane, discriminatory, racial, political or otherwise considered irrelevant and unofficial language will be deemed unfit for processing and UCCI is free to remove such communication from the system. 
		<br/><br/>
		<b>10.</b> UCCI does not legally represent the issues put up by the members, nor does it claim to solicit on their behalf. In any matter of dispute/conflict UCCI President's decision shall be final.
		</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
									

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<?php echo $this->Html->script('/assets/plugins/jquery/jsapi.js'); ?>

<script>

$(document).ready(function() { 
		
	$('#model').click();	
	
	$("input[type='radio']").click(function(){
		myfunc();
    });
 
 
	function myfunc()
	{   
		var radioValue = $("input[name='lodge_same_grievance']:checked").val();
		if(radioValue == 'Yes'){
			$("#title_check").html('<div align=""><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
			var url="<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'titlecheck']); ?>";
			$.ajax({
				url: url,
				success: function(data){
					$("#title_check").html(data);
				}  
			});
		}
		else{
			$("#title_check").hide();
		}
	}

	
	
	
	
	
	
	$("#validationForm").validate({ 
		rules: {
			industrial_department_id: {
				required: true
			},
			grievance_category_id: {
				required: true
			},
			grievance_issue_id: {
				required: true
			},
			grievance_issue_related_id: {
				required: true
			},
		},
		
		submitHandler: function () {
				
				//$("#submit_member").attr('disabled','disabled');
				
				 form.submit();
			}
	});

});
</script>



<script>

$(document).ready(function() { 

 
 $(document).on('change','.issue',function() {
		var id=$(this).val();
		$("#related_issue").html('<div align=""><?php echo $this->Html->Image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var url="<?php echo $this->Url->build(['controller'=>'IndustrialGrievances','action'=>'grievance_related_issuse']); ?>/"+id;
		 $.ajax({
			type: "POST",
			url: url,
			success: function(data){
				$("#related_issue").html(data);
				$('#related_issue').find('select').select2();
			}  
		});
	});
 
 
	$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
		
	});
	$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
	});
	
	
});
</script>
<?php echo $this->Html->script('/assets/plugins/jquery/jsapi.js'); ?>

    <script type="text/javascript">


 
	
	
	
	
	$(document).on('click', '#translControl', function(e){
		var c = $('.inputapi-transliterate-button').attr('aria-pressed');
		if(c=="true"){
			$('.inputapi-transliterate-img').html('English');
		}else{
			$('.inputapi-transliterate-img').html('Hindi');
		}
	});
	
      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      function onLoad() {
		  
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
        var ids = [ "transl1", "transl2" ];
        control.makeTransliteratable(ids);

        // Show the transliteration control which can be used to toggle between
        // English and Hindi.
        control.showControl('translControl');
		$('.inputapi-transliterate-img').html('English');
		$('.inputapi-transliterate-button-inner-box').addClass('btn btn-success');
      }
      google.setOnLoadCallback(onLoad);
	  
    </script>
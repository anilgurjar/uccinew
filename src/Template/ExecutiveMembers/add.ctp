<!--<div class="executiveMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($executiveMember) ?>
    <fieldset>
        <legend><?= __('Add Executive Member') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('master_financial_year_id', ['options' => $masterFinancialYears]);
            echo $this->Form->input('executive_category_id', ['options' => $executiveCategories]);
            echo $this->Form->input('designation_id', ['options' => $designations]);
            echo $this->Form->input('status');
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>-->


<div class="col-md-12">
<?php echo $this->Form->create($executiveMember, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add Executive Member</h3>
			</div>
			<div class="box-body" style="display: block;">
				<div class="row">
						
					<div class="col-md-12 pad">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Financial Year</label>
									<?=  $this->Form->input('master_financial_year_id', ['empty'=> '--Select--','data-placeholder'=>'Select a category','label' => false,'class'=>'form-control master_purpose_id','options'=>$masterFinancialYears,'required'=>'required']); ?>
									
									
								</div>
							</div>
					</div>
					
					<div id="executive">

					</div>
					
					
				</div>
			</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-primary','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
			<?php echo $this->Form->end(); ?>
</div>





<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
$(document).on("change",".master_purpose_id",function(){  
		var id=$(this).val();
		//$('.financial_year').val(id);
			var url="<?php echo $this->Url->build(['controller'=>'ExecutiveMembers','action'=>'executive_ajax']); ?>";
			url=url+"/"+id;
			
			$.ajax({
			   type: "POST",
			    url: url,
			    success: function(data){
				 $('#executive').html(data);
				 $('select').select2();
			   }  
			}); 
	});

</script>
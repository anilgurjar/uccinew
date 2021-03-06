<style>
body{
	font-size:13px !important;
}
</style>
<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border">
	  <h3 class="box-title">Add Visa Recommendations</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php echo $this->Form->create($businessVisa, ['type' => 'post','id'=>'bussinesForm']); ?>
	<div class="box-body">
		<div class="form-group">
			<h4 class="box-title" style="color:#DA3E2E">Company Informations :-</h4>
		</div><br>
		<div class="form-group">
			<label class="col-sm-2 control-label">Company/Organisation</label>
			<div class="col-sm-4">
				<?php
				$options=array();
				
				foreach($members as $master_member_data)
				{ 
				$name = $master_member_data['company_organisation'];
				$id = $master_member_data['id'];
				//pr($options[$master_member_data['id']]);     exit;
				}

				echo $this->Form->input('company_name', ['data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control ','type'=>'text','value'=>$name,'style'=>'width:100%;border:none','readonly'=>'readonly']);
				echo $this->Form->input('company_id', ['data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control ','type'=>'hidden','value'=>$id,'style'=>'width:100%;border:none','readonly'=>'readonly']);	?>
			</div>
			<label class="col-sm-2 control-label">Manufacturer</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('company_manufacture', ['label' => false,'placeholder'=>'Company Manufacturer','class'=>'form-control']); ?>
			</div>
		</div><br/>
		<div class="form-group">
			<h4 class="box-title" style="color:#DA3E2E">Sendor Informations :-</h4>
		</div><br/>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Send To</label>
			<div class="col-sm-4">
				<?php
				
				foreach($mastersendors as $mastersendor){  
					$name=$mastersendor->name;
					$id=$mastersendor->id;
					$address=$mastersendor->address;
					$sendor_name=$mastersendor->sendor_name;
					$sendor_country=$mastersendor->sendor_country;
					{
						$options[]=['value'=>$name,'text'=>$name,'address'=>$address,'sendor_name'=>$sendor_name,'sendor_country'=>$sendor_country];
					}	
					
				}
				echo $this->Form->input('sender_type', ['empty'=>'----Select---','label' => false,'placeholder'=>'Select Sender Type','class'=>'form-control select2me  sender_type','options'=>$options]);  ?>
			</div>
			<label class="col-sm-2 control-label">Category Bussiness Visa</label>
			<div class="col-sm-4">	
				<?php 
				$category=array(1=>"Going Offshore",2=>"Inviting Foreign Nationals to India");
				
				echo $this->Form->input('category_type', ['empty'=>'----Select---','label' => false,'placeholder'=>'Select Category','class'=>'form-control select2me  category_type typevissa','options'=>$category]); ?>
			</div>
		</div><br/>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Sender Name</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('sender_name', ['label' => false,'placeholder'=>'Sender Name','class'=>'form-control sendor_name']); ?>
			</div>
			<label class="col-sm-2 control-label">Sender Country</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('sender_country', ['label' => false,'placeholder'=>'Sender Country','class'=>'form-control sendor_country']); ?>
			</div>
		</div><br/>
		<div class="form-group">
			<label class="col-sm-2 control-label">Subject</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('subject', ['label' => false,'placeholder'=>'subject Name','class'=>'form-control']); ?>
			</div>
			<label class="col-sm-2 control-label">Sender Address</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('sender_address', ['label' => false,'placeholder'=>'Sender Address','class'=>'form-control address']); ?>
			</div>
		</div><br>
		<div class="form-group">
			<h4 class="box-title" style="color:#DA3E2E">Visitor Informations :-</h4>
		</div><br>
		<div class="form-group">
			<label class="col-sm-2 control-label">Name of Visitor</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visitor_name', ['label' => false,'placeholder'=>'Name of Visitor','class'=>'form-control']); ?>
			</div>
			<label class="col-sm-2 control-label">Designation</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visitor_designation', ['label' => false,'placeholder'=>'Visitor Designation','class'=>'form-control']); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Nationality</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visitor_country', ['label' => false,'placeholder'=>'Country of Visitor','class'=>'form-control visitor_country']); ?>
			</div>
			<label class="col-sm-2 control-label">Date of Birth</label>
			<div class="col-sm-4">	
				<?php echo $this->Form->input('date_of_birth', ['label' => false,'placeholder'=>'Date of Birth','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text']); ?>
			</div>
		</div>
		<div class="form-group">	  
			<label class="col-sm-2 control-label">Place of Birth</label>
			<div class="col-sm-4">	
				<?php 
				echo $this->Form->input('birth_place', ['label' => false,'placeholder'=>'Birth Place','class'=>'form-control ']); ?>
			</div>
			<label class="col-sm-2 control-label">Passport No. </label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('passport_no', ['label' => false,'placeholder'=>'Passport No.','class'=>'form-control']); ?>
			</div>
		</div><br/>
		<div class="form-group">
		<br>
			<h4 class="box-title" style="color:#DA3E2E">Other Informations :-</h4>
		</div><br>	
		<div class="form-group">
			<label class="col-sm-2 control-label">Visit Country</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visit_country', ['label' => false,'placeholder'=>'Country Name','class'=>'form-control visit_country']); ?>
			</div>
			<label class="col-sm-2 control-label">Visit Month</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visit_month', ['label' => false,'placeholder'=>'Visit Month','class'=>'form-control date-picker','data-date-format'=>'mm-yyyy', 'type'=>'text']); ?>
			</div>
		</div>
		<div class="form-group">	
			<label class="col-sm-2 control-label">Reason for Visit</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('visit_reason', ['label' => false,'placeholder'=>'Reason for Visit','class'=>'form-control']); ?>
			</div>
			
		</div>
		<div class="form-group">	
			<label class="col-sm-2 control-label">Date of Issue</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('issue_date', ['label' => false,'placeholder'=>'Date of Issue','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text']); ?>
			</div>
			<label class="col-sm-2 control-label">Place of Issue</label>
			<div class="col-sm-4">
				<?php echo $this->Form->input('issue_place', ['label' => false,'placeholder'=>'Place of Issue','class'=>'form-control']); ?>
			</div>
		</div>
		<div class="form-group">	
			<label class="col-sm-2 control-label">Date of Expiry</label>
			<div class="col-sm-4">	
				<?php echo $this->Form->input('expiry_date', ['label' => false,'placeholder'=>'Date of Expiry','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy', 'type'=>'text']); ?>
			</div>
		</div>
	</div>
	  <!-- /.box-body -->
	  <div class="box-footer">
		<center>
			
			<?php
			echo $this->Form->button(__('Save as Draft') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'business_submit']);
			?>		   
		</center>
	  </div>
	  <!-- /.box-footer -->
	<?php echo $this->Form->end(); ?>
	
  </div>
  <!-- /.box -->
         
           
             
</div>
<?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>
$(document).ready(function() {
	$('.sender_type').on("change",function() { 
		var address = $(this).find('option:selected').attr('address');
		var sendor_country = $(this).find('option:selected').attr('sendor_country');
		var sendor_name = $(this).find('option:selected').attr('sendor_name');
		
		
		$('.address').val(address);
		$('.sendor_country').val(sendor_country);
		$('.sendor_name').val(sendor_name);

	});
	
	$('.typevissa').on("change",function() { 
	
		var category_type = $('.category_type').find('option:selected').val();
		if(category_type==1){
			$('.visitor_country').val('India');
			//$('.visitor_country').attr('readonly','readonly');
			//$('.visit_country').attr('readonly',false);
			$('.visit_country').val('');
		}
		else{
			$('.visit_country').val('India');
			//$('.visit_country').attr('readonly','readonly');
			//$('.visitor_country').attr('readonly',false);
			$('.visitor_country').val('');
		}
		

	});
});
</script>
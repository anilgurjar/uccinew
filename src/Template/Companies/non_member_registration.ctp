<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}

</style>
<div class="col-md-12">
<?php echo $this->Form->create($Companies, ['type' => 'file','id'=>'registratiomForm']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Non Member Exporter Registration</h3>
			</div>
			<div class="box-body" style="display: block;">
			<div class="row">
			<div class="col-md-12 pad">
			
			      <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Exporter Name </label>
							<?php echo $this->Form->input('company_organisation', ['label' => false,'placeholder'=>'Company/Organisation','class'=>'form-control']); ?>
						</div>
					</div>
			       
				  
					
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Gst Number </label>
							<?php echo $this->Form->input('gst_number', ['label' => false,'placeholder'=>'GST NUMBER','class'=>'form-control ','type'=>'text']); ?>
						</div>
					</div>
					
					 <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Export Type </label>
							
							<?php
						$options=array();
							$options['Manufacturer/Trader'] = 'Manufacturer/Trader';
							$options['Nature of Export Goods'] = 'Nature of Export Goods';
							
												
						echo $this->Form->input('export', array('label' => false,'options' => $options,'hiddenField' => false,'value'=>'Manufacturer/Trader','class'=>'form-control')); ?>
							
							
						</div>
					</div>
				 
				</div>
				
				
				<!--<div class="col-md-12 pad">
			
			      <div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Manufacturer/Trader  </label>
							<?php echo $this->Form->input('manufacturer', ['label' => false,'placeholder'=>'Manufacturer/Trader','class'=>'form-control']); ?>
						</div>
					</div>
			       
				   <div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Nature of Export Goods  </label>
							<?php echo $this->Form->input('export_good', ['label' => false,'placeholder'=>'Nature of Export Goods','class'=>'form-control']); ?>
						</div>
					</div>
					
					
				</div>-->
				
				
			<div class="col-md-12 pad">
				
				
				
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Address </label>
							<?php echo $this->Form->input('address', ['label' => false,'placeholder'=>'Address','class'=>'form-control','type'=>'textarea','style'=>'resize:none;','rows'=>'2']); ?>
						</div>
				</div>
				
				<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Office-Telephone</label>
							<?php echo $this->Form->input('office_telephone', ['label' => false,'placeholder'=>'Office-Telephone','class'=>'form-control']); ?>
						</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Nationality </label><br/>
						
						<?php
						$options=array();
							$options['Indian'] = 'Indian';
							$options['NRI'] = 'NRI';
							$options['Non-Indian'] = 'Non-Indian';
												
						echo $this->Form->input('nationality', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'hiddenField' => false,'value'=>'Indian')); ?>
								
							<label id="nationality-error" class="error" for="nationality"></label>
						</div>
				</div>
				
			</div>
					
			<div class="col-md-12 pad">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Contact Person</label>
							<?php echo $this->Form->input('users[0][member_name]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control']); ?>
							
							<?php echo $this->Form->input('users[0][member_nominee_type]', ['label' => false,'placeholder'=>'Member Name','class'=>'form-control nominee_first','type'=>'hidden','value'=>'first']); ?>
							
						</div>
					</div>
					<div class="col-md-4"> 
						<div class="form-group">
							<label class="control-label">Email </label>
							<?php echo $this->Form->input('users[0][email]', ['label' => false,'placeholder'=>'Company E-mail','class'=>'form-control first']); ?>
						</div>
					</div> 
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Mobile No.</label>
							<?php echo $this->Form->input('users[0][mobile_no]', ['label' => false,'placeholder'=>'Mobile Number','class'=>'form-control first']); ?>
						</div>
					</div>
				</div>
				<div class="col-md-12 pad">
				
					<div class="col-md-4">
					   <div class="form-group">
						 <label>Mode of Payment</label>

							<?php
							$options=array();
							
							$options['Cheque No'] ='Cheque';
							$options['Cash'] = 'Cash';
							$options['D.D. No'] = 'D.D.';
							$options['NEFT/RTGS'] = 'NEFT/RTGS';

							echo $this->Form->input('amount_type', array('templates' => ['radioWrapper' => '<div class="radio inline radio-div">{{label}}</div>'],'type' => 'radio','label' => false,'options' => $options,'value'=>'Cheque No','hiddenField' => false)); ?>				

						</div>
					</div>
						
					<div class="col-md-4"> 
						<div class="form-group">
							<label class="control-label cheque ">Cheque No </label>
							<label class="control-label d_d" style="display:none;">D.D. No. </label>
							<?php echo $this->Form->input('cheque_number', ['label' => false,'placeholder'=>'','class'=>'form-control first']); ?>
						</div>
					</div> 
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label cheque">Cheque date.</label>
							<label class="control-label d_d" style="display:none;">D.D. Date</label>
							<?php echo $this->Form->input('cheque_date', ['label' => false,'placeholder'=>'','class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','type'=>'text']); ?>
						</div>
					</div>
				</div>
				
				
		<div class="col-sm-12 no-print" style="margin-top:20px;" id="main">		
			<table class="table table-bordered">	
			<thead style="">
				<tr>
					<th>Particulars</th>
					<th>Amount </th>
					<?php foreach($taxations as $taxation){
					echo"<th>".$taxation->tax_name. " ( " .$taxation->master_taxation_rates[0]->tax_percentage." % )</th>";
					}
					?>
					<th>Total</th>
				</tr>
			</thead>
            <tbody>
			<tr>
			<?php
			$total=0;
			foreach($master_membership_fees as $master_membership_fee){
				$subscription_amount=$master_membership_fee->subscription_amount;
				$total+=$subscription_amount;
				echo"<td>".$master_membership_fee->component."</td>";
				echo"<td>".$master_membership_fee->subscription_amount."</td>";
				
			}
			echo $this->Form->input('co_registrations[0][amount]', ['label' => false,'class'=>'form-control','value'=>$subscription_amount,'type'=>'hidden']);
			
			echo $this->Form->input('company_member_types[0][master_member_type_id]', ['label' => false,'class'=>'form-control','value'=>3,'type'=>'hidden']);
			
			echo $this->Form->input('company_member_types[0][master_financial_year_id]', ['label' => false,'class'=>'form-control','value'=>$master_financial_year_id,'type'=>'hidden']);
			
			echo $this->Form->input('company_member_types[0][due_amount]', ['label' => false,'class'=>'form-control','value'=>'0.00','type'=>'hidden']);
			
			
			?>
			
			<?php 
			$total_tax=0; $i=0;
			foreach($taxations as $taxation){
					$tax=$taxation->master_taxation_rates[0]->tax_percentage;
					$tax_amount=$subscription_amount*$tax/100;
					$total+=$tax_amount;
					$total_tax+=$tax_amount;
					echo"<td>".$tax_amount."</td>";
					
					echo $this->Form->input('co_registrations[0][co_tax_amounts]['.$i.'][tax_id]', ['label' => false,'class'=>'form-control','value'=>$taxation->tax_id,'type'=>'hidden']);
					echo $this->Form->input('co_registrations[0][co_tax_amounts]['.$i.'][tax_percentage]', ['label' => false,'class'=>'form-control','value'=>$taxation->master_taxation_rates[0]->tax_percentage,'type'=>'hidden']);
					
					echo $this->Form->input('co_registrations[0][co_tax_amounts]['.$i.'][amount]', ['label' => false,'class'=>'form-control','value'=>$tax_amount,'type'=>'hidden']);
					
					$i++;
					}
					echo $this->Form->input('co_registrations[0][tax_amount]', ['label' => false,'class'=>'form-control','value'=>$total_tax,'type'=>'hidden']);
					?>
			<td><?php echo $total; 
			echo $this->Form->input('co_registrations[0][total_amount]', ['label' => false,'class'=>'form-control','value'=>$total,'type'=>'hidden']);
			echo $this->Form->input('co_registrations[0][master_financial_year_id]', ['label' => false,'class'=>'form-control','value'=>$master_financial_year_id,'type'=>'hidden']);
			?></td>
			</tr>
			</tbody>

				
			</table>
		</div>
				
			
			</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']).__(' Submit') ,['class'=>'btn btn-success','type'=>'Submit','id'=>'submit_member','name'=>'registration_submit']);
					   ?>
				</center>
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>
					
			
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 

$('.second').on('keyup change',function() {
var x=$(this).val();
	if(x.length>0){
		$('.nominee_second').val('second');
	}else{
		$('.nominee_second').val('');
	}

});

$('input[name="amount_type"]').on('click',function() {
		var amount_type=$(this).val();
		if(amount_type=="Cheque No"){
			$('.d_d').hide();
			$('.cheque').show();
		}
		if(amount_type=="D.D. No"){
			$('.cheque').hide();
			$('.d_d').show();
		}
});


	/* $('input[name="member_type_id"]').on('change',function() {
		var member_type_id=$(this).val();
		if(member_type_id==1)
		{
			$('select[name="turn_over_id"]').removeAttr('disabled');
			$('select[name="grade"]').removeAttr('disabled');
			$('select[name="category"]').removeAttr('disabled');
			$('select[name="classification"]').removeAttr('disabled');
		}
		else
		{
			$('select[name="turn_over_id"]').attr('disabled','disabled');
		}
		if(member_type_id==2)
		{
			$('select[name="grade"]').removeAttr('disabled');
			$('select[name="category"]').removeAttr('disabled');
			$('select[name="classification"]').removeAttr('disabled');
		}
		if(member_type_id==3)
		{
			$('select[name="grade"]').attr('disabled','disabled');
			$('select[name="category"]').attr('disabled','disabled');
			$('select[name="classification"]').attr('disabled','disabled');
		}
	}); */
	
	jQuery.validator.addMethod("pan_no", function(value, element) {
		return this.optional(element) || /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/.test( value );
	},"You are entering incorrect PANCARD no please see the format ABCDE1234F " );
	jQuery.validator.addMethod("[name=email],[name=alternate_email]", function(value, element) {
		return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test( value );
	});
	
	jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
 return this.optional(element) || value != $(param).val();
 }, "This E-mail is already chose in email.");
 jQuery.validator.addMethod("notEqualToNo", function(value, element, param) {
 return this.optional(element) || value != $(param).val();
 }, "This No. is already chose in mobile no.");
	// validate the comment form when it is submitted
	// validate signup form on keyup and submit
	 $("#registratiomForm").validate({ 
		rules: {
			company_organisation: {
				required: true
			},
			'users[0][member_name]': {
				required: true
			},
			address: {
				required: true
			},
			
			'users[0][email]': {
				required: true,
				email:true,
				//remote:"check_email"
			},
			'users[1][email]': {
				email:true,
				//remote:"check_alternate_email"
			},
			'users[0][mobile_no]': {
				number: true,
				minlength: 10,
                maxlength: 10
				
			},
			'users[1][mobile_no]': {
				number: true,
				minlength: 10,
                maxlength: 10
				
			},
			city: {
				
			},
			pincode: {
				number: true,
				minlength: 6,
                maxlength: 6
			},
			pan_no: {
				pan_no:true
			},
			grade: {
				required: true
			},
			category: {
				required: true
			},
			classification: {
				required: true
			},
			year_of_joining: {
				required: true
			},
			'company_member_types[master_member_type_id][]': {
				required: true
			},
			turn_over_id: {
				required: true
			}
			
		},
		messages: {
			 email: {
              remote: "This E-mail is already exist."
            },
			 alternate_email: {
              remote: "This E-mail is already exist."
            },
			member_name: {
				required: "Please enter a username."
			},
			member_type_id: {
					required: "Please select a member type."
				}
		},
		submitHandler: function () {
				
				$("#submit_member").attr('disabled','disabled');
				
				 form.submit();
			}
	}); 

});
</script>
       
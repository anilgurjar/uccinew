
<style>
.pad{
	padding-right: 0px;
padding-left: 0px;
}
.form-group
{
	margin-bottom: 0px;
}
input[type="checkbox"]{
	margin-right: 2px;
}
</style>   
<div class="col-md-12">
<?php echo $this->Form->create($notice, ['type' => 'post','id'=>'registratiomForm','enctype' => 'multipart/form-data']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Send Email</h3>
			</div>
			<div class="box-body" style="display: block;">
			<div class="row">
						
			<div class="col-md-12 pad">
									
					 <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Subject</label>
							<?php echo $this->Form->input('title', ['label' => false,'placeholder'=>'Subject','class'=>'form-control']); ?>
						</div>
					</div>
					
			</div>
			
			
			<div class="col-md-12 ">
					<div class="box-body  pad">
					<textarea class="textarea wysihtml5textarea"  name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					</div>
			    
			</div>
				
			</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button(__('Submit') . $this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-success','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']);
					   ?>
				</center>
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>
					
			
					
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>

<script>

$(document).ready(function() { 

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
			title: {
				required: true
			},
			description: {
				required: true
			},
					
		},
		submitHandler: function () {
				
				$("#create_notice").attr('disabled','disabled');
				
				 form.submit();
			},
		
	});

});
</script>
       

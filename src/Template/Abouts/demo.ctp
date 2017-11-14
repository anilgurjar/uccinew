echo '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/css/datepicker3.css"/> 

<script src="http://ucciudaipur.com/app/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script src="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
	$( document ).ready(function() {
		$(".joindate").datepicker();
		
		$(".exporting_product").on("click", function(){
			if($(this).val()=="yes")
			{
				$("#where").show();
			}
			else
			{
				$("#where").hide();
			}
			  
		});
		
		$(".expansions_planned").on("click", function(){
			if($(this).val()=="yes")
			{
				$("#expansions_planned_waste").show();
			}
			else
			{
				$("#expansions_planned_waste").hide();
			}
			  
		});
		
		$(".onsite_treatment_facility").on("click", function(){
			if($(this).val()=="yes")
			{
				$("#onsite_treatment_facility_type").show();
			}
			else
			{
				$("#onsite_treatment_facility_type").hide();
			}
			  
		});
	});
	
	
</script>



<style>
.pad{
	padding-right: 0px;
	padding-left: 0px;
}
.form-group
{ margin-bottom: 0px;}

.form-control {
    border: 1px solid #ccc !important;
	background-color: rgba(245, 245, 247, 0.18) !important;
}
.col-md-12 {
	background-color:#FFF !important;
}
.form-group { margin: 20px; }
legend
{
	padding-top: 20px;
}
table > thead > tr > th { background-color: rgba(105, 98, 98, 0.82) !important;; }

</style>

<div class="col-md-12">

<form action="http://app.ucciudaipur.com/app/api/companies/nonmemberexporter.json" method="post">

<div class="box box-primary">

<div class="box-header with-border">
<div class="section-heading clearfix sr-animated stripe text-center" data-sr-id="1" style="; visibility: visible;  -webkit-transform: translateY(0) scale(1); opacity: 1;transform: translateY(0) scale(1); opacity: 1;-webkit-transition: -webkit-transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">

<h3 class="box-title title " style="text-align: center;margin: 20px;"  >
INDUSTRIAL WASTE SURVEY <span class="effect"></span>
</h3>
</div>
</div>

<div class="box-body" style="display: block;">

<fieldset>
    <legend>Point of Contact</legend>
	<div class="col-md-12 pad">
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> Name </label>
			 <input type="text" name="member_name" class="form-control" placeholder="Name" required >
		 </div>
		</div>
				   

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Position Title </label>
				<input type="text" name="position" class="form-control" placeholder="Title of Position ">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Telephone </label>
				<input type="text" name="mobile_no" class="form-control" placeholder="Telephone">	 
			</div>
		</div>
	</div>
	<div class="col-md-12 pad">
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> E-Mail </label>
			 <input type="text" name="email" class="form-control" placeholder="E-mail" required >
		 </div>
		</div>
				   

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">FAX</label>
				<input type="text" name="fax" class="form-control" placeholder="FAX">
			</div>
		</div>
 	</div>
</fieldset>
<fieldset>
    <legend>Corporate Descriptions</legend>
	<div class="col-md-12 pad">
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> Company Name </label>
			 <input type="text" name="company_organisation" class="form-control" placeholder="Company Name" required >
		 </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Telephone </label>
				<input type="text" name="office_telephone" class="form-control" placeholder="Telephone">	 
			</div>
		</div>
	 
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> E-Mail </label>
			 <input type="text" name="company_email_id" class="form-control" placeholder="E-mail" required >
		 </div>
		</div>
	</div>			   
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control" rows="2" placeholder="Company Address "></textarea>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">FAX</label>
				<input type="text" name="company_fax" class="form-control" placeholder="FAX">
			</div>
		</div>
 	</div>
</fieldset>

<fieldset>
    <legend>General Facility Information</legend>
	<div class="col-md-12 pad">
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> Number of  Employees </label>
			 <input type="text" name="no_of_employee" class="form-control" placeholder="Number of  Employees" required >
		 </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Months/Year in Operation </label>
				<input type="text" name="year_of_joining" class="form-control" placeholder="Months/Year in Operation">	 
			</div>
		</div>
	 
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> Products Manufactured </label>
			 <input type="text" name="end_products_item_dealing_in" class="form-control" placeholder="Products Manufactured" required >
		 </div>
		</div>
	</div>			   
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Are you currently exporting your products</label><br/>
				<label class="radio-inline">
					<input type="radio" name="exporting_product" checked class="exporting_product" value="yes">Yes
				<label class="radio-inline">
					<input type="radio" name="exporting_product"  class="exporting_product" value="no">No
				</label>
 			</div>
 		</div>
		<div class="col-md-4" id="where">
			<div class="form-group">
				<label class="control-label">Where ?</label>
				<input type="text" name="where_exporting_product" class="form-control" placeholder="Where you exporting your products ?" required>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Industry Code under HW Rules 2000</label>
				<input type="text" name="industry_code" class="form-control" placeholder="Industry Code under HW Rules 2000">
			</div>
		</div>
		
  	</div>
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Do you currently run an on-site treatment facility? (Incinerator, effluent treatment plant or other facility)? </label><br/>
				<label class="radio-inline">
					<input type="radio" name="onsite_treatment_facility" class="onsite_treatment_facility" value="yes">Yes
				<label class="radio-inline">
					<input type="radio" name="onsite_treatment_facility" class="onsite_treatment_facility" checked value="no">No
				</label>
 			</div>
 		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Are there any process changes or facility expansions planned for the next five fiscal years? </label><br/>
				<label class="radio-inline">
					<input type="radio" name="expansions_planned" class="expansions_planned"  value="yes">Yes
				<label class="radio-inline">
					<input type="radio" name="expansions_planned" class="expansions_planned" checked value="no">No
				</label>
 			</div>
 		</div>
  	</div>
	<div class="col-md-12 pad">
		<div class="col-md-6" id="onsite_treatment_facility_type" style="display:none">
			<div class="form-group">
				<label class="control-label">Type ?</label>
				<input type="text" name="onsite_treatment_facility_type" class="form-control" placeholder="Pleasde Discribe ISO Registration Type?">
			</div>
		</div>
		<div class="col-md-6" id="expansions_planned_waste" style="display:none">
			<div class="form-group">
				<label class="control-label">Please Describe Their Potential Effect on Waste Generation</label>
				<textarea name="expansions_planned_potential_effect" class="form-control" rows="2" placeholder=""></textarea>
			</div>
		</div> 
	</div>
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Are you presently or will you in the near future be seeking ISO 14000 registration? </label><br/>
				<label class="radio-inline">
					<input type="radio" name="iso_registration" checked value="yes">Yes
				<label class="radio-inline">
					<input type="radio" name="iso_registration" value="no">No
				</label>
 			</div>
 		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">If a new facility was constructed and commissioned would you consider decommissioning your existing treatment facility </label><br/>
				<label class="radio-inline">
					<input type="radio" name="existing_treatment_facility" checked value="yes">Yes
				<label class="radio-inline">
					<input type="radio" name="existing_treatment_facility" value="no">No
				</label>
 			</div>
 		</div>
 	</div>
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Hypothetically, if an off-site waste treatment facility was constructed what do you think would be an appropriate cost, in Rupees per metric tonne, for disposal?  </label><br/>
				<select name="appropriate_cost" class="form-control">
					<option value=""> Select...</option>
					<option value="0-1,000">0-1,000</option>
					<option value="1,000-2,000">1,000-2,000</option>
					<option value="2,000-3,000">2,000-3,000</option>
				</select>
 			</div>
 		</div>
		 
 	</div>
</fieldset>
</div>

<div class="box-footer" style="margin-top: 30px;" >
 	<center>
		<button type="submit" id="submit_member" name="registration_submit" class="btn btn-success">Submit</button>
	</center>
</div>

</div>

</form>

</div> ';
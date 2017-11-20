$company_id=$_GET['CaaOdaMsdaPsaArefNdsY__IdsadcD'];
echo '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/css/datepicker3.css"/> 

<script src="http://ucciudaipur.com/app/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script src="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
	$( document ).ready(function() {
		$(".joindate").datepicker();
		$(".company_service_type").on("click", function(){
			 
			if($(this).val()=="on site")
			{
				$("#on_site").show();
			}
			else
			{
				$("#on_site").hide();
			}
			if($(this).val()=="off site")
			{
				$("#off_site").show();
			}
			else
			{
				$("#off_site").hide();
			}
		});
		$(".chemical_composition").on("click", function(){
			 
			if($(this).val()=="yes")
			{
				$("#chemical_composition_sheet").show();
			}
			else
			{
				$("#chemical_composition_sheet").hide();
			}
		});
		$(".waste_stream").on("click", function(){
			 
			if($(this).val()=="Solid")
			{
				$("#solid_type").show();
				$("#liquid_type").hide();
				$("#sludge_type").hide();
			}
			else if($(this).val()=="Liquid")
			{
				$("#solid_type").hide();
				$("#liquid_type").show();
				$("#sludge_type").hide();
			}
			else if($(this).val()=="Sludge")
			{
				$("#solid_type").hide();
				$("#liquid_type").hide();
				$("#sludge_type").show();
			}
		});
	});
	//-- GENERAL
	function add_row()
	{
		var new_line=$("#monthly tbody").html();
		$("#monthly_table tbody").append(new_line);
		rename_rows();
	}
	$(document).on("click",".add_row",function(){ 
		add_row();
	});
	$(document).ready(function(){
		add_row();
 	});
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
		rename_rows();
	});
	//-- END GENERAL
	function rename_rows()
	{
		var i =0;
		$("#monthly_table tbody tr").each(function(){
			
			$(this).find("td input.number").attr({name:"company_waste_informations["+i+"][number]"});

			$(this).find("td input.waste_type").attr({name:"company_waste_informations["+i+"][waste_type]"});
			
			$(this).find("td input.volume").attr({name:"company_waste_informations["+i+"][volume]"});
					
			$(this).find("td input.inventory").attr({name:"company_waste_informations["+i+"][inventory]"});
			
			$(this).find("td input.company_id").attr({name:"company_waste_informations["+i+"][company_id]"});
			
			$(this).find("td input.storage_method").attr({name:"company_waste_informations["+i+"][storage_method]"});
			
			$(this).find("td input.size_storage_container").attr({name:"company_waste_informations["+i+"][size_storage_container]"});
			
			i++;
		});
			
	}
	 
	
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
legend {
    padding-left: 35px;
	color: #0a4b7d;
    font-weight: 700;
}
</style>

<div class="col-md-12">

<form action="http://ucciudaipur.com/uccinew/api/company_hwm_informations/hwmSecondForm.json" method="post"  enctype="multipart/form-data">

<div class="box box-primary" style="padding-top: 99px !important;">

<div class="box-header with-border">
<div class="section-heading clearfix sr-animated stripe text-center" data-sr-id="1" style="; visibility: visible;  -webkit-transform: translateY(0) scale(1); opacity: 1;transform: translateY(0) scale(1); opacity: 1;-webkit-transition: -webkit-transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; transition: transform 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1s cubic-bezier(0.6, 0.2, 0.1, 1) 0s; ">

<h3 class="box-title title " style="text-align: center;"  >
INDUSTRIAL WASTE SURVEY <span class="effect"></span>
</h3>
</div>
</div>

<div class="box-body" style="display: block;">

<fieldset>
    <legend>General Waste Information</legend>
 	<div class="col-sm-12 no-print" style="margin-top:20px;" id="monthly_table">
	<label class="control-label"> What types of waste does your facility generate and estimate on a monthly basis the volume generated. </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th width="7%">Reference Number</th>
					<th width="7%">Waste Type</th>
					<th width="7%">Volume</th>
					<th width="7%">Inventory</th>
					<th width="7%">Storage Method</th>
					<th width="7%">Size of Storage Container</th>
					<th width="3%"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</fieldset>
<fieldset style="margin-top: 20px;">
    <legend>Detailed Waste Information</legend>
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label"> Company Name </label>
				 <input type="text" name="company_name" class="form-control" placeholder="Company Name" required >
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Waste Description </label>
				<input type="text" name="waste_description" class="form-control" placeholder="Please provide waste description">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Waste Type Number from HW Rules 2000 </label>
				<input type="text" name="waste_type_number" class="form-control" placeholder="Please provide waste type number">
			</div>
		</div>
	</div>			   
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Process Generating Waste from HW Rules 2000 </label>
				<input type="text" name="process_generating_waste" class="form-control" placeholder="Please provide waste from HW rules 2000">
			</div>
 		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">What is the generation rate of this waste type in metric tones per month </label>
				<input type="text" name="generation_rate" class="form-control" placeholder="Waste type in metric tones per month">	 
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Describe your current disposal arrangements for this waste</label><br/>
				<input type="text" name="disposal_arrangement" class="form-control" placeholder="Current arrangements for this waste">	
 			</div>
		</div>
  	</div>
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Do you have any information on the chemical composition of the waste ?</label><br/>
				<label class="radio-inline">
					<input type="radio" name="chemical_composition" class="chemical_composition" checked value="yes"> Yes
				<label class="radio-inline">
					<input type="radio" name="chemical_composition" class="chemical_composition" value="no">No
				</label>
 			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Please Select Type</label><br/>
				<label class="radio-inline">
					<input type="radio" name="company_service_type" class="company_service_type" checked value="off site">off site
				</label>
				<label class="radio-inline">
					<input type="radio" name="company_service_type" class="company_service_type"  value="on site"> On site 
				</label>
				
 			</div>
		</div>
	</div>
	<div class="col-md-12 pad">
		<div class="col-md-4" id="chemical_composition_sheet">
			<div class="form-group">
				<label class="control-label">Please attach details on a separate sheet</label><br/>
				<input type="file" name="chemical_composition_sheet">
 			</div>
		</div>
		<div id="off_site">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Company Name </label><br/>
					<input type="text" name="off_site_company_name" class="form-control" placeholder="Please provide company name">	 
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Address </label><br/>
					 <textarea class="form-control" name="off_site_address" row="1" placeholder="Please provide address"></textarea>
				</div>
			</div>
		</div>
		<div id="on_site" style="display:none;">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">what disposal method is used (burn, bury, surface stockpile, transport elsewhere, other please specify)? </label><br/>
					<input type="text" name="on_site_disposal_method" class="form-control" placeholder="Please provide company name">	 
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12 pad">
		<div class="col-md-8">
			<div class="form-group">
				<label class="control-label">If not disposal, what do you currently do with this waste?</label><br/>
				<label class="radio-inline">
					<input type="radio" name="disposal_waste_use"  checked value="Recycle it on site">Recycle it on site
				</label>
				<label class="radio-inline">
					<input type="radio" name="disposal_waste_use" value="Reuse it on site"> Reuse it on site 
				</label>
				<label class="radio-inline">
					<input type="radio" name="disposal_waste_use" value="sell it to another manufacturer for their use">Sell it to Another Manufacturer for their use 
				</label>
 				
 			</div>
		</div>
	</div>
</fieldset>
<fieldset style="margin-top: 20px;">
    <legend>Detailed Disposal Information</legend>
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Please describe the waste stream in the following categories </label><br/>
				<label class="radio-inline">
					<input type="radio" name="waste_stream" class="waste_stream" checked value="Solid">Solid
				</label>
				<label class="radio-inline">
					<input type="radio" name="waste_stream" class="waste_stream" value="Liquid"> Liquid
				</label>
				<label class="radio-inline">
					<input type="radio" name="waste_stream" class="waste_stream" value="Sludge"> Sludge
				</label>
			</div>
		</div>
		<div class="col-md-6" id="solid_type">
			<div class="form-group">
				<label class="control-label">Please select solid type</label><br/>
				<select name="solid_type" class="form-control">
					<option value=""> Select...</option>
					<option value="Powder">Powder</option>
					<option value="Small Pieces < 12mm">Small Pieces < 12mm</option>
					<option value="Medium size < 50mm">Medium size < 50mm </option>
					<option value="Large size < 150mm">Large size < 150mm </option>
					<option value="Mixed Sizes">Mixed Sizes</option>
				</select>
 			</div>
		</div>
		<div class="col-md-6" id="liquid_type"  style="display:none;">
			<div class="form-group">
				<label class="control-label">Please select liquid type</label><br/>
				<select name="liquid_type" class="form-control">
					<option value=""> Select...</option>
					<option value="Organic">Organic</option>
					<option value="Inorganic">Inorganic (aqueous)</option>
					<option value="Other">Other (emulsions)</option>
					<option value="Unknown">Unknown</option>
				</select>
 			</div>
		</div>
		<div class="col-md-6" id="sludge_type" style="display:none;">
			<div class="form-group">
				<label class="control-label">Please select sludge type</label><br/>
				<select name="sludge_type" class="form-control">
					<option value=""> Select...</option>
					<option value="Organic">Organic</option>
					<option value="Inorganic">Inorganic</option>
					<option value="% Moisture">% Moisture</option>
					<option value="Unknown">Unknown</option>
				</select>
 			</div>
		</div>
	</div>
	 
		
	 
	<div class="col-md-12 pad">
		<div class="col-md-6">
			<div class="form-group">
				<label>Are any of the following constituents present ?</label>
				<div class="checkbox-list">
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Heavy  Metals">Heavy  Metals </label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Phenols or their Derivatives">Phenols or their Derivatives</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Cyanide or Isocyanates"> Cyanide or Isocyanates</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Organic Halogenated Material"> Organic Halogenated Material</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Organic Non-Halogenated Solvents"> Organic Non-Halogenated Solvents</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Biocides or Pharmaceuticals"> Biocides or Pharmaceuticals</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Tarry Residues"> Tarry Residues</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Asbestos"> Asbestos</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Oxidizing Materials"> Oxidizing Materials</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Polycyclic Organic Materials"> Polycyclic Organic Materials</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Metal Carbonyls"> Metal Carbonyls</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Radioactive"> Radioactive</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="None"> None</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="constituents_present[]" value="Unknown"> Unknown</label><br/>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Principal Components of the waste is ?</label>
				<div class="checkbox-list">
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Organic – chemical or petrochemical origin">Organic – chemical or petrochemical origin </label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Organic - biological origin"> Organic - biological origin </label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Metallic"> Metallic</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Mix of Inorganic Materials"> Mix of Inorganic Materials</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Mix of Organic Materials"> Mix of Organic Materials</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Mix of Organic and Inorganic Materials"> Mix of Organic and Inorganic Materials</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="principal_components[]" value="Unknown"> Unknown</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label>Is waste acidic or basic? Please indicate pH if known.</label>
				<div class="checkbox-list">
 					<label class="checkbox-inline"><input type="checkbox" name="acidic_basic[]" value="pH ="> pH =</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="acidic_basic[]" value="Acid">Acid</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="acidic_basic[]" value="Basic"> Basic</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="acidic_basic[]" value="Neutral"> Neutral</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="acidic_basic[]" value="Unknown"> Unknown</label>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Is the waste combustible ?</label>
				<div class="checkbox-list">
 					<label class="checkbox-inline"><input type="checkbox" name="waste_combustible[]" value="Highly Flammable"> Highly Flammable</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="waste_combustible[]" value="Combustible">Combustible</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="waste_combustible[]" value="Combustible with other material of  if dried"> Combustible with other material of  if dried</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="waste_combustible[]" value="Not Combustible"> Not Combustible</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="waste_combustible[]" value="Unknown"> Unknown</label>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Is there a potential for direct reuse of the waste ?</label>
				<div class="checkbox-list">
 					<label class="checkbox-inline"><input type="checkbox" name="potential_reuse[]" value="Possible with no processing">Possible with no processing</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="potential_reuse[]" value="Possible with Processing">Possible with Processing</label><br/>
					<label class="checkbox-inline"><input type="checkbox" name="potential_reuse[]" value="Not possible and Not probable"> Not possible and Not probable</label> <br/>
					<label class="checkbox-inline"><input type="checkbox" name="potential_reuse[]" value="Unknown"> Unknown</label>
				</div>
			</div>
		</div>
	</div>
</fieldset>
</div>

<div class="box-footer" style="margin: 30px;" >
 	<center>
		<button type="submit" id="submit_member" name="registration_submit" class="btn btn-success">Submit</button>
	</center>
</div>

</div>

</form>
<table id="monthly" style="display:none;">
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control number" name="number[]">
			</td>
			<td>
				<input type="text" class="form-control waste_type" name="waste_type[]"> 
			</td>
			<td>
				<input type="text" class="form-control volume" name="volume[]">
			</td>
			<td>
				<input type="text" class="form-control inventory" name="inventory[]">
				<input type="hidden" class="form-control company_id" value="'.$company_id.'" name="company_id[]">
			</td>
			<td>
				<input type="text" class="form-control storage_method" name="storage_method[]">
			</td>
			<td>
				<input type="text" class="form-control size_storage_container" name="size_storage_container[]">
			</td>
			<td>
				<button type="button" class="btn btn-primary btn-xs add_row"><i class="fa fa-plus"></i></button>		
				<button type="button" class="btn  btn-danger btn-xs remove_row"><i class="fa fa-times"></i></button>		
			</td>
		</tr>
	</tbody>
</table>
 

</div> ';
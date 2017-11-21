$company_id=$_GET['CaaOdaMsdaPsaArefNdsY__IdsadcD'];

	$post =['company_id' =>$company_id];
	$ch = curl_init('http://ucciudaipur.com/uccinew/api/companies/CompanyInformation.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$response = curl_exec($ch);
	$response_data = json_decode($response);
	curl_close($ch);
echo '	<pre>';
print_r();
echo '</pre>';
$company_name=$response_data->response->company_organisation;
 


 
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
		var new_line=$("#monthlys tbody").html();
		$("#monthly_tables tbody").append(new_line);
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
		$("#monthly_tables tbody tr").each(function(){
			
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
UDAIPUR CHAMBER OF COMMERCE & INDUSTRY <span class="effect"></span>
</h3>
<h4 style="text-align: center;">Questionnaire on the Incinerable/ non incinerable Hazardous Waste</h4>
</div>
</div>

<div class="box-body" style="display: block;">
  
	<div class="col-md-12 pad">
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label"> Company Name </label>
				 <input type="text" name="company_organisation" class="form-control" placeholder="Company Name" required >
			</div>
		</div>
		 <div class="col-md-8">
			<div class="form-group">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control" rows="2" placeholder="Company Address "></textarea>
			</div>
		</div>
	</div>			   
	<div class="col-md-12 pad">
		
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">FAX</label>
				<input type="text" name="company_fax" class="form-control" placeholder="Company FAX">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Telephone </label>
				<input type="text" name="office_telephone" class="form-control" placeholder="Company Telephone">	 
			</div>
		</div>
	 
		<div class="col-md-4">
		 <div class="form-group">
			<label class="control-label"> E-Mail </label>
			 <input type="text" name="company_email_id" class="form-control" placeholder="Company E-mail" required >
		 </div>
		</div>
 	</div>
	
   
 	<div class="col-sm-12 no-print" style="margin-top:20px;" id="monthly_tables">
	<label class="control-label"> Describe the Details. </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th rowspan="2">Code No. as per Sch-1 of HW Rules, 2003</th>
					<th colspan="2">Waste type/Description</th>
					<th colspan="2">Quantity/ Month</th>
					<th colspan="2">Inventory</th>
					<th colspan="2">Storage Method</th>
					<th width="3%" rowspan="2" ></th>
				</tr>
				<tr>
					<th>Incinerable</th>
					<th>Non-Incinerable</th>
					<th>Incinerable</th>
					<th>Non-Incinerable</th>
					<th>Incinerable</th>
					<th>Non-Incinerable</th>
					<th>Incinerable</th>
					<th>Non-Incinerable</th>
					
					 
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
 	<div class="col-md-12 pad">
		<div class="box-footer" style="margin: 30px;" >
			<center>
				<button type="submit" id="submit_member" name="registration_submit" class="btn btn-success">Submit</button>
			</center>
		</div>
	</div>
</div>
	
</div>
</form>
<table id="monthlys" style="display:none;">
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
				<input type="text" class="form-control size_storage_container" name="size_storage_container[]">
			</td>
			<td>
				<input type="text" class="form-control size_storage_container" name="size_storage_container[]">
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
 </div>';
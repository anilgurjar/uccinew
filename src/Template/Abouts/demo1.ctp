echo '
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/css/datepicker3.css"/> 

<script src="http://ucciudaipur.com/app/assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<script src="http://ucciudaipur.com/app/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
	$( document ).ready(function() {
		$(".joindate").datepicker();
	});
	//-- GENERAL
	function add_row()
	{
		var new_line=$("#monthly tbody").html();
		$("#monthly_table tbody").append(new_line);
	}
	$(document).on("click",".add_row",function(){ 
		add_row();
	});
	$(document).ready(function(){
		add_row();
		add_row1();
		add_row2();
		add_row3();
	});
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
	});
	//-- END GENERAL
	
	//-- inventoried
	function add_row1()
	{ 
		var new_line=$("#inventoried tbody").html();
		$("#inventoried_table tbody").append(new_line);
	}
	$(document).on("click",".add_row1",function(){ 
		add_row1();
	});
	$(document).on("click",".remove_row1",function(){ 
		$(this).closest("tr").remove();
	});
	//-- END inventoried
	
	//-- inventoried
	function add_row2()
	{
		var new_line=$("#storing_waste tbody").html();
		$("#storing_waste_table tbody").append(new_line);
	}
	$(document).on("click",".add_row2",function(){ 
		add_row2();
	});
	$(document).on("click",".remove_row2",function(){ 
		$(this).closest("tr").remove();
	});
	//-- END inventoried
	
	//-- inventoried
	function add_row3()
	{
		var new_line=$("#Storage_Systems  tbody").html();
		$("#Storage_Systems_table tbody").append(new_line);
	}
	$(document).on("click",".add_row3",function(){ 
		add_row3();
	});
	$(document).on("click",".remove_row3",function(){ 
		$(this).closest("tr").remove();
	});
	//-- END inventoried
	
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
    <legend>General Waste Information</legend>
 	<div class="col-sm-12 no-print" style="margin-top:20px;" id="monthly_table">
	<label class="control-label"> What types of waste does your facility generate and estimate on a monthly basis the volume generated. </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th width="27%">Number</th>
					<th width="27%">Waste Type</th>
					<th width="27%">Volume</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
 
 	<div class="col-sm-12 no-print" style="margin-top:20px;" id="inventoried_table">
	<label class="control-label"> How much of each waste generation identified above is currently inventoried on site?. </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th width="27%">Reference Number</th>
					<th width="27%">Waste</th>
					<th width="27%">Inventory</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
	<div class="col-sm-12 no-print" style="margin-top:20px;" id="storing_waste_table">
	<label class="control-label"> Describe methodology of storing waste (warehouse, outside in secure compound, outside in general compound lagoons, ponds). If other, please describe. </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th width="27%">Reference Number</th>
					<th width="27%">Waste</th>
					<th width="27%">Storage Method</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	
	<div class="col-sm-12 no-print" style="margin-top:20px;" id="Storage_Systems_table">
	<label class="control-label"> Describe storage systems used (bins, barrels, on pallets, boxes, open tanks, closed tanks). </label>
		<table class="table table-bordered">	
			<thead>
				<tr>
					<th width="27%">Reference Number</th>
					<th width="27%">Waste</th>
					<th width="27%">Size of Storage Container</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
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
<table id="monthly" style="display:none;">
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control" name="number[]">
			</td>
			<td>
				<input type="text" class="form-control" name="waste_type[]">
				<input type="hidden" class="form-control" name="waste_category_id[]" value="1">
			</td>
			<td>
				<input type="text" class="form-control" name="volume[]">
			</td>
			<td>
				<button type="button" class="btn btn-primary btn-xs add_row"><i class="fa fa-plus"></i></button>		
				<button type="button" class="btn  btn-danger btn-xs remove_row"><i class="fa fa-times"></i></button>		
			</td>
		</tr>
	</tbody>
</table>
<table id="inventoried" style="display:none;">
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control" name="ref_no[]">
			</td>
			<td>
				<input type="text" class="form-control" name="waste[]">
				<input type="hidden" class="form-control" name="waste_category_id[]" value="2">
			</td>
			<td>
				<input type="text" class="form-control" name="inventory[]">
			</td>
			<td>
				<button type="button" class="btn btn-primary btn-xs add_row1"><i class="fa fa-plus"></i></button>		
				<button type="button" class="btn  btn-danger btn-xs remove_row1"><i class="fa fa-times"></i></button>		
			</td>
		</tr>
	</tbody>
</table>
<table id="storing_waste" style="display:none;">
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control" name="ref_no[]">
			</td>
			<td>
				<input type="text" class="form-control" name="waste[]">
				<input type="hidden" class="form-control" name="waste_category_id[]" value="3">
			</td>
			<td>
				<input type="text" class="form-control" name="inventory[]">
			</td>
			<td>
				<button type="button" class="btn btn-primary btn-xs add_row2"><i class="fa fa-plus"></i></button>		
				<button type="button" class="btn  btn-danger btn-xs remove_row2"><i class="fa fa-times"></i></button>		
			</td>
		</tr>
	</tbody>
</table>
<table id="Storage_Systems" style="display:none;">
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control" name="ref_no[]">
			</td>
			<td>
				<input type="text" class="form-control" name="waste[]">
				<input type="hidden" class="form-control" name="waste_category_id[]" value="4">
			</td>
			<td>
				<input type="text" class="form-control" name="inventory[]">
			</td>
			<td>
				<button type="button" class="btn btn-primary btn-xs add_row3"><i class="fa fa-plus"></i></button>		
				<button type="button" class="btn  btn-danger btn-xs remove_row3"><i class="fa fa-times"></i></button>		
			</td>
		</tr>
	</tbody>
</table>

</div> ';
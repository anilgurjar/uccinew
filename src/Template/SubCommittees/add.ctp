<div class="col-md-12">
<?= $this->Form->create($subCommittee, ['type' => 'file','id'=>'registratiomForm']) ?>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Add Sub Committee Member</h3>
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
							
						<div class="col-sm-12 no-print" style="margin-top:20px;" id="main">		
								<table class="table table-bordered">	
									<thead style="">
										<tr>
											<th width="30%">Member</th>
											<th width="20%">Designation</th>
											<th width="30%">Committee Name</th>
											<th width="20%"></th>
										</tr>
									</thead>
									<tbody>
									 
									</tbody>
							
								</table>
						</div>
						
						
					</div>
				</div>
				<div class="box-footer">
					<center>
					
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) .__(' Submit'),['class'=>'btn btn-primary','type'=>'Submit','name'=>'registration_submit','id'=>'create_notice']) ?>
					</center>
					
				</div>
		</div>
	<?= $this->Form->end() ?>
</div>


				<table id="sample" style="display:none;">
				<tbody>
					<tr>
						<td>
							<?=  $this->Form->input('sub_committees[][user_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a Sub-committee member','label' => false,'class'=>'user_id form-control','options'=>$users,'required'=>'required']);
												
								?>
							
							 <?php echo $this->Form->input('sub_committees[][master_financial_year_id]', ['type' => 'hidden' , 'value'=>'','label' => false , 'class'=>'financial_year']); ?>
							 
							 <?php echo $this->Form->input('sub_committees[][created_by]', ['type' => 'hidden' , 'value'=>''.$user_id.'','label' => false , 'class'=>'created_by']); ?>
							
						</td>
						<td>
							<?=  $this->Form->input('sub_committees[][designation_id]', ['empty'=> '--Select--','data-placeholder'=>'Select a designation','label' => false,'class'=>' designation form-control','options'=>$designations]);
												
							?>
						</td>
						
						<td>
							<?=  $this->Form->input('sub_committees[][committee_name]', ['empty'=> '--Select--','data-placeholder'=>'','label' => false,'class'=>' committee form-control','type'=>'text']);
												
							?>
						</td>
						
						<td>
									
							<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']),['class'=>'btn btn-primary btn-xs add_row','type'=>'button']); ?>
							<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-times']),['class'=>'btn  btn-danger btn-xs remove_row','type'=>'button']); ?>
						</td>
					</tr>
				</tbody>
				</table>

<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script>
function add_row()
{
	var new_line=$("#sample tbody").html();
	
	$("#main tbody").append(new_line);
	$('#main tbody tr:last select').select2();		
	rename_rows();
	//insert_value()
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
	

$(document).on("change",".master_purpose_id",function(){  
		var id=$(this).val();
		$('.financial_year').val(id);
		 
});

function rename_rows()
	{
		var i =0;
		$("#main tbody tr").each(function(){
			
			$(this).find("td select.user_id").attr({name:'sub_committees['+i+'][user_id]',id:'sub_committees-'+i+'-user_id'});

			$(this).find("td input.financial_year").attr({name:'sub_committees['+i+'][master_financial_year_id]',id:'sub_committees-'+i+'-master_financial_year_id'});
			
			$(this).find("td input.created_by").attr({name:'sub_committees['+i+'][created_by]',id:'sub_committees-'+i+'-created_by'});
					
			$(this).find("td select.designation").attr({name:'sub_committees['+i+'][designation_id]'});
			
			$(this).find("td input.committee").attr({name:'sub_committees['+i+'][committee_name]'});
			
			i++;
		});
			
	}

</script>

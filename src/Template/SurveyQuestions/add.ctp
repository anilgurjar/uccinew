<div class="col-md-12">
<?php echo $this->Form->create($surveyQuestion, ['type' => 'file','id'=>'registratiomForm']); ?>
		<div class="box box-primary">
			<div class="box-header with-border">
			<h3 class="box-title">Add Survey Question</h3>
			</div>
			<div class="box-body" style="display: block;">
			<div class="row">
			<div class="col-md-12 pad">
			
			      <div class="col-md-8">
						<div class="form-group">
							<label class="control-label">Question</label>
							<?php echo $this->Form->input('question', ['label' => false,'placeholder'=>'Question','class'=>'form-control']); ?>
						</div>
					</div>
			       
				   <div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Question type</label>
							<?php
						$options=array();
						
							$options['radio'] = 'radio';
							$options['text'] = 'text';
							$options['checkbox'] = 'checkbox';
						
							  echo $this->Form->input('question_type', ['empty'=> '--Select--','data-placeholder'=>'Question type','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
						</div>
					</div>
			      
				</div>
					<div class="col-md-6 pad" id="main">	
					
						<table width="100%">
							<tbody>
								
							</tbody>
						</table>																	
					</div>	
			</div>
			</div>
			<div class="box-footer">
				<center>
				
				<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Submit')  ,['class'=>'btn btn-success','type'=>'Submit','id'=>'submit_member','name'=>'registration_submit']);
					   ?>
				</center>
			</div>
			</div>
			<?php echo $this->Form->end(); ?>
			</div>
		<table id="sample" style="display:none;">
							<tbody>
								<tr>
									
									<td>
									<div class="col-md-12">
										<?php echo $this->Form->input('survey_question_rows[][objective]', ['label' => false,'placeholder'=>'Objective','class'=>'form-control objective ']); ?>
									<div>	
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
$(document).ready(function(){
	$('select[name="question_type"]').on('change',function(){
	var type=$(this).val();
		if(type!='text'){
			add_row();
		}else{
			$("#main tbody").html('');
		}
	});
	
	function add_row()
	{ 
		var new_line=$("#sample tbody").html();
		$("#main tbody").append(new_line);
		rename();
	}	
	
	$(document).on("click",".add_row",function(){ 
		add_row();
		rename();
		
	});
	
	$(document).on("click",".remove_row",function(){ 
		$(this).closest("tr").remove();
		rename();
	});
	function rename(){
		var i=0;
		$("#main tbody tr").each(function(){
			$(this).find("td input.objective").attr({name:'survey_question_rows['+i+'][objective]',id:'survey_question_rows-'+i+'-objective_id'});
		
		i++;
		});
		
	}
	
});
</script>

	
	
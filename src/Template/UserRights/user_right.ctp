<div class="col-md-12">
   <div class="box box-primary">
		<div class="box-header with-border no-print">
			<h3 class="box-title">Assign Module</h3>
		</div>
		<div class="box-body">
<div class="col-md-12">
          
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">User Wise</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Role Wise</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               
				<?php echo $this->Form->create($rights, ['type' => 'post','id'=>'purposeForm','class'=>'form-horizontal cmxform']); ?>
	 	<div class="form-group">
		  <label class="col-sm-2 control-label">User Login</label>
		  <div class="col-sm-4">
			<?php 
						$options=array();
						foreach($fetch_login as $data){
							$options[$data->id]=''.$data->member_name.'          ('.$data->email.')';
						}
                        echo $this->Form->input('user_id', ['empty'=> '--Select--','data-placeholder'=>'Select ID...','label' => false,'class'=>'form-control select2 user_id','options'=>$options,'style'=>'width:100%;','id'=>'user_id']); ?>
			<span class="help-block">
			Provide your login id to assign rights</span>
		  </div>
		</div>
		<div class="" id="user_data">
         </div>
	  
	<?php echo $this->Form->end(); ?>

			   
			   
			   
			   
              </div>
             
              <div class="tab-pane" id="tab_2">
               <?php echo $this->Form->create($rights, ['type' => 'post','id'=>'purposeForm','class'=>'form-horizontal cmxform']); ?>
	 	<div class="form-group">
		  <label class="col-sm-2 control-label">Role Login</label>
		  <div class="col-sm-4">
			<?php 
						$options=array();
						foreach($fetch_role as $data){
							$options[$data->id]= $data->role_name;         
						}
                        echo $this->Form->input('role_id', ['empty'=> '--Select--','data-placeholder'=>'Select Role...','label' => false,'class'=>'form-control select2 role_id','options'=>$options,'style'=>'width:100%;','id'=>'role_id']); ?>
			<span class="help-block">
			Provide your Role id to assign rights</span>
		  </div>
		</div>
		<div class="" id="role_data">
         </div>
	  
	<?php echo $this->Form->end(); ?>
			 </div>
             </div>
           </div>
         
        </div>
		</div>
		</div>
		</div>
<?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
<script type="text/javascript">
$(document).ready(function()
{
	$('#user_id').on('change',function(){
		var user_id=$(this).val();
		
		
		var m_data = new FormData();
		m_data.append('user_id',user_id);
		$.ajax({
			url:"<?php echo $this->Url->build(['controller'=>'UserRights','action'=>'user_right_ajax']); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			async: false,
			type: 'POST',
			dataType:'text',
			success:function(data){
				$("#user_data").html(data);
				$(".page-spinner-bar").addClass(" hide"); 
			}
		});
	});
	
	
	$('#role_id').on('change',function(){  
		var role_id=$(this).val();
		
		
		var m_data = new FormData();
		m_data.append('role_id',role_id);
		$.ajax({
			url:"<?php echo $this->Url->build(['controller'=>'UserRights','action'=>'role_right_ajax']); ?>",
			data: m_data,
			processData: false,
			contentType: false,
			async: false,
			type: 'POST',
			dataType:'text',
			success:function(data){
				$("#role_data").html(data);
				$(".page-spinner-bar").addClass(" hide"); 
			}
		});
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$(document).on('click','#check_all',function(){ 
	
		if($('#check_all').is(":checked"))
		{
			$(".check").prop('checked', true);
		}
		else
		{
			$(".check").removeAttr('checked');
		}
		
	});
		
});		
</script>

<style>
@media print {
  body * {
    visibility: hidden;
	
  }
  .print
  {
	  display:none;
  }
  #fee_data, #fee_data * {
    visibility: visible;
  }
  #fee_data {
	margin-left: auto;
	margin-right: auto;
	left: 0;
	right: 0;
  }
}
</style>
<div class="col-md-12">
   <div class="box box-primary">
		<div class="box-header with-border no-print">
			<h3 class="box-title">Id Card Report</h3>
		</div>
		<div class="box-body">
		<form method="get">
		<div class="col-sm-12 no-print">
			<div class="form-group col-sm-4">
			  <label class="">Member</label>
			 	<?php 
						$options=array();
						foreach($master_member as $master_member_data){
							$options[$master_member_data->id] = $master_member_data->member_name;
						}
                        echo $this->Form->input('member_id', ['empty'=> 'Select a Member','data-placeholder'=>'Select a Company/Organisation','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;']); ?>
			</div>
			
			<div class="form-group col-sm-4">
			  <label class="">Send/Unsend</label>
				<?php 
						$options=array();
							$options['2'] = "Send";
							$options['0'] = "Unsend";
							$options['3'] = "All";
							
                        echo $this->Form->input('send_unsend', ['empty'=> '---SELECT---','data-placeholder'=>'Select...','label' => false,'class'=>'form-control select2','options'=>$options,'style'=>'width:100%;','value'=>'0']); ?>
			</div>
			
		</div>
		<div class="no-print">
		<center>
			<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-file-text'])  .  ' Report' ,['class'=>'btn btn-info','type'=>'submit','style'=>'margin-right:5px;','name'=>'id_card_report','value'=>'id_card_report']); ?>
			
			
		</center>
		</div>
	</form>
	<?php 
	if(!empty($member_user))
	{ 
		?>
	<div class="col-sm-12" id="fee_data">
	<div class="col-sm-12">
	<form method="post">
	<div class="table-responsive no-padding">
		<table class="table table-borderd" style="width: 100%;border: #00c0ef; border-spacing: 0;border-collapse: collapse;" >
			<thead>
				 <tr>
					<th>S.No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Status</th>
					<th><center>Member Send Mail</center><center><input type="checkbox" class="mail_check_all"></center></th>
					<th style="text-align:center">Member View</th>
				</tr>
			</thead>
			<tbody>
<?php		$sr_no=0;
			$grand_total=0; 
			
			foreach($member_user as $data)
			{  
				$member_id=$data->id;
				$status=$data->id_card_email;
				$total=0;
				$sr_no++;
				?>
					<tr>
					<td><?php echo $sr_no; ?></td>
					<td><?php echo $data->member_name; ?></td>
					<td><?php echo $data->email ;?> </td>
					<td><?php echo $data->mobile_no ; ?></td>
					<td width="100px"> <?php if($status==0){echo" <strong style='color:#dd4b39;'> Unsend </strong>"; }elseif($status==1){ echo"<strong style='color:#f39c12;'>Pending </strong>"; }else{ echo"<strong style='color:#00a65a;'>Sent </strong>"; } ?> </td>
					<td><center>
					
					<input type="checkbox" class="mail_check" name="mail[]" value="<?php echo $data->id; ?>"></center>
					</td>
					
					<td><center>
				
					<?php 
					echo $this->Html->link('<i class="fa fa-download"></i> PDF', array('controller' => 'Users', 'action' => 'id_card_pdf',$data->id,1),['class' => 'btn btn-sm btn-primary btn-flat pull-right hide_print', 'target' => '_blank','style'=>'margin-right:5px;','escape'=>false]); ?>
					
					</center>
					</td>
					
					</tr>
	<?php    }   ?></tbody>
					<tfoot>
					<tr>
					<td colspan="8">
					<center>
					
					<?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-mail-forward'])  .  ' Send Mail' ,['class'=>'btn btn-success','type'=>'submit','style'=>'margin-right:5px;','name'=>'member_idcard_send','value'=>'member_idcard_send']); ?>
					</center>
				</td>
				</tr>
			</tfoot>
		</table>
	</div>
	</form>
	</div>
	<?php } ?>
	</div>
	<?php if(!empty($member_user)) { ?>
	<div  class="col-sm-12 no print">
		<div class="pull-left">
			<div style="margin-top: 20px;white-space: nowrap;font-weight: 600;">
			Showing &nbsp; <?= $this->Paginator->counter(); ?></div>
		</div>
		<div class="pull-right" style="float:right;">
			<div class="paginator" style="float:right;">
				<ul class="pagination">
					<?= $this->Paginator->prev(__('Previous')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('Next')) ?>
				</ul>
			</div>
		</div>
	</div>
	<?php } ?>
	</div>
   </div>
</div>
	
  <!-- /.box -->
  <?php echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js'); ?>
 <script>
$(document).ready(function(){

		$('.mail_check_all').on('change',function(){
			if($(this).is(':checked'))
			{
				$('.mail_check').prop('checked',true);
			}
			else
			{
				$('.mail_check').prop('checked',false);
			}
		});
		$('.sms_check_all').on('change',function(){
			if($(this).is(':checked'))
			{
				$('.sms_check').prop('checked',true);
			}
			else
			{
				$('.sms_check').prop('checked',false);
			}
		});
});
</script>
 
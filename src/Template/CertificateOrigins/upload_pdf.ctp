<div class="col-md-12">
  <!-- Horizontal Form -->
  <div class="box box-primary">
	<div class="box-header with-border no-print">
	<center>
	  <h3 class="box-title"><strong>CERTIFICATE OF ORIGIN</strong></h3>
	</center>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<?php $this->Form->templates([
			'inputContainer' => '{{content}}'
		]); 
	?>
	<div class="box-body">
	 <?= $this->Form->create($certificate_origin_good,['method'=>'post','class'=>'form-horizontal','id'=>'certificate_form','enctype' => 'multipart/form-data','onsubmit' => 'return file_submit();'])?> 
		<div class="col-sm-12 no-print">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label">Invoice Attachment</label>
					<table id="file_table" style="line-height:2.5">
						<tr>
							<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?></td>
							<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?></td>
							<td></td>
						</tr>
					</table>
				</div>	
			</div>	
		</div>
		<table id="copy_row" style="display:none;">	
			<tbody>
				<tr>
					<td><?= $this->Form->file('file[]',['multiple'=>'multiple','class'=>'invoice_attachment']); ?></td>
					<td><?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . __(' Add More'), ['class'=>'btn btn-block btn-primary btn-sm add_more','type'=>'button']) ?>
					</td>
					<td>
					<?= $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-trash']) . __(' Delete'), ['class'=>'btn btn-block btn-danger btn-sm delete_row','type'=>'button']) ?></td>
				</tr>
			</tbody>
		</table>
		<div class="col-sm-12 no-print">
			<center>
				<?php
				echo $this->Form->button(__('Save as Draft') . $this->Html->tag('i', '', ['class'=>'fa fa-submit']),['class'=>'btn btn-success','button type'=>'Submit','name'=>'certificate_origin_submit','id'=>'certificate_origin']);
				?>
			</center>
			
		</div>
	  <?php echo $this->Form->end(); ?>
    </div>
	 
 
</div>
<?php
echo $this->Html->script('/assets/plugins/jquery/jquery-2.2.3.min.js');

?>
<script>

function file_submit(){
	
	var x =$('.invoice_attachment').val();
	
	if(x){
			var ext = x.substring(x.lastIndexOf('.') + 1);
			if(ext == "pdf" )
			{
				return true;
			} 
			else
			{
				alert("Upload pdf files only");
				
				return false;
			}

		
	}else{
		
		return true;
	}
	
}

$(document).on('click','button.add_more',function() {
		var row=$('#copy_row tbody').html();
		$('#file_table tbody').append(row);
		
});

$(document).on('click','button.delete_row',function() {
		$(this).closest('tr').remove();
});



$(document).ready(function(){ 

	
$("#certificate_form").validate({
		rules: {
			
			
		},
		submitHandler: function () {
				
				//$("#certificate_origin").attr('disabled','disabled');
				form.submit();
			}
		
	});
	
	
});
</script>	
	
 
				
				
   
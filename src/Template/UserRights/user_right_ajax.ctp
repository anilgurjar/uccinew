<center>
                <table class="table table-bordered table-hover" style="width:50%">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th  style="text-align:center;">Status<br/>
						
						<?php echo $this->Form->checkbox('accc', ['hiddenField' => false,'class'=>'','id'=>'check_all']);  ?>
						</th>
                    </tr>
                </thead>
                <tbody>
		<?php $i=1; foreach($fetch_menu as $data){ $check=""; if(in_array($data->id, $user_right)) { $check="checked"; } ?>
               <tr>
               <td><?php echo $data->name;  ?></td>
               <td style="text-align:center">
			   
			   <?php echo $this->Form->checkbox('module_id[]', ['hiddenField' => false,'class'=>'check','value'=>$data->id,'checked'=>$check]);  ?>
			   
			   </td>
               </tr>
            <?php }  ?> 
			</tbody>
            </table>
                   <div class="form-actions" style="border-top: 1px solid #E5E5E5; padding: 20px 10px;">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                               
								 <?php echo $this->Form->button($this->Html->tag('i', '', ['class'=>'fa fa-plus']) . ' Submit',['class'=>'btn btn-success','type'=>'submit','name'=>'right_submit']); ?>
								
								
                            </div>
                        </div>
                    </div>
                    </center>
           
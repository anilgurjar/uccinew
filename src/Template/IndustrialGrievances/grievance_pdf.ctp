<?php 
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'MoolBoran');
$dompdf = new Dompdf($options);


$html='';
			$html.='<link href="https://fonts.googleapis.com/css?family=Noto+Sans&subset=devanagari" rel="stylesheet">
<style>
  * { font-family: Noto Sans, sans-serif; }
</style>
<h3 style="text-align:center">Grievance </h3>
				
<table >
			
					
				<tr>
					<td width="40%">Grievance Number</td>
					<td>'.str_pad($industrialGrievance->grievance_number, 4, "0", STR_PAD_LEFT).'</td>
				</tr>
				<tr>
					<td width="40%">Member Name</td>
					<td>'.$industrialGrievance->user->member_name .'</td>
				</tr>
				<tr>
					<td>Name of Member Organisation </td>
					<td>'.$industrialGrievance->user->company->company_organisation.'</td>
				</tr>
				<tr>
					<td>Company Address </td>
					<td>'.$industrialGrievance->user->company->address.' '.$industrialGrievance->user->company->city.' '.$industrialGrievance->user->company->pincode .'</td>
				</tr>
			   <tr>
					<td scope="row">Grievance Area</td>
					<td>'. h($industrialGrievance->location).'<br/>'. h($industrialGrievance->contact_details).'</td>
				</tr>
				  
				<tr>
					<td scope="row">Department type</td>
					<td>'.$industrialGrievance->company->company_organisation.'</td>
				</tr>
				 <tr>
					<td scope="row">Grievance Category</td>
					<td>'.h($industrialGrievance->grievance_category->name).'<br/>'. h($industrialGrievance->contact_details).'</td>
				</tr>
				<tr>
					<td scope="row">Grievance issues :</td>
					 <td>'.h($industrialGrievance->grievance_issue->name).'</td>
				</tr>
				
				<tr>
					<td scope="row">Grievance issues related</td>
					<td>'.h($industrialGrievance->grievance_issue_related->name).'</td>
				</tr>
				<tr>
					<td scope="row">Title</td>
					<td>'.h($industrialGrievance->title).'</td>
				</tr>
				<tr>
					<td scope="row">Description</td>
					<td>'.$this->Text->autoParagraph(h($industrialGrievance->description)).'</td>
				</tr>
				<tr>
					<td scope="row">How long you are facing this problem ? </td>
					<td>'.$industrialGrievance->grievance_age.' '. $industrialGrievance->grievance_period.'</td>
				</tr>
				<tr>
					<td scope="row">Have you lodged same grievance earlier with chamber </td>
					<td>'.$industrialGrievance->lodge_same_grievance.'</td>
				</tr>
				<tr>
					<td scope="row">Created on</td>
					<td>'.h(date('d-m-Y', strtotime($industrialGrievance->created_on))).'</td>
				</tr>
			</table>';
			

			$html.='<div class="row" style="margin-right:0px;margin-left:0px;">			
					<div class="col-md-12 pad follow_view">
						<h3 class="box-title"> <center>Grievance Action </center></h3>	
							<table class="table table-bordered">
								<tr>
									<td>Sr no.</td>
									<td width="85">Date</td>
									<td>Departmant</td>
									<td>UCCI</td>
									<td>Member</td>
								</tr>';
										
									$i=0;
									foreach($industrialGrievance->industrial_grievance_follows as $industrial_grievance_follow)
									{ $i++; 

										$html.='<tr>
											<td>'.h($i).'</td>
											<td>'.h(date("d-m-Y",strtotime($industrial_grievance_follow->follow_date))).'</td>
											<td>'.h($industrial_grievance_follow->department_content).'</td>
											<td>'.h($industrial_grievance_follow->ucci_content).'</td>
											<td>'.h($industrial_grievance_follow->member_content).'</td>
										</tr>';

									} 
							$html.='</table>
						</div>	
				</div>
				<div class="row" style="margin-right:0px;margin-left:0px;">
					<div class="col-md-12 pad follow_view">
						<h3 class="box-title"> <center>Grievance History </center></h3>	
							<table class="table table-bordered">
								<tr>
									<td>Sr no.</td>
									<td>Date</td>
									<td>Status</td>
									<td>Description</td>
								</tr>';
										
									$i=0;
									foreach($industrialGrievance->industrial_grievance_statuses as $industrial_grievance_status)
									{ $i++;  
										if($industrial_grievance_status->status=='hold'){
											$Description=$industrial_grievance_status->comment; 
										}else{
											$Description=$industrial_grievance_status->reopen_reason; 
										}
										$html.='<tr>
											<td>'.h($i).'</td>
											<td>'.h(date("d-m-Y",strtotime($industrial_grievance_status->action_date))).'</td>
											<td>'.h($industrial_grievance_status->status).'</td>
											<td>'.$Description.'</td>
										</tr>';
								    }  
				$html.='</table>
					</div>
				</div>';
				
					$dompdf->loadHtml($html);
					$dompdf->setPaper('A4', 'portrait');
					$dompdf->render();
					$dompdf->stream($name,array('Attachment'=>0));
					exit(0);
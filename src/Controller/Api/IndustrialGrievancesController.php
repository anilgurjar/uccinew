<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * IndustrialGrievances Controller
 *
 * @property \App\Model\Table\IndustrialGrievancesTable $IndustrialGrievances
 */
class IndustrialGrievancesController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
	}
	
	public function index()
    {
		//-- 	GrievanceCategories
        $grievanceCategories = $this->IndustrialGrievances->GrievanceCategories->find('all')->count();
		if($grievanceCategories > 0){
			$grievanceCategories = $this->IndustrialGrievances->GrievanceCategories->find('all');
		}
		else {
			$grievanceCategories=(object)[];
		}
		//--	IndustrialDepartments
		$industrialDepartments = $this->IndustrialGrievances->IndustrialDepartments->find('all')->count();
		if($industrialDepartments > 0){
			$industrialDepartments = $this->IndustrialGrievances->IndustrialDepartments->find('all');
		}
		else {
			$industrialDepartments=(object)[];
		}
		//--	GrievanceIssues
		$grievanceIssues = $this->IndustrialGrievances->GrievanceIssues->find('all')->count();
		if($grievanceIssues > 0){
			$grievanceIssues = $this->IndustrialGrievances->GrievanceIssues->find('all')->contain(['GrievanceIssueRelateds']);
		}
		else {
			$grievanceIssues=(object)[];
		}
		$response=array('grievanceCategories'=>$grievanceCategories,
				'industrialDepartments'=>$industrialDepartments,
				'grievanceIssues'=>$grievanceIssues
				);
		$success=true;
		$error="";
		
        $this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
    }
	
    public function add()
    {
		if(!empty($this->request->data['document'])){
			$document = $this->request->data['document'];
		}
		else {
			$document = '';
		}
		
 		$industrialGrievance = $this->IndustrialGrievances->newEntity();
		$created_by=$this->request->data['created_by'];
        if ($this->request->is('post')) {
			$result_user=$this->IndustrialGrievances->find()->select(['grievance_number'])->order(['grievance_number' => 'DESC'])->first();
			$grievance_number=$result_user->grievance_number+1; 
			$this->request->data['grievance_number']=$grievance_number;
			$industrialGrievance = $this->IndustrialGrievances->patchEntity($industrialGrievance, $this->request->data);
            if ($industrialGrievance_data=$this->IndustrialGrievances->save($industrialGrievance)) {
				$coverage_path='';
				$grievance_id=$industrialGrievance_data->id;
				if(!empty($document['tmp_name']))
				{
					
					$ext = substr(strtolower(strrchr($document['name'], '.')), 1); //get the extension
					$setNewFileName = uniqid().".".$ext; 
					$dir = new folder(WWW_ROOT . 'img/grievance/'.$grievance_id, true, 0755);
					$coverage_path='img/grievance/'.$grievance_id.'/'.$setNewFileName;
					move_uploaded_file($document['tmp_name'], WWW_ROOT . '/img/grievance/'.$grievance_id.'/'.$setNewFileName);
					//- 
					$query = $this->IndustrialGrievances->query();
					$query->update()
					->set(['document'=>$coverage_path])
					->where(['id' => $grievance_id])
					->execute();
				}
				//-- SMS COde
				$Users=$this->IndustrialGrievances->Users->find()
					->select(['member_name','mobile_no'])
					->where(['id'=>$created_by])
					->first();
				 
				$member_name=$Users->member_name;
				$mobile_no=$Users->mobile_no;
				if(!empty($mobile_no))
				{
					
					//$sms="Dear ".$member_name." thank you submitting grievance. Your grievance no is ".$grievance_number;
					
					$grievance_number=str_pad($grievance_number, 4, "0", STR_PAD_LEFT);
					
					$sms="We sincerely thank you for contacting our grievance cell we will investigate the grievance by gathering pertinent information against your grievance no ".$grievance_number;
					
					
					$sms1=str_replace(" ", '+', $sms);
					$sms_send=file_get_contents('http://103.39.134.40/api/mt/SendSMS?user=ucciudr&password=7737291465&senderid=ucciud&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$sms1.'&route=7');
				}	
				$success=true;
				$error='';
				$response="successfully submitted";
            } else { 
					$success=false;
					$error="Something went wrong.";
					$response="";
            }
		}
		$this->set(compact('success', 'error', 'response'));
        $this->set('_serialize', ['success', 'error', 'response']); 
	}		

	public function view()
    {
		$grievance_number=$this->request->query('grievance_number');
		$industrialGrievance = $this->IndustrialGrievances->find('all')->where(['grievance_number'=>$grievance_number])->count();
		if($industrialGrievance>0)
		{
			//--- GENERATE PDF and Move ion Folder
			$industrialGrievance = $this->IndustrialGrievances->find('all')->where(['grievance_number'=>$grievance_number])->contain(['Users','IndustrialDepartments','GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses'])->first();
			$name='grievanc_pdf_'.$grievance_number;
			$options = new Options();
			$options->set('defaultFont', 'MoolBoran');
			$dompdf = new Dompdf($options);
			$html='';
			$html.='<link href="https://fonts.googleapis.com/css?family=Noto+Sans&subset=devanagari" rel="stylesheet">
<style>
  * { font-family: Noto Sans, sans-serif; }
</style>
<table>
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
					<td'.$industrialGrievance->user->company_organisation.'</td>
				</tr>
				<tr>
					<td>Company Address </td>
					<td>'.$industrialGrievance->user->address.' '.$industrialGrievance->user->city.' '.$industrialGrievance->user->pincode .'</td>
				</tr>
			   <tr>
					<td scope="row">Grievance Area</td>
					<td>'. h($industrialGrievance->location).'<br/>'. h($industrialGrievance->contact_details).'</td>
				</tr>
				  
				<tr>
					<td scope="row">Department type</td>
					<td>'.$industrialGrievance->industrial_department->department_name.'</td>
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
					<td scope="row">Description</td>
					<td>'.h($industrialGrievance->description).'</td>
				</tr>
				<tr>
					<td scope="row">How long you are facing this problem ? </td>
					<td>'.$industrialGrievance->grievance_age.' '. $industrialGrievance->grievance_period.'</td>
				</tr>
				<tr>
					<td scope="row">Have you lodge same grievance earlier with chamber </td>
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
								</tr>';
										
									$i=0;
									foreach($industrialGrievance->industrial_grievance_follows as $industrial_grievance_follow)
									{ $i++; 

										$html.='<tr>
											<td>'.h($i).'</td>
											<td>'.h(date("d-m-Y",strtotime($industrial_grievance_follow->follow_date))).'</td>
											<td>'.h($industrial_grievance_follow->department_content).'</td>
											<td>'.h($industrial_grievance_follow->ucci_content).'</td>
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
				///-  Create File and Move File to folder
 				$pdf=$dompdf->output();
				$setNewFileName = $name.'.pdf'; 
				$dir = new folder(WWW_ROOT . 'img/grievance/'.$industrialGrievance->id, true, 0755);
				$file_path=str_replace('\\','/',WWW_ROOT).'img/grievance/'.$industrialGrievance->id.'/'.$setNewFileName;
				$insert_path='img/grievance/'.$industrialGrievance->id.'/'.$setNewFileName;
 				file_put_contents($file_path,$dompdf->output());
				
				$query = $this->IndustrialGrievances->query();
					$query->update()
					->set(['grievance_pdf'=>$insert_path])
					->where(['id' => $industrialGrievance->id])
					->execute();
			
			//--- End Of PDF and move in folder
			$success=true;
			$error='';
			$industrialGrievance = $this->IndustrialGrievances->find('all')->where(['grievance_number'=>$grievance_number])->contain(['Users','IndustrialDepartments','GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses'])->first();
			
		}
		else
		{
			$success=false;
			$error='';
			$industrialGrievance = (object)[];
		}
 		$this->set(compact('success', 'error', 'industrialGrievance'));
        $this->set('_serialize', ['success', 'error', 'industrialGrievance']);
     }
	
}

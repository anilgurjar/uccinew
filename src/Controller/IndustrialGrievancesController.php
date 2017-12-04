<?php
namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * IndustrialGrievances Controller
 *
 * @property \App\Model\Table\IndustrialGrievancesTable $IndustrialGrievances
 */
class IndustrialGrievancesController extends AppController
{
	 public $paginate = [
        'limit' => 50
    ];
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->IndustrialGrievances->Companies->get($company_id);
		$role_id=$Companies->role_id;
		
		$this->paginate = [
            'contain' => ['Users']
        ];
		$random_color=['btn btn-success','btn btn-danger','btn btn-info','btn btn-warning'];
       
		$IndustrialDepartments = $this->IndustrialGrievances->Companies->find('list')->where(['role_id'=>5]);
				
		$industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->newEntity();
		
		if($role_id==1 || $role_id==4){
			$IndustrialGrievances = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])
					->contain(['IndustrialGrievances'=>function($q){return $q->where(['complete_status IN'=>['running','hold']])
						->order(['complete_status'=>'DESC'])
						->contain(['Users'=>['Companies'],'IndustrialGrievanceFollows'=>function($qfollow){
							return $qfollow->order(['id'=>'DESC']);
						}]);
				}]);
		}else{
			$IndustrialGrievances = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])
					->contain(['IndustrialGrievances'=>function($q)use($company_id){return $q->where(['complete_status IN'=>['running'],'created_by'=>$company_id])
						->order(['complete_status'=>'DESC'])
						->contain(['Users'=>['Companies'],'IndustrialGrievanceFollows'=>function($qfollow){
							return $qfollow->order(['id'=>'DESC']);
						}]);
				}]);
		}	
			
		pr($IndustrialGrievances->toArray());    exit;	
					
        $this->set(compact('IndustrialGrievances', 'IndustrialDepartments','random_color','role_id','industrialGrievance'));
        $this->set('_serialize', ['industrialGrievances','industrialGrievance']);
    }

	
	
	
	
	
	
	
	public function industrialGrievanceViewPublished()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->IndustrialGrievances->Companies->get($company_id);
		$role_id=$Companies->role_id;
		$this->paginate = [
            'contain' => ['Users']
        ];
		$random_color=['btn btn-success','btn btn-danger','btn btn-info','btn btn-warning'];
       
		$IndustrialDepartments = $this->IndustrialGrievances->Companies->find('list')->where(['role_id'=>5]);
				
		$industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->newEntity();
		
		
			$IndustrialGrievances = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])
			->contain(['IndustrialGrievances'=>function($q){
				return $q->where(['complete_status IN'=>['published']])
						->order(['complete_status'=>'DESC'])
						->contain(['Users'=>['Companies'],'IndustrialGrievanceFollows'=>function($qfollow){
							return $qfollow->order(['id'=>'DESC']);
						}]);
			}]);
			
			
			
					
        $this->set(compact('IndustrialGrievances', 'IndustrialDepartments','random_color','industrialGrievance'));
        $this->set('_serialize', ['industrialGrievances','industrialGrievance']);
	}
	
	
	
 
	public function industrialGrievancePublishedView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		
		if(isset($this->request->data['view']))
		{ 
	
			$grienance_id=$this->request->data['view'];
			$industrialGrievance = $this->IndustrialGrievances->get($grienance_id, [
            'contain' => ['Companies','GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses','Users'=>['Companies']]
			]);
			$IndustrialGrievances = $this->IndustrialGrievances->newEntity();
		
			$dir = new Folder(WWW_ROOT . 'img/grievance/'.$grienance_id);
			$file_path = str_replace("\\","/",WWW_ROOT).'img/grievance/'.$grienance_id;

			$files = $dir->find('.*', true);
			$this->set('id', $grienance_id);
			$this->set('files', $files);
			$this->set('file_path', $file_path);
			$IndustrialDepartments = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])->toArray();
			$this->set('industrialGrievance', $industrialGrievance);
			$this->set('IndustrialDepartments', $IndustrialDepartments);
			$this->set('_serialize', ['IndustrialGrievances']);
			$this->set('IndustrialGrievances', $IndustrialGrievances);
			
		}
		if($this->request->is('post')) 
		{		
			  			
			if(isset($this->request->data['grievance_accept_submit']))
			{
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['grievance_accept_submit'];
				$industrial_grievances=$this->IndustrialGrievances->get($id,  [ 'contain'=>['Companies'=>['Users'=>function($q){
				return $q->where(['member_nominee_type IN'=>['first']]);}],'GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses','Users'=>['Companies']]]);
				$grievance_numbers=$this->IndustrialGrievances->find()->select(['grievance_number'])->order(['grievance_number'=>'DESC'])->first();
				$this->request->data['grievance_number'] = @$grievance_numbers->grievance_number+1;
				$this->request->data['accept_by']=$user_id;
				$this->request->data['accept_on']=date('Y-m-d h:i:s');
				$this->request->data['complete_status']='running';
				
				$Industrialgrievances = $this->IndustrialGrievances->patchEntity($industrial_grievances, $this->request->data);
				
				if($Industrial_Grievances=$this->IndustrialGrievances->save($Industrialgrievances))
				{
					$member_name=$Industrial_Grievances['user']->member_name;
					$member_email=$Industrial_Grievances['user']->email;
					$department_name=$Industrial_Grievances['company']->company_organisation;
					$department_email=$Industrial_Grievances['company']['users'][0]->email;
					$sub="Industrial Grievance is Accept";
					$from_name="UCCI";
					//$email_to=trim($member_email,'');
					$email_to='anilgurjer371@gmail.com';
					//$email_to1=trim($department_email,'');
					$email_to1='anilgurjer371@gmail.com';
					
					if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('grievance_accept_for_member')
								->emailFormat('html')
								->viewVars(['member_name'=>$member_name]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						} 
						
						if(!empty($email_to1)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to1)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('grievance_accept_for_department')
								->emailFormat('html')
								->viewVars(['department_name'=>$department_name]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
					
			        
					$this->Flash->success(__('Industrial Grievance has been Accept.'));
					return $this->redirect(['action' => 'industrial-grievance-view-published']);
			}											
				$this->Flash->error(__('Unable to Accept Industrial Grievance.'));
			}
			else if(isset($this->request->data['grievance_notaccept_submit']))
			{
					
				$id=$this->request->data['grievance_notaccept_submit'];
				$industrial_grievances=$this->IndustrialGrievances->get($id,  [ 'contain'=>['Companies'=>['Users'=>function($q){
				return $q->where(['member_nominee_type IN'=>['first']]);}],'GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses','Users'=>['Companies']]]);
				
				$remarks=$this->request->data['verify_remarks'];
				$this->request->data['accept_by']=$user_id;
				$this->request->data['accept_on']=date('Y-m-d h:i:s');
				$this->request->data['complete_status']='not-accept';
				
				 
				$industrialgrievances = $this->IndustrialGrievances->patchEntity($industrial_grievances, $this->request->data);
				
				$email = new Email();
				$email->transport('SendGrid');
			if($IndustrialGrievances=$this->IndustrialGrievances->save($industrialgrievances))
				{
					
						$mailsendtomember=$IndustrialGrievances['user']['member_name'];
						$mailsendtoemail=$IndustrialGrievances['user']['email'];
						$sub="Industrial Grievance is Not Accept";
						$from_name="UCCI";
						$email_to=trim($mailsendtoemail,' ');
						$email_to="anilgurjer371@gmail.com";
					if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('industrial_grievance_not_accept')
								->emailFormat('html')
								->viewVars(['member_name'=>$mailsendtomember,'remarks'=>$remarks]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
						
					$this->Flash->success(__('Industrial Grievance has been not Accept.'));
					return $this->redirect(['action' => 'industrial-grievance-view-published']);
				}
				$this->Flash->error(__('Unable to not Accept Industrial Grievance.'));
			}
		}
	}	
		
	
	
	
	
	
	
	
    /**
     * View method
     *
     * @param string|null $id Industrial Grievance id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $industrialGrievance = $this->IndustrialGrievances->get($id, [
            'contain' => ['Companies','GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses','Users'=>['Companies']]
        ]);
		
		$dir = new Folder(WWW_ROOT . 'img/grievance/'.$id);
		$file_path = str_replace("\\","/",WWW_ROOT).'img/grievance/'.$id;

		$files = $dir->find('.*', true);
		$this->set('id', $id);
		$this->set('files', $files);
		$this->set('file_path', $file_path);
		$IndustrialDepartments = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])->toArray();
        $this->set('industrialGrievance', $industrialGrievance);
        $this->set('IndustrialDepartments', $IndustrialDepartments);
        $this->set('_serialize', ['industrialGrievance']);
    }

	  public function grievancePdf($id = null)
		{
			 $industrialGrievance = $this->IndustrialGrievances->get($id, [
            'contain' => ['Companies','GrievanceIssues','GrievanceIssueRelateds','GrievanceCategories','IndustrialGrievanceFollows','IndustrialGrievanceStatuses','Users'=>['Companies']]
			]);
			
			$dir = new Folder(WWW_ROOT . 'img/grievance/'.$id);
			$file_path = str_replace("\\","/",WWW_ROOT).'img/grievance/'.$id;

			$files = $dir->find('.*', true);
			$this->set('id', $id);
			$this->set('files', $files);
			$this->set('file_path', $file_path);
			$IndustrialDepartments = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])->toArray();
			$this->set('industrialGrievance', $industrialGrievance);
			$this->set('IndustrialDepartments', $IndustrialDepartments);
			$this->set('_serialize', ['industrialGrievance']);
			
			
		}
	
	
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
	 
		public function grievanceRelatedIssuse($id=null)
		{
			
			$GrievanceIssueRelated = $this->IndustrialGrievances->GrievanceIssueRelateds->find('list')
									->where(['grievance_issue_id'=>$id]);
			
			 $this->set(compact('GrievanceIssueRelated'));
								
		}	
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		
		
		$result_users=$this->IndustrialGrievances->Users->get($user_id,['contain'=>'Companies']);
		$mobile_no=$result_users->mobile_no;
		$email_to=$result_users->email; 
		$member_name=$result_users->member_name;
		$company_organisation=$result_users->company->company_organisation;
		$address=$result_users->company->address;
		
		$city=$result_users->company->city;
		$pincode=$result_users->company->pincode;
				
        $industrialGrievance = $this->IndustrialGrievances->newEntity();
        if ($this->request->is('post')) {
			
			
			$files=$this->request->data['file']; 
			$file_name=$files[0]['name'];
			
			if(!empty($files[0]['name'])){
				$this->request->data['file']='true';
			}else{
				$this->request->data['file']='false';
			}
		
			$this->request->data['file_name'] = $file_name;
			$this->request->data['created_by'] = $user_id;
			$industrialGrievance = $this->IndustrialGrievances->patchEntity($industrialGrievance, $this->request->data);
			
            if ($industrialGrievance_data=$this->IndustrialGrievances->save($industrialGrievance)) {
				$coverage_path='';
				$grievance_id=$industrialGrievance_data->id; 
				 $grievance_number=$industrialGrievance_data->grievance_number;
					$grievance_number=str_pad($grievance_number, 4, "0", STR_PAD_LEFT);
						
				
					if(!empty($mobile_no)){
						
						
						
						$sms="We sincerely thank you for contacting our grievance cell. We will investigate the grievance by gathering pertinent information against your grievance no ".$grievance_number;
						
						
						$sms1=str_replace(" ", '+', $sms);
						//$sms_send=file_get_contents('http://103.39.134.40/api/mt/SendSMS?user=ucciudr&password=7737291465&senderid=ucciud&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$sms1.'&route=7');
					}
					$email_to='anilgurjer371@gmail.com';
					if(!empty($email_to)){
						$from_name="UCCI";
						$subject="Grievance Enquiry Acknowledgement";
						$email = new Email();
						$email->transport('SendGrid');
						try {
								$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($subject)
								->profile('default')
								->template('grievance_add')
								->emailFormat('html')
								->viewVars(['grievance_number'=>$grievance_number,'member_name'=>$member_name]);
								$email->send();	
								
						} catch (Exception $e) {
							echo 'Exception : ',  $e->getMessage(), "\n";

						}
					
					}
					
					
				
				
				if(!empty($files[0]['name'])){
					$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the 
					$setNewFileName = uniqid();
					$dir = new Folder(WWW_ROOT . 'img/grievance/'.$grievance_id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/grievance/'.$grievance_id;
					$coverage_path='img/grievance/'.$grievance_id.'/'.$setNewFileName.'.'.$ext;
					
					foreach($files as $file){
						move_uploaded_file($file['tmp_name'], $file_path.'/' . $setNewFileName.'.'.$ext);
						
					}
				}
				
				$query = $this->IndustrialGrievances->query();
				$query->update()
				->set(['document'=>$coverage_path,'complete_status'=>'published'])
				->where(['id' => $grievance_id])
				->execute();
                $this->Flash->success(__('Thanking You  for industrial grievance It has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
				$this->Flash->error(__('The industrial grievance could not be saved. Please, try again.'));
            }
        }
        $IndustrialDepartments = $this->IndustrialGrievances->Companies->find('list')->where(['role_id'=>5])->toArray();
		
		
		$grievancecategorys = $this->IndustrialGrievances->GrievanceCategories->find('list');
		$GrievanceIssues = $this->IndustrialGrievances->GrievanceIssues->find('list');
        $this->set(compact('industrialGrievance', 'IndustrialDepartments', 'company_organisation', 'address', 'pincode', 'city','grievancecategorys','GrievanceIssues'));
        $this->set('_serialize', ['industrialGrievance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Industrial Grievance id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_organisation=$this->Auth->User('company_organisation');
		$address=$this->Auth->User('address');
		$user_id=$this->Auth->User('id');
		$city=$this->Auth->User('city');
		$pincode=$this->Auth->User('pincode');
        $industrialGrievance = $this->IndustrialGrievances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$files=$this->request->data['file']; 
					
			if(!empty($files[0]['name'])){
				$this->request->data['file']='true';
			}else{
				$this->request->data['file']='false';
			}
			//$this->request->data['industrial_department_id'] = implode(",",$this->request->data['industrial_department_id']);
			$this->request->data['repair_maintenance'] = implode(",",$this->request->data['repair_maintenance']);
			$this->request->data['construction'] = implode(",",$this->request->data['construction']);
			$this->request->data['clearance_matter'] = implode(",",$this->request->data['clearance_matter']);
			$this->request->data['issue_regarding'] = implode(",",$this->request->data['issue_regarding']);
			$this->request->data['user_id'] = $user_id;
			$this->request->data['grievance_pending'] = date('Y-m-d', strtotime($this->request->data['grievance_pending']));
            $industrialGrievance = $this->IndustrialGrievances->patchEntity($industrialGrievance, $this->request->data);
            if ($industrialGrievance_data=$this->IndustrialGrievances->save($industrialGrievance)) {
				
				$grievance_id=$industrialGrievance_data->id; 
				
				$dir = new Folder(WWW_ROOT . 'img/grievance/'.$grievance_id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/grievance/'.$grievance_id;
				foreach($files as $file){
					move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				
				}
                $this->Flash->success(__('The industrial grievance has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The industrial grievance could not be saved. Please, try again.'));
            }
        }

		$IndustrialDepartments = $this->IndustrialGrievances->IndustrialDepartments->find()->toArray();
       
        $this->set(compact('industrialGrievance', 'IndustrialDepartments', 'company_organisation', 'address', 'pincode', 'city'));
        $this->set('_serialize', ['industrialGrievance']);
    }
	public function deleteGrievanceFile($grievance_id = null, $file_name = null)
    {
		unlink(WWW_ROOT . '/img/grievance/'.$grievance_id.'/'.$file_name);
	}
	
	
	public function grievanceFollow()
    {
		$this->viewBuilder()->layout(null);
		
		
		$industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->newEntity();
		$id=$this->request->data['industrial_grievance_id'];
	
		$industrialGrievance_follow = $this->IndustrialGrievances->get($id, [
            'contain' =>['Companies','Users','IndustrialGrievanceFollows']
        ]);
		//pr($industrialGrievance_follow);   exit;
		
		
		$department_name=$industrialGrievance_follow->company->company_organisation; 
		$email_to=$industrialGrievance_follow->user->email; 
		$member_name=$industrialGrievance_follow->user->member_name;
		$mobile_no=$industrialGrievance_follow->user->mobile_no; 
		$email = new Email();
		$email->transport('SendGrid');
		
		/* //$mobile_no='9887779123';
		//pr($industrialGrievance_follow); exit;
		
		$sms="hello testing for grivenese";
		$sms1=str_replace(" ", '+', $sms);
		$sms_send=file_get_contents('http://103.39.134.40/api/mt/SendSMS?user=ucciudr&password=7737291465&senderid=ucciud&channel=Trans&DCS=0&flashsms=0&number='.$mobile_no.'&text='.$sms1.'&route=7');
		 */
		 
		 	$this->request->data['industrial_grievance_id'] = $id;		
            $industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->patchEntity($industrialGrievance, $this->request->data);
			
            if ($industrialGrievance_data=$this->IndustrialGrievances->IndustrialGrievanceFollows->save($industrialGrievance)) {
				
			$industrialGrievance_id=$industrialGrievance_data->id;
			
			$industrialGrievance_follows = $this->IndustrialGrievances->IndustrialGrievanceFollows->get($industrialGrievance_id);
			$department_content=$industrialGrievance_follows->department_content;
			$ucci_content=$industrialGrievance_follows->ucci_content;
			
			/* $email_to="rohitkumarjoshi43@gmail.com";
			$from_name="UCCI";
			$subject="Industrial Grievance Follow";
			  try {
				$email->from(['ucciudaipur@gmail.com' => $from_name])
					->to($email_to)
					->replyTo('uccisec@hotmail.com')
					->subject($subject)
					->profile('default')
					->template('industrial_grievance_follow')
					->emailFormat('html')
					->viewVars(['department_content'=>$department_content,'ucci_content'=>$ucci_content,'member_name'=>$member_name,'department_name'=>$department_name]);
					
					$email->send();
				
				
		} catch (Exception $e) {
			
			echo 'Exception : ',  $e->getMessage(), "\n";

		}   */
	   
	
                $this->Flash->success(__('The industrial grievance follow has been saved.'));

                //return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The industrial grievance follow could not be saved. Please, try again.'));
            }
       
		
    }
	
	public function grievanceCancel()
	{
		
		
		 
		 $user_id=$this->Auth->User('id');
		 $close_date=date("Y-m-d"); 
		 $comment=$this->request->data['comment'];
		 $industrial_grievance_id=$this->request->data['industrial_grievance_id']; 
		 $query = $this->IndustrialGrievances->query();
				$query->update()
				->set(['comment' => $comment,'complete_status'=>'hold','close_date'=>$close_date])
				->where(['id' => $industrial_grievance_id])
				->execute();
			
			$industrial_status = $this->IndustrialGrievances->IndustrialGrievanceStatuses->newEntity();	
			 $industrial_status->user_id=$user_id;
			$industrial_status->status='hold';
			$industrial_status->comment=$comment;
			$industrial_status->industrial_grievance_id=$industrial_grievance_id;

			$this->IndustrialGrievances->IndustrialGrievanceStatuses->save($industrial_status);
			
			// email code 
			
		/* 	$industrialGrievance = $this->IndustrialGrievances->get($industrial_grievance_id, [
			'contain' => ['Users']
			]);
		
			
			$email=$industrialGrievance->user->email;
			$member_name=$industrialGrievance->user->member_name;
			
			 */

		exit;
	}
	
	public function grievanceReopen(){
		
		 $user_id=$this->Auth->User('id');
		 $reopen_reason=$this->request->data['reopen_reason'];
		 $industrial_grievance_id=$this->request->data['industrial_grievance_id'];
		 
		  $query = $this->IndustrialGrievances->query();
				$query->update()
				->set(['reopen_reason' => $reopen_reason,'complete_status'=>'running'])
				->where(['id' => $industrial_grievance_id])
				->execute();
			
			$industrial_status = $this->IndustrialGrievances->IndustrialGrievanceStatuses->newEntity();	
			$industrial_status->user_id=$user_id;
			$industrial_status->status='reopen';
			$industrial_status->reopen_reason=$reopen_reason;
			$industrial_status->industrial_grievance_id=$industrial_grievance_id;
			$this->IndustrialGrievances->IndustrialGrievanceStatuses->save($industrial_status);
			
		exit;
	}
	
	public function grievanceDepartmentReport()
	{
		$this->viewBuilder()->layout('index_layout');
		
		
		$IndustrialGrievances = $this->IndustrialGrievances->IndustrialDepartments->find()->contain(['IndustrialGrievances'=>function($q){
			return $q->where(['complete_status'=>'inprogress'])->contain(['Users','IndustrialGrievanceFollows'=>function($qfollow){
				return $qfollow->order(['id'=>'DESC']);
			}]);
		}]);
			
		$this->set(compact('IndustrialGrievances'));
		
	}
	public function grievanceDepartmentExport() {
		
		$IndustrialGrievances = $this->IndustrialGrievances->IndustrialDepartments->find()->contain(['IndustrialGrievances'=>function($q){
			return $q->where(['complete_status'=>'inprogress'])->contain(['Users','IndustrialGrievanceFollows'=>function($qfollow){
				return $qfollow->order(['id'=>'DESC']);
			}]);
		}]);
		$sr_no=0;
		$_header=['S.No.', 'Departmant Name', 'Point', 'Complainant', 'Action Taken By Department', 'Action Taken By UCCI'];
		
		foreach ($IndustrialGrievances as $departments): 
			foreach($departments->industrial_grievances as $industrial_grievance) :
				foreach($industrial_grievance->industrial_grievance_follows as $industrial_grievance_follow):
						
					$department_content=$industrial_grievance_follow->department_content;
					$ucci_content=$industrial_grievance_follow->ucci_content;
						
					goto a;
				endforeach;
					a:
				$contain[]=[ ++$sr_no, $departments->department_name, $industrial_grievance->address_issue, $industrial_grievance->user->company_organisation,$department_content,$ucci_content];
				
			endforeach;		
		endforeach;
	
		$_serialize = 'contain';
		
   		$this->response->download('Invoice Payment Received report.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
		
	}
	public function grievanceReport()
    {
		$this->viewBuilder()->layout('index_layout');
		$IndustrialDepartments = $this->IndustrialGrievances->Companies->find()->where(['role_id'=>5])->toArray();
		$this->set(compact('IndustrialDepartments'));
    }
	public function grievanceReportAjax()
    {
		$this->viewBuilder()->layout('ajax');
		
		$IndustrialGrievances = $this->IndustrialGrievances->find()->where(['complete_status'=>'inprogress','industrial_department_id'=>$this->request->query('id')])->contain(['Users','IndustrialGrievanceFollows'=>function($qfollow){
			return $qfollow->order(['id'=>'DESC']);
		}]);
		
		$this->set(compact('IndustrialGrievances'));
    }
	
	public function industrialGrievanceAjax($id=null,$from=null,$to=null)
    {
		$this->viewBuilder()->layout('ajax');
	
		
		$industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->newEntity();
		$conditions['complete_status in']=['running','hold'];
		if(!empty($id)){
			$conditions['industrial_department_id']=$id;
			
		}
		
	    if(!empty($from)){
            $conditions['created_on >=']=date('Y-m-d 00:00:01',strtotime($from));
        }
		
        if(!empty($to)){
            $conditions['created_on <=']=date('Y-m-d 23:59:59',strtotime($to));
        }
		
		$IndustrialGrievances = $this->IndustrialGrievances->find()->where($conditions)->order(['complete_status'=>'DESC'])->contain(['Users','Companies','IndustrialGrievanceFollows'=>function($qfollow){
			return $qfollow->order(['id'=>'DESC']);
		}]);
		
			
		$this->set(compact('IndustrialGrievances','industrialGrievance'));
    }
	
	
	
	public function industrialGrievanceAjaxPublished($id=null,$from=null,$to=null)
    {
		$this->viewBuilder()->layout('ajax');
	
		
		$industrialGrievance = $this->IndustrialGrievances->IndustrialGrievanceFollows->newEntity();
		$conditions['complete_status in']=['published'];
		if(!empty($id)){
			$conditions['industrial_department_id']=$id;
			
		}
		
	    if(!empty($from)){
            $conditions['created_on >=']=date('Y-m-d 00:00:01',strtotime($from));
        }
		
        if(!empty($to)){
            $conditions['created_on <=']=date('Y-m-d 23:59:59',strtotime($to));
        }
		
		$IndustrialGrievances = $this->IndustrialGrievances->find()->where($conditions)->order(['complete_status'=>'DESC'])->contain(['Users','Companies','IndustrialGrievanceFollows'=>function($qfollow){
			return $qfollow->order(['id'=>'DESC']);
		}]);
		
			
		$this->set(compact('IndustrialGrievances','industrialGrievance'));
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Industrial Grievance id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $industrialGrievance = $this->IndustrialGrievances->get($id);
        if ($this->IndustrialGrievances->delete($industrialGrievance)) {
            $this->Flash->success(__('The industrial grievance has been deleted.'));
        } else {
            $this->Flash->error(__('The industrial grievance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

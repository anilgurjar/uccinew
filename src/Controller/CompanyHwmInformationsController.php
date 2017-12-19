<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
/**

/**
 * CompanyHwmInformations Controller
 *
 * @property \App\Model\Table\CompanyHwmInformationsTable $CompanyHwmInformations
 */
class CompanyHwmInformationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout','payment']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		header('Content-type: text/html');
		header('Access-Control-Allow-Origin: *'); 
	}
	
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $companyHwmInformations = $this->paginate($this->CompanyHwmInformations);

        $this->set(compact('companyHwmInformations'));
        $this->set('_serialize', ['companyHwmInformations']);
    }

    public function view($id = null)
    {
        $companyHwmInformation = $this->CompanyHwmInformations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('companyHwmInformation', $companyHwmInformation);
        $this->set('_serialize', ['companyHwmInformation']);
    }

    public function add()
    {
        $companyHwmInformation = $this->CompanyHwmInformations->newEntity();
        if ($this->request->is('post')) {
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
                $this->Flash->success(__('The company hwm information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company hwm information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyHwmInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyHwmInformation', 'companies'));
        $this->set('_serialize', ['companyHwmInformation']);
    }

    public function edit($id = null)
    {
        $companyHwmInformation = $this->CompanyHwmInformations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
                $this->Flash->success(__('The company hwm information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company hwm information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyHwmInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyHwmInformation', 'companies'));
        $this->set('_serialize', ['companyHwmInformation']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyHwmInformation = $this->CompanyHwmInformations->get($id);
        if ($this->CompanyHwmInformations->delete($companyHwmInformation)) {
            $this->Flash->success(__('The company hwm information has been deleted.'));
        } else {
            $this->Flash->error(__('The company hwm information could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	//-- DSU CODE
	public function hwmPublishedView()
    {
        $user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
 		$CompanyHwmInformations = $this->CompanyHwmInformations->find()
			->contain(['Companies'=>['Users']])
			->where(['CompanyHwmInformations.status'=>'published'])
			->order(['CompanyHwmInformations.id'=>'DESC']);
			
        $this->set(compact('CompanyHwmInformations'));
        $this->set('_serialize', ['CompanyHwmInformations']);
		
		if($this->request->is('post')) 
		{
			
			if(isset($this->request->data['hwm_approve_submit']))
			{
				$email = new Email();
				$email->transport('SendGrid');
				$id=$this->request->data['user_id'];
				$hwm_id=$this->request->data['hwm_approve_submit'];
				$Users=$this->CompanyHwmInformations->Companies->Users->get($id,['contain'=>['Companies'=>['Users']]]);
				$exporter_name=ucwords($Users->member_name);
				
				$CompanyHwmInformations=$this->CompanyHwmInformations->get($hwm_id,['contain'=>['Companies'=>['Users']]]);
				
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='verified';
				$this->request->data['hwm_verify_email']='yes';
				
				$CompanyHwmInformations = $this->CompanyHwmInformations->patchEntity($CompanyHwmInformations, $this->request->data);
  				if($this->CompanyHwmInformations->save($CompanyHwmInformations))
				{
					$certificates_data = base64_encode($hwm_id);
					
					$authorise_person_mails=$this->CompanyHwmInformations->CertificateOriginAuthorizeds->find()->contain(['Users']);
					
					foreach($authorise_person_mails as $authorise_person_mail)
					{
						$emailperson_id=$authorise_person_mail['user']->id;
						$emailperson=$authorise_person_mail['user']->member_name;
						$emailsend=$authorise_person_mail['user']->email;
 						$emailperson_id = base64_encode($emailperson_id);
						//$url="http://localhost/uccinew/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id."";
						 
						//$url="http://www.ucciudaipur.com/uccinew/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id.""; 
						
						//$url="http://www.ucciudaipur.com/app/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id.""; 
						
						$sub="Hazardous Waste Management Application is Varified";
						$from_name="UCCI";
						$email_to=trim($emailsend,' ');
						$email_to='anilgurjer371@gmail.com';
						if(!empty($email_to)){		
							try {
								$email->from(['ucciudaipur@gmail.com' => $from_name])
									->to($email_to)
									->replyTo('uccisec@hotmail.com')
									->subject($sub)
									->profile('default')
									->template('hwm_varify')
									->emailFormat('html')
									->viewVars(['member_name'=>$emailperson,'url'=>$url,'exporter_name'=>$exporter_name]);
									$email->send();
								} catch (Exception $e) {
									
									echo 'Exception : ',  $e->getMessage(), "\n";

								} 
							}
					}	
				
					$this->Flash->success(__('HWM Application from has been verified.'));
					return $this->redirect(['action' => 'hwmPublishedView']);
				}
				$this->Flash->error(__('Unable to verify HWM Application.'));
			}
			else if(isset($this->request->data['hwm_notapprove_submit']))
			{
 				$hwm_id=$this->request->data['hwm_notapprove_submit'];
				$CompanyHwmInformations=$this->CompanyHwmInformations->get($hwm_id,['contain'=>['Companies'=>['Users']]]);
			
				$remarks=$this->request->data['verify_remarks'];
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='draft';
				$this->request->data['authorised_remarks']='';
				 
				$CompanyHwmInformations = $this->CompanyHwmInformations->patchEntity($CompanyHwmInformations, $this->request->data);
				$email = new Email();
				$email->transport('SendGrid');
				if($this->CompanyHwmInformations->save($CompanyHwmInformations))
				{
					foreach($CompanyHwmInformations['company']['users'] as $CertificateOrigin)
					{
 						$mailsendtomember=$CertificateOrigin['member_name'];
						$mailsendtoemail=$CertificateOrigin['email']; 
						$sub="Hazardous Waste Management Application is Not Varified";
						$from_name="UCCI";
						$email_to=trim($mailsendtoemail,' ');
						$email_to='anilgurjer371@gmail.com'; 
						if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('hwm_not_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$mailsendtomember,'remarks'=>$remarks]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
					}
					$this->Flash->success(__('HWM application form has been not verify.'));
					return $this->redirect(['action' => 'hwmPublishedView']);
				}
				$this->Flash->error(__('Unable to not verify HWM application.'));
			}
		}
    }
	
	public function hwmVerifiedView()
    {
        $user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
 		$CompanyHwmInformations = $this->CompanyHwmInformations->find()
			->contain(['Companies'=>['Users']])
			->where(['CompanyHwmInformations.status'=>'verified'])
			->order(['CompanyHwmInformations.id'=>'DESC']);
			
        $this->set(compact('CompanyHwmInformations'));
        $this->set('_serialize', ['CompanyHwmInformations']);
		
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['hwm_approve_submit']))
			{
				$email = new Email();
				$email->transport('SendGrid');
				$id=$this->request->data['user_id'];
				$hwm_id=$this->request->data['hwm_approve_submit'];
				$Users=$this->CompanyHwmInformations->Companies->Users->get($id,['contain'=>['Companies'=>['Users']]]);
				$exporter_name=ucwords($Users->member_name);
				
				$CompanyHwmInformations=$this->CompanyHwmInformations->get($hwm_id,['contain'=>['Companies'=>['Users']]]);
				$email_to=$CompanyHwmInformations->company->users[0]->email; 
				$member_name=$CompanyHwmInformations->company->users[0]->member_name;
				$Users= $this->CompanyHwmInformations->Companies->Users->get($user_id);
				$regards_member_name=$Users->member_name;
				
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='approved';
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']='';  
				$CompanyHwmInformations = $this->CompanyHwmInformations->patchEntity($CompanyHwmInformations, $this->request->data);
				
  				if($this->CompanyHwmInformations->save($CompanyHwmInformations))
				{
					$sub="Your Hazardous Waste Management Application is approved";
					$from_name="UCCI";
					$email_to=trim($email_to,' ');
					$email_to='anilgurjer371@gmail.com';
					if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
									->to($email_to)
									->replyTo('uccisec@hotmail.com')
									->subject($sub)
									->profile('default')
									->template('hwm_approve')
									->emailFormat('html')
									->viewVars(['member_name'=>$member_name]);
									$email->send();									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
				
					$this->Flash->success(__('HWM Application from has been approved.'));
					return $this->redirect(['action' => 'hwmVerifiedView']);
				}
				$this->Flash->error(__('Unable to approve HWM Application.'));
			}
			else if(isset($this->request->data['hwm_notapprove_submit']))
			{
 				$hwm_id=$this->request->data['hwm_notapprove_submit'];
				$CompanyHwmInformations=$this->CompanyHwmInformations->get($hwm_id,['contain'=>['Companies'=>['Users']]]);
			
				$remarks=$this->request->data['authorised_remarks'];
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
 				$CompanyHwmInformations = $this->CompanyHwmInformations->patchEntity($CompanyHwmInformations, $this->request->data);
 				if($this->CompanyHwmInformations->save($CompanyHwmInformations))
				{ 
					$this->Flash->success(__('HWM application form has been rejected.'));
					return $this->redirect(['action' => 'hwmVerifiedView']);
				}
				$this->Flash->error(__('Unable to reject HWM application.'));
			}
		}
    }
	public function hwmDraftedView()
    {
        $user_id=$this->Auth->User('id');
		$data=$this->CompanyHwmInformations->Companies->Users->get($user_id);
		$company_id=$data->company_id;  
		$this->viewBuilder()->layout('index_layout');
 		$CompanyHwmInformations = $this->CompanyHwmInformations->find()
			->contain(['Companies'=>['Users']])
			->where(['CompanyHwmInformations.status'=>'draft','CompanyHwmInformations.company_id'=>$company_id])
			->order(['CompanyHwmInformations.id'=>'DESC']);
		$this->set(compact('CompanyHwmInformations'));
        $this->set('_serialize', ['CompanyHwmInformations']);
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['hwm_approve_submit']))
			{
				$hwm_id=$this->request->data['hwm_approve_submit'];
				$CompanyHwmInformations=$this->CompanyHwmInformations->get($hwm_id,['contain'=>['Companies'=>['Users']]]);
				$email_to=$CompanyHwmInformations->company->users[0]->email; 
				$member_name=$CompanyHwmInformations->company->users[0]->member_name;
				$Users= $this->CompanyHwmInformations->Companies->Users->get($user_id);
				$regards_member_name=$Users->member_name;
				$this->request->data['status']='published';
				$CompanyHwmInformations = $this->CompanyHwmInformations->patchEntity($CompanyHwmInformations, $this->request->data);
				
  				if($this->CompanyHwmInformations->save($CompanyHwmInformations))
				{
 					$this->Flash->success(__('HWM Application from has been published.'));
					return $this->redirect(['action' => 'hwmDraftedView']);
				}
				$this->Flash->error(__('Unable to publish HWM Application.'));
			}
		}
	}
}

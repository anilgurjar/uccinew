<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class CertificateOriginsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index','CooSendEmail']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['index', 'logout']);
    }

	function CooUpdate($id=Null,$status=Null)
	{
		$query = $this->CertificateOrigins->CooEmailApprovals->query();
		$query->update()
		->set(['status' => $status])
		->where(['id' => $id])
		->execute();
		exit;
	}
	
	
	public function CertificateOriginViewList() 
	{
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->CertificateOrigins->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
		
		 if($role_id==1){
			 $certificate_origins = $this->CertificateOrigins->find()->where(['approve'=>1])->order(['CertificateOrigins.origin_no'=>'DESC']);
		   }else{
			  $certificate_origins = $this->CertificateOrigins->find()->where(['approve'=>1,'company_id'=>$company_id])->order(['CertificateOrigins.origin_no'=>'DESC']); 
		   }
       $this->set(compact('certificate_origins'));
	}
	public function certificateOriginView()
    {
		$this->viewBuilder()->layout('index_layout');
		$certificate_origin_id=$this->request->data['view'];
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'approve'=>1])->contain(['Users','CertificateOriginGoods'])->toArray();
		
		$this->set(compact('certificate_origins'));
    }
	public function CertificateOriginApprove()
    {
       $this->viewBuilder()->layout('index_layout');
	   
       $certificate_origins = $this->CertificateOrigins->find()->where(['approve'=>0,'payment_status'=>'success']);
       $this->set(compact('certificate_origins'));
		
    }
	
	public function CertificateOriginApproveView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
	  
		if(isset($this->request->data['view']))
		{ 
			 $certificate_origin_id=$this->request->data['view'];;
			$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'approve'=>0])->contain(['Companies','CertificateOriginGoods'])->toArray();
			
			$this->set(compact('certificate_origins'));
		}
		
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['certificate_approve_submit']))
			{
				
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['certificate_approve_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['Companies'=>['Users']]]);
				
				$this->request->data['approve']=1;
				$this->request->data['approved_by']=$user_id;
				$query = $this->CertificateOrigins->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				 $email_to=$CertificateOrigins->company->users[0]->email; 
				 $member_name=$CertificateOrigins->company->users[0]->member_name;
				 
				 $Users= $this->CertificateOrigins->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					
					  $sub="Your certificate of origin is approved";
					  $from_name="UCCI";
					  $email_to=trim($email_to,' ');
					// $email_to="rohitkumarjoshi43@gmail.com";
					  if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'regards_member_name'=>$regards_member_name]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Certificate of origin has been approved.'));
					return $this->redirect(['action' => 'certificate_origin_approve']);
				}
				$this->Flash->error(__('Unable to approved certificate of origin.'));
			}
			else if(isset($this->request->data['certificate_notapprove_submit']))
			{
				$id=$this->request->data['certificate_notapprove_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id);
				
			//$this->request->data['id']=$this->request->data['certificate_notapprove_submit'];
				$this->request->data['approve']=2;
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					$this->Flash->success(__('Certificate of origin has been not approved.'));
					return $this->redirect(['action' => 'certificate_origin_approve']);
				}
				$this->Flash->error(__('Unable to not approved certificate of origin.'));
			}
		}
		
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('CertificateOrigins'));
		 
    }
	
	public function paymentTest($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->CertificateOrigins->Users->get($user_id);
		//$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['CertificateOriginGoods']]);
		
			$sul='http://localhost/ucci/certificate-origins/success';
			$furl='http://localhost/ucci/certificate-origins/failure';
			
			//$sul='http://ucciudaipur.com/app/certificate-origins/success';
			//$furl='http://ucciudaipur.com/app/certificate-origins/failure';
			
			
			$CertificateOrigins = $this->CertificateOrigins->find()
			->where(['CertificateOrigins.id'=>$id]);
			$CertificateOrigins->select(['total' =>$CertificateOrigins->func()->sum('CertificateOriginGoods.value')])
			->group(['certificate_origin_id'])
			->innerJoinWith('CertificateOriginGoods')
			->autoFields(true);
			
		$this->set(compact('Users','CertificateOrigins','id','txnid','sul','furl'));
	}
	
	
	
	public function payment($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->CertificateOrigins->Users->get($user_id);
		//$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['CertificateOriginGoods']]);
		
			//$sul='http://localhost/ucci/certificate-origins/success';
			//$furl='http://localhost/ucci/certificate-origins/failure';
			
			$sul='http://ucciudaipur.com/app/certificate-origins/success';
			$furl='http://ucciudaipur.com/app/certificate-origins/failure';
			
			
			$CertificateOrigins = $this->CertificateOrigins->find()
			->where(['CertificateOrigins.id'=>$id]);
			$CertificateOrigins->select(['total' =>$CertificateOrigins->func()->sum('CertificateOriginGoods.value')])
			->group(['certificate_origin_id'])
			->innerJoinWith('CertificateOriginGoods')
			->autoFields(true);
			
		$this->set(compact('Users','CertificateOrigins','id','txnid','sul','furl'));
	}
 
	public function success()
    {
		$this->viewBuilder()->layout('index_layout');
		$status=$this->request->data["status"];
		$amount=$this->request->data["amount"];
		$txnid=$this->request->data["txnid"];
		$hash=$this->request->data["hash"];
		$key=$this->request->data["key"];
		$udf1=$this->request->data["udf1"];
		$productinfo=$this->request->data["productinfo"];
		$email=$this->request->data["email"];
		$query = $this->CertificateOrigins->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status])
		->where(['id' => $udf1])
		->execute();
		
		 $this->set(compact('status','amount','id','txnid','sul'));	
		
	}
 
 public function failure()
    {
		$this->viewBuilder()->layout('index_layout');
		$status=$this->request->data["status"];
		$amount=$this->request->data["amount"];
		$txnid=$this->request->data["txnid"];
		$hash=$this->request->data["hash"];
		$key=$this->request->data["key"];
		$udf1=$this->request->data["udf1"];
		$productinfo=$this->request->data["productinfo"];
		$email=$this->request->data["email"];
		$query = $this->CertificateOrigins->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status])
		->where(['id' => $udf1])
		->execute();
		
		 $this->set(compact('status','amount','udf1','txnid','try'));	
		
	}
 
 
 
 
/* 	public function CooSendEmail()
    {
	
		$send_emails=$this->CertificateOrigins->CooEmailApprovals->find()->where(['status'=>0])->contain(['Users','CertificateOrigins'=>['MasterCurrencies','CertificateOriginGoods','Companies'=>['Users']]])->limit(1)->toArray();
		
		$this->set(compact('send_emails'));
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
	
		
	} */
	
	
	public function CooSendEmail()
    {
	
		$send_emails=$this->CertificateOrigins->CooEmailApprovals->find()->where(['status'=>0])->contain(['Users','CertificateOrigins'=>['Companies'=>['Users']]])->limit(5)->toArray();
		
		$email = new Email();
		$email->transport('SendGrid');
		
		foreach($send_emails as $send_email){
		 
			  $id=$send_email->id;
			  $regards_member_name=$send_email->certificate_origin->company->users[0]->member_name;
			   $payment_status=$send_email->certificate_origin->payment_status;
			  
			  $member_name=$send_email->user->member_name;
			  $to=$send_email->user->email;
			  $sub="Requesting Approval for Coo";
			  $from_name="UCCI";
			  $email_to=trim($to,' ');
			 // $email_to="rohitkumarjoshi43@gmail.com";
			 
			 if($payment_status=='success'){ 
			
					  if(!empty($to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_email_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'regards_member_name'=>$regards_member_name]);
										$email->send();
									$query = $this->CertificateOrigins->CooEmailApprovals->query();
									$query->update()
									->set(['status' => 1])
									->where(['id' => $id])
									->execute();
									
							} catch (Exception $e) {
								$query = $this->CertificateOrigins->CooEmailApprovals->query();
								$query->update()
								->set(['status' => 2])
								->where(['id' => $id])
								->execute();
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}else{
							
							  $query = $this->CertificateOrigins->CooEmailApprovals->query();
								$query->update()
								->set(['status' => 2])
								->where(['id' => $id])
								->execute();
							
						}
					 }elseif($payment_status=='failure'){
 
						$query = $this->CertificateOrigins->CooEmailApprovals->query();
							$query->update()
							->set(['status' => 2])
							->where(['id' => $id])
							->execute();

					 }		 
	  }
	 exit;
		
	}
	
	
 

	public function CertificateOrigin()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('company_id');
		$certificate_origin_good = $this->CertificateOrigins->newEntity();
		if($this->request->is('post')) 
		{				
			$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['company_id']=$user_id;
			$files=$this->request->data['file']; 
			
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			 
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			
			$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
			$i=0;
			foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
				$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
				$this->request->data['coo_email_approvals'][$i]['status']=0;	
				$i++;	
			}
			$this->request->data['status'] = 'draft';			
			$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
			 	
			if ($data=$this->CertificateOrigins->save($certificate_origin_good))
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				}
				$last_insert_id=$data->id;
				$this->Flash->success(__('Your certificate origin good has been saved.'));
				return $this->redirect(['action' => 'edit',$last_insert_id]);
				//return $this->redirect('https://test.payu.in/_payment');
				//return $this->redirect(['action' => 'payment',$data->id]);
			}
			
			$this->Flash->error(__('Unable to add your certificate origin goods.'));
		}
		$this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$user_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies'));
			 
		 
	}
	//-- DRAFT View
	public function draftView($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$certificate_origin_good = $this->CertificateOrigins->get($id, [
            'contain' => []
        ]);
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$id])->contain(['Companies','CertificateOriginGoods'])->toArray();
	 
		 
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			if(isset($this->request->data['certificate_origin_draft']))
			{ 
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['company_id']=$user_id;
				$files=$this->request->data['file']; 
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']='false';
				}
				
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				
				$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				}
							
				$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
				
				if ($data=$this->CertificateOrigins->save($certificate_origin_good))
				{ 
					$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
					foreach($files as $file){
					  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

					}
					$this->Flash->success(__('Your certificate origin good has been saved.'));
					return $this->redirect(['action' => 'certificateOrigin']);
					 
				}
			}
			else if(isset($this->request->data['certificate_origin_publish']))
			{ 
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['company_id']=$user_id;
				
				$files=$this->request->data['file']; 
				
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']='false';
				}
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				
				$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				}
							
				$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
				
						
				if ($data=$this->CertificateOrigins->save($certificate_origin_good))
				{ 
					$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
					foreach($files as $file){
					  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

					}
					$this->Flash->success(__('Your certificate origin good has been saved.'));
					//return $this->redirect(['action' => 'edit']);
					return $this->redirect('https://test.payu.in/_payment');
					//return $this->redirect(['action' => 'payment',$data->id]);
				}
			}
        }
        $this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
	}
	
	
	
	//  edit start 
	
	public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$certificate_origin_good = $this->CertificateOrigins->get($id, [
            'contain' => []
        ]);
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$id,'approve'=>1])->contain(['Companies','CertificateOriginGoods'])->toArray();
		$approved_by=$certificate_origins[0]->approved_by;
		$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['company_id']=$user_id;
			
			
			$files=$this->request->data['file']; 
			
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			
			
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			
			$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
			$i=0;
			foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
				$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
				$this->request->data['coo_email_approvals'][$i]['status']=0;	
				$i++;	
			}
						
			$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
			
			
				 	
			if ($data=$this->CertificateOrigins->save($certificate_origin_good))
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

				}
				

		
		
		
				$this->Flash->success(__('Your certificate origin good has been saved.'));
				return $this->redirect(['action' => 'edit']);
				//return $this->redirect('https://test.payu.in/_payment');
				//return $this->redirect(['action' => 'payment',$data->id]);
			}
			
			$this->Flash->error(__('Unable to add your certificate origin goods.'));
        }
        $this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$user_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
	}
	
	//  edit end
	
	
	
	
	
	
	public function CertificateOriginPerformaView(){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$certificate_origin_id=$this->request->data['view'];
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'approve'=>1])->contain(['Companies','CertificateOriginGoods'])->toArray();
		$approved_by=$certificate_origins[0]->approved_by;
		$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		
		$this->set(compact('certificate_origins','CertificateOriginAuthorizeds'));
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		
	}

} 
	
	
 
?>



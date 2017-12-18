<?php
namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Notices Controller
 *
 * @property \App\Model\Table\NoticesTable $Notices
 */
class NoticesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index','NoticeSendEmail']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout'); 
        $this->paginate = [
            'contain' => ['NoticeCategories', 'MasterMemberTypes','NoticeMails']
        ];
        $notices = $this->paginate($this->Notices->find()->order(['Notices.id'=>'DESC']));

        $this->set(compact('notices'));
        $this->set('_serialize', ['notices']);
    }

    /**
     * View method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
        
		$notice = $this->Notices->get($id, [

            'contain' => ['NoticeCategories', 'MasterMemberTypes', 'NoticeMails'=>['Users']]
        ]);
		
		$dir = new Folder(WWW_ROOT . 'img/notice/'.$id);
		$file_path = str_replace("\\","/",WWW_ROOT).'img/notice/'.$id;

		$files = $dir->find('.*', true);
		
		$this->set('files', $files);
		$this->set('file_path', $file_path);
        $this->set('notice', $notice);
        $this->set('_serialize', ['notice']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		$this->viewBuilder()->layout('index_layout');
        $notice = $this->Notices->newEntity();
        if ($this->request->is('post')) {
			
			$files=$this->request->data['file']; 
			
			if(!empty($files[0]['name'])){
				$this->request->data['file']='true';
			}else{
				$this->request->data['file']='false';
			}
			
		
			$type=$this->request->data['type_of_member']; 
			$i=0; $j=0;
			if($type==2)
			{
				$email_id=$this->request->data['email_id'];
			
				$alternate='no';
				foreach($email_id as $email)
				{
					$this->request->data['notice_mails'][$i]['user_id']=$email;
					$this->request->data['notice_mails'][$i]['alternate']=$alternate;
					$i++;
				}
				
				
			}
			else
			{
				$Users=$this->Notices->Users->find()->where(['member_nominee_type IN'=>['first','second']])
					->matching('Companies.CompanyMemberTypes',function($q){
						return $q->where(['master_member_type_id IN'=>$this->request->data['member_type_id']]);
					})
					->group(['Users.email'])->toArray();
				
				
				$alternate='no';
				
					/* $Users=$this->Notices->Users->find()->where(['member_nominee_type'=>'first'])
					->matching('Companies.CompanyMemberTypes',function($q){
						return $q->where(['master_member_type_id IN'=>$this->request->data['member_type_id']]);
					})->toArray();
				
				$Users_alternates=$this->Notices->Users->find()->where(['member_nominee_type'=>'second'])
					->matching('Companies.CompanyMemberTypes',function($q){
						return $q->where(['master_member_type_id IN'=>$this->request->data['member_type_id']]);
					})->toArray();
				//pr($Users_alternates); exit; */
				foreach($Users as $user)
				{ 
					if(!empty($user->email)){
						$this->request->data['notice_mails'][$i]['user_id']=$user->id;
						$this->request->data['notice_mails'][$i]['alternate']=$alternate;
						$i++;
					}	
				}
				
			/* 	foreach($Users_alternates as $Users_alternate)
				{ 
					$this->request->data['notice_mails'][$i]['user_id']=$Users_alternate->id;
					$this->request->data['notice_mails'][$i]['alternate']=$alternate;
					$i++;
				}
				 */
				
				$this->request->data['member_type_id']=implode(',',$this->request->data['member_type_id']);
			}
			
            $notice = $this->Notices->patchEntity($notice, $this->request->data);
		
            if($notice_data=$this->Notices->save($notice)) 
			{ 
		
				 $notice_id=$notice_data->id; 
				
				$dir = new Folder(WWW_ROOT . 'img/notice/'.$notice_id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/notice/'.$notice_id;
				foreach($files as $file){
					move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				
				}

				
				
                $this->Flash->success(__('The notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The notice could not be saved. Please, try again.'));
            }
        }
        $noticeCategories = $this->Notices->NoticeCategories->find()->toArray();
        $MasterMemberTypes = $this->Notices->MasterMemberTypes->find()->toArray();
		$User = $this->Notices->Users->find()->toArray();
        $this->set(compact('notice', 'noticeCategories', 'MasterMemberTypes','User'));
        $this->set('_serialize', ['notice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
	public function deleteNoticeFile($notice_id = null, $file_name = null)
    {
		unlink(WWW_ROOT . '/img/notice/'.$notice_id.'/'.$file_name);
	}
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $notice = $this->Notices->get($id, [
            'contain' => ['NoticeMails']
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$files=$this->request->data['file']; 
					
			if(!empty($files[0]['name'])){
				$this->request->data['file']='true';
			}else{
				$this->request->data['file']='false';
			}
			
		
			//$type=$this->request->data['type_of_member'];
			$i=0;
			/*if($type==2)
			{
				
				$email_id=$this->request->data['email_id'];
				
				foreach($email_id as $email)
				{
					$this->request->data['notice_mails'][$i++]['user_id']=$email;
				}
				
			}
			else
			{
				
				$Users=$this->Notices->Users->find()->select(['id','email'])->where(['member_type_id IN'=>$this->request->data['member_type_id']])->toArray();
				
				foreach($Users as $user)
				{
					$this->request->data['notice_mails'][$i++]['user_id']=$user->id;
				}
				
				$this->request->data['member_type_id']=implode(',',$this->request->data['member_type_id']);
			}
			*/
			
            $notice = $this->Notices->patchEntity($notice, $this->request->data);
			
            if($notice_data=$this->Notices->save($notice)) 
			{ 
				 $notice_id=$notice_data->id; 
				
				$dir = new Folder(WWW_ROOT . 'img/notice/'.$notice_id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/notice/'.$notice_id;
				foreach($files as $file){
					move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				
				}
				
                $this->Flash->success(__('The notice has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The notice could not be saved. Please, try again.'));
            }
			
			
        }
		$noticeCategories = $this->Notices->NoticeCategories->find()->toArray();
        $MasterMemberTypes = $this->Notices->MasterMemberTypes->find()->toArray();
		$User = $this->Notices->Users->find()->toArray();
        
        $this->set(compact('notice', 'noticeCategories', 'MasterMemberTypes','User'));
        $this->set('_serialize', ['notice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notice = $this->Notices->get($id);
        if ($this->Notices->delete($notice)) {
            $this->Flash->success(__('The notice has been deleted.'));
        } else {
            $this->Flash->error(__('The notice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function NoticeSendEmail()
	{ 
		$this->viewBuilder()->layout('Email');
		
		$send_emails=$this->Notices->NoticeMails->find()->where(['status'=>0])->contain(['Users','Notices'=>['NoticeCategories']])->limit(5)->toArray();
		
		$email = new Email();
		$email->transport('SendGrid');
		
		foreach($send_emails as $send_email){
		
		 $subject=$send_email->notice->title;
		 $description=$send_email->notice->description;
		 $file=$send_email->notice->file;
		 $category_name=$send_email->notice->notice_category->category_name;
		 $alternate=$send_email->alternate;
		 $to=$send_email->user->email; 
		 $sub="[".$category_name."] ".$subject;
		 $member_name=$send_email->user->member_name;
			/*  if($alternate=='no'){
				 $to=$send_email->user->email; 
				 $member_name=$send_email->user->member_name;
			 }else{
				// $to=$send_email->user->alternate_email; 
				// $member_name=$send_email->user->alternate_nominee;
			 } */
			
		 $id=$send_email->id; 
		 $notice_id=$send_email->notice_id; 
		
		$message_web=$description;
		$from_name="UCCI";
		$email_to=trim($to,' ');
	if(!empty($to)){
		$attachments='';
		if($file=='true'){
		
			 $dir = new Folder(WWW_ROOT . 'img/notice/'.$notice_id);
			 $file_path = str_replace("\\","/",WWW_ROOT).'img/notice/'.$notice_id;
             
			$files = $dir->find('.*', true);
			
			foreach($files as $file){
				
				$attachments[]=$file_path.'/'.$file;
			}
		}
		
try {
		$email->from(['ucciudaipur@gmail.com' => $from_name])
					->to($email_to)
					->replyTo('uccisec@hotmail.com')
					->subject($sub)
					->profile('default')
					->template('notice_send_email')
					->emailFormat('html')
					->viewVars(['content'=>$message_web,'member_name'=>$member_name]);
					if(is_array($attachments)){
						$email->attachments($attachments);
					}
					$email->send();
				$query = $this->Notices->NoticeMails->query();
				$query->update()
				->set(['status' => 1])
				->where(['id' => $id])
				->execute();
				
		} catch (Exception $e) {
			$query = $this->Notices->NoticeMails->query();
			$query->update()
			->set(['status' => 2])
			->where(['id' => $id])
			->execute();
			echo 'Exception : ',  $e->getMessage(), "\n";

		} 
	}else{
		$query = $this->Notices->NoticeMails->query();
			$query->update()
			->set(['status' => 2])
			->where(['id' => $id])
			->execute();
	}	
	
	}
exit;
	}
	
}

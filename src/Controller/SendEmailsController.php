<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * SendEmails Controller
 *
 * @property \App\Model\Table\SendEmailsTable $SendEmails
 */
class SendEmailsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'AllSendEmail']);
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
        $sendEmails = $this->paginate($this->SendEmails);

        $this->set(compact('sendEmails'));
        $this->set('_serialize', ['sendEmails']);
    }

    /**
     * View method
     *
     * @param string|null $id Send Email id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sendEmail = $this->SendEmails->get($id, [
            'contain' => ['SendEmailAll', 'SendEmailAlls']
        ]);

        $this->set('sendEmail', $sendEmail);
        $this->set('_serialize', ['sendEmail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $sendEmail = $this->SendEmails->newEntity();
       $Users_email=$this->SendEmails->Users->find()->select(['email','id'])->where(['member_type_id'=>1])->toArray();
     
	  if($this->request->is('post')) {
		
		 $this->request->data['date_current']=date('Y-m-d');
		  $this->request->data['flag']=1;
		 $i=0;
		  foreach($Users_email as $email)
				{
					$i++;
					$this->request->data['send_email_alls'][$i]['user_id']=$email->id;
					$this->request->data['send_email_alls'][$i]['flag']=1;
					$this->request->data['send_email_alls'][$i]['date_current']=date('Y-m-d');
				}
		 
            $sendEmail = $this->SendEmails->patchEntity($sendEmail, $this->request->data);
		//	pr($sendEmail); exit;
            if ($this->SendEmails->save($sendEmail)) {
                $this->Flash->success(__('Email has been sent.'));

                return $this->redirect(['action' => 'add']);
            } else {
				
                $this->Flash->error(__('The send email could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('sendEmail'));
        $this->set('_serialize', ['sendEmail']);
    }

	public function AllSendEmail()
	{ 
		//$this->viewBuilder()->layout('Email');
		
		$send_email=$this->SendEmails->find()->where(['flag'=>1])->contain(['SendEmailAlls'=>function($q){
			return $q->where(['flag'=>1])->limit(1)->contain(['Users']);
		}])->limit(1)->toArray();
		
	
		 $ids=$send_email[0]->id;
		$count=$this->SendEmails->SendEmailAlls->find()->where(['send_email_id'=>$ids,'flag'=>1])->count();
		if($count==0){
			$query = $this->SendEmails->query();
			$query->update()
			->set(['flag' => 2])
			->where(['id' => $ids])
			->execute();
		}
		
			$subject=$send_email[0]->subject;
			$content=$send_email[0]->content;

			$email = new Email();
			$email->transport('SendGrid');
			$from_name="UCCI";
			$Send_all_emails=$send_email[0]->send_email_alls;
		
		 foreach($Send_all_emails as $Send_all_email){
			 
			$id=$Send_all_email->id;
			$company_organisation=$Send_all_email->user->company_organisation;
			$member_name=$Send_all_email->user->member_name;
			$alternate_nominee=$Send_all_email->user->alternate_nominee;
			$to=$Send_all_email->user->email;
			$to="ashishbohara1008@gmail.com";
			
			try {
					$email->from(['choudhary.hansraj91@gmail.com' => $from_name])
					->to($to)
					->replyTo('choudhary.hansraj91@gmail.com')
					->subject($subject)
					->profile('default')
					->template('member_send_email')
					->emailFormat('html')
					->viewVars(['company_organisation' => $company_organisation,'content'=>$content,'alternate_nominee'=>$alternate_nominee,'member_name'=>$member_name])
					->send();
				
				$query = $this->SendEmails->SendEmailAlls->query();
				$query->update()
				->set(['flag' => 2])
				->where(['id' => $id])
				->execute();
				
				
			} catch (Exception $e) {

				echo 'Exception : ',  $e->getMessage(), "\n";
				$query = $this->SendEmails->SendEmailAlls->query();
				$query->update()
				->set(['flag' => 0])
				->where(['id' => $id])
				->execute();
				
			}
		
			
		 }
		
		
	}
	
	
    public function edit($id = null)
    {
        $sendEmail = $this->SendEmails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sendEmail = $this->SendEmails->patchEntity($sendEmail, $this->request->data);
            if ($this->SendEmails->save($sendEmail)) {
                $this->Flash->success(__('The send email has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The send email could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('sendEmail'));
        $this->set('_serialize', ['sendEmail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Send Email id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sendEmail = $this->SendEmails->get($id);
        if ($this->SendEmails->delete($sendEmail)) {
            $this->Flash->success(__('The send email has been deleted.'));
        } else {
            $this->Flash->error(__('The send email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

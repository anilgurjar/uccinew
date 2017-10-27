<?php
namespace App\Controller;
use Cake\View\View;
use Cake\View\ViewBuilder;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * NoticeMails Controller
 *
 * @property \App\Model\Table\NoticeMailsTable $NoticeMails
 */
class GratitudeLettersController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout','gratitudePdf','UpdateGratitude']);
    }
	public function gratitudePdf($id = null)
    {
		$this->viewBuilder()->layout('Email/text/default');
	
		$master_member=$this->GratitudeLetters->find()->where(['send_status'=>1])->contain(['Users'=> function($q){
			return $q->select(['id','email','member_name'])->where(['member_flag'=>1]);
		}])->limit(15)->toArray();
		
		if(!empty($master_member))
		{
			$this->set('master_member',$master_member);
			$MasterCompanies=$this->GratitudeLetters->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
		}
    }
	public function UpdateGratitude($id=Null,$mail_send=Null)
	{
			$query = $this->GratitudeLetters->query();
			$query->update()
			->set(['send_status' => $mail_send])
			->where(['id' => $id])
			->execute();
		
		$this->response->body('Ok');
		return $this->response;
	}
}

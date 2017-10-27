<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterCompaniesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index']);
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
	public function masterCompany()
    {
		$this->viewBuilder()->layout('index_layout');
		$MasterCompanies=$this->MasterCompanies->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterCompanies = $this->MasterCompanies->patchEntity($MasterCompanies, $this->request->data);
			if ($this->MasterCompanies->save($MasterCompanies)) 
			{
                $this->Flash->success('Master Company has been saved.');
                return $this->redirect(['action' => 'masterCompany']);
            }
		}
		$this->set(compact('MasterCompanies'));
	}
}
?>
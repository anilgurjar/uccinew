<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterClassificationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name', $member_name);
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }
	public function masterClassification()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterClassifications=$this->MasterClassifications->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterClassifications = $this->MasterClassifications->patchEntity($MasterClassifications, $this->request->data);
			if ($this->MasterClassifications->save($MasterClassifications)) {
                $this->Flash->success('Master Classification has been saved.');
                return $this->redirect(['action' => 'master_classification']);
            }
		}
		$this->set(compact('MasterClassifications'));
		$this->set('fetch_master_classification' , $this->MasterClassifications->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterClassifications->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterTurnOversController extends AppController
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
	public function masterTurnOver()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterTurnOvers=$this->MasterTurnOvers->newEntity();
		if ($this->request->is(['post']))
		{
			$this->request->data['category_name']=2;
			$MasterTurnOvers = $this->MasterTurnOvers->patchEntity($MasterTurnOvers, $this->request->data);
			if ($this->MasterTurnOvers->save($MasterTurnOvers)) {
                $this->Flash->success('Master Turn Over has been saved.');
                return $this->redirect(['action' => 'master_turn_over']);
            }
			
		}
		$this->set(compact('MasterTurnOvers'));
		$this->set('fetch_master_turn_over' , $this->MasterTurnOvers->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterTurnOvers->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
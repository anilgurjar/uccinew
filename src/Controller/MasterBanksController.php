<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterBanksController extends AppController
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
	public function masterBank()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterBanks=$this->MasterBanks->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterBanks = $this->MasterBanks->patchEntity($MasterBanks, $this->request->data);
			if ($this->MasterBanks->save($MasterBanks)) {
                $this->Flash->success('Master Bank has been saved.');
                return $this->redirect(['action' => 'master_bank']);
            }
		}
		$this->set(compact('MasterBanks'));
		$this->set('fetch_master_bank' , $this->MasterBanks->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterBanks->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
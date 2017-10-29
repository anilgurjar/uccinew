<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class RolesController extends AppController
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
	public function masterRole()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterRoles=$this->Roles->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterRoles = $this->Roles->patchEntity($MasterRoles, $this->request->data);
			if ($this->Roles->save($MasterRoles)) {
                $this->Flash->success('Master Role has been saved.');
                return $this->redirect(['action' => 'master_role']);
            }
		}
		$this->set(compact('MasterRoles'));
		$this->set('fetch_master_role' , $this->Roles->find('all'));
	}
	function autoEdit()
	{
		$query = $this->Roles->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
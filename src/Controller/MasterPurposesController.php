<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterPurposesController extends AppController
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
	public function masterPurpose()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterPurposes=$this->MasterPurposes->newEntity();
		if ($this->request->is(['post']))
		{
			$this->request->data['email']=implode(',',$this->request->data['email']);
			$MasterPurposes = $this->MasterPurposes->patchEntity($MasterPurposes, $this->request->data);
			if ($this->MasterPurposes->save($MasterPurposes)) {
                $this->Flash->success('Master Purpose has been saved.');
                return $this->redirect(['action' => 'master_purpose']);
            }
		}
		$this->set(compact('MasterPurposes'));
		$this->set('fetch_master_purpose' , $this->MasterPurposes->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterPurposes->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
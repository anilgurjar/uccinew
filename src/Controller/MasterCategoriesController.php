<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterCategoriesController extends AppController
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
	public function masterCategory()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterCategories=$this->MasterCategories->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterCategories = $this->MasterCategories->patchEntity($MasterCategories, $this->request->data);
			if ($this->MasterCategories->save($MasterCategories)) {
                $this->Flash->success('Master Category has been saved.');
                return $this->redirect(['action' => 'master_category']);
            }
		}
		$this->set(compact('MasterCategories'));
		$this->set('fetch_master_category' , $this->MasterCategories->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterCategories->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
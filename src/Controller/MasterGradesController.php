<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterGradesController extends AppController
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
	public function masterGrade()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterGrades=$this->MasterGrades->newEntity();
		if ($this->request->is(['post']))
		{
			$MasterGrades = $this->MasterGrades->patchEntity($MasterGrades, $this->request->data);
			if ($this->MasterGrades->save($MasterGrades)) {
                $this->Flash->success('Master Grade has been saved.');
                return $this->redirect(['action' => 'master_grade']);
            }
		}
		$this->set(compact('MasterGrades'));
		$this->set('fetch_master_grade' , $this->MasterGrades->find('all'));
	}
	function autoEdit()
	{
		$query = $this->MasterGrades->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
	
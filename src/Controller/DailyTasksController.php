<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DailyTasks Controller
 *
 * @property \App\Model\Table\DailyTasksTable $DailyTasks
 */
class DailyTasksController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $dailyTasks = $this->paginate($this->DailyTasks);

        $this->set(compact('dailyTasks'));
        $this->set('_serialize', ['dailyTasks']);
    }

    /**
     * View method
     *
     * @param string|null $id Daily Task id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dailyTask = $this->DailyTasks->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('dailyTask', $dailyTask);
        $this->set('_serialize', ['dailyTask']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $dailyTask = $this->DailyTasks->newEntity();
        if ($this->request->is('post')) {
            $dailyTask = $this->DailyTasks->patchEntity($dailyTask, $this->request->data);
            if ($this->DailyTasks->save($dailyTask)) {
                $this->Flash->success(__('The daily task has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The daily task could not be saved. Please, try again.'));
            }
        }
        $users = $this->DailyTasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('dailyTask', 'users'));
        $this->set('_serialize', ['dailyTask']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Daily Task id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dailyTask = $this->DailyTasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dailyTask = $this->DailyTasks->patchEntity($dailyTask, $this->request->data);
            if ($this->DailyTasks->save($dailyTask)) {
                $this->Flash->success(__('The daily task has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The daily task could not be saved. Please, try again.'));
            }
        }
        $users = $this->DailyTasks->Users->find('list', ['limit' => 200]);
        $this->set(compact('dailyTask', 'users'));
        $this->set('_serialize', ['dailyTask']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Daily Task id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dailyTask = $this->DailyTasks->get($id);
        if ($this->DailyTasks->delete($dailyTask)) {
            $this->Flash->success(__('The daily task has been deleted.'));
        } else {
            $this->Flash->error(__('The daily task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

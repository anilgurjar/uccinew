<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubCommittees Controller
 *
 * @property \App\Model\Table\SubCommitteesTable $SubCommittees
 */
class SubCommitteesController extends AppController
{

		public function initialize()
		{
			parent::initialize();
			$this->Auth->allow(['logout']);
			$member_name=$this->Auth->User('member_name');
			$this->set('member_name',$member_name);
		}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Users', 'Designations']
        ];
        //$subCommittees = $this->paginate($this->SubCommittees);
$subCommittees=$this->SubCommittees->MasterFinancialYears->find();
		
        $this->set(compact('subCommittees'));
        $this->set('_serialize', ['subCommittees']);
    }

    /**
     * View method
     *
     * @param string|null $id Sub Committee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
       /*  $subCommittee = $this->SubCommittees->get($id, [
            'contain' => ['Users', 'Designations']
        ]);
 */
		$this->viewBuilder()->layout('index_layout');
		$subCommittees=$this->SubCommittees->find()->where(['SubCommittees.master_financial_year_id'=>$id])->contain(['Users','Designations']);	
		$MasterFinancialYears=$this->SubCommittees->MasterFinancialYears->get($id);
		
        $this->set('subCommittees', $subCommittees);
        $this->set('MasterFinancialYears', $MasterFinancialYears);
        $this->set('_serialize', ['subCommittees']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $subCommittee = $this->SubCommittees->newEntity();
        if ($this->request->is('post')) {
			
			$data=$this->request->data['sub_committees'];
			
            $subCommittee = $this->SubCommittees->newEntities($data);
			
            if ($this->SubCommittees->saveMany($subCommittee)) {
                $this->Flash->success(__('The sub committee has been saved.'));
				
                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The sub committee could not be saved. Please, try again.'));
            }
        }
        $users = $this->SubCommittees->Users->find('list');
        $designations = $this->SubCommittees->Designations->find('list');
		 $masterFinancialYears = $this->SubCommittees->MasterFinancialYears->find('list');
        $this->set(compact('subCommittee', 'users', 'designations','masterFinancialYears','user_id'));
        $this->set('_serialize', ['subCommittee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sub Committee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subCommittee = $this->SubCommittees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subCommittee = $this->SubCommittees->patchEntity($subCommittee, $this->request->data);
            if ($this->SubCommittees->save($subCommittee)) {
                $this->Flash->success(__('The sub committee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sub committee could not be saved. Please, try again.'));
            }
        }
        $users = $this->SubCommittees->Users->find('list', ['limit' => 200]);
        $designations = $this->SubCommittees->Designations->find('list', ['limit' => 200]);
        $this->set(compact('subCommittee', 'users', 'designations'));
        $this->set('_serialize', ['subCommittee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sub Committee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subCommittee = $this->SubCommittees->get($id);
        if ($this->SubCommittees->delete($subCommittee)) {
            $this->Flash->success(__('The sub committee has been deleted.'));
        } else {
            $this->Flash->error(__('The sub committee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

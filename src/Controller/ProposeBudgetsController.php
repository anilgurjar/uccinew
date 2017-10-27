<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProposeBudgets Controller
 *
 * @property \App\Model\Table\ProposeBudgetsTable $ProposeBudgets
 */
class ProposeBudgetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
	
	public function add()
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $proposeBudget = $this->ProposeBudgets->newEntity();
        if ($this->request->is('post')) {
 			$data=$this->request->data['propose_budgets'];
            $proposeBudget = $this->ProposeBudgets->newEntities($data);
            if ($this->ProposeBudgets->saveMany($proposeBudget)) {
                 $this->Flash->success(__('The propose budget has been saved.'));
                 return $this->redirect(['action' => 'add']);
            } else { 
                $this->Flash->error(__('The propose budget could not be saved. Please, try again.'));
				
            }
         }
        $masterPurposes = $this->ProposeBudgets->MasterPurposes->find('list');
		$master_financial_years = $this->ProposeBudgets->master_financial_years->find();
        $users = $this->ProposeBudgets->Users->find('list', ['limit' => 200]);
        $this->set(compact('proposeBudget', 'masterPurposes', 'users','master_financial_years','user_id'));
        $this->set('_serialize', ['proposeBudget']);
		
    }
	
    public function index()
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $proposeBudgets = $this->ProposeBudgets->newEntity();
        $this->paginate = [
            'contain' => ['MasterPurposes', 'Users']
        ];
		$proposeBudgets = $this->paginate($this->ProposeBudgets);
		$masterPurposes = $this->ProposeBudgets->MasterPurposes->find('list');
		$master_financial_years = $this->ProposeBudgets->master_financial_years->find();
		$this->set(compact('proposeBudgets','masterPurposes','master_financial_years'));
        $this->set('_serialize', ['proposeBudgets']);
    }

    /**
     * View method
     *
     * @param string|null $id Propose Budget id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $proposeBudget = $this->ProposeBudgets->get($id, [
            'contain' => ['MasterPurposes', 'Users']
        ]);

        $this->set('proposeBudget', $proposeBudget);
        $this->set('_serialize', ['proposeBudget']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    

    /**
     * Edit method
     *
     * @param string|null $id Propose Budget id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $proposeBudget = $this->ProposeBudgets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proposeBudget = $this->ProposeBudgets->patchEntity($proposeBudget, $this->request->data);
            if ($this->ProposeBudgets->save($proposeBudget)) {
                $this->Flash->success(__('The propose budget has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The propose budget could not be saved. Please, try again.'));
            }
        }
        $masterPurposes = $this->ProposeBudgets->MasterPurposes->find('list', ['limit' => 200]);
        $users = $this->ProposeBudgets->Users->find('list', ['limit' => 200]);
        $this->set(compact('proposeBudget', 'masterPurposes', 'users'));
        $this->set('_serialize', ['proposeBudget']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Propose Budget id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proposeBudget = $this->ProposeBudgets->get($id);
        if ($this->ProposeBudgets->delete($proposeBudget)) {
            $this->Flash->success(__('The propose budget has been deleted.'));
        } else {
            $this->Flash->error(__('The propose budget could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExecutiveMembers Controller
 *
 * @property \App\Model\Table\ExecutiveMembersTable $ExecutiveMembers
 */
class ExecutiveMembersController extends AppController
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
            'contain' => ['Users', 'MasterFinancialYears', 'ExecutiveCategories', 'Designations']
        ];
        $executiveMembers = $this->paginate($this->ExecutiveMembers);

		$executiveMembers=$this->ExecutiveMembers->MasterFinancialYears->find();
		
		
        $this->set(compact('executiveMembers'));
        $this->set('_serialize', ['executiveMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Executive Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        /* $executiveMember = $this->ExecutiveMembers->get($id, [
            'contain' => ['Users', 'MasterFinancialYears', 'ExecutiveCategories', 'Designations']
        ]); */

		$executiveMember=$this->ExecutiveMembers->ExecutiveCategories->find()
		->where(['master_financial_year_id'=>$id])
		->contain(['ExecutiveMembers'=> function($q) use ($id) {
			return $q
			->where(['ExecutiveMembers.master_financial_year_id'=>$id])->contain(['Users','Designations']);
		}]);
		
		$MasterFinancialYears=$this->ExecutiveMembers->MasterFinancialYears->get($id);
		
        $this->set('executiveMember', $executiveMember);
		 $this->set('MasterFinancialYears',$MasterFinancialYears);
        $this->set('_serialize', ['executiveMember']);
    }

	 public function executiveAjax($finacial_id=null)
		{
			
			$user_id=$this->Auth->User('id');

			$executiveCategoryall = $this->ExecutiveMembers->ExecutiveCategories->find()->where(['master_financial_year_id'=>$finacial_id]);
			
			$users = $this->ExecutiveMembers->Users->find('list');
			$masterFinancialYears = $this->ExecutiveMembers->MasterFinancialYears->find('list');
			$executiveCategories = $this->ExecutiveMembers->ExecutiveCategories->find('list');
			
			$designations = $this->ExecutiveMembers->Designations->find('list');
			$this->set(compact('finacial_id', 'users', 'masterFinancialYears', 'executiveCategories', 'designations','executiveCategoryall','user_id'));
			$this->set('_serialize', ['finacial_id']);
			
			
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
        $executiveMember = $this->ExecutiveMembers->newEntity();
        if ($this->request->is('post')) {
			
			$data=$this->request->data['executive_members'];
			
            $executiveMember = $this->ExecutiveMembers->newEntities($data);
			
            if ($this->ExecutiveMembers->saveMany($executiveMember)) {
				
			
                $this->Flash->success(__('The executive member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The executive member could not be saved. Please, try again.'));
            }
        }
        $users = $this->ExecutiveMembers->Users->find('list');
        $masterFinancialYears = $this->ExecutiveMembers->MasterFinancialYears->find('list');
        $executiveCategories = $this->ExecutiveMembers->ExecutiveCategories->find('list');
		$executiveCategoryall = $this->ExecutiveMembers->ExecutiveCategories->find();
        $designations = $this->ExecutiveMembers->Designations->find('list');
        $this->set(compact('executiveMember', 'users', 'masterFinancialYears', 'executiveCategories', 'designations','executiveCategoryall','user_id'));
        $this->set('_serialize', ['executiveMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Executive Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
      /*   $executiveMember = $this->ExecutiveMembers->get($id, [
            'contain' => []
        ]);
		 */
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
        $executiveMember = $this->ExecutiveMembers->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
				$ExecutiveMembers_deletes=$this->ExecutiveMembers->find()->where(['master_financial_year_id'=>$id]);
				foreach($ExecutiveMembers_deletes as $ExecutiveMembers_delete){
					$this->ExecutiveMembers->delete($ExecutiveMembers_delete);
				}
			$data=$this->request->data['executive_members'];
			$executiveMember = $this->ExecutiveMembers->newEntities($data);
					
            if ($this->ExecutiveMembers->saveMany($executiveMember)) {
                $this->Flash->success(__('The executive member has been saved.'));
			
                return $this->redirect(['action' => 'index']);
            } else {
			
                $this->Flash->error(__('The executive member could not be saved. Please, try again.'));
            }
        }
		
		$executiveMember=$this->ExecutiveMembers->ExecutiveCategories->find()->contain(['ExecutiveMembers'=> function($q) use ($id) {
			return $q
			->where(['ExecutiveMembers.master_financial_year_id'=>$id])->contain(['Users','Designations']);
		}]);
		
		$users = $this->ExecutiveMembers->Users->find('list');
        $masterFinancialYears = $this->ExecutiveMembers->MasterFinancialYears->find('list');
        $executiveCategories = $this->ExecutiveMembers->ExecutiveCategories->find('list');
		$executiveCategoryall = $this->ExecutiveMembers->ExecutiveCategories->find();
        $designations = $this->ExecutiveMembers->Designations->find('list');
		$this->set(compact('executiveMember', 'users', 'masterFinancialYears', 'executiveCategories', 'designations','executiveCategoryall','user_id','id'));
        $this->set('_serialize', ['executiveMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Executive Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $executiveMember = $this->ExecutiveMembers->get($id);
        if ($this->ExecutiveMembers->delete($executiveMember)) {
            $this->Flash->success(__('The executive member has been deleted.'));
        } else {
            $this->Flash->error(__('The executive member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

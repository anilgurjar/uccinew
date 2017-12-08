<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IndustrialDepartments Controller
 *
 * @property \App\Model\Table\IndustrialDepartmentsTable $IndustrialDepartments
 */
class IndustrialDepartmentsController extends AppController
{
	 public $paginate = [
        'limit' => 50
    ];
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
        $industrialDepartments = $this->paginate($this->IndustrialDepartments);

        $this->set(compact('industrialDepartments'));
        $this->set('_serialize', ['industrialDepartments']);
    }

    /**
     * View method
     *
     * @param string|null $id Industrial Department id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $industrialDepartment = $this->IndustrialDepartments->get($id, [
            'contain' => []
        ]);

        $this->set('industrialDepartment', $industrialDepartment);
        $this->set('_serialize', ['industrialDepartment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $industrialDepartment = $this->IndustrialDepartments->Companies->newEntity();
        if ($this->request->is('post')) {
			
			$this->request->data['member_flag']=4;
			$this->request->data['role_id']=5;
			$this->request->data['users'][0]['member_nominee_type']='first';
			
            $industrialDepartment = $this->IndustrialDepartments->Companies->patchEntity($industrialDepartment, $this->request->data);
			
            if ($this->IndustrialDepartments->Companies->save($industrialDepartment)) {
                $this->Flash->success(__('The industrial department has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The industrial department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('industrialDepartment'));
        $this->set('_serialize', ['industrialDepartment']);
		$industrialDepartments = $this->paginate($this->IndustrialDepartments->Companies->find()->where(['role_id'=>5])->contain(['Users']));

        $this->set(compact('industrialDepartments'));
        $this->set('_serialize', ['industrialDepartments']);
    }
	
	
	 public function AddMember()
     {
		$this->viewBuilder()->layout('index_layout');
        $Users = $this->IndustrialDepartments->Companies->Users->newEntity();
		
		
		 if($this->request->is('post')) {
			 
			
			$Users = $this->IndustrialDepartments->Companies->Users->patchEntity($Users, $this->request->data);
			
			if ($this->IndustrialDepartments->Companies->Users->save($Users)) {
			$this->Flash->success(__('The industrial department member has been saved.'));

                return $this->redirect(['action' => 'AddMember']);
            } else {
                $this->Flash->error(__('The industrial department member could not be saved. Please, try again.'));
            }
			 
			
		
		 }
		
		$Companies_datas=$this->IndustrialDepartments->Companies->find()->where(['role_id'=>5])->contain(['Users'])->toArray();
		$Companies=$this->IndustrialDepartments->Companies->find('list')->where(['role_id'=>5])->toArray();
		
		$this->set(compact('IndustrialDepartments','Companies','Users','Companies_datas'));
        $this->set('_serialize', ['industrialDepartment','Users']);
	 }
	
	

    /**
     * Edit method
     *
     * @param string|null $id Industrial Department id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $industrialDepartment = $this->IndustrialDepartments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $industrialDepartment = $this->IndustrialDepartments->patchEntity($industrialDepartment, $this->request->data);
            if ($this->IndustrialDepartments->save($industrialDepartment)) {
                $this->Flash->success(__('The industrial department has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The industrial department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('industrialDepartment'));
        $this->set('_serialize', ['industrialDepartment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Industrial Department id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $industrialDepartment = $this->IndustrialDepartments->get($id);
        if ($this->IndustrialDepartments->delete($industrialDepartment)) {
            $this->Flash->success(__('The industrial department has been deleted.'));
        } else {
            $this->Flash->error(__('The industrial department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}

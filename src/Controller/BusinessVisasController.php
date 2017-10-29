<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BusinessVisas Controller
 *
 * @property \App\Model\Table\BusinessVisasTable $BusinessVisas
 */
class BusinessVisasController extends AppController
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
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $businessVisas = $this->paginate($this->BusinessVisas);

        $this->set(compact('businessVisas'));
        $this->set('_serialize', ['businessVisas']);
    }

    /**
     * View method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $businessVisa = $this->BusinessVisas->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('businessVisa', $businessVisa);
        $this->set('_serialize', ['businessVisa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $businessVisa = $this->BusinessVisas->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
			$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
            $businessVisa = $this->BusinessVisas->patchEntity($businessVisa, $this->request->data);
			
            if ($this->BusinessVisas->save($businessVisa)) {
                $this->Flash->success(__('The business visa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The business visa could not be saved. Please, try again.'));
            }
        }
        $members = $this->BusinessVisas->Companies->find()->select(['id','company_organisation'])->toArray();
        $this->set(compact('businessVisa', 'members'));
        $this->set('_serialize', ['businessVisa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $businessVisa = $this->BusinessVisas->get($id, [
            'contain' => ['Companies']
        ]);
		$company_id=$businessVisa->company->id; 
         if ($this->request->is('post')) {
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
			$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
            $businessVisa = $this->BusinessVisas->patchEntity($businessVisa, $this->request->data);
			
            if ($this->BusinessVisas->save($businessVisa)) {
                $this->Flash->success(__('The business visa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The business visa could not be saved. Please, try again.'));
            }
        }
        $members = $this->BusinessVisas->Companies->find()->select(['id','company_organisation'])->toArray();
        $this->set(compact('businessVisa', 'members','company_id'));
        $this->set('_serialize', ['businessVisa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $businessVisa = $this->BusinessVisas->get($id);
        if ($this->BusinessVisas->delete($businessVisa)) {
            $this->Flash->success(__('The business visa has been deleted.'));
        } else {
            $this->Flash->error(__('The business visa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

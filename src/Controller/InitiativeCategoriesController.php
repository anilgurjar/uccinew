<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InitiativeCategories Controller
 *
 * @property \App\Model\Table\InitiativeCategoriesTable $InitiativeCategories
 */
class InitiativeCategoriesController extends AppController
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
        $initiativeCategories = $this->paginate($this->InitiativeCategories);

        $this->set(compact('initiativeCategories'));
        $this->set('_serialize', ['initiativeCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Initiative Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $initiativeCategory = $this->InitiativeCategories->get($id, [
            'contain' => ['Initiatives']
        ]);

        $this->set('initiativeCategory', $initiativeCategory);
        $this->set('_serialize', ['initiativeCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $initiativeCategory = $this->InitiativeCategories->newEntity();
        if ($this->request->is('post')) {
            $initiativeCategory = $this->InitiativeCategories->patchEntity($initiativeCategory, $this->request->data);
            if ($this->InitiativeCategories->save($initiativeCategory)) {
                $this->Flash->success(__('The initiative category has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The initiative category could not be saved. Please, try again.'));
            }
        }
		$initiativeCategories = $this->paginate($this->InitiativeCategories);
        $this->set(compact('initiativeCategory','initiativeCategories'));
        $this->set('_serialize', ['initiativeCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Initiative Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $initiativeCategory = $this->InitiativeCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $initiativeCategory = $this->InitiativeCategories->patchEntity($initiativeCategory, $this->request->data);
            if ($this->InitiativeCategories->save($initiativeCategory)) {
                $this->Flash->success(__('The initiative category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The initiative category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('initiativeCategory'));
        $this->set('_serialize', ['initiativeCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Initiative Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $initiativeCategory = $this->InitiativeCategories->get($id);
        if ($this->InitiativeCategories->delete($initiativeCategory)) {
            $this->Flash->success(__('The initiative category has been deleted.'));
        } else {
            $this->Flash->error(__('The initiative category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

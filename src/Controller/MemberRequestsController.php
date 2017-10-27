<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MemberRequests Controller
 *
 * @property \App\Model\Table\MemberRequestsTable $MemberRequests
 */
class MemberRequestsController extends AppController
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
		$this->set('role_id',$this->Auth->User('role_id'));
	}
	 
	 
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['MasterMemberTypes', 'Users']
        ];
		
		
        $memberRequests = $this->paginate($this->MemberRequests);

        $this->set(compact('memberRequests'));
        $this->set('_serialize', ['memberRequests']);
    }

    /**
     * View method
     *
     * @param string|null $id Member Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $memberRequest = $this->MemberRequests->get($id, [
            'contain' => ['MasterMemberTypes', 'Users']
        ]);

        $this->set('memberRequest', $memberRequest);
        $this->set('_serialize', ['memberRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $memberRequest = $this->MemberRequests->newEntity();
        if ($this->request->is('post')) {
            $memberRequest = $this->MemberRequests->patchEntity($memberRequest, $this->request->data);
            if ($this->MemberRequests->save($memberRequest)) {
                $this->Flash->success(__('The member request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The member request could not be saved. Please, try again.'));
            }
        }
        $masterMemberTypes = $this->MemberRequests->MasterMemberTypes->find('list', ['limit' => 200]);
        $users = $this->MemberRequests->Users->find('list', ['limit' => 200]);
        $this->set(compact('memberRequest', 'masterMemberTypes', 'users'));
        $this->set('_serialize', ['memberRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Member Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $memberRequest = $this->MemberRequests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $memberRequest = $this->MemberRequests->patchEntity($memberRequest, $this->request->data);
            if ($this->MemberRequests->save($memberRequest)) {
                $this->Flash->success(__('The member request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The member request could not be saved. Please, try again.'));
            }
        }
        $masterMemberTypes = $this->MemberRequests->MasterMemberTypes->find('list', ['limit' => 200]);
        $users = $this->MemberRequests->Users->find('list', ['limit' => 200]);
        $this->set(compact('memberRequest', 'masterMemberTypes', 'users'));
        $this->set('_serialize', ['memberRequest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Member Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $memberRequest = $this->MemberRequests->get($id);
        if ($this->MemberRequests->delete($memberRequest)) {
            $this->Flash->success(__('The member request has been deleted.'));
        } else {
            $this->Flash->error(__('The member request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

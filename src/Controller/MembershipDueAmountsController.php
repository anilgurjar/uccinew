<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MembershipDueAmounts Controller
 *
 * @property \App\Model\Table\MembershipDueAmountsTable $MembershipDueAmounts
 */
class MembershipDueAmountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CompanyMasters', 'MemberTypes']
        ];
        $membershipDueAmounts = $this->paginate($this->MembershipDueAmounts);

        $this->set(compact('membershipDueAmounts'));
        $this->set('_serialize', ['membershipDueAmounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Membership Due Amount id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $membershipDueAmount = $this->MembershipDueAmounts->get($id, [
            'contain' => ['CompanyMasters', 'MemberTypes']
        ]);

        $this->set('membershipDueAmount', $membershipDueAmount);
        $this->set('_serialize', ['membershipDueAmount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $membershipDueAmount = $this->MembershipDueAmounts->newEntity();
        if ($this->request->is('post')) {
            $membershipDueAmount = $this->MembershipDueAmounts->patchEntity($membershipDueAmount, $this->request->data);
            if ($this->MembershipDueAmounts->save($membershipDueAmount)) {
                $this->Flash->success(__('The membership due amount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The membership due amount could not be saved. Please, try again.'));
            }
        }
        $companyMasters = $this->MembershipDueAmounts->CompanyMasters->find('list', ['limit' => 200]);
        $memberTypes = $this->MembershipDueAmounts->MemberTypes->find('list', ['limit' => 200]);
        $this->set(compact('membershipDueAmount', 'companyMasters', 'memberTypes'));
        $this->set('_serialize', ['membershipDueAmount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Membership Due Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $membershipDueAmount = $this->MembershipDueAmounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $membershipDueAmount = $this->MembershipDueAmounts->patchEntity($membershipDueAmount, $this->request->data);
            if ($this->MembershipDueAmounts->save($membershipDueAmount)) {
                $this->Flash->success(__('The membership due amount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The membership due amount could not be saved. Please, try again.'));
            }
        }
        $companyMasters = $this->MembershipDueAmounts->CompanyMasters->find('list', ['limit' => 200]);
        $memberTypes = $this->MembershipDueAmounts->MemberTypes->find('list', ['limit' => 200]);
        $this->set(compact('membershipDueAmount', 'companyMasters', 'memberTypes'));
        $this->set('_serialize', ['membershipDueAmount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Membership Due Amount id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $membershipDueAmount = $this->MembershipDueAmounts->get($id);
        if ($this->MembershipDueAmounts->delete($membershipDueAmount)) {
            $this->Flash->success(__('The membership due amount has been deleted.'));
        } else {
            $this->Flash->error(__('The membership due amount could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

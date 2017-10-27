<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoRegistrations Controller
 *
 * @property \App\Model\Table\CoRegistrationsTable $CoRegistrations
 */
class CoRegistrationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'MasterFinancialYears']
        ];
        $coRegistrations = $this->paginate($this->CoRegistrations);

        $this->set(compact('coRegistrations'));
        $this->set('_serialize', ['coRegistrations']);
    }

    /**
     * View method
     *
     * @param string|null $id Co Registration id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coRegistration = $this->CoRegistrations->get($id, [
            'contain' => ['Companies', 'MasterFinancialYears', 'CoTaxAmounts']
        ]);

        $this->set('coRegistration', $coRegistration);
        $this->set('_serialize', ['coRegistration']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coRegistration = $this->CoRegistrations->newEntity();
        if ($this->request->is('post')) {
            $coRegistration = $this->CoRegistrations->patchEntity($coRegistration, $this->request->data);
            if ($this->CoRegistrations->save($coRegistration)) {
                $this->Flash->success(__('The co registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The co registration could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CoRegistrations->Companies->find('list', ['limit' => 200]);
        $masterFinancialYears = $this->CoRegistrations->MasterFinancialYears->find('list', ['limit' => 200]);
        $this->set(compact('coRegistration', 'companies', 'masterFinancialYears'));
        $this->set('_serialize', ['coRegistration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co Registration id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coRegistration = $this->CoRegistrations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coRegistration = $this->CoRegistrations->patchEntity($coRegistration, $this->request->data);
            if ($this->CoRegistrations->save($coRegistration)) {
                $this->Flash->success(__('The co registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The co registration could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CoRegistrations->Companies->find('list', ['limit' => 200]);
        $masterFinancialYears = $this->CoRegistrations->MasterFinancialYears->find('list', ['limit' => 200]);
        $this->set(compact('coRegistration', 'companies', 'masterFinancialYears'));
        $this->set('_serialize', ['coRegistration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co Registration id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coRegistration = $this->CoRegistrations->get($id);
        if ($this->CoRegistrations->delete($coRegistration)) {
            $this->Flash->success(__('The co registration has been deleted.'));
        } else {
            $this->Flash->error(__('The co registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

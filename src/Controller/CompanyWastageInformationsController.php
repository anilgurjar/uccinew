<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyWastageInformations Controller
 *
 * @property \App\Model\Table\CompanyWastageInformationsTable $CompanyWastageInformations
 */
class CompanyWastageInformationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $companyWastageInformations = $this->paginate($this->CompanyWastageInformations);

        $this->set(compact('companyWastageInformations'));
        $this->set('_serialize', ['companyWastageInformations']);
    }

    /**
     * View method
     *
     * @param string|null $id Company Wastage Information id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companyWastageInformation = $this->CompanyWastageInformations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('companyWastageInformation', $companyWastageInformation);
        $this->set('_serialize', ['companyWastageInformation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companyWastageInformation = $this->CompanyWastageInformations->newEntity();
        if ($this->request->is('post')) {
            $companyWastageInformation = $this->CompanyWastageInformations->patchEntity($companyWastageInformation, $this->request->data);
            if ($this->CompanyWastageInformations->save($companyWastageInformation)) {
                $this->Flash->success(__('The company wastage information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company wastage information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyWastageInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyWastageInformation', 'companies'));
        $this->set('_serialize', ['companyWastageInformation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company Wastage Information id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companyWastageInformation = $this->CompanyWastageInformations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyWastageInformation = $this->CompanyWastageInformations->patchEntity($companyWastageInformation, $this->request->data);
            if ($this->CompanyWastageInformations->save($companyWastageInformation)) {
                $this->Flash->success(__('The company wastage information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company wastage information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyWastageInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyWastageInformation', 'companies'));
        $this->set('_serialize', ['companyWastageInformation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company Wastage Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyWastageInformation = $this->CompanyWastageInformations->get($id);
        if ($this->CompanyWastageInformations->delete($companyWastageInformation)) {
            $this->Flash->success(__('The company wastage information has been deleted.'));
        } else {
            $this->Flash->error(__('The company wastage information could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

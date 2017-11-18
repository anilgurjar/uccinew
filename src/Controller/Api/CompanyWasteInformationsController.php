<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyWasteInformations Controller
 *
 * @property \App\Model\Table\CompanyWasteInformationsTable $CompanyWasteInformations
 */
class CompanyWasteInformationsController extends AppController
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
        $companyWasteInformations = $this->paginate($this->CompanyWasteInformations);

        $this->set(compact('companyWasteInformations'));
        $this->set('_serialize', ['companyWasteInformations']);
    }

    /**
     * View method
     *
     * @param string|null $id Company Waste Information id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companyWasteInformation = $this->CompanyWasteInformations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('companyWasteInformation', $companyWasteInformation);
        $this->set('_serialize', ['companyWasteInformation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companyWasteInformation = $this->CompanyWasteInformations->newEntity();
        if ($this->request->is('post')) {
            $companyWasteInformation = $this->CompanyWasteInformations->patchEntity($companyWasteInformation, $this->request->data);
            if ($this->CompanyWasteInformations->save($companyWasteInformation)) {
                $this->Flash->success(__('The company waste information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company waste information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyWasteInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyWasteInformation', 'companies'));
        $this->set('_serialize', ['companyWasteInformation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company Waste Information id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companyWasteInformation = $this->CompanyWasteInformations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyWasteInformation = $this->CompanyWasteInformations->patchEntity($companyWasteInformation, $this->request->data);
            if ($this->CompanyWasteInformations->save($companyWasteInformation)) {
                $this->Flash->success(__('The company waste information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company waste information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyWasteInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyWasteInformation', 'companies'));
        $this->set('_serialize', ['companyWasteInformation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company Waste Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyWasteInformation = $this->CompanyWasteInformations->get($id);
        if ($this->CompanyWasteInformations->delete($companyWasteInformation)) {
            $this->Flash->success(__('The company waste information has been deleted.'));
        } else {
            $this->Flash->error(__('The company waste information could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

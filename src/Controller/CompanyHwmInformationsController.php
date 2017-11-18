<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyHwmInformations Controller
 *
 * @property \App\Model\Table\CompanyHwmInformationsTable $CompanyHwmInformations
 */
class CompanyHwmInformationsController extends AppController
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
        $companyHwmInformations = $this->paginate($this->CompanyHwmInformations);

        $this->set(compact('companyHwmInformations'));
        $this->set('_serialize', ['companyHwmInformations']);
    }

    /**
     * View method
     *
     * @param string|null $id Company Hwm Information id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companyHwmInformation = $this->CompanyHwmInformations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('companyHwmInformation', $companyHwmInformation);
        $this->set('_serialize', ['companyHwmInformation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companyHwmInformation = $this->CompanyHwmInformations->newEntity();
        if ($this->request->is('post')) {
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
                $this->Flash->success(__('The company hwm information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company hwm information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyHwmInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyHwmInformation', 'companies'));
        $this->set('_serialize', ['companyHwmInformation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company Hwm Information id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companyHwmInformation = $this->CompanyHwmInformations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
                $this->Flash->success(__('The company hwm information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company hwm information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyHwmInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyHwmInformation', 'companies'));
        $this->set('_serialize', ['companyHwmInformation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company Hwm Information id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyHwmInformation = $this->CompanyHwmInformations->get($id);
        if ($this->CompanyHwmInformations->delete($companyHwmInformation)) {
            $this->Flash->success(__('The company hwm information has been deleted.'));
        } else {
            $this->Flash->error(__('The company hwm information could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

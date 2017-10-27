<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MasterFinancialYears Controller
 *
 * @property \App\Model\Table\MasterFinancialYearsTable $MasterFinancialYears
 */
class MasterFinancialYearsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $masterFinancialYears = $this->paginate($this->MasterFinancialYears);

        $this->set(compact('masterFinancialYears'));
        $this->set('_serialize', ['masterFinancialYears']);
    }

    /**
     * View method
     *
     * @param string|null $id Master Financial Year id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $masterFinancialYear = $this->MasterFinancialYears->get($id, [
            'contain' => []
        ]);

        $this->set('masterFinancialYear', $masterFinancialYear);
        $this->set('_serialize', ['masterFinancialYear']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $masterFinancialYear = $this->MasterFinancialYears->newEntity();
        if ($this->request->is('post')) {
            $masterFinancialYear = $this->MasterFinancialYears->patchEntity($masterFinancialYear, $this->request->data);
            if ($this->MasterFinancialYears->save($masterFinancialYear)) {
                $this->Flash->success(__('The master financial year has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The master financial year could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('masterFinancialYear'));
        $this->set('_serialize', ['masterFinancialYear']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Master Financial Year id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $masterFinancialYear = $this->MasterFinancialYears->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $masterFinancialYear = $this->MasterFinancialYears->patchEntity($masterFinancialYear, $this->request->data);
            if ($this->MasterFinancialYears->save($masterFinancialYear)) {
                $this->Flash->success(__('The master financial year has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The master financial year could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('masterFinancialYear'));
        $this->set('_serialize', ['masterFinancialYear']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Master Financial Year id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $masterFinancialYear = $this->MasterFinancialYears->get($id);
        if ($this->MasterFinancialYears->delete($masterFinancialYear)) {
            $this->Flash->success(__('The master financial year has been deleted.'));
        } else {
            $this->Flash->error(__('The master financial year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

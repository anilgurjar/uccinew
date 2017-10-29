<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoTaxAmounts Controller
 *
 * @property \App\Model\Table\CoTaxAmountsTable $CoTaxAmounts
 */
class CoTaxAmountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoRegistrations', 'Taxes']
        ];
        $coTaxAmounts = $this->paginate($this->CoTaxAmounts);

        $this->set(compact('coTaxAmounts'));
        $this->set('_serialize', ['coTaxAmounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Co Tax Amount id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coTaxAmount = $this->CoTaxAmounts->get($id, [
            'contain' => ['CoRegistrations', 'Taxes']
        ]);

        $this->set('coTaxAmount', $coTaxAmount);
        $this->set('_serialize', ['coTaxAmount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coTaxAmount = $this->CoTaxAmounts->newEntity();
        if ($this->request->is('post')) {
            $coTaxAmount = $this->CoTaxAmounts->patchEntity($coTaxAmount, $this->request->data);
            if ($this->CoTaxAmounts->save($coTaxAmount)) {
                $this->Flash->success(__('The co tax amount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The co tax amount could not be saved. Please, try again.'));
            }
        }
        $coRegistrations = $this->CoTaxAmounts->CoRegistrations->find('list', ['limit' => 200]);
        $taxes = $this->CoTaxAmounts->Taxes->find('list', ['limit' => 200]);
        $this->set(compact('coTaxAmount', 'coRegistrations', 'taxes'));
        $this->set('_serialize', ['coTaxAmount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co Tax Amount id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coTaxAmount = $this->CoTaxAmounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coTaxAmount = $this->CoTaxAmounts->patchEntity($coTaxAmount, $this->request->data);
            if ($this->CoTaxAmounts->save($coTaxAmount)) {
                $this->Flash->success(__('The co tax amount has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The co tax amount could not be saved. Please, try again.'));
            }
        }
        $coRegistrations = $this->CoTaxAmounts->CoRegistrations->find('list', ['limit' => 200]);
        $taxes = $this->CoTaxAmounts->Taxes->find('list', ['limit' => 200]);
        $this->set(compact('coTaxAmount', 'coRegistrations', 'taxes'));
        $this->set('_serialize', ['coTaxAmount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co Tax Amount id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coTaxAmount = $this->CoTaxAmounts->get($id);
        if ($this->CoTaxAmounts->delete($coTaxAmount)) {
            $this->Flash->success(__('The co tax amount has been deleted.'));
        } else {
            $this->Flash->error(__('The co tax amount could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

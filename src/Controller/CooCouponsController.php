<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CooCoupons Controller
 *
 * @property \App\Model\Table\CooCouponsTable $CooCoupons
 */
class CooCouponsController extends AppController
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
        $cooCoupons = $this->paginate($this->CooCoupons);

        $this->set(compact('cooCoupons'));
        $this->set('_serialize', ['cooCoupons']);
    }

    /**
     * View method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cooCoupon = $this->CooCoupons->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('cooCoupon', $cooCoupon);
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cooCoupon = $this->CooCoupons->newEntity();
        if ($this->request->is('post')) {
            $cooCoupon = $this->CooCoupons->patchEntity($cooCoupon, $this->request->data);
            if ($this->CooCoupons->save($cooCoupon)) {
                $this->Flash->success(__('The coo coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coo coupon could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CooCoupons->Companies->find('list', ['limit' => 200]);
        $this->set(compact('cooCoupon', 'companies'));
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cooCoupon = $this->CooCoupons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cooCoupon = $this->CooCoupons->patchEntity($cooCoupon, $this->request->data);
            if ($this->CooCoupons->save($cooCoupon)) {
                $this->Flash->success(__('The coo coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coo coupon could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CooCoupons->Companies->find('list', ['limit' => 200]);
        $this->set(compact('cooCoupon', 'companies'));
        $this->set('_serialize', ['cooCoupon']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Coo Coupon id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cooCoupon = $this->CooCoupons->get($id);
        if ($this->CooCoupons->delete($cooCoupon)) {
            $this->Flash->success(__('The coo coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coo coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

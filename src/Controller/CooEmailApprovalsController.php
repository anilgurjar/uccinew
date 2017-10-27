<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CooEmailApprovals Controller
 *
 * @property \App\Model\Table\CooEmailApprovalsTable $CooEmailApprovals
 */
class CooEmailApprovalsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CertificateOrigins', 'Users']
        ];
        $cooEmailApprovals = $this->paginate($this->CooEmailApprovals);

        $this->set(compact('cooEmailApprovals'));
        $this->set('_serialize', ['cooEmailApprovals']);
    }

    /**
     * View method
     *
     * @param string|null $id Coo Email Approval id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cooEmailApproval = $this->CooEmailApprovals->get($id, [
            'contain' => ['CertificateOrigins', 'Users']
        ]);

        $this->set('cooEmailApproval', $cooEmailApproval);
        $this->set('_serialize', ['cooEmailApproval']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cooEmailApproval = $this->CooEmailApprovals->newEntity();
        if ($this->request->is('post')) {
            $cooEmailApproval = $this->CooEmailApprovals->patchEntity($cooEmailApproval, $this->request->data);
            if ($this->CooEmailApprovals->save($cooEmailApproval)) {
                $this->Flash->success(__('The coo email approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coo email approval could not be saved. Please, try again.'));
            }
        }
        $certificateOrigins = $this->CooEmailApprovals->CertificateOrigins->find('list', ['limit' => 200]);
        $users = $this->CooEmailApprovals->Users->find('list', ['limit' => 200]);
        $this->set(compact('cooEmailApproval', 'certificateOrigins', 'users'));
        $this->set('_serialize', ['cooEmailApproval']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Coo Email Approval id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cooEmailApproval = $this->CooEmailApprovals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cooEmailApproval = $this->CooEmailApprovals->patchEntity($cooEmailApproval, $this->request->data);
            if ($this->CooEmailApprovals->save($cooEmailApproval)) {
                $this->Flash->success(__('The coo email approval has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The coo email approval could not be saved. Please, try again.'));
            }
        }
        $certificateOrigins = $this->CooEmailApprovals->CertificateOrigins->find('list', ['limit' => 200]);
        $users = $this->CooEmailApprovals->Users->find('list', ['limit' => 200]);
        $this->set(compact('cooEmailApproval', 'certificateOrigins', 'users'));
        $this->set('_serialize', ['cooEmailApproval']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Coo Email Approval id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cooEmailApproval = $this->CooEmailApprovals->get($id);
        if ($this->CooEmailApprovals->delete($cooEmailApproval)) {
            $this->Flash->success(__('The coo email approval has been deleted.'));
        } else {
            $this->Flash->error(__('The coo email approval could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GrievanceIssueRelateds Controller
 *
 * @property \App\Model\Table\GrievanceIssueRelatedsTable $GrievanceIssueRelateds
 */
class GrievanceIssueRelatedsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['GrievanceIssues']
        ];
        $grievanceIssueRelateds = $this->paginate($this->GrievanceIssueRelateds);

        $this->set(compact('grievanceIssueRelateds'));
        $this->set('_serialize', ['grievanceIssueRelateds']);
    }

    /**
     * View method
     *
     * @param string|null $id Grievance Issue Related id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grievanceIssueRelated = $this->GrievanceIssueRelateds->get($id, [
            'contain' => ['GrievanceIssues', 'IndustrialGrievances']
        ]);

        $this->set('grievanceIssueRelated', $grievanceIssueRelated);
        $this->set('_serialize', ['grievanceIssueRelated']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grievanceIssueRelated = $this->GrievanceIssueRelateds->newEntity();
        if ($this->request->is('post')) {
            $grievanceIssueRelated = $this->GrievanceIssueRelateds->patchEntity($grievanceIssueRelated, $this->request->data);
            if ($this->GrievanceIssueRelateds->save($grievanceIssueRelated)) {
                $this->Flash->success(__('The grievance issue related has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance issue related could not be saved. Please, try again.'));
            }
        }
        $grievanceIssues = $this->GrievanceIssueRelateds->GrievanceIssues->find('list', ['limit' => 200]);
        $this->set(compact('grievanceIssueRelated', 'grievanceIssues'));
        $this->set('_serialize', ['grievanceIssueRelated']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grievance Issue Related id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grievanceIssueRelated = $this->GrievanceIssueRelateds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grievanceIssueRelated = $this->GrievanceIssueRelateds->patchEntity($grievanceIssueRelated, $this->request->data);
            if ($this->GrievanceIssueRelateds->save($grievanceIssueRelated)) {
                $this->Flash->success(__('The grievance issue related has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance issue related could not be saved. Please, try again.'));
            }
        }
        $grievanceIssues = $this->GrievanceIssueRelateds->GrievanceIssues->find('list', ['limit' => 200]);
        $this->set(compact('grievanceIssueRelated', 'grievanceIssues'));
        $this->set('_serialize', ['grievanceIssueRelated']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grievance Issue Related id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grievanceIssueRelated = $this->GrievanceIssueRelateds->get($id);
        if ($this->GrievanceIssueRelateds->delete($grievanceIssueRelated)) {
            $this->Flash->success(__('The grievance issue related has been deleted.'));
        } else {
            $this->Flash->error(__('The grievance issue related could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

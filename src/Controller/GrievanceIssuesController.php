<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GrievanceIssues Controller
 *
 * @property \App\Model\Table\GrievanceIssuesTable $GrievanceIssues
 */
class GrievanceIssuesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $grievanceIssues = $this->paginate($this->GrievanceIssues);

        $this->set(compact('grievanceIssues'));
        $this->set('_serialize', ['grievanceIssues']);
    }

    /**
     * View method
     *
     * @param string|null $id Grievance Issue id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grievanceIssue = $this->GrievanceIssues->get($id, [
            'contain' => ['GrievanceIssueRelateds', 'IndustrialGrievances']
        ]);

        $this->set('grievanceIssue', $grievanceIssue);
        $this->set('_serialize', ['grievanceIssue']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grievanceIssue = $this->GrievanceIssues->newEntity();
        if ($this->request->is('post')) {
            $grievanceIssue = $this->GrievanceIssues->patchEntity($grievanceIssue, $this->request->data);
            if ($this->GrievanceIssues->save($grievanceIssue)) {
                $this->Flash->success(__('The grievance issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance issue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('grievanceIssue'));
        $this->set('_serialize', ['grievanceIssue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grievance Issue id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grievanceIssue = $this->GrievanceIssues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grievanceIssue = $this->GrievanceIssues->patchEntity($grievanceIssue, $this->request->data);
            if ($this->GrievanceIssues->save($grievanceIssue)) {
                $this->Flash->success(__('The grievance issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance issue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('grievanceIssue'));
        $this->set('_serialize', ['grievanceIssue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grievance Issue id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grievanceIssue = $this->GrievanceIssues->get($id);
        if ($this->GrievanceIssues->delete($grievanceIssue)) {
            $this->Flash->success(__('The grievance issue has been deleted.'));
        } else {
            $this->Flash->error(__('The grievance issue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

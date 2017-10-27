<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GrievanceCategories Controller
 *
 * @property \App\Model\Table\GrievanceCategoriesTable $GrievanceCategories
 */
class GrievanceCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $grievanceCategories = $this->paginate($this->GrievanceCategories);

        $this->set(compact('grievanceCategories'));
        $this->set('_serialize', ['grievanceCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Grievance Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $grievanceCategory = $this->GrievanceCategories->get($id, [
            'contain' => ['IndustrialGrievances']
        ]);

        $this->set('grievanceCategory', $grievanceCategory);
        $this->set('_serialize', ['grievanceCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $grievanceCategory = $this->GrievanceCategories->newEntity();
        if ($this->request->is('post')) {
            $grievanceCategory = $this->GrievanceCategories->patchEntity($grievanceCategory, $this->request->data);
            if ($this->GrievanceCategories->save($grievanceCategory)) {
                $this->Flash->success(__('The grievance category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('grievanceCategory'));
        $this->set('_serialize', ['grievanceCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Grievance Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $grievanceCategory = $this->GrievanceCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $grievanceCategory = $this->GrievanceCategories->patchEntity($grievanceCategory, $this->request->data);
            if ($this->GrievanceCategories->save($grievanceCategory)) {
                $this->Flash->success(__('The grievance category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The grievance category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('grievanceCategory'));
        $this->set('_serialize', ['grievanceCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Grievance Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $grievanceCategory = $this->GrievanceCategories->get($id);
        if ($this->GrievanceCategories->delete($grievanceCategory)) {
            $this->Flash->success(__('The grievance category has been deleted.'));
        } else {
            $this->Flash->error(__('The grievance category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

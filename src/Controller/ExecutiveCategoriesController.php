<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExecutiveCategories Controller
 *
 * @property \App\Model\Table\ExecutiveCategoriesTable $ExecutiveCategories
 */
class ExecutiveCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $executiveCategories = $this->paginate($this->ExecutiveCategories);

        $this->set(compact('executiveCategories'));
        $this->set('_serialize', ['executiveCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Executive Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $executiveCategory = $this->ExecutiveCategories->get($id, [
            'contain' => ['ExecutiveMembers']
        ]);

        $this->set('executiveCategory', $executiveCategory);
        $this->set('_serialize', ['executiveCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $executiveCategory = $this->ExecutiveCategories->newEntity();
        if ($this->request->is('post')) {
            $executiveCategory = $this->ExecutiveCategories->patchEntity($executiveCategory, $this->request->data);
            if ($this->ExecutiveCategories->save($executiveCategory)) {
                $this->Flash->success(__('The executive category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The executive category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('executiveCategory'));
        $this->set('_serialize', ['executiveCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Executive Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $executiveCategory = $this->ExecutiveCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $executiveCategory = $this->ExecutiveCategories->patchEntity($executiveCategory, $this->request->data);
            if ($this->ExecutiveCategories->save($executiveCategory)) {
                $this->Flash->success(__('The executive category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The executive category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('executiveCategory'));
        $this->set('_serialize', ['executiveCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Executive Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $executiveCategory = $this->ExecutiveCategories->get($id);
        if ($this->ExecutiveCategories->delete($executiveCategory)) {
            $this->Flash->success(__('The executive category has been deleted.'));
        } else {
            $this->Flash->error(__('The executive category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

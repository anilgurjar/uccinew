<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EventCategories Controller
 *
 * @property \App\Model\Table\EventCategoriesTable $EventCategories
 */
class EventCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $eventCategories = $this->paginate($this->EventCategories);

        $this->set(compact('eventCategories'));
        $this->set('_serialize', ['eventCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventCategory = $this->EventCategories->get($id, [
            'contain' => ['EventHistories', 'Events']
        ]);

        $this->set('eventCategory', $eventCategory);
        $this->set('_serialize', ['eventCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventCategory = $this->EventCategories->newEntity();
        if ($this->request->is('post')) {
            $eventCategory = $this->EventCategories->patchEntity($eventCategory, $this->request->data);
            if ($this->EventCategories->save($eventCategory)) {
                $this->Flash->success(__('The event category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('eventCategory'));
        $this->set('_serialize', ['eventCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventCategory = $this->EventCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventCategory = $this->EventCategories->patchEntity($eventCategory, $this->request->data);
            if ($this->EventCategories->save($eventCategory)) {
                $this->Flash->success(__('The event category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('eventCategory'));
        $this->set('_serialize', ['eventCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventCategory = $this->EventCategories->get($id);
        if ($this->EventCategories->delete($eventCategory)) {
            $this->Flash->success(__('The event category has been deleted.'));
        } else {
            $this->Flash->error(__('The event category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

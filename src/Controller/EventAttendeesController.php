<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EventAttendees Controller
 *
 * @property \App\Model\Table\EventAttendeesTable $EventAttendees
 */
class EventAttendeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users']
        ];
        $eventAttendees = $this->paginate($this->EventAttendees);

        $this->set(compact('eventAttendees'));
        $this->set('_serialize', ['eventAttendees']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Attendee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventAttendee = $this->EventAttendees->get($id, [
            'contain' => ['Events', 'Users']
        ]);

        $this->set('eventAttendee', $eventAttendee);
        $this->set('_serialize', ['eventAttendee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventAttendee = $this->EventAttendees->newEntity();
        if ($this->request->is('post')) {
            $eventAttendee = $this->EventAttendees->patchEntity($eventAttendee, $this->request->data);
            if ($this->EventAttendees->save($eventAttendee)) {
                $this->Flash->success(__('The event attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event attendee could not be saved. Please, try again.'));
            }
        }
        $events = $this->EventAttendees->Events->find('list', ['limit' => 200]);
        $users = $this->EventAttendees->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventAttendee', 'events', 'users'));
        $this->set('_serialize', ['eventAttendee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Attendee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventAttendee = $this->EventAttendees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventAttendee = $this->EventAttendees->patchEntity($eventAttendee, $this->request->data);
            if ($this->EventAttendees->save($eventAttendee)) {
                $this->Flash->success(__('The event attendee has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event attendee could not be saved. Please, try again.'));
            }
        }
        $events = $this->EventAttendees->Events->find('list', ['limit' => 200]);
        $users = $this->EventAttendees->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventAttendee', 'events', 'users'));
        $this->set('_serialize', ['eventAttendee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Attendee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventAttendee = $this->EventAttendees->get($id);
        if ($this->EventAttendees->delete($eventAttendee)) {
            $this->Flash->success(__('The event attendee has been deleted.'));
        } else {
            $this->Flash->error(__('The event attendee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

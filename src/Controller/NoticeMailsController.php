<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NoticeMails Controller
 *
 * @property \App\Model\Table\NoticeMailsTable $NoticeMails
 */
class NoticeMailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Notices']
        ];
        $noticeMails = $this->paginate($this->NoticeMails);

        $this->set(compact('noticeMails'));
        $this->set('_serialize', ['noticeMails']);
    }

    /**
     * View method
     *
     * @param string|null $id Notice Mail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $noticeMail = $this->NoticeMails->get($id, [
            'contain' => ['Notices']
        ]);

        $this->set('noticeMail', $noticeMail);
        $this->set('_serialize', ['noticeMail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $noticeMail = $this->NoticeMails->newEntity();
        if ($this->request->is('post')) {
            $noticeMail = $this->NoticeMails->patchEntity($noticeMail, $this->request->data);
            if ($this->NoticeMails->save($noticeMail)) {
                $this->Flash->success(__('The notice mail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notice mail could not be saved. Please, try again.'));
            }
        }
        $notices = $this->NoticeMails->Notices->find('list', ['limit' => 200]);
        $this->set(compact('noticeMail', 'notices'));
        $this->set('_serialize', ['noticeMail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice Mail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $noticeMail = $this->NoticeMails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $noticeMail = $this->NoticeMails->patchEntity($noticeMail, $this->request->data);
            if ($this->NoticeMails->save($noticeMail)) {
                $this->Flash->success(__('The notice mail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notice mail could not be saved. Please, try again.'));
            }
        }
        $notices = $this->NoticeMails->Notices->find('list', ['limit' => 200]);
        $this->set(compact('noticeMail', 'notices'));
        $this->set('_serialize', ['noticeMail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice Mail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $noticeMail = $this->NoticeMails->get($id);
        if ($this->NoticeMails->delete($noticeMail)) {
            $this->Flash->success(__('The notice mail has been deleted.'));
        } else {
            $this->Flash->error(__('The notice mail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

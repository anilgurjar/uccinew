<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NoticeCategories Controller
 *
 * @property \App\Model\Table\NoticeCategoriesTable $NoticeCategories
 */
class NoticeCategoriesController extends AppController
{
	public function initialize()
		{
			parent::initialize();
			$this->Auth->allow(['logout', 'index']);
			$member_name=$this->Auth->User('member_name');
			$this->set('member_name',$member_name);
		}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $noticeCategories = $this->paginate($this->NoticeCategories);

        $this->set(compact('noticeCategories'));
        $this->set('_serialize', ['noticeCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $noticeCategory = $this->NoticeCategories->get($id, [
            'contain' => []
        ]);

        $this->set('noticeCategory', $noticeCategory);
        $this->set('_serialize', ['noticeCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $noticeCategory = $this->NoticeCategories->newEntity();
        if ($this->request->is('post')) {
            $noticeCategory = $this->NoticeCategories->patchEntity($noticeCategory, $this->request->data);
            if ($this->NoticeCategories->save($noticeCategory)) {
                $this->Flash->success(__('The notice category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notice category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('noticeCategory'));
        $this->set('_serialize', ['noticeCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $noticeCategory = $this->NoticeCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $noticeCategory = $this->NoticeCategories->patchEntity($noticeCategory, $this->request->data);
            if ($this->NoticeCategories->save($noticeCategory)) {
                $this->Flash->success(__('The notice category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notice category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('noticeCategory'));
        $this->set('_serialize', ['noticeCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notice Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $noticeCategory = $this->NoticeCategories->get($id);
        if ($this->NoticeCategories->delete($noticeCategory)) {
            $this->Flash->success(__('The notice category has been deleted.'));
        } else {
            $this->Flash->error(__('The notice category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

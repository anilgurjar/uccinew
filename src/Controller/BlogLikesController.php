<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BlogLikes Controller
 *
 * @property \App\Model\Table\BlogLikesTable $BlogLikes
 */
class BlogLikesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Blogs', 'Users']
        ];
        $blogLikes = $this->paginate($this->BlogLikes);

        $this->set(compact('blogLikes'));
        $this->set('_serialize', ['blogLikes']);
    }

    /**
     * View method
     *
     * @param string|null $id Blog Like id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blogLike = $this->BlogLikes->get($id, [
            'contain' => ['Blogs', 'Users']
        ]);

        $this->set('blogLike', $blogLike);
        $this->set('_serialize', ['blogLike']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blogLike = $this->BlogLikes->newEntity();
        if ($this->request->is('post')) {
            $blogLike = $this->BlogLikes->patchEntity($blogLike, $this->request->data);
            if ($this->BlogLikes->save($blogLike)) {
                $this->Flash->success(__('The blog like has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog like could not be saved. Please, try again.'));
            }
        }
        $blogs = $this->BlogLikes->Blogs->find('list', ['limit' => 200]);
        $users = $this->BlogLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('blogLike', 'blogs', 'users'));
        $this->set('_serialize', ['blogLike']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog Like id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blogLike = $this->BlogLikes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blogLike = $this->BlogLikes->patchEntity($blogLike, $this->request->data);
            if ($this->BlogLikes->save($blogLike)) {
                $this->Flash->success(__('The blog like has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog like could not be saved. Please, try again.'));
            }
        }
        $blogs = $this->BlogLikes->Blogs->find('list', ['limit' => 200]);
        $users = $this->BlogLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('blogLike', 'blogs', 'users'));
        $this->set('_serialize', ['blogLike']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog Like id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blogLike = $this->BlogLikes->get($id);
        if ($this->BlogLikes->delete($blogLike)) {
            $this->Flash->success(__('The blog like has been deleted.'));
        } else {
            $this->Flash->error(__('The blog like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

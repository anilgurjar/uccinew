<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HomeMenus Controller
 *
 * @property \App\Model\Table\HomeMenusTable $HomeMenus
 */
class HomeMenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $homeMenus = $this->paginate($this->HomeMenus);

        $this->set(compact('homeMenus'));
        $this->set('_serialize', ['homeMenus']);
    }

    /**
     * View method
     *
     * @param string|null $id Home Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homeMenu = $this->HomeMenus->get($id, [
            'contain' => []
        ]);

        $this->set('homeMenu', $homeMenu);
        $this->set('_serialize', ['homeMenu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homeMenu = $this->HomeMenus->newEntity();
        if ($this->request->is('post')) {
            $homeMenu = $this->HomeMenus->patchEntity($homeMenu, $this->request->data);
            if ($this->HomeMenus->save($homeMenu)) {
                $this->Flash->success(__('The home menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The home menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('homeMenu'));
        $this->set('_serialize', ['homeMenu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Home Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homeMenu = $this->HomeMenus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeMenu = $this->HomeMenus->patchEntity($homeMenu, $this->request->data);
            if ($this->HomeMenus->save($homeMenu)) {
                $this->Flash->success(__('The home menu has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The home menu could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('homeMenu'));
        $this->set('_serialize', ['homeMenu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Home Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homeMenu = $this->HomeMenus->get($id);
        if ($this->HomeMenus->delete($homeMenu)) {
            $this->Flash->success(__('The home menu has been deleted.'));
        } else {
            $this->Flash->error(__('The home menu could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

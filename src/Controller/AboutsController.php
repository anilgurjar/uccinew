<?php
namespace App\Controller;
use Cake\View\View;
use Cake\View\ViewBuilder;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Event\Event;
ini_set('max_execution_time', 300);
ini_set('memory_limit', '256M');
//use Cake\Network\Email\Email;
/**
 * Abouts Controller
 *
 * @property \App\Model\Table\AboutsTable $Abouts
 */
class AboutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $abouts = $this->paginate($this->Abouts);

        $this->set(compact('abouts'));
        $this->set('_serialize', ['abouts']);
    }
	public function demo()
    {
       $user_id=$this->Auth->User('id');
	   $this->viewBuilder()->layout('index_layout');
    }
	
	public function demo1()
    {
       $user_id=$this->Auth->User('id');
	   $this->viewBuilder()->layout('index_layout');
    }
	public function demo3()
    {
       $user_id=$this->Auth->User('id');
	   $this->viewBuilder()->layout('index_layout');
    }

    /**
     * View method
     *
     * @param string|null $id About id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $about = $this->Abouts->get($id, [
            'contain' => []
        ]);

        $this->set('about', $about);
        $this->set('_serialize', ['about']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $about = $this->Abouts->newEntity();
        if ($this->request->is('post')) {
            $about = $this->Abouts->patchEntity($about, $this->request->data);
            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('The about has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The about could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('about'));
        $this->set('_serialize', ['about']);
    }

    /**
     * Edit method
     *
     * @param string|null $id About id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $about = $this->Abouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $about = $this->Abouts->patchEntity($about, $this->request->data);
            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('The about has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The about could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('about'));
        $this->set('_serialize', ['about']);
    }

    /**
     * Delete method
     *
     * @param string|null $id About id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $about = $this->Abouts->get($id);
        if ($this->Abouts->delete($about)) {
            $this->Flash->success(__('The about has been deleted.'));
        } else {
            $this->Flash->error(__('The about could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * AffilationRegistrations Controller
 *
 * @property \App\Model\Table\AffilationRegistrationsTable $AffilationRegistrations
 */
class AffilationRegistrationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
	 
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $affilationRegistrations = $this->paginate($this->AffilationRegistrations);

        $this->set(compact('affilationRegistrations'));
        $this->set('_serialize', ['affilationRegistrations']);
    }

    /**
     * View method
     *
     * @param string|null $id Affilation Registration id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
        $affilationRegistration = $this->AffilationRegistrations->get($id, [
            'contain' => []
        ]);

        $this->set('affilationRegistration', $affilationRegistration);
        $this->set('_serialize', ['affilationRegistration']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $affilationRegistration = $this->AffilationRegistrations->newEntity();
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        if ($this->request->is('post')) {
			
			$images=$this->request->data['image'];
			$this->request->data['created_by']=$user_id;
			$ext = substr(strtolower(strrchr($images['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();


				$dir = new Folder(WWW_ROOT . 'img/affilation/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/affilation/';
				$coverage_path='img/affilation/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($images['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['logo']=$coverage_path;
						
			
			
            $affilationRegistration = $this->AffilationRegistrations->patchEntity($affilationRegistration, $this->request->data);
            if ($this->AffilationRegistrations->save($affilationRegistration)) {
                $this->Flash->success(__('The affilation registration has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
				
                $this->Flash->error(__('The affilation registration could not be saved. Please, try again.'));
            }
        }
		 $affilationRegistrations = $this->paginate($this->AffilationRegistrations);

        $this->set(compact('affilationRegistration','affilationRegistrations'));
        $this->set('_serialize', ['affilationRegistration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Affilation Registration id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $affilationRegistration = $this->AffilationRegistrations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $affilationRegistration = $this->AffilationRegistrations->patchEntity($affilationRegistration, $this->request->data);
            if ($this->AffilationRegistrations->save($affilationRegistration)) {
                $this->Flash->success(__('The affilation registration has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The affilation registration could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('affilationRegistration'));
        $this->set('_serialize', ['affilationRegistration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Affilation Registration id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $affilationRegistration = $this->AffilationRegistrations->get($id);
        if ($this->AffilationRegistrations->delete($affilationRegistration)) {
            $this->Flash->success(__('The affilation registration has been deleted.'));
        } else {
            $this->Flash->error(__('The affilation registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}

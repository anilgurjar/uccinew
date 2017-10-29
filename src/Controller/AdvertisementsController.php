<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Advertisements Controller
 *
 * @property \App\Model\Table\AdvertisementsTable $Advertisements
 */
class AdvertisementsController extends AppController
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
        $advertisements = $this->paginate($this->Advertisements);

        $this->set(compact('advertisements'));
        $this->set('_serialize', ['advertisements']);
    }

    /**
     * View method
     *
     * @param string|null $id Advertisement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $advertisement = $this->Advertisements->get($id, [
            'contain' => []
        ]);

        $this->set('advertisement', $advertisement);
        $this->set('_serialize', ['advertisement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $advertisement = $this->Advertisements->newEntity();
        if ($this->request->is('post')) {
			$images=$this->request->data['image'];
			$this->request->data['created_by']=$user_id;
			
				$ext = substr(strtolower(strrchr($images['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();


				$dir = new Folder(WWW_ROOT . 'img/advertisement/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/advertisement/';
				$coverage_path='img/advertisement/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($images['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['photo']=$coverage_path;
						
            $advertisement = $this->Advertisements->patchEntity($advertisement, $this->request->data);
					
            if ($this->Advertisements->save($advertisement)) {
				
				
                $this->Flash->success(__('The advertisement has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The advertisement could not be saved. Please, try again.'));
            }
        }
		 $advertisements = $this->paginate($this->Advertisements);

        $this->set(compact('advertisement','advertisements'));
        $this->set('_serialize', ['advertisement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Advertisement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $advertisement = $this->Advertisements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $advertisement = $this->Advertisements->patchEntity($advertisement, $this->request->data);
            if ($this->Advertisements->save($advertisement)) {
                $this->Flash->success(__('The advertisement has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The advertisement could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('advertisement'));
        $this->set('_serialize', ['advertisement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Advertisement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $advertisement = $this->Advertisements->get($id);
        if ($this->Advertisements->delete($advertisement)) {
            $this->Flash->success(__('The advertisement has been deleted.'));
        } else {
            $this->Flash->error(__('The advertisement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}

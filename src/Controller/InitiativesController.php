<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Initiatives Controller
 *
 * @property \App\Model\Table\InitiativesTable $Initiatives
 */
class InitiativesController extends AppController
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
        $initiatives = $this->paginate($this->Initiatives->find()->contain(['InitiativeCategories']));

        $this->set(compact('initiatives'));
        $this->set('_serialize', ['initiatives']);
    }

    /**
     * View method
     *
     * @param string|null $id Initiative id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $initiative = $this->Initiatives->get($id, [
            'contain' => []
        ]);

        $this->set('initiative', $initiative);
        $this->set('_serialize', ['initiative']);
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
        $initiative = $this->Initiatives->newEntity();
        if ($this->request->is('post')) {
			
			$this->request->data['created_by']=$user_id;
			$images=$this->request->data['photo'];
			$description_photo=$this->request->data['description_photo'];
			
			if(!empty($images['name'])){
				$ext = substr(strtolower(strrchr($images['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();

				$dir = new Folder(WWW_ROOT . 'img/initiative/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/initiative/';
				$coverage_path='img/initiative/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($images['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['icon_photo']=$coverage_path;
				
			}	
			
			if(!empty($description_photo['name'])){
				
				$ext = substr(strtolower(strrchr($description_photo['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();

				$dir = new Folder(WWW_ROOT . 'img/initiative/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/initiative/';
				$coverage_path_des='img/initiative/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($description_photo['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['description_photo']=$coverage_path_des;
			}
			
			
            $initiative = $this->Initiatives->patchEntity($initiative, $this->request->data);
			
			
			
            if ($this->Initiatives->save($initiative)) {
                $this->Flash->success(__('The initiative has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The initiative could not be saved. Please, try again.'));
            }
        }
		
		$InitiativeCategories=$this->Initiatives->InitiativeCategories->find('list');
		
        $this->set(compact('initiative','InitiativeCategories'));
        $this->set('_serialize', ['initiative']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Initiative id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $initiative = $this->Initiatives->get($id, [
            'contain' => []
        ]);
		$old_photo=$initiative->icon_photo; 
		$old_description_photo=$initiative->description_photo; 
        if ($this->request->is(['patch', 'post', 'put'])) {
			$this->request->data['edited_by']=$user_id;
			//$this->request->data['edited_on']=date('Y-m-d');
					
			$images=$this->request->data['photo'];
			$description_photo=$this->request->data['description_photo'];
			if(!empty($images['name'])){
				//unlink($old_photo);
				$ext = substr(strtolower(strrchr($images['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();


				$dir = new Folder(WWW_ROOT . 'img/initiative/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/initiative/';
				$coverage_path='img/initiative/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($images['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['icon_photo']=$coverage_path;
			}else{
				$this->request->data['icon_photo']=$old_photo;
			}
			
			if(!empty($description_photo['name'])){
				//unlink($old_photo);
				$ext = substr(strtolower(strrchr($description_photo['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				$setNewFileName = uniqid();


				$dir = new Folder(WWW_ROOT . 'img/initiative/', true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/initiative/';
				$coverage_path_new='img/initiative/'.$setNewFileName.'.'.$ext;
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($description_photo['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
				}

				$this->request->data['description_photo']=$coverage_path_new;
			}else{
				$this->request->data['description_photo']=$old_description_photo;
			}
						
					
            $initiative = $this->Initiatives->patchEntity($initiative, $this->request->data);
            if ($this->Initiatives->save($initiative)) {
                $this->Flash->success(__('The initiative has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The initiative could not be saved. Please, try again.'));
            }
        }
		$InitiativeCategories=$this->Initiatives->InitiativeCategories->find('list');
		
        $this->set(compact('initiative','InitiativeCategories'));
        $this->set('_serialize', ['initiative']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Initiative id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $initiative = $this->Initiatives->get($id);
        if ($this->Initiatives->delete($initiative)) {
            $this->Flash->success(__('The initiative has been deleted.'));
        } else {
            $this->Flash->error(__('The initiative could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

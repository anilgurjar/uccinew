<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Galleries Controller
 *
 * @property \App\Model\Table\GalleriesTable $Galleries
 */
class GalleriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 
	 public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
	 
	 
	 
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Events', 'Blogs']
        ];
        $galleries = $this->Galleries->find();

        $this->set(compact('galleries'));
        $this->set('_serialize', ['galleries']);
    }

    /**
     * View method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gallery = $this->Galleries->get($id, [
            'contain' => ['Events', 'Blogs', 'GalleryPhotos']
        ]);

        $this->set('gallery', $gallery);
        $this->set('_serialize', ['gallery']);
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
        $gallery = $this->Galleries->newEntity();
        if ($this->request->is('post')) {
			
			$files=$this->request->data['cover_image'];
			$this->request->data['created_by']=$user_id;
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->data);
            if ($gallery_data=$this->Galleries->save($gallery)) {
				
				 $gallery_id=$gallery_data->id; 
				
				if(!empty($files['name'])){
					
					$ext = substr(strtolower(strrchr($files['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					
					
					$dir = new Folder(WWW_ROOT . 'img/Gallery/'.$gallery_id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/Gallery/'.$gallery_id;
					$coverage_path='img/Gallery/'.$gallery_id.'/'.$setNewFileName.'.'.$ext;
					
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($files['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
						}
					
				}	
				
			
				$query = $this->Galleries->query();
				$query->update()
				->set(['cover_image'=>$coverage_path])
				->where(['id' => $gallery_id])
				->execute();
								
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				
                $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
            }
        }
        $events = $this->Galleries->Events->find('list', ['limit' => 200]);
        $blogs = $this->Galleries->Blogs->find('list', ['limit' => 200]);
        $this->set(compact('gallery', 'events', 'blogs'));
        $this->set('_serialize', ['gallery']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gallery = $this->Galleries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->data);
            if ($this->Galleries->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
            }
        }
        $events = $this->Galleries->Events->find('list', ['limit' => 200]);
        $blogs = $this->Galleries->Blogs->find('list', ['limit' => 200]);
        $this->set(compact('gallery', 'events', 'blogs'));
        $this->set('_serialize', ['gallery']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gallery = $this->Galleries->get($id);
        if ($this->Galleries->delete($gallery)) {
            $this->Flash->success(__('The gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

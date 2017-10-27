<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * GalleryPhotos Controller
 *
 * @property \App\Model\Table\GalleryPhotosTable $GalleryPhotos
 */
class GalleryPhotosController extends AppController
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
        $this->paginate = [
            'contain' => ['Galleries']
        ];
        $galleryPhotos = $this->paginate($this->GalleryPhotos);

        $this->set(compact('galleryPhotos'));
        $this->set('_serialize', ['galleryPhotos']);
    }

    /**
     * View method
     *
     * @param string|null $id Gallery Photo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $galleryPhoto = $this->GalleryPhotos->get($id, [
            'contain' => ['Galleries']
        ]);

        $this->set('galleryPhoto', $galleryPhoto);
        $this->set('_serialize', ['galleryPhoto']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $galleryPhoto = $this->GalleryPhotos->newEntity();
        if ($this->request->is('post')) {
			
			$this->request->data['created_by']=$user_id;
			$files=$this->request->data['photo'];
			
            $galleryPhoto = $this->GalleryPhotos->patchEntity($galleryPhoto, $this->request->data);
            if ($gallery_data=$this->GalleryPhotos->save($galleryPhoto)) {
				$gallery_photo_id=$gallery_data->id;
												
				if(!empty($files['name'])){
					$dir = new Folder(WWW_ROOT . 'img/gallery_photo/'.$id, true, 0755);
					$ext = substr(strtolower(strrchr($files['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					
					$file_path = str_replace("\\","/",WWW_ROOT).'img/gallery_photo/'.$id;
					$coverage_path='img/gallery_photo/'.$id.'/'.$setNewFileName.'.'.$ext;
					if (in_array($ext, $arr_ext)) {
					 move_uploaded_file($files['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
					}
					
					$query = $this->GalleryPhotos->query();
					$query->update()
					->set(['image'=>$coverage_path])
					->where(['id' => $gallery_photo_id])
					->execute();
				}	
				
							
                $this->Flash->success(__('The gallery photo has been saved.'));

                return $this->redirect(['action' => 'add',$id]);
            } else {
				pr($galleryPhoto); exit;
                $this->Flash->error(__('The gallery photo could not be saved. Please, try again.'));
            }
        }
		
		$GalleryPhoto_lists=$this->GalleryPhotos->find()
							->where(['gallery_id'=>$id])
							->contain(['Galleries']);
		
		
        $galleries = $this->GalleryPhotos->Galleries->find('list', ['limit' => 200]);
        $this->set(compact('galleryPhoto', 'galleries','id','GalleryPhoto_lists'));
        $this->set('_serialize', ['galleryPhoto']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery Photo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $galleryPhoto = $this->GalleryPhotos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $galleryPhoto = $this->GalleryPhotos->patchEntity($galleryPhoto, $this->request->data);
            if ($this->GalleryPhotos->save($galleryPhoto)) {
                $this->Flash->success(__('The gallery photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gallery photo could not be saved. Please, try again.'));
            }
        }
        $galleries = $this->GalleryPhotos->Galleries->find('list', ['limit' => 200]);
        $this->set(compact('galleryPhoto', 'galleries'));
        $this->set('_serialize', ['galleryPhoto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallery Photo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $galleryPhoto = $this->GalleryPhotos->get($id);
        if ($this->GalleryPhotos->delete($galleryPhoto)) {
            $this->Flash->success(__('The gallery photo has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

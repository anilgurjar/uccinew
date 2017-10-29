<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Blogs Controller
 *
 * @property \App\Model\Table\BlogsTable $Blogs
 */
class BlogsController extends AppController
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
	 
    public function index($status=null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$Companies=$this->Blogs->Companies->get($company_id);
		$role_id=$Companies->role_id;
		$Blogs = $this->Blogs->newEntity();
        $blogs = $this->paginate($this->Blogs);
			
			 if($this->request->is('post')) {
					
					$id=$this->request->data['event_id'];
					$save_blogs= $this->Blogs->get($id);
					$save_blogs->status='published';
					$save_blogs->published_on=date("Y-m-d");
					$save_blogs->published_by=$user_id;
				
						if($this->Blogs->save($save_blogs)) {
							
							$this->Flash->success(__('The event has been published.'));

							return $this->redirect(['action' => 'index']);
						} else {

							$this->Flash->error(__('The event could not be published. Please, try again.'));
						}
				}
				
				if(!empty($status)){
					$where['status']=$status;

				}else{
					$where['status']='draft';
				}

				$blogs = $this->paginate($this->Blogs->find()
					->where($where)
					->order(['Blogs.id'=>'DESC'])
					
				);
		
			
        $this->set(compact('blogs','status','Blogs','role_id'));
        $this->set('_serialize', ['blogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blog = $this->Blogs->get($id, [
            'contain' => ['BlogLikes', 'Galleries']
        ]);

        $this->set('blog', $blog);
        $this->set('_serialize', ['blog']);
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
        $blog = $this->Blogs->newEntity();
        if ($this->request->is('post')) {
			$files=$this->request->data['cover_image']; 
			$this->request->data['created_by']=$user_id;
			$this->request->data['status']='draft';
            $blog = $this->Blogs->patchEntity($blog, $this->request->data);
			$coverage_path='';
            if ($blod_data=$this->Blogs->save($blog)) {
				
				$blog_id=$blod_data->id; 
				
				
				if(!empty($files[0]['name'])){
					
					$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					$dir = new Folder(WWW_ROOT . 'img/blog/'.$blog_id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/blog/'.$blog_id;
					$coverage_path='img/blog/'.$blog_id.'/'.$setNewFileName.'.'.$ext;
					foreach($files as $file){
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($file['tmp_name'], $file_path.'/' . $setNewFileName.'.'.$ext);
						}
					}
				}
				
				
				$query = $this->Blogs->query();
				$query->update()
				->set(['cover_image'=>$coverage_path])
				->where(['id' => $blog_id])
				->execute();
				
				
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blog'));
        $this->set('_serialize', ['blog']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $blog = $this->Blogs->get($id, [
            'contain' => []
        ]);
		
		$image=$blog->cover_image;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
						
			$this->request->data['edited_on']=date("Y-m-d");
			$this->request->data['edited_by']=$user_id;
				
			$files=$this->request->data['cover_image']; 
            $blog = $this->Blogs->patchEntity($blog, $this->request->data);
            if ($this->Blogs->save($blog)) {
				
				if(!empty($files[0]['name'])){
					$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					$dir = new Folder(WWW_ROOT . 'img/blog/'.$id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/blog/'.$id;
					$coverage_path='img/blog/'.$id.'/'.$setNewFileName.'.'.$ext;
					foreach($files as $file){
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($file['tmp_name'], $file_path.'/' . $setNewFileName.'.'.$ext);
						}
					}
				}else{
					$coverage_path= $image;
				}
				
				
				$query = $this->Blogs->query();
				$query->update()
				->set(['cover_image'=>$coverage_path])
				->where(['id' => $id])
				->execute();
				
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The blog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('blog'));
        $this->set('_serialize', ['blog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blogs->get($id);
        if ($this->Blogs->delete($blog)) {
            $this->Flash->success(__('The blog has been deleted.'));
        } else {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

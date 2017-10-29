<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
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
        $event_datas = $this->Events->newEntity();
		 if ($this->request->is('post')) {
			 
				$id=$this->request->data['event_id'];
				$save_events= $this->Events->get($id);
				$save_events->status='published';
				$save_events->published_on=date("Y-m-d");
				$save_events->published_by=$user_id;
								
				$gallerys = $this->Events->Galleries->newEntity();
				$gallerys->event_id=$id;
				$gallerys->name=$save_events->name;
				$gallerys->cover_image=$save_events->cover_image;
				$gallerys->created_by=$user_id;
				if($this->Events->save($save_events)) {
					$this->Events->Galleries->save($gallerys);
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
		$events = $this->paginate($this->Events->find()
					->where($where)
					->order(['Events.id'=>'DESC'])
					->contain(['EventCategories'])
				);
		
        $this->set(compact('events','status','event_datas'));
        $this->set('_serialize', ['events']);
    }

	
	
	
    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $event = $this->Events->get($id, [
            'contain' => ['EventAttendees'=>['Users'], 'EventGuests','EventCategories']
        ]);

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $event = $this->Events->newEntity();
		$user_id=$this->Auth->User('id');
        if ($this->request->is('post')) {
			$this->request->data['status']='draft';
			$this->request->data['created_by']=$user_id;
			$files=$this->request->data['cover_image']; 
			$this->request->data['date']=date("Y-m-d",strtotime($this->request->data['date']));
			$this->request->data['time']=date("H:i", strtotime($this->request->data['time']));;
			
			
            $event = $this->Events->patchEntity($event, $this->request->data);
			$coverage_path='';
            if ($event_data=$this->Events->save($event)) {
				 $event_id=$event_data->id; 
				
				if(!empty($files[0]['name'])){
					
					$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					
					
					$dir = new Folder(WWW_ROOT . 'img/event/'.$event_id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/event/'.$event_id;
					$coverage_path='img/event/'.$event_id.'/'.$setNewFileName.'.'.$ext;
					
					foreach($files as $file){
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($file['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
						}
					}
				}	
				
			
				$query = $this->Events->query();
				$query->update()
				->set(['cover_image'=>$coverage_path])
				->where(['id' => $event_id])
				->execute();
				
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['controller'=>'EventGuests','action' => 'add',$event_id]);
            } else {

                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
		 $eventCategories = $this->Events->EventCategories->find('list');
		
        $this->set(compact('event','eventCategories'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $event = $this->Events->get($id, [
            'contain' => ['EventCategories']
        ]);
		
		$image=$event->cover_image;
		
		
        if($this->request->is(['patch', 'post', 'put'])) {
			
			
			$this->request->data['edited_by']=$user_id;
			$files=$this->request->data['cover_image']; 
			$this->request->data['date']=date("Y-m-d",strtotime($this->request->data['date']));
			$this->request->data['edited_on']=date("Y-m-d");
			$this->request->data['time']=date("H:i", strtotime($this->request->data['time']));;
			
			
			
            $events = $this->Events->patchEntity($event, $this->request->data);
			
            if ($event_data=$this->Events->save($event)) {
				
				 if(!empty($files[0]['name'])){
					 
						$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the extension
						$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
						$setNewFileName = uniqid();
					
						$dir = new Folder(WWW_ROOT . 'img/event/'.$id, true, 0755);
						$file_path = str_replace("\\","/",WWW_ROOT).'img/event/'.$id;
						$coverage_path='img/event/'.$id.'/'.$setNewFileName.'.'.$ext;
						
						foreach($files as $file){ 
							if (in_array($ext, $arr_ext)) {
								move_uploaded_file($file['tmp_name'], $file_path.'/' . $setNewFileName.'.'.$ext);
							}
						}
						
				  }else{
					 $coverage_path= $image;
				  }
				
				$query = $this->Events->query();
				$query->update()
				->set(['cover_image'=>$coverage_path])
				->where(['id' => $id])
				->execute();
				
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
		 $eventCategories = $this->Events->EventCategories->find('list');
        $this->set(compact('event','eventCategories'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

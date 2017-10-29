<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * EventGuests Controller
 *
 * @property \App\Model\Table\EventGuestsTable $EventGuests
 */
class EventGuestsController extends AppController
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
        $this->paginate = [
            'contain' => ['Events']
        ];
        $EventGuests = $this->paginate($this->EventGuests);

        $this->set(compact('EventGuests'));
        $this->set('_serialize', ['EventGuests']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Guet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventGuet = $this->EventGuests->get($id, [
            'contain' => ['Events']
        ]);

        $this->set('eventGuet', $eventGuet);
        $this->set('_serialize', ['eventGuet']);
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
		
		 $events_data = $this->EventGuests->Events->get($id);
		
		
		
        $eventGuet = $this->EventGuests->newEntity();
        if ($this->request->is('post')) {
				$event_id=$this->request->data['event_id'];
				$files=$this->request->data['photo'];
				$this->request->data['created_by']=$user_id;
				$eventGuet = $this->EventGuests->patchEntity($eventGuet, $this->request->data);
				$coverage_path='';
				if($event_guest=$this->EventGuests->save($eventGuet)) {
					
					$event_guest_id=$event_guest->id; 
					
					if(!empty($files[0]['name'])){
						$ext = substr(strtolower(strrchr($files[0]['name'], '.')), 1); //get the extension
						$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
						$setNewFileName = uniqid();
						$dir = new Folder(WWW_ROOT . 'img/event_guest/'.$id, true, 0755);
						$file_path = str_replace("\\","/",WWW_ROOT).'img/event_guest/'.$id;
						$coverage_path='img/event_guest/'.$id.'/'.$setNewFileName.'.'.$ext;
						
						foreach($files as $file){
							if (in_array($ext, $arr_ext)) {
								move_uploaded_file($file['tmp_name'], $file_path.'/' . $setNewFileName.'.'.$ext);
							}
						}
					}	
					
						$query = $this->EventGuests->query();
						$query->update()
						->set(['photo'=>$coverage_path])
						->where(['id' => $event_guest_id])
						->execute();
										
					$this->Flash->success(__('The event guet has been saved.'));

					return $this->redirect(['controller'=>'EventGuests','action' => 'add',$event_id]);
				} else {
					
					$this->Flash->error(__('The event guet could not be saved. Please, try again.'));
				}
        }
		
		$eventGuetlists = $this->EventGuests->find()
							->where(['event_id'=>$id])
							->contain(['Events']);
		
        $events = $this->EventGuests->Events->find('list', ['limit' => 200]);
        $this->set(compact('eventGuet', 'events','id','eventGuetlists','events_data'));
        $this->set('_serialize', ['eventGuet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Guet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventGuet = $this->EventGuests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventGuet = $this->EventGuests->patchEntity($eventGuet, $this->request->data);
            if ($this->EventGuests->save($eventGuet)) {
                $this->Flash->success(__('The event guet has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event guet could not be saved. Please, try again.'));
            }
        }
        $events = $this->EventGuests->Events->find('list', ['limit' => 200]);
        $this->set(compact('eventGuet', 'events'));
        $this->set('_serialize', ['eventGuet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Guet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventGuet = $this->EventGuests->get($id);
        if ($this->EventGuests->delete($eventGuet)) {
            $this->Flash->success(__('The event guet has been deleted.'));
        } else {
            $this->Flash->error(__('The event guet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

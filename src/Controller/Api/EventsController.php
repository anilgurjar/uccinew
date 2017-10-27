<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;


 
class EventsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }
	
	public function EventList()
	{
		$event_count=$this->Events->find()->count();  
		if($event_count>0)
		{
			$eventlist=$this->Events->find();
			$eventlist->select(['id','name','date','location','latitude','longitude','time','cover_image','description'])->where(['status' => 'published'])->order(['published_on'=>'DESC']);
			
			$success=true;
			$error="";
 		}
		else
		{
			$success=false;
			$error="No data found";
 		}
		$this->set(compact('success','error','eventlist'));
        $this->set('_serialize', ['success','error','eventlist']);
	}
	
	public function EventDetails()
	{
		$event_id=$this->request->query['event_id'];
		$user_id=$this->request->query['user_id'];
 		$countevent=$this->Events->find()->where(['status'=>'published' , 'id' => $event_id])->count();
		if($countevent>0)
		{
			$event=$this->Events->find();
			$event->where(['status' => 'published', 'id' => $event_id])
					->order(['published_on'=>'DESC'])
					->contain(['EventGuests',
						'EventAttendees'=>function($q) use($user_id){
							return $q->where(['user_id'=>$user_id]);
						}
					])
					->autoFields(true);
			
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
		}
		$this->set(compact('success','error','event'));
        $this->set('_serialize', ['success','error','event']);
	} 
	public function EventSearch()
	{
		$search_data=$this->request->query['search_data'];
		$Eventscount=$this->Events->find()->where(['status' => 'published','name LIKE '=>'%'.$search_data.'%'])->count();
		if($Eventscount>0)
		{
			$eventlist=$this->Events->find();
			$eventlist->select(['id','name','date','location','latitude','longitude','time','cover_image'])->where(['status' => 'published','name LIKE '=>'%'.$search_data.'%'])->order(['published_on'=>'DESC']);
			 
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
			$eventlist=(object)[];
		}
 		$this->set(compact('success','error','eventlist'));
        $this->set('_serialize', ['success','error','eventlist']);	 
	}
}

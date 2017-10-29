<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
/**
 * EventAttendees Controller
 *
 * @property \App\Model\Table\EventAttendeesTable $EventAttendees
 */
class EventAttendeesController extends AppController
{
	public function initialize()
    {
        parent::initialize();
    }

    public function EventAttendorNot()
	{
		$event_id=$this->request->query['event_id'];
		$user_id=$this->request->query['user_id'];
		$answer=$this->request->query['answer'];
		$EventAttendee = $this->EventAttendees->newEntity();
		
		$IfEventAttendee=$this->EventAttendees->find()->where(['user_id'=>$user_id,'event_id'=>$event_id])->first();
		if($IfEventAttendee){
			$EventAttendee=$this->EventAttendees->get($IfEventAttendee->id);
		}
		$EventAttendee->answer=$answer;
		$EventAttendee->user_id=$user_id;
		$EventAttendee->event_id=$event_id;
		if ($this->EventAttendees->save($EventAttendee)){
			$success=true;
			$error='';
			$response="successfully submitted";
		}else{
			$success=false;
			$error='Something Welesmfls';
			$response="";
		}
			
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
	}
}

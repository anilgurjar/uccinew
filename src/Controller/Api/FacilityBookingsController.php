<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * FacilityBookings Controller
 *
 * @property \App\Model\Table\FacilityBookingsTable $FacilityBookings
 */
class FacilityBookingsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
	}
	
    public function add()
    {
		$facilityBooking = $this->FacilityBookings->newEntity();
        if ($this->request->is('post')) {
			$date_from=$this->request->data('date_from');
			$date_to=$this->request->data('date_to');
			$time_from=$this->request->data('time_from');
			$time_to=$this->request->data('time_to');
			
			$this->request->data['date_from']=date('Y-m-d',strtotime($date_from)).' '.$time_from;
			$this->request->data['date_to']=date('Y-m-d',strtotime($date_to)).' '.$time_to;
			 
			$facilityBooking = $this->FacilityBookings->patchEntity($facilityBooking, $this->request->data);
			 
            if ($this->FacilityBookings->save($facilityBooking)) {
                $success=true;
				$error='';
				$response="successfully submitted";
				
            } else {
                $success=false;
				$error="Something went wrong.";
				$response="";
            }
		$this->set(compact('success','error','response'));
		$this->set('_serialize', ['success','error','response']);
		}
 
    }

}

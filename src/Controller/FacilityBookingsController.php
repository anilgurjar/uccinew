<?php
namespace App\Controller;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\I18n\Time;
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
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
	
    public function index()
    {
        $this->viewBuilder()->layout('index_layout'); 
        $facilityBookings = $this->paginate($this->FacilityBookings->find('all')->order(['FacilityBookings.id' => 'DESC'])->contain(['Venues']));

		$facilityBooking_new = $this->FacilityBookings->newEntity();
		
        $this->set(compact('facilityBookings','facilityBooking_new'));
        $this->set('_serialize', ['facilityBookings']);
    }

    /**
     * View method
     *
     * @param string|null $id Facility Booking id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout'); 
        $facilityBooking = $this->FacilityBookings->get($id, [
            'contain' => ['Venues']
        ]);

        $this->set('facilityBooking', $facilityBooking);
        $this->set('_serialize', ['facilityBooking']);
    }

	 public function facilityBookingApprove()
	 {
		
		$facility_boking_id=$this->request->data['facility_boking_id'];
		$facilityBooking = $this->FacilityBookings->get($facility_boking_id, [
            'contain' => ['Venues','Users']
        ]);
		
			$venue=$facilityBooking->venue->name;
			$member_name=$facilityBooking->user->member_name;
			
			$to=$facilityBooking->user->email;
		
		$email = new Email();
	    $email->transport('gmail');
		
		$from_name="UCCI";
		$email_to=trim($to,' ');
		$subject="Request approved";
		
		/*  try {
			$email->from(['ucciudaipur@gmail.com' => $from_name])
					->to($email_to)
					->replyTo('uccisec@hotmail.com')
					->subject($subject)
					->profile('default')
					->template('facility_boking_approval')
					->emailFormat('html')
					->viewVars(['member_name'=>$member_name,'venue'=>$venue]);
					
					$email->send();
				$query = $this->FacilityBookings->query();
				$query->update()
				->set(['status' => 'approved'])
				->where(['id' => $facility_boking_id])
				->execute();
				
		} catch (Exception $e) { echo "hi";
				$query = $this->FacilityBookings->query();
				$query->update()
				->set(['status' => 'pending'])
				->where(['id' => $facility_boking_id])
				->execute();
			echo 'Exception : ',  $e->getMessage(), "\n";
 
		} 
		  */
		exit;
	
	}
	
	public function facilityBokingCalender(){
		
		 $this->viewBuilder()->layout('index_layout'); 
		
		
	}
	
	public function calendar($m_y=null){
		 
			if(empty($m_y))
			{ 
			$m_y = date('m-Y');
			}


			$m_y_ex=explode('-',$m_y);
			$m=$m_y_ex[0];
			$y=$m_y_ex[1];

			/////////////////
			$start='1-'.$m_y;
			$start = date("Y-m-d", strtotime($start));
			//$start = new MongoDate(strtotime($start));

			$days_in_month = cal_days_in_month(CAL_GREGORIAN, $m, $y);

			$end=$days_in_month.'-'.$m_y;
			$end = date("Y-m-d", strtotime($end));
			//$end = new MongoDate(strtotime($end));

				$event_info=array();
				if(!empty($start)){
					$conditions['date_from >=']=date('Y-m-d 00:00:01',strtotime($start));
				}

				if(!empty($end)){
					$conditions['date_from <=']=date('Y-m-d 23:59:59',strtotime($end));
				}
				
				$event_info=$this->FacilityBookings->find()->where($conditions);
			
			if(sizeof($event_info)==0) { $event_info=array(); }
			$this->set('event_info',$event_info);
			/////////////////

			 $dateObj   = Time::createFromFormat('!m', $m); 
			 $month_name = $dateObj->format('F'); // March 
			

			$this->set('month',$m);
			$this->set('month_name',$month_name);
			$this->set('year',$y);

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
        $facilityBooking = $this->FacilityBookings->newEntity();
        if ($this->request->is('post')) {
			$facilityBooking = $this->FacilityBookings->patchEntity($facilityBooking, $this->request->data);
			$venue_id=$this->request->data['venue_id'];
		    $venues = $this->FacilityBookings->Venues->find()->where(['id'=>$venue_id]);
			foreach($venues as $venue){
				$venueamount=$venue->amount;
			}
			$facilityBooking->total_amount=$venueamount;
			$facilityBooking->created_by=$user_id;
			$date_from=$this->request->data('date_from');
			$date_to=$this->request->data('date_to');
			//$time_from=$this->request->data('time_from');
			//$time_to=$this->request->data('time_to');
			$timefrom=date( 'H:i:s',strtotime($this->request->data['time_from']));
			$timeto=date( 'H:i:s',strtotime($this->request->data['time_to']));
			$facilityBooking->date_from = date('Y-m-d ',strtotime($date_from)).' '.$timefrom;
			$facilityBooking->date_to = date('Y-m-d ',strtotime($date_to)).' '.$timeto;
			   
			
            if ($this->FacilityBookings->save($facilityBooking)) {
				
                $this->Flash->success(__('The facility booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The facility booking could not be saved. Please, try again.'));
            }
        }
        $venues = $this->FacilityBookings->Venues->find('list');
		
        $this->set(compact('facilityBooking', 'venues'));
        $this->set('_serialize', ['facilityBooking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Facility Booking id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facilityBooking = $this->FacilityBookings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facilityBooking = $this->FacilityBookings->patchEntity($facilityBooking, $this->request->data);
            if ($this->FacilityBookings->save($facilityBooking)) {
                $this->Flash->success(__('The facility booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The facility booking could not be saved. Please, try again.'));
            }
        }
        $venues = $this->FacilityBookings->Venues->find('list', ['limit' => 200]);
        $this->set(compact('facilityBooking', 'venues'));
        $this->set('_serialize', ['facilityBooking']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Facility Booking id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facilityBooking = $this->FacilityBookings->get($id);
        if ($this->FacilityBookings->delete($facilityBooking)) {
            $this->Flash->success(__('The facility booking has been deleted.'));
        } else {
            $this->Flash->error(__('The facility booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

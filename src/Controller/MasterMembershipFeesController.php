<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class MasterMembershipFeesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name', $member_name);
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }
	public function masterMembershipFee()
	{	
		$this->viewBuilder()->layout('index_layout');
		$MasterMembershipFees=$this->MasterMembershipFees->newEntity();
		if ($this->request->is(['post']))
		{
			$member_type_id_array=$this->request->data['member_type_id'];
			
			foreach($member_type_id_array as $member_type_id)
			{
				$this->request->data['member_type_id']=$member_type_id;
				
				$this->MasterMembershipFees->query()
				->insert(['component','category_name','member_type_id','subscription_amount'])
				->values([
				'component'=>$this->request->data['component'],
				'category_name'=>$this->request->data['category_name'],
				'member_type_id'=>$this->request->data['member_type_id'],
				'subscription_amount'=>$this->request->data['subscription_amount']
				])
				->execute();
				
			}
			 $this->Flash->success('Master Membership Fee has been saved.');
             return $this->redirect(['action' => 'master_membership_fee']);
			
		}
		$this->set(compact('MasterMembershipFees'));
		$this->set('member_type' , $this->MasterMembershipFees->MasterMemberTypes->find('all'));
		$this->set('fetch_master_membership_fee' , $this->MasterMembershipFees->find('all'));
	}
	function get_member_type($id) 
	{
		$this->viewBuilder()->layout('ajax_layout');
		$data=$this->MasterMembershipFees->MasterMemberTypes->find('all',array('conditions'=>array('id'=>$id)))->toArray();
		$this->response->body($data);
		return $this->response;
	}
	
	function autoEdit()
	{
		$query = $this->MasterMembershipFees->query();
		$query->update()
		->set($this->request->data)
		->where(['id' => $this->request->data['id']])
		->execute();
		
	}
}
?>
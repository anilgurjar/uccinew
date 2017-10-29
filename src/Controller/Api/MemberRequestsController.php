<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;

/**
 * MemberRequests Controller
 *
 * @property \App\Model\Table\MemberRequestsTable $MemberRequests
 */
class MemberRequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 
	 public function initialize()
	{
		parent::initialize();
		
	}
	 
   
    public function member()
    {
        $memberRequest = $this->MemberRequests->newEntity();
        if ($this->request->is('post')) {
		
            $memberRequest = $this->MemberRequests->patchEntity($memberRequest, $this->request->data);
            if ($this->MemberRequests->save($memberRequest)) {
					$success=true;
					$error='';
					$response="successfully submitted";
            } else {
					$success=false;
					$error="Something went wrong.";
					$response="";
					
            }
        }
         $this->set(compact('success', 'error', 'response'));
         $this->set('_serialize', ['success', 'error', 'response']);
		
	}
	
	
	public function MemberTypes()
    {
        $MasterMemberTypes_count=$this->MemberRequests->MasterMemberTypes->find()->count();
		if($MasterMemberTypes_count>0)
		{
			$MasterMemberTypes=$this->MemberRequests->MasterMemberTypes->find();
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
			$MasterMemberTypes='';			
		}
		$this->set(compact('success', 'error', 'MasterMemberTypes'));
		$this->set('_serialize', ['success', 'error', 'MasterMemberTypes']);
	}

   
  
}

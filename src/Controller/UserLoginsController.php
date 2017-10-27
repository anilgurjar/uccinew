<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;

class UserLoginsController extends AppController
{
	
	public function initialize(){
		parent::initialize();
		$this->eventManager()->off($this->Csrf);
	}
	
	public function login(){
		$this->viewBuilder()->layout('login_layout');
		$logins = $this->UserLogins->newEntity();
	   
		if(isset($this->request->data['login_submit']) || isset($this->request->data["login_submit_text"]))
		{
				$this->request->session()->destroy();
				$email=htmlentities($this->request->data["email"]);
				$password=htmlentities($this->request->data["password"]);
				$md5ed_password = md5($password);
				$conditions=array("email"=>$email,"password"=>$md5ed_password);
				$result = $this->UserLogins->find('all',array('conditions'=>$conditions))->toArray();
			    $n = sizeof($result); 
				if($n>0)
				{
					foreach($result as $data){
					$user_id = $data->user_id;	
					}
					$this->request->session()->write('user_id',$user_id);
					$this->redirect(['Controller' => 'UserLogins' , 'action' => 'index']);
				}
				else
				{
					$conditions=array("email" => $email);
					$result1 = $this->UserLogins->find('all',array('conditions'=>$conditions))->toArray();
					$n1 = sizeof($result1);
					if($n1>0){ 
						 $this->set('wrong4', 'Password is Incorrect. Please try again.');
					}
					else{
						$this->set('wrong4', 'Email Id and Password are Incorrect.');
					}}}
	}
	
	public function index(){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->request->session()->read('user_id');
			$count=$this->UserLogins->MasterMembers->find('all',array('conditions'=>array('member_flag'=>1)))->toArray();
			$master_member=0;
			foreach($count as $count_data){
				$master_member++;
			}
			$conditions1=array("user_id"=>$user_id); 		
			$result1 = $this->UserLogins->find('all',array('conditions'=>$conditions1))->toArray();
			foreach($result1 as $data){
				$role_id=$data['role_id'];
			}
		$member_fee = $this->UserLogins->MemberFees->find('all',array('fields'=>array('id')))->toArray();
		$due=0;
		foreach($member_fee as $member_fee_data)
		{
			$conditions['member_fee_id']=$member_fee_data['id'];
			$member_receipt=$this->UserLogins->MemberReceipts->find('all',array('conditions'=>$conditions))->toArray();
			if(empty($member_receipt)){
				$due++;
			}
		}
		$this->set(compact('due','role_id'));
	}
	
	public function authentication()
	{
		$user_id=$this->request->session()->read('user_id');
		$conditions=array("user_id"=>$user_id);
		$result = $this->UserLogins->find('all',array('fields'=>array('username'),'conditions'=>$conditions))->toArray();
		if(empty($user_id))
		{
		$this->request->session()->destroy();
		$this->redirect(['Controller' => 'UserLogins' , 'action' => 'login']);
		}
		$this->response->body($result);
		return $this->response;
	}
	
	public function UserRights(){
		$user_id=$this->request->session()->read('user_id');
		$conditions=array("user_id" => 1);
		$fetch_user_right = $this->UserLogins->UserRights->find('all',array('conditions'=>$conditions))->toArray();
		
		$this->response->body($fetch_user_right);
		return $this->response;
	}
	public function menu()
	{
		$user_id=$this->request->session()->read('user_id');
		$fetch_menu = $this->UserLogins->Modules->find('all',array('order' => 'preferance ASC'))->toArray();
		$this->response->body($fetch_menu);
		return $this->response;
	}
	
	public function MenuSubmenu($main_menu)
	{
		$user_id=$this->request->session()->read('user_id');
		$conditions=array("main_menu" => $main_menu);
		$fetch_menu_submenu = $this->UserLogins->Modules->find('all',array('conditions'=>$conditions))->toArray();
		$this->response->body($fetch_menu_submenu);
		return $this->response;
	}
	public function submenu($sub_menu)
	{
		$user_id=$this->request->session()->read('user_id');
		$conditions=array("sub_menu" => $sub_menu);
		$fetch_submenu = $this->UserLogins->Modules->find('all',array('conditions'=>$conditions))->toArray();
		$this->response->body($fetch_submenu);
		return $this->response;
	}
	
	public function MemberRegistration(){
		$user_id=$this->request->session()->read('user_id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->UserLogins->newEntity();
		$master_member=$this->UserLogins->MasterMembers->newEntity();
		
		if(isset($this->request->data['registration_submit']))
		{
			
			$this->request->data['role_id']=2;
			$this->request->data['year_of_joining']=date('Y-m-d',strtotime($this->request->data['year_of_joining']));
			$this->request->data=array_filter($this->request->data);
			$master_member=$this->UserLogins->patchEntity($master_member,$this->request->data);
			$this->UserLogins->MasterMembers->save($master_member);
			$member_id=$master_member->member_id;
			$email = $this->request->data['email'];
			$user_name = $this->request->data['member_name'];
			$password = md5('hello');
			$array_insert = array('member_id'=>$member_id,'email'=>$email,'username'=>$user_name,'password'=>$password);
			$master_user =$this->UserLogins->patchEntity($master_user,$array_insert);
			$this->UserLogins->save($master_user);	
		}
		
		$this->set('turn_over' , $this->UserLogins->MasterTurnOvers->find('all')->toArray());
		$this->set('member_type' , $this->UserLogins->MasterMemberTypes->find('all')->toArray());
		$this->set('fetch_master_grade' , $this->UserLogins->MasterGrades->find('all')->toArray());
		$this->set('fetch_master_category' , $this->UserLogins->MasterCategories->find('all')->toArray());
		$this->set('fetch_master_classification' , $this->UserLogins->MasterClassifications->find('all')->toArray());
		$this->set('master_user',$master_user);
	}
	public function MemberView(){
		$user_id=$this->request->session()->read('user_id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->UserLogins->newEntity();
		$master_member = $this->UserLogins->MasterMembers->find('all')->contain(['MasterMemberTypes'])->toArray();

		$this->set(compact('master_member'));
		$this->set('member_type',$this->UserLogins->MasterMemberTypes->find('all')->toArray());
		$this->set('fetch_master_grade' , $this->UserLogins->MasterGrades->find('all')->toArray());
		$this->set('fetch_master_category' , $this->UserLogins->MasterCategories->find('all')->toArray());
		$this->set('master_user',$master_user);
	}
	
	public function MemberViewDetail(){
		$user_id=$this->request->session()->read('user_id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->UserLogins->newEntity();
		//if(isset($this->request->data['member_view'])){
			$member_details=$this->UserLogins->MasterMembers->find('all',array('conditions'=>array('member_id'=>$this->request->data['member_view'])))->toArray();
			$this->set(compact('member_details'));
			$this->set('turn_over' , $this->UserLogins->MasterTurnOvers->find('all')->toArray());
			$this->set('member_type' , $this->UserLogins->MasterMemberTypes->find('all')->toArray());
			$this->set('fetch_master_grade' , $this->UserLogins->MasterGrades->find('all')->toArray());
			$this->set('fetch_master_category' , $this->UserLogins->MasterCategories->find('all')->toArray());
			$this->set('fetch_master_classification' , $this->UserLogins->MasterClassifications->find('all')->toArray());
		//}
		
		if(isset($this->request->data['registration_submit'])){
			$this->request->data['role_id']=2;
			$this->request->data['year_of_joining']=date('Y-m-d',strtotime($this->request->data['year_of_joining']));
			$this->request->data=array_filter($this->request->data);
			$this->loadmodel('user_login');
		}
		$this->set('master_user',$master_user);
		
	}
 
    

 
}

?>
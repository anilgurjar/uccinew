<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
class UserRightsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['index', 'logout']);
    }
	public function UserRight(){
		$this->viewBuilder()->layout('index_layout');
		$rights = $this->UserRights->newEntity();
		if($this->request->is('post')){
			if(isset($this->request->data['right_submit'])){
				
				    $module_id = @$this->request->data['module_id'];
					$module_id_implode = "";
					if(!empty($module_id)){
						$module_id_implode = implode(',',$module_id);
					}
					$user_id = $this->request->data['user_id'];
					$conditions=array("user_id" =>$user_id);
					$fetch_user_right = $this->UserRights->find()->where($conditions)->toArray();
					@$auto_id=@$fetch_user_right['0']['id'];
					if(empty($auto_id)){
							$query = $this->UserRights->query();
							$query->insert(['user_id', 'module_id'])
							->values([
							'user_id' => $user_id,
							'module_id' => $module_id_implode
							])
							->execute();
					}else{
							$query = $this->UserRights->query();
							$query->update()
							->set(['module_id' => $module_id_implode])
							->where(['id' => $auto_id])
							->execute();
					}
			}
			if(isset($this->request->data['role_submit'])){
			      $module_id = @$this->request->data['module_id'];
					$module_id_implode = "";
					if(!empty($module_id)){
						$module_id_implode = implode(',',$module_id);
					}
					$role_id = $this->request->data['role_id'];
					$conditions=array("role_id" =>$role_id);
					$fetch_user_right = $this->UserRights->find()->where($conditions)->toArray();
					@$auto_id=@$fetch_user_right['0']['id'];
					if(empty($auto_id)){
							$query = $this->UserRights->query();
							$query->insert(['role_id', 'module_id'])
							->values([
							'role_id' => $role_id,
							'module_id' => $module_id_implode
							])
							->execute();
					}else{
					
					$query = $this->UserRights->query();
					$query->update()
					->set(['module_id' => $module_id_implode])
					->where(['role_id' => $role_id])
					->execute();
					}
			}
			
		}
		
		$fetch_login = $this->UserRights->Users->find()->toArray();
		$this->set('fetch_login', $fetch_login);
		$fetch_role = $this->UserRights->Roles->find()->toArray();
		$this->set('fetch_login', $fetch_login);
		$this->set('fetch_role', $fetch_role);
		$this->set('rights',$rights);
	}
	public function UserRightAjax(){
		$this->viewBuilder()->layout('ajax_layout');
		
			$user_id=$this->request->data('user_id');
			$fetch_menu = $this->UserRights->Modules->find('all');
			$conditions=array("user_id" => $user_id);
			
			$fetch_user_right = $this->UserRights->find()->where($conditions)->toArray();
			@$user_right1=$fetch_user_right['0']->module_id;
			$user_right=explode(',', $user_right1);
			$this->set('fetch_menu',$fetch_menu);
			$this->set('user_right',$user_right);
	}
	
	public function RoleRightAjax(){
		$this->viewBuilder()->layout('ajax_layout');
		
			$role_id=$this->request->data('role_id');
			$fetch_menu = $this->UserRights->Modules->find('all');
			$conditions=array("role_id" => $role_id);
			$fetch_user_right = $this->UserRights->find()->where($conditions)->toArray();
			@$user_right1=$fetch_user_right['0']->module_id;
			$user_right=explode(',', $user_right1);
			$this->set('fetch_menu',$fetch_menu);
			$this->set('user_right',$user_right);
		
	}
	
	
	
	
}
?>
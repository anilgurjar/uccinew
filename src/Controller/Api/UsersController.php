<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


class UsersController extends AppController{
	 
	public function initialize()
    {
        parent::initialize();
    }
	public function login()
	{
		if ($this->request->is('post')) {
			 
			$data = $this->request->data;
			$email=$data['email'];
			$password=$data['password'];
			$hasher = new DefaultPasswordHasher();
			
			$user=$this->Users->find()->where(['username'=>$email])->contain(['Companies'])->first();
			if(!empty($user))
			{
				if(empty($user->company->year_of_joining) || $user->company->year_of_joining=='0000-00-00')
				{
					$user->company->year_of_joining="";
				}
				$is_valid_password=$hasher->check($password,$user->password); 
				if($is_valid_password){
					$success=true;
					$error='';
					unset($user->password);
				}else{
					$success=false;
					$error="Wrong password";
					unset($user);
				}
			}
			else
			{
				$success=false;
				$error="Wrong username and password";
				unset($user);
			}
			$this->set(compact('success', 'error', 'user'));
        	$this->set('_serialize', ['success', 'error', 'user']);
		}
	}
	public function TokenUpdate()
	{
		if($this->request->is('post')) {
 
			$data = $this->request->data;
 			$device_token=$data['device_token'];
			$id=$data['id'];
			
			$find_user=$this->Users->find()->where(['id'=>$id])->count();
			if($find_user>0)
			{
				$query = $this->Users->query();
					$query->update()
						->set(['device_token' => $device_token])
						->where(['id' => $id])
						->execute();
				$success=true;
				$error='';
				$response="update successfully";
					
			}
			else
			{
				$success=false;
				$error="User not found";
				$response="";
			}
		$this->set(compact('success', 'error', 'response'));
		$this->set('_serialize', ['success', 'error', 'response']);
			
			
		}
	}
	public function signup()
	{		
		if ($this->request->is('post')) {
			 
			$user = $this->Users->newEntity();
			$Companies = $this->Users->Companies->newEntity();
			
			$this->request->data['role_id']=3;
			$this->request->data['id_card_no']=0;
			$this->request->data['member_type_id']=3;
			$this->request->data['member_flag']=1;
			if(!empty($this->request->data['member_image'])){
				$member_image = $this->request->data['member_image'];	
			}
			else{
				$member_image='';
			}	
			
			
			$CompaniesData=$this->Users->Companies->patchEntity($Companies,$this->request->data);
 			$Companieedata=$this->Users->Companies->save($CompaniesData);
 			$Companyid=$Companieedata->id;	
			
 			$this->request->data['company_id']=$Companyid;
 			$email = $this->request->data['email'];
 			$member_name = $this->request->data['member_name'];
			$this->request->data['username']=$member_name;			
			$user=$this->Users->patchEntity($user,$this->request->data);
            if ($user_data=$this->Users->save($user)) {
				$user_id=$user_data->id; 
					if(!empty($member_image['tmp_name']))
					{
						$ext = substr(strtolower(strrchr($member_image['name'], '.')), 1); //get the extension
						$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
						$setNewFileName = 'user_profile_'.$user_id.'.jpg';
						$dir = new folder(WWW_ROOT . 'images/member_user', true, 0755);
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($member_image['tmp_name'], WWW_ROOT . '/images/member_user/'.$setNewFileName);
						$UpdateUrl='images/member_user/'.$setNewFileName;
						//-- save to database
						$IfUpdate=$this->Users->find()->where(['id'=>$user_id])->first();
						if($IfUpdate){
							$Users=$this->Users->get($IfUpdate->id);
						}
						$Users->image=$UpdateUrl;
						if ($this->Users->save($Users));
						}
					}
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
	
	public function profileData()
	{
		$company_id=$this->request->query['company_id'];
		
		$CountUser=$this->Users->Companies->find()
			->where(['Companies.id' => $company_id])
			->contain(['Users'])
			->count();
 		
		if($CountUser>0)
		{
			$profile=$this->Users->Companies->find()
				->where(['Companies.id' => $company_id])
				->contain(['Users','MasterCategories','MasterGrades','MasterClassifications'])->first();
			 
			 
 			$user_profile=(object)[];
			$company_profile=(object)[];
			$Firstnomini_profile=(object)[];
			$secondnomini_profile=(object)[];
			$FirstNominiProfile=(object)[];
			$SecondNominiProfile=(object)[];
 				$id_card_no=$profile->id_card_no;
				$grade_name='';
				if(!empty($profile->master_grade))
				{
					$grade_name=$profile->master_grade->grade_name;
				}
				 
				$category_name='';
				if(!empty($profile->master_category))
				{
					$category_name=$profile->master_category->category_name;
				} 
				
				$classification_name='';
				if(!empty($profile->master_classification))
				{
					$classification_name=$profile->master_classification->classification_name;
				} 
				$x=1;
				if($profile->year_of_joining==0000-00-00)
				{
					$profile->year_of_joining="";
				}
				else
				{
					$profile->year_of_joining=date('d-m-Y',strtotime($profile->year_of_joining));
				}
 
				foreach($profile->users as $Users)
				{
					if($x==1)
					{
						//-- Member Image 
							$member_image='';
 							if(!empty($Users->image)){
								if(file_exists($Users->image)){
									$member_image='';//$this->coreVariable['SiteUrl'].$Users->image;
								}
							}
						//-- Company Image 
							$company_image='';
 							if(!empty($profile->company_image)){
								$company_image='';//$this->coreVariable['SiteUrl'].$profile->company_image;
							} 
						$company_profile=array(
							"id" => $profile->id,
							"user_id" => $Users->id,
							"company_organisation" => $profile->company_organisation,
							"address" => $profile->address,
							"website" => $profile->website,
							"office_telephone" => $profile->office_telephone,
							"email" => $Users->email,
							"city" => $profile->city,
							"pincode" => $profile->pincode,
							"end_products" => $profile->end_products_item_dealing_in,
							"company_image" => $company_image
						);
						$user_profile=array(
							"id" => $Users->id,
							"member_name" => $Users->member_name,
							"mobile_no" => $Users->mobile_no,
							"email" => $Users->email,
							"address" => $profile->address,
							"id_card_no" => $profile->id_card_no,
							"grade" => $grade_name,
							"category" => $category_name,
							"classification" => $classification_name,
							"year_of_joining" => $profile->year_of_joining,
							"member_image" => $member_image
						);
						$FirstNominiProfile=array(
							"id" => $Users->id,
							"name" => $Users->member_name,
							"email" => $Users->email,
							"mobile_no" => $Users->mobile_no,
							"designation" => $Users->member_designation,
							"first_nomini_image" => $member_image
						);
					}
					if($x==2)
					{
					//-- Nominee Image 
						$nominiee_image='';
						if(!empty($Users->image)){
							$nominiee_image='';//$this->coreVariable['SiteUrl'].$Users->image;
						}
 						$SecondNominiProfile=array(
							"id" => $Users->id,
							"alternate_nominee" => $Users->member_name,
							"alternate_email" => $Users->email,
							"alternate_mobile_no" => $Users->mobile_no,
							"designation" => $Users->member_designation,
							"second_nomini_image" => $nominiee_image
						);
					}
					$x++;
				}
			$nominee_profile=array('first_nominee' => $FirstNominiProfile , 'second_nominee' => $SecondNominiProfile);
			$response=array("user_profile" => $user_profile, "company_profile" => $company_profile, "nominee_profile" => $nominee_profile);
 			$success=true;
			$error='';
		}
		else
		{
			$success=false;
			$error="No data found";
		}
		 $this->set(compact('success', 'error', 'response'));
		 $this->set('_serialize', ['success', 'error', 'response']);
	}
	
	public function ProfileUpdate()
	{
		$user_id=$this->request->data('user_id');
		$company_id=$this->request->data('company_id');
		$name=$this->request->data['name'];
		$email=$this->request->data['email'];
		$mobile_no=$this->request->data['mobile_no'];
		$address=$this->request->data['address'];
		if(!empty($this->request->data['member_image'])){
			$member_image = $this->request->data['member_image'];	
		}
		else{
			$member_image='';
		}	
		
		$Users = $this->Users->newEntity();
		$Users = $this->Users->Companies->newEntity();
		
		$IfUsers=$this->Users->find()->where(['id'=>$user_id])->first();
		if($IfUsers)
		{
			$IfCompany=$this->Users->Companies->find()->where(['id'=>$company_id])->first();
			$Users=$this->Users->Companies->get($IfCompany->id);
			
			$Users=$this->Users->get($IfUsers->id);
			$id_card_no=$IfCompany->id_card_no;  
			$Users->member_name=$name;
			$Users->email=$email;
			$Users->mobile_no=$mobile_no;
			$IfCompany->address=$address;
			
			if(!empty($member_image['tmp_name']))
			{
				$ext = substr(strtolower(strrchr($member_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				if (in_array($ext, $arr_ext)) {
					$setNewFileName = 'user_profile_'.$IfUsers->id.'.jpg';
					$target=WWW_ROOT . 'images/member_user';
					$exist = is_dir($target);
					if(!$exist)
					{
						$dir = new folder(WWW_ROOT . 'images/member_user', true, 0755);
					}
					move_uploaded_file($member_image['tmp_name'], WWW_ROOT . '/images/member_user/'.$setNewFileName);
				$UploadURL='images/member_user/'.$setNewFileName;
				$Users->image=$UploadURL;
				}
			}

			if ($this->Users->save($Users)){
				$this->Users->Companies->save($IfCompany);
				$success=true;
				$error='';
				$response="successfully submitted";
			}
			else
			{
				$success=false;
				$error='Something went wrong.';
				$response="";
			}
		}
		else
		{
			$success=false;
			$error='No data found.';
			$response="";
		}
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
 	}
	
	public function CompanyUpdate()
	{
		$user_id=$this->request->data('user_id');
		$company_id=$this->request->data('company_id');
		$company_organisation=$this->request->data['company_organisation'];
		$address=$this->request->data['address'];
		$email=$this->request->data['email'];
		$office_telephone=$this->request->data['office_telephone'];
		$city=$this->request->data['city'];
		$pincode=$this->request->data['pincode'];
		$website=$this->request->data['website'];
		$end_products_item_dealing_in=$this->request->data['end_products_item_dealing_in'];
 		if(!empty($this->request->data['company_image'])){
			$company_image = $this->request->data['company_image'];	
		}
		else{
			$company_image='';
		}		
		
		$Users = $this->Users->newEntity();
		$Companies = $this->Users->Companies->newEntity();
		
		$IfCompanies=$this->Users->Companies->find()->where(['id'=>$company_id])->first();
		if($IfCompanies)
		{
			$Ifuser=$this->Users->find()->where(['id'=>$user_id])->first();
			$User=$this->Users->get($Ifuser->id);
			
			$Users=$this->Users->get($IfCompanies->id);
			$Users->company_organisation=$company_organisation;
			$Users->address=$address;
			$User->email=$email;
			$Users->office_telephone=$office_telephone;
			$Users->city=$city;
			$Users->pincode=$pincode;
			$Users->website=$website;
			$Users->end_products_item_dealing_in=$end_products_item_dealing_in;
			if(!empty($company_image['tmp_name']))
			{
				$ext = substr(strtolower(strrchr($company_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				if (in_array($ext, $arr_ext)) {
					$setNewFileName =  'company_image_'.$IfCompanies->id.'.jpg';
					$target=WWW_ROOT . 'images/company_images';
					$exist = is_dir($target);
					if(!$exist)
					{
						$dir = new folder(WWW_ROOT . 'images/company_images', true, 0755);
					}
					move_uploaded_file($company_image['tmp_name'], WWW_ROOT . '/images/company_images/'.$setNewFileName);
				$UploadURL='images/company_images/'.$setNewFileName;
				$Users->company_image=$UploadURL;
				}
			}
			
			if ($this->Users->Companies->save($Users)){
				$this->Users->save($User);
				$success=true;
				$error='';
				$response="successfully submitted";
			}else{
				$success=false;
				$error='Something went wrong.';
				$response="";
			}
		}
		else
		{
			$success=false;
			$error='No data found.';
			$response="";
		}
			
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
 	}
	
	public function NomineeUpdate()	
	{
		$user_id = $this->request->data['user_id'];
		//- first Nominee
		$first_name=$this->request->data('first_name');
		$first_email=$this->request->data['first_email'];
		$first_mobile_no=$this->request->data['first_mobile_no'];
		$first_designation=$this->request->data['first_designation'];
		if(empty($this->request->data['first_image']))
		{$first_image =''; }
		else {
			$first_image = $this->request->data['first_image'];		
		}
 		
		//-- second Nominee
		$nominee_id = $this->request->data['nominee_id'];
		$second_name=$this->request->data('second_name');
		$second_email=$this->request->data['second_email'];
		$second_mobile_no=$this->request->data['second_mobile_no'];
		$second_designation=$this->request->data['second_designation'];
		if(empty($this->request->data['second_image']))
		{ $second_image='';}
		else {
			$second_image = $this->request->data['second_image'];	
		}
		
		$Users = $this->Users->newEntity();
		$Nominee = $this->Users->newEntity();
		$IfUsers=$this->Users->find()->where(['id'=>$user_id])->first();
		$IfNomineeUsers=$this->Users->find()->where(['id'=>$nominee_id])->first();
		if($IfUsers)
		{
			$Users=$this->Users->get($IfUsers->id);
			$NomineeUsers=$this->Users->get($IfNomineeUsers->id);
			$Users->member_name=$first_name;
			$NomineeUsers->member_name=$second_name;
 			$Users->email=$first_email;
 			$NomineeUsers->email=$second_email;
			$Users->mobile_no=$first_mobile_no;
			$NomineeUsers->mobile_no=$second_mobile_no;
			$Users->member_designation=$first_designation;
			$NomineeUsers->member_designation=$second_designation;
			
 			if(!empty($first_image['tmp_name']))
			{
				$ext = substr(strtolower(strrchr($first_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				if (in_array($ext, $arr_ext)) {
					$setNewFileName = 'user_profile_'.$IfUsers->id.'.jpg';
					$target=WWW_ROOT . 'images/member_user';
					$exist = is_dir($target);
					if(!$exist)
					{
						$dir = new folder(WWW_ROOT . 'images/member_user', true, 0755);
					}
					move_uploaded_file($first_image['tmp_name'], WWW_ROOT . '/images/member_user/'.$setNewFileName);
				$UploadURL='images/member_user/'.$setNewFileName;
				$Users->image=$UploadURL;
				}
			}
			if(!empty($second_image['tmp_name']))
			{
				$ext = substr(strtolower(strrchr($second_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
				if (in_array($ext, $arr_ext)) {
					$setNewFileName = 'user_profile_'.$IfNomineeUsers->id.'.jpg';
					$target=WWW_ROOT . 'images/member_user';
					$exist = is_dir($target);
					if(!$exist)
					{
						$dir = new folder(WWW_ROOT . 'images/member_user', true, 0755);
					}
					move_uploaded_file($second_image['tmp_name'], WWW_ROOT . '/images/member_user/'.$setNewFileName);
				$UploadURL='images/member_user/'.$setNewFileName;
				$NomineeUsers->image=$UploadURL;
				}
			}
			if ($this->Users->save($Users)){
				$this->Users->save($NomineeUsers);
				$success=true;
				$error='';
				$response="successfully submitted";
			}else{
				$success=false;
				$error='Something went wrong.';
				$response="";
			}
		}
		else
		{
			$success=false;
			$error='No data found.';
			$response="";
		}
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
 	}
	
	public function SocialLogin()
	{
		if ($this->request->is('post')) {
			 
			$user = $this->Users->newEntity();
			$this->request->data['role_id']=$role_id=3;
			 
			$this->request->data['member_type_id']=$member_type_id=3;
			$this->request->data['member_flag']=$member_flag=1;
			if(!empty($this->request->data('member_image')))
			{
				$member_image = $this->request->data['member_image'];
			}
			else
			{
				$member_image = '';
			}
			$member_name=$this->request->data['member_name'];
			$email=$this->request->data['email'];
			$social_id=$this->request->data['social_id'];
			$login_by=$this->request->data['login_by'];
			$fbUserId=$this->request->data['fb_user_id'];
			$fbToken=$this->request->data['fb_token'];
			$googleToken=$this->request->data['google_token'];
			$googleAuth=$this->request->data['google_auth'];
			$IfUsers=$this->Users->find()->where(['email'=>$email])->first();
			if($IfUsers)
			{
				$Users=$this->Users->get($IfUsers->id);
				$Users->member_name=$member_name;
				$id_card_no=$Users->id_card_no ;
				$Users->email=$email;
				$Users->social_id=$social_id;
				$Users->login_by=$login_by;
 				$member_type_id=$Users->member_type_id;
 				$Users->member_flag=$member_flag;
				$Users->fb_user_id=$fbUserId;
				$Users->fb_token=$fbToken;
				$Users->google_token=$googleToken;
				$Users->google_auth=$googleAuth;
  				if ($user_data=$this->Users->save($Users)) {
					$user_id=$user_data->id; 
					if(!empty($member_image))
					{
						$setNewFileName = 'user_profile_'.$IfUsers->id.'.jpg';
 						//Get the file
						$content = file_get_contents($member_image);
						//Store in the filesystem.
						$fp = fopen(WWW_ROOT . '/images/member_user/'.$setNewFileName, "w");
						fwrite($fp, $content);
						fclose($fp);
						$UploadURL='images/member_user/'.$setNewFileName;
						$IfCompany=$this->Users->find()->where(['id'=>$user_id])->first();
						$Users=$this->Users->get($IfCompany->id);
						$Users->image=$UploadURL;
						$this->Users->save($Users);
 					}
					$user=$this->Users->find()->where(['Users.id'=>$user_id])->contain(['Companies'])->first();
 					$success=true;
					$error='';
					$response="successfully submitted";
				} else { 
					$success=false;
					$error="Something went wrong.";
					$response="";
					$user='';
				}
			}
			else
			{
				$user=$this->Users->patchEntity($user,$this->request->data);
				if ($user_data=$this->Users->save($user)) {
					$user_id=$user_data->id; 
					if(!empty($member_image))
					{
						$setNewFileName = 'user_profile_'.$user_id.'.jpg';
						//Get the file
						$content = file_get_contents($member_image);
						//Store in the filesystem.
						$fp = fopen(WWW_ROOT . '/images/member_user/'.$setNewFileName, "w");
						fwrite($fp, $content);
						fclose($fp);

						$UploadURL='images/member_user/'.$setNewFileName;
						$IfCompany=$this->Users->find()->where(['id'=>$user_id])->first();
						$Users=$this->Users->get($IfCompany->id);
						$Users->image=$UploadURL;
						$this->Users->save($Users);
					}
					$user=$this->Users->find()->where(['Users.id'=>$user_id])->contain(['Companies'])->first();
					
					$success=true;
					$error='';
					$response="successfully submitted";
				} 
				else 
				{ 
					$success=false;
					$error="Something went wrong.";
					$response="";
					$user=0;
				}
			}
			$this->set(compact('success', 'error', 'user'));
			$this->set('_serialize', ['success', 'error', 'user']);
		}
	}
	public function homescreen()
	{
		//-- Galleries
		
		$Galleries=$this->Users->Galleries->find()->count();
		if($Galleries > 0)
		{
			$Slider=$this->Users->Galleries->find();
			$Slider->select(['id','name','cover_image'])
				->order(['created_on' => 'DESC'])
				->limit(5);
				
 		}
		else { $Slider=[];}
		//-- GalleryPhotos
		$Initiatives=$this->Users->Initiatives->find()->count();
		if($Initiatives > 0)
		{
			$Initiatives=$this->Users->Initiatives->find();
			$Initiatives->select(['id','title','description','icon_photo','description_photo'])
				->order(['created_on' => 'DESC']);
 		}
		
		else { $Initiatives=[];}
		//-- Blog
		$Blogs=$this->Users->Blogs->find()->where(['status' => 'published'])->count(); 
		if($Blogs > 0)
		{
			$Blogs=$this->Users->Blogs->find();
 			$Blogs->contain(['Users'=> function($q){
				return $q->find('all')->select(['id','member_name','email']);
			}])
			->where(['status' => 'published'])
			->order(['published_on' => 'DESC'])
			->limit(5);
  		}
		else { $Blogs=[];}
		//-- Events
		$Events=$this->Users->Events->find()->where(['status' => 'published'])->count();
		if($Events > 0)
		{
			$Events=$this->Users->Events->find();
			$Events->select(['id','name','date','time','published_on','description','published_on','cover_image','location'])
				->where(['status' => 'published'])
				->order(['published_on' => 'DESC','Events.id'=>'DESC'])
				->limit(5);
 		}
		else { $Events=[];}
		//-- GalleryPhotos
		$GalleryPhotos=$this->Users->GalleryPhotos->find()->count();
		if($GalleryPhotos > 0)
		{
			$GalleryPhotos=$this->Users->GalleryPhotos->find();
			$GalleryPhotos->select(['id','gallery_id','image','description','created_on'])
				->order(['created_on' => 'DESC'])
				->limit(5);
 		}
		else { $GalleryPhotos=[];}
		
		$Advertisements = $this->Users->Advertisements->find()->count();
		if($Advertisements>0)
		{
			$Advertisements = $this->Users->Advertisements->find();
			$success=true;
			$error='';
		}
		else { $Advertisements=[];}
		
		$AffilationRegistrations = $this->Users->AffilationRegistrations->find()->count();
		if($AffilationRegistrations>0)
		{
			$AffilationRegistrations = $this->Users->AffilationRegistrations->find();
			$success=true;
			$error='';
 		}
		else { $AffilationRegistrations=[];}
		
		$HomeMenus = $this->Users->HomeMenus->find()->count();
		 
		if($HomeMenus>0)
		{
			$HomeMenus = $this->Users->HomeMenus->find();
			$success=true;
			$error='';
		}
		else { $HomeMenus=[];}
		
		$response=array('Slider'=>$Slider,
				'HomeMenus'=>$HomeMenus,
				'Initiatives'=>$Initiatives,
				'Advertisements'=>$Advertisements,
				'Blogs'=>$Blogs,
				'Events'=>$Events,
				'GalleryPhotos'=>$GalleryPhotos,
				'AffilationRegistrations'=>$AffilationRegistrations
				);
		$success=true;
		$error="";
 
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
	}
	
	public function memberList()
	{ 
		$limit=$this->request->query['limit'];
		$page=$this->request->query['page'];
		$Users=$this->Users->Companies->find()->count();
		if($Users > 0 )
		{
			$userlist=$this->Users->Companies->find()
				->where(['Companies.role_id !='=>3])
				->order(['Companies.year_of_joining'=>'ASC'])
				->limit($limit)
				->page($page);
				//pr($userlist->toArray());  exit;
			//-- Company Image 	
				foreach($userlist as $user)
				{
					if(empty($user->year_of_joining) || $user->year_of_joining=='0000-00-00')
					{
						$user->year_of_joining="";
					}
				}
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
			$userlist='';
 		}
		$this->set(compact('success','error','userlist'));
        $this->set('_serialize', ['success','error','userlist']);
	}
	
	public function memberSearch()
	{
		$search_data=$this->request->query['search_data'];
		$Users=$this->Users->Companies->find()
			->where(['tag LIKE' => '%'.$search_data.'%'])
			 ->orWhere(['company_organisation LIKE' => '%'.$search_data.'%'])
			->order(['year_of_joining'=>'ASC'])->count(); 

		if($Users > 0 )
		{ 
			$userlist=$this->Users->Companies->find()
  				->where(['Companies.tag LIKE' => '%'.$search_data.'%'])
				->orWhere(['company_organisation LIKE' => '%'.$search_data.'%'])
				->order(['Companies.year_of_joining'=>'DESC']);
			//-- Company Image 	
			
				foreach($userlist as $user)
				{ 
					if(empty($user->year_of_joining) || $user->year_of_joining=='0000-00-00')
					{ 
						$user->year_of_joining="";
					}
				} 
				
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
			$userlist='';
 		}
		$this->set(compact('success','error','userlist'));
        $this->set('_serialize', ['success','error','userlist']);
	}
	
	public function memberData()
	{
		$user_id=$this->request->query['user_id'];
		$Users=$this->Users->Companies->find()
			->contain(['Users'])
			->where(['Companies.id' => $user_id])
			->count(); 
		if($Users > 0 )
		{
			$memberDetails=$this->Users->Companies->find()
			->contain(['Users'])
			->where(['Companies.id' => $user_id])
				->first();
			$success=true;
			$error="";
		}
		else
		{
			$success=false;
			$error="No data found";
			$memberDetails='';
 		}
		$this->set(compact('success','error','memberDetails'));
        $this->set('_serialize', ['success','error','memberDetails']);
	}
	
	
	public function weblogin()
	{
		if ($this->request->is('post')) {
			 
			$data = $this->request->data;
			
			$email=$data['email'];
			$password=$data['password'];
			$hasher = new DefaultPasswordHasher();
			
			$user=$this->Users->find()->where(['username'=>$email])->contain(['Companies'])->first();
			if(!empty($user))
			{
				
				if(empty($user->company->year_of_joining) || $user->company->year_of_joining=='0000-00-00')
				{
					$user->company->year_of_joining="";
				}
				$is_valid_password=$hasher->check($password,$user->password); 
				if($is_valid_password){
					
					$Logs=$this->Users->Logs->newEntity();
					$Logs->user_id=$user->id;
					$Logs->status='wplogin';
										
					$this->Users->Logs->save($Logs);
							
					$success=true;
					$user_id=base64_encode($user->id);
					
					
					echo "<script> window.location='http://www.ucciudaipur.in/web/survey?con=".$user_id."';</script>";
					
					 exit;
					
				}else{ 
						echo "<script> window.location='http://www.ucciudaipur.in/web/userlogin?con=false';</script>";
					
					 exit;
				}
			}else{ 
						echo "<script> window.location='http://www.ucciudaipur.in/web/userlogin?con=false';</script>";
					
					 exit;
				}
			
		}
		
		
	}
	
}

?>
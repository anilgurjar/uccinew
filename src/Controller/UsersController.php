<?php
namespace App\Controller;
use Cake\View\View;
use Cake\View\ViewBuilder;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validation;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Event\Event;
ini_set('max_execution_time', 300);
ini_set('memory_limit', '256M');
//use Cake\Network\Email\Email;
class UsersController extends AppController
{
	 public $paginate = [
        'limit' => 50
    ];
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['PerformaInvoiceMailSms','PerformaInvoiceReminderMail','logout', 'idCard','UpdateIdCardMail','FetchMasterMembershipFees','FetchMasterTurnOvers','UpdateInvoiceMail','UpdateInvoiceReminderMail',  'forgotPassword', 'resetPassword','sendResetEmail','EmailShot','convert_number_to_words']);
    }
	public function election() 
	{
		$this->viewBuilder()->layout('Email/text/default');
		$master_member = $this->Users->Elections->find()->where(['send'=>1])->limit(30)->toArray();
		$this->set(compact('master_member'));
	}
	
	public function check_invoice_generates($id=null) 
	{
		
			$MemberFeeMemberReceipts=$this->Users->MemberReceipts->MemberFeeMemberReceipts->find()->where(['member_fee_id'=>$id])->count();
			$this->response->body($MemberFeeMemberReceipts);
			return $this->response;
	}
	
	
	public function EmailPrepared(){
		
		//$users=$this->Users->find()->toArray();
		
		$Users=$this->Users->find()
		->matching('Companies.CompanyMemberTypes',function($q){
			return $q->where(['master_member_type_id IN'=>1]);
		})->where(['member_nominee_type'=>'first'])
		->toArray();
		
		
		
		foreach($Users as $User){
			
			$EmailShots=$this->Users->EmailShots->newEntity();
			$EmailShots->user_id=$User->id;
			$EmailShots->status=0;
		    $this->Users->EmailShots->save($EmailShots);
			
		}
		
		
		exit;
	}
	
	
	public function EmailShot(){
		
		$send_emails=$this->Users->EmailShots->find()->where(['status'=>0])->contain(['Users'])->limit(5)->toArray();
		
		$email = new Email();
		$email->transport('SendGrid');
		
		foreach($send_emails as $send_email){
			
			
			 $user_save = $this->Users->newEntity();
			 $id=$send_email->id;
			 $user_id=$send_email->user_id;
			 $to=$send_email->user->email;
			 $member_name=$send_email->user->member_name;
			 $subject='Credentials for COO';
			  if(!empty($to)){
				   $password=uniqid(); 
				   
					$this->request->data['id']=$user_id;
					$this->request->data['username']=$to;
					$this->request->data['password']=$password;
					$user_save = $this->Users->patchEntity($user_save, $this->request->data);
					$this->Users->save($user_save);
				   
				    $from_name="UCCI";
					$email_to=trim($to,' ');
					$email_to='rohitkumarjoshi43@gmail.com';
				
				try {
					  $email->from(['ucciudaipur@gmail.com' => $from_name])
					->to($email_to)
					->replyTo('uccisec@hotmail.com')
					->subject($subject)
					->profile('default')
					->template('credentials')
					->emailFormat('html')
					->viewVars(['member_name'=>$member_name,'user_name'=>$to,'password'=>$password]);
					
					$email->send();
					$query = $this->Users->EmailShots->query();
					$query->update()
					->set(['status' => 1])
					->where(['id' => $id])
					->execute();



					} catch (Exception $e) {
							$query = $this->Users->EmailShots->query();
							$query->update()
							->set(['status' => 1])
							->where(['id' => $id])
							->execute();

						echo 'Exception : ',  $e->getMessage(), "\n";

					} 

				exit;  
			  }else{
				  
					$query = $this->Users->EmailShots->query();
					$query->update()
					->set(['status' => 1])
					->where(['id' => $id])
					->execute();
 
			  }
		}
		
		exit;
	}
	
	
	public function ElectionMail($id=Null,$mail_send=Null)
	{
		$query = $this->Users->Elections->query();
		$query->update()
		->set(['send' => $mail_send])
		->where(['id' => $id])
		->execute();
		
		$this->response->body('Ok');
		return $this->response;
	}
	public function memberExport() {
		
		//$master_member = $this->Users->find()->order(['Users.company_organisation ASC'])->contain(['MasterCategories','MasterMemberTypes','MasterTurnOvers']);
		
		$master_member = $this->Users->Companies->find()->where(['Companies.member_flag'=>1])->order(['Companies.company_organisation ASC'])->contain(['Users','MasterCategories','CompanyMemberTypes','MasterTurnOvers']);
		
		$sr_no=0;
		$_header=['S.No.', 'Company/Organisation', 'Gst Number','ID Card No.',  'Member Name',  'Category', 'Address', 'City','E-mail', 'Mobile No.',  'Year of Joining', 'Turn Over', 'Due Amount'];
		
		foreach($master_member as $data) 
		{	
			$contain[]=[ ++$sr_no, $data->company_organisation,$data->gst_number, $data->id_card_no, $data->users[0]->member_name, @$data->master_category->category_name, $data->address, $data->city, $data->users[0]->email, $data->users[0]->mobile_no, date('d-m-Y',strtotime($data->year_of_joining)), $data->master_turn_over->component, $data->due_amount ];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Member report.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
		
	}
	public function idCard()
	{
		/*$receipt=$this->Users->find()->select(['id'])->where(['member_type_id'=>1,'member_flag'=>1])->order(['Users.year_of_joining ASC','Users.id ASC'])->toArray();
		
		$id_card_no=1000;
		foreach($receipt as $data)
		{
			$id_card_no++;
			$query = $this->Users->query();
			$query->update()
			->set(['id_card_no' => $id_card_no])
			->where(['id' => $data->id])
			->execute();
		}
		exit;*/
		$this->viewBuilder()->layout('Email/text/default');
		$master_member=$this->Users->find()->select(['id','company_organisation','address','member_name','alternate_nominee','city','pincode','email','alternate_email','id_card_no','id_card_email','id_card_alternate_email'])->where(['member_type_id'=>1,'member_flag'=>1,'OR' => [['id_card_email' => 1], ['id_card_alternate_email' => 1]]])->limit(10)->toArray();
		
		if(!empty($master_member))
		{
			$this->set('master_member',$master_member);
		}
	}
	
	public function IdCardPdf($id=null,$file_name=Null)
	{
	//$this->viewBuilder()->layout('ajax_layout');
		$this->viewBuilder()->layout('Email/text/default');
		/* $master_member=$this->Users->find()->select(['id','company_organisation','address','member_name','alternate_nominee','city','pincode','email','alternate_email','id_card_no','id_card_email','id_card_alternate_email'])->where(['id'=>$id])->toArray();
		
		$master_member=$this->Users->find()->select(['id','company_organisation','address','member_name','alternate_nominee','city','pincode','email','alternate_email','id_card_no','id_card_email','id_card_alternate_email'])->where(['id'=>$id])->toArray();
		 */
		 
		$master_member=$this->Users->find()
					->where(['Users.id'=>$id])
					->contain(['Companies'])
					->order(['Users.member_name ASC']);

		
		if(!empty($master_member))
		{
			$this->set('master_member',$master_member);
			$this->set('file_name',$file_name);
		}
	}
	
	
	
	
	public function UpdateIdCardMail($id=Null,$file_name=Null,$mail_send=Null)
	{
		if($file_name==1)
		{
			$query = $this->Users->query();
			$query->update()
			->set(['id_card_email' => $mail_send])
			->where(['id' => $id])
			->execute();
		}
		else if($file_name==2)
		{
			$query = $this->Users->query();
			$query->update()
			->set(['id_card_alternate_email' => $mail_send])
			->where(['id' => $id])
			->execute();
		}
		$this->response->body('Ok');
		return $this->response;
	}
	public function index()
    {
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		
		$this->viewBuilder()->layout('index_layout');
		
		$UsersOrigins=$this->Users->UserOrigins->find()->toArray();
		
		/* $SubCommittees=$this->Users->SubCommittees->find()->contain(['Users'])->toArray();
		
		foreach($SubCommittees as $SubCommitte){
			 $id=$SubCommitte->id;
			 $member_name=$SubCommitte->user->member_name;
				$query = $this->Users->SubCommittees->query();
				$query->update()
				->set(['member_name'=>$member_name])
				->where(['id' => $id])
				->execute();
			
		}
		 */
		//pr($UsersOrigins); 
		//Companies and company member and user code
		/* 
		
		foreach($UsersOrigins as $userorigin){
			$id= $userorigin->id;
			$role_id= $userorigin->role_id;
			$gst_number= $userorigin->gst_number;
			$id_card_no= $userorigin->id_card_no;
			$company_organisation= $userorigin->company_organisation;
			$member_name= $userorigin->member_name;
			$alternate_nominee= $userorigin->alternate_nominee;
			$address= $userorigin->address;
			$city= $userorigin->city;
			$pincode= $userorigin->pincode;
			$pan_no= $userorigin->pan_no;
			$end_products_item_dealing_in= $userorigin->end_products_item_dealing_in;
			$office_telephone= $userorigin->office_telephone;
			$residential_telephone= $userorigin->residential_telephone;
			$email= $userorigin->email;
			$password= $userorigin->password;
			$alternate_email= $userorigin->alternate_email;
			$mobile_no= $userorigin->mobile_no;
			$alternate_mobile_no= $userorigin->alternate_mobile_no;
			$grade= $userorigin->grade;
			$category= $userorigin->category;
			$classification= $userorigin->classification;
			$year_of_joining= $userorigin->year_of_joining;
			$member_type_id= $userorigin->member_type_id;
			$turn_over_id= $userorigin->turn_over_id;
			$due_amount= $userorigin->due_amount;
			$id_card_email= $userorigin->id_card_email;
			$id_card_alternate_email= $userorigin->id_card_alternate_email;
			$passkey= $userorigin->passkey;
			$timeout= $userorigin->timeout;
			$member_flag= $userorigin->member_flag;
			
			$CompanyNews=$this->Users->CompanyNews->newEntity();
			
			$CompanyNews->role_id=$role_id;
			$CompanyNews->gst_number=$gst_number;
			$CompanyNews->id_card_no=$id_card_no;
			$CompanyNews->company_organisation=$company_organisation;
			$CompanyNews->due_amount=$due_amount;
			$CompanyNews->address=$address;
			$CompanyNews->city=$city;
			$CompanyNews->pincode=$pincode;
			$CompanyNews->end_products_item_dealing_in=$end_products_item_dealing_in;
			$CompanyNews->office_telephone=$office_telephone;
			$CompanyNews->residential_telephone=$residential_telephone;
			$CompanyNews->company_email_id='';
			$CompanyNews->grade=$grade;
			$CompanyNews->category=$category;
			$CompanyNews->classification=$classification;
			$CompanyNews->year_of_joining=$year_of_joining;
			$CompanyNews->turn_over_id=$turn_over_id;
			$CompanyNews->member_flag=$member_flag;
			$CompanyNews->website='';
			$CompanyNews->tag='';
			$CompanyNews->infrastructure='';
			$CompanyNews->brief_description='';
			//pr($CompanyNews);
			//exit;
			$company=$this->Users->CompanyNews->save($CompanyNews);
			$company_id=$company->id;
			
			
			$Companymember=$this->Users->CompanyMembers->newEntity();
			$Companymember->company_id=$company_id;
			$Companymember->master_member_type_id=$member_type_id;
			$Companymember->master_financial_year_id=8;
			$Companymember->due_amount=$due_amount;
			$Companymember->flag=1;
			
			
			$this->Users->CompanyMembers->save($Companymember);
			$image='images/member_user/user_profile_'.$id.'.jpg';
			
			$UserNews=$this->Users->UserNews->newEntity();
			$UserNews->id=$id;
			$UserNews->company_id=$company_id;
			$UserNews->member_name=$member_name;
			$UserNews->member_nominee_type='first';
			$UserNews->email=$email;
			$UserNews->username='';
			$UserNews->password=$password;
			$UserNews->mobile_no=$mobile_no;
			$UserNews->id_card_email=$id_card_email;
			$UserNews->passkey=$passkey;
			$UserNews->timeout=$timeout;
			$UserNews->member_flag=$member_flag;
			$UserNews->facebook_account='';
			$UserNews->gmail_account='';
			$UserNews->device_token='';
			$UserNews->member_designation='';
			$UserNews->social_id='';
			$UserNews->login_by='';
			$UserNews->fb_user_id='';
			$UserNews->fb_token='';
			$UserNews->google_token='';
			$UserNews->google_auth='';
			$UserNews->image=$image;
			
			$this->Users->UserNews->save($UserNews);
			
		
			
		}
		exit; */
		
		/* 
		// Nominate member entry code 
		foreach($UsersOrigins as $userorigin){
			$id= $userorigin->id;
			$role_id= $userorigin->role_id;
			$gst_number= $userorigin->gst_number;
			$id_card_no= $userorigin->id_card_no;
			$company_organisation= $userorigin->company_organisation;
			$member_name= $userorigin->member_name;
			$alternate_nominee= $userorigin->alternate_nominee;
			$address= $userorigin->address;
			$city= $userorigin->city;
			$pincode= $userorigin->pincode;
			$pan_no= $userorigin->pan_no;
			$end_products_item_dealing_in= $userorigin->end_products_item_dealing_in;
			$office_telephone= $userorigin->office_telephone;
			$residential_telephone= $userorigin->residential_telephone;
			$email= $userorigin->email;
			$password= $userorigin->password;
			$alternate_email= $userorigin->alternate_email;
			$mobile_no= $userorigin->mobile_no;
			$alternate_mobile_no= $userorigin->alternate_mobile_no;
			$grade= $userorigin->grade;
			$category= $userorigin->category;
			$classification= $userorigin->classification;
			$year_of_joining= $userorigin->year_of_joining;
			$member_type_id= $userorigin->member_type_id;
			$turn_over_id= $userorigin->turn_over_id;
			$due_amount= $userorigin->due_amount;
			$id_card_email= $userorigin->id_card_email;
			$id_card_alternate_email= $userorigin->id_card_alternate_email;
			$passkey= $userorigin->passkey;
			$timeout= $userorigin->timeout;
			$member_flag= $userorigin->member_flag;
			
			$UserNewss=$this->Users->UserNews->find()->where(['id'=>$id])->toArray();
			$company_id=$UserNewss[0]->company_id;
			
			
			
			//$image='images/member_user/user_profile_'.$id.'.jpg';
			
			if(!empty($alternate_nominee)){
			
				$UserNews=$this->Users->UserNews->newEntity();
				
				$UserNews->company_id=$company_id;
				$UserNews->member_name=$alternate_nominee;
				$UserNews->member_nominee_type='second';
				$UserNews->email=$alternate_email;
				$UserNews->username='';
				$UserNews->password=$password;
				$UserNews->mobile_no=$alternate_mobile_no;
				$UserNews->id_card_email=$id_card_alternate_email;
				$UserNews->passkey=$passkey;
				$UserNews->timeout=$timeout;
				$UserNews->member_flag=$member_flag;
				$UserNews->facebook_account='';
				$UserNews->gmail_account='';
				$UserNews->device_token='';
				$UserNews->member_designation='';
				$UserNews->social_id='';
				$UserNews->login_by='';
				$UserNews->fb_user_id='';
				$UserNews->fb_token='';
				$UserNews->google_token='';
				$UserNews->google_auth='';
				$UserNews->image='';
				
				$this->Users->UserNews->save($UserNews);
			
			}
			
			
		}
		exit; */
		//Api for image path code
		
		/* $UserNews=$this->Users->UserNews->find()->toArray();
		
		foreach($UserNews as $User){
			
			$id=$User->id;
			$image='images/member_user/user_profile_'.$id.'.jpg';
			$query = $this->Users->UserNews->query();
			$query->update()
			->set(['image'=>$image])
			->where(['id' => $id])
			->execute();
			
		}
		
		
		exit; */
		
		
		
		//Member fee code
		
	/* 	
		
		$MemberFees=$this->Users->MemberFees->find()->toArray();
		
		//pr($MemberFees);
		foreach($MemberFees as $fee){
			$id=$fee->id;
			$member_id=$fee->member_id;
			$invoice_no=$fee->invoice_no;
			$performa_invoice_no=$fee->performa_invoice_no;
			$turn_over_fee=$fee->turn_over_fee;
			$membership_fee=$fee->membership_fee;
			$sub_total=$fee->sub_total;
			$tax_amount=$fee->tax_amount;
			$grand_total=$fee->grand_total;
			$date=$fee->date;
			$invoice_date=$fee->invoice_date;
			$mail_send=$fee->mail_send;
			$reminder_mail=$fee->reminder_mail;
			$flag=$fee->flag;
			$master_financial_year_id=8;
			
			
			$userss=$this->Users->find()->where(['Users.id'=>$member_id])
			->contain(['Companies'=>['CompanyMemberTypes']])->toArray();
			
			$company_id=$userss[0]->company_id;
			
			$company_member_type_id=$userss[0]->company->company_member_types[0]->id;
			
			$MemberFeeNews=$this->Users->MemberFeeNews->newEntity();
			$MemberFeeNews->id=$id;
			$MemberFeeNews->company_id=$company_id;
			$MemberFeeNews->company_member_type_id=$company_member_type_id;
			$MemberFeeNews->invoice_no=$invoice_no;
			$MemberFeeNews->performa_invoice_no=$performa_invoice_no;
			$MemberFeeNews->turn_over_fee=$turn_over_fee;
			$MemberFeeNews->membership_fee=$membership_fee;
			$MemberFeeNews->sub_total=$sub_total;
			$MemberFeeNews->tax_amount=$tax_amount;
			$MemberFeeNews->grand_total=$grand_total;
			$MemberFeeNews->date=$date;
			$MemberFeeNews->invoice_date=$invoice_date;
			$MemberFeeNews->mail_send=$mail_send;
			$MemberFeeNews->reminder_mail=$reminder_mail;
			$MemberFeeNews->flag=$flag;
			$MemberFeeNews->master_financial_year_id=$master_financial_year_id;
					
			$this->Users->MemberFeeNews->save($MemberFeeNews);
			
		}
		
		
		exit;
		
		 */
		 
		 
		 // Member Receipt code
		/*  
		 
		 $MemberReceipts=$this->Users->MemberReceipts->find()->toArray();
		 
		// pr($MemberReceipts); 
		 
		 foreach($MemberReceipts as $MemberReceipt){
			 
			  $receipt_id=$MemberReceipt->receipt_id; 
			  $member_fee_id=$MemberReceipt->member_fee_id;
			  $receipt_no=$MemberReceipt->receipt_no;
			  $member_id=$MemberReceipt->member_id;
			  $purpose_id=$MemberReceipt->purpose_id;
			  $amount_type=$MemberReceipt->amount_type;
			  $bank_id=$MemberReceipt->bank_id;
			  $drawn_bank=$MemberReceipt->drawn_bank;
			  $cheque_no=$MemberReceipt->cheque_no;
			  $cheque_date=$MemberReceipt->cheque_date;
			  $basic_amount=$MemberReceipt->basic_amount;
			  $taxamount=$MemberReceipt->taxamount;
			  $amount=$MemberReceipt->amount;
			  $tds_amount=$MemberReceipt->tds_amount;
			  $narration=$MemberReceipt->narration;
			  $mail_send=$MemberReceipt->mail_send;
			  $sms_send=$MemberReceipt->sms_send;
			  $date_current=$MemberReceipt->date_current;
			  $receipt_flag=$MemberReceipt->receipt_flag;
			  
			   $receipt_type='general_receipt';
			  if($member_fee_id!=0){
				  
				  $MemberFeeMemberReceipts=$this->Users->MemberFeeMemberReceipts->newEntity();
				  $MemberFeeMemberReceipts->member_fee_id=$member_fee_id;
				  $MemberFeeMemberReceipts->member_receipt_id=$receipt_id;
				  $this->Users->MemberFeeMemberReceipts->save($MemberFeeMemberReceipts);
				  $receipt_type='member_receipt';
			  }
			
			$Users=$this->Users->find()->where(['id'=>$member_id])->toArray();
			$company_id=$Users[0]->company_id; 
			$MemberReceiptNews=$this->Users->MemberReceiptNews->newEntity();
			$MemberReceiptNews->receipt_id=$receipt_id;
			$MemberReceiptNews->receipt_type=$receipt_type;
			$MemberReceiptNews->receipt_no=$receipt_no;
			$MemberReceiptNews->company_id=$company_id;
			$MemberReceiptNews->purpose_id=$purpose_id;
			$MemberReceiptNews->amount_type=$amount_type;
			$MemberReceiptNews->bank_id=$bank_id;
			$MemberReceiptNews->drawn_bank=$drawn_bank;
			$MemberReceiptNews->cheque_no=$cheque_no;
			$MemberReceiptNews->cheque_date=$cheque_date;
			$MemberReceiptNews->basic_amount=$basic_amount;
			$MemberReceiptNews->taxamount=$taxamount;
			$MemberReceiptNews->amount=$amount;
			$MemberReceiptNews->tds_amount=$tds_amount;
			$MemberReceiptNews->narration=$narration;
			$MemberReceiptNews->mail_send=$mail_send;
			$MemberReceiptNews->sms_send=$sms_send;
			$MemberReceiptNews->date_current=$date_current;
			$MemberReceiptNews->receipt_flag=$receipt_flag;
					
			$this->Users->MemberReceiptNews->save($MemberReceiptNews);
			  
		
		 }
		exit; 
		  */
		
		
		
		
//file_get_contents('http://103.39.134.40/api/mt/SendSMS?user=UCCIUDR&password=7737291465&senderid=UCCIUD&channel=Trans&DCS=0&flashsms=0&number=918058483636&text=testmessage&route=07');

		//$master_member=$this->Users->find()->where(['member_flag'=>1])->count();
		
		//$coo_count=$this->Users->CertificateOrigins->find()->where(['approve'=>1])->count();
		/* $MembershipDueAmounts=$this->Users->MembershipDueAmounts->find();
		
		foreach($MembershipDueAmounts as $MembershipDueAmount)
		{
			$Users=$this->Users->find()->select(['id'])->where(['company_master_id'=>$MembershipDueAmount->company_master_id])->order(['id'=>'ASC'])->limit(1);
			foreach($Users as $User)
			{
					$query = $this->Users->MembershipDueAmounts->query();
							$query->update()
							->set(['user_id'=>$User->id])
							->where(['id' => $MembershipDueAmount->id])
							->execute();
			}
			
		} */
		
		
		//$receipt=$this->Users->MemberReceipts->find()->where(['member_fee_id'=>0])->count();
		
		//$member_fee = $this->Users->MemberFees->find()->select(['id'])->toArray();
		
		//$due = $this->Users->find()->where(['due_amount >'=>0,'member_type_id IN'=>'1,2'])->count();
		
		// Folder data
		
		/* 
		$all=glob("images/member_user".'/*');
		
		$all_ids= str_replace("images/member_user/","",$all);
		
		$x=0;
		foreach($all as $folder)
		{ 
			$id_code_no=$all_ids[$x];
			$users=$this->Users->find()->where(['id_card_no'=>$id_code_no])->toArray();
			//pr($users);
			$company_organisation=$users[0]->company_organisation;
			$company_organisation=trim($company_organisation);
			if(!empty($company_organisation)){
				rename(@$folder, "images/member_user/".$company_organisation);
			}
			$x++;	
		}
		exit;
		
		
		 */
		
		/* $all=glob("images/member_user".'/*');
		
		$all_ids= str_replace("images/member_user/","",$all);
		
		$x=0;
		foreach($all as $folder)
		{ 
			$id_code_no=$all_ids[$x];
			$users=$this->Users->find()->where(['id_card_no'=>$id_code_no])->toArray();
			
			$member_name=$users[0]->member_name;
			$alternate_nominee=$users[0]->alternate_nominee;
			$FolderWise=glob($folder.'/*');
			
			foreach($FolderWise as $single_data)
			{
				
				$image_type= str_replace("images/member_user/".$id_code_no."/","",$single_data);
				//--- Condition
				
				
				if($image_type=="1.jpg"){
					
					rename($single_data, "images/member_user/".$id_code_no."/".$member_name.".jpg");
					
				}
				if($image_type=="2.jpg"){
					
					rename($single_data, "images/member_user/".$id_code_no."/".$alternate_nominee.".jpg");
				}
				
			}			
			
			$x++;
		} */
		
		
		//
		
	/* 	
		$all=glob("images/member_user".'/*');
		
		$all_ids= str_replace("images/member_user/","",$all);
		
		//pr($all_ids);exit;
		$x=0;
		foreach($all as $folder)
		{ 
			$id_code_no=$all_ids[$x];
			$Companies=$this->Users->Companies->find()
			->where(['id_card_no'=>$id_code_no])
			->contain(['Users'])
			->toArray();
			 $id=$Companies[0]->users[0]->id;
			 $id1=$Companies[0]->users[1]->id;
			
			//$member_name=$users[0]->member_name;
			//$alternate_nominee=$users[0]->alternate_nominee;
			$FolderWise=glob($folder.'/*');
			
			foreach($FolderWise as $single_data)
			{
				
				$image_type= str_replace("images/member_user/".$id_code_no."/","",$single_data);
				//--- Condition
				
				
				if($image_type=="1.jpg"){
					
					rename($single_data, "images/member_user/user_profile_".$id.".jpg");
					
				}
				if($image_type=="2.jpg"){
					
					
					rename($single_data, "images/member_user/user_profile_".$id1.".jpg");
				}
				
			}			
			
			$x++;
		}  */
		
		
	/* 	$all=glob("images/company_images".'/*');
		
		$all_ids= str_replace("images/company_images/","",$all);
		
		$x=0;
		foreach($all as $folder)
		{ 
			$id=$all_ids[$x];
			$users=$this->Users->find()
			->where(['Users.id'=>$id])->toArray();
			
			
			$company_id=$users[0]->company_id;
			//$alternate_nominee=$users[0]->alternate_nominee;
			$FolderWise=glob($folder.'/*');
			
			foreach($FolderWise as $single_data)
			{
				 // $single_data="images/company_images/684/company_image.png";
				//echo $image_type= str_replace("images/member_user/".$id."/","",$single_data);
				//--- Condition
				$coverage_path="images/company_images/company_image_".$company_id.".jpg";
					
				rename($single_data, "images/company_images/company_image_".$company_id.".jpg");
				
				$query = $this->Users->Companies->query();
				$query->update()
				->set(['company_image'=>$coverage_path])
				->where(['id' => $company_id])
				->execute();	
				
			}			
			
			$x++;
		}
		
		
		exit; */
		
		
		
		
		$this->set(compact('master_member','role_id','due','coo_count','receipt'));
	}
	public function add()
    {
		$this->Auth->User('id');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	public function checkEmail()
    {
		$email=$this->request->query['email'];
		
		$Users=$this->Users->find()
		->where(['OR' => ['email' => $email,'alternate_email' => $email]])
		->count();
		if(empty($Users))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		$this->response->body($output);
		return $this->response;
	}
	public function checkEmailEdit($id = null)
    {
		 $email=$this->request->query['email'];
	    
			$Users=$this->Users->find()
			->where(['id !='=>$id, 'OR' => ['email' => $email,'alternate_email' => $email]])
			->count();
		if(empty($Users))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		$this->response->body($output);
		return $this->response;
	}
	
	public function checkAlternateEmailEdit($id = null)
    {
		$email=$this->request->query['alternate_email'];
		
		$Users=$this->Users->find()
		->where(['id !='=>$id, 'OR' => ['email' => $email,'alternate_email' => $email]])
		->count();
		if(empty($Users))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		$this->response->body($output);
		return $this->response;
	}
	
	public function checkAlternateEmail()
    {
		$email=$this->request->query['alternate_email'];
		
		$Users=$this->Users->find()
		->where(['OR' => ['email' => $email,'alternate_email' => $email]])
		->count();
		if(empty($Users))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		$this->response->body($output);
		return $this->response;
	}
	public function checkEditEmail()
    {
		$email=$this->request->query['email'];
		$id=$this->request->query['id'];
		$Users=$this->Users->find()
		->where(['id !='=>$id, 'OR' => ['email' => $email,'alternate_email' => $email]])
		->count();
		if(empty($Users))
		{
			$output="true";
		}
		else
		{
			$output="false";
		}
		$this->response->body($output);
		return $this->response;
	}
	public function createLogin()
    {
		$this->viewBuilder()->layout('index_layout');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been created.'));
                return $this->redirect(['action' => 'create_login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }

        $this->set('user', $user);
		$fetch_role=$this->Users->Roles->find('all');
		$this->set('fetch_role',$fetch_role);
    }
	public function changePassword()
    {
		$this->viewBuilder()->layout('index_layout');
		$id=$this->Auth->User('id');
        $user = $this->Users->newEntity();
		$users = $this->Users->find()->select(['id','member_name','username', 'email'])->where(['id'=>$id])->toArray();
        if($this->request->is('post')) {
			$this->request->data['id']=$id;
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account has been updated.'));
                return $this->redirect(['action' => 'change_password']);
            }
            $this->Flash->error(__('Unable to update account.'));
        }
		$this->set('users', $users);
        $this->set('user', $user);
		$this->set('user_id', $id);
    }
	
	
	public function MemberRegistration()
	{
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->Users->Companies->newEntity();
		
		$result_user=$this->Users->Companies->find()->select(['id_card_no'])->order(['id_card_no' => 'DESC'])->first();
		$master_financial_years=$this->Users->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
		foreach($master_financial_years as $master_financial_year){
			$master_financial_year_id=$master_financial_year->id;
		}
		
	
		if ($this->request->is('post')) 
		{
		
		    $id_card_no=$result_user->id_card_no+1;
			$member_image = $this->request->data['member_image'];
			$alternate_image = $this->request->data['alternate_image'];
			
			$this->request->data['role_id']=2;
			$this->request->data['id_card_no']=$id_card_no;
			$this->request->data['password']='ucci';
			$this->request->data['year_of_joining']=date('Y-m-d',strtotime($this->request->data['year_of_joining']));
			
			$this->request->data=array_filter($this->request->data);
			$this->request->data['users'][0]=array_filter($this->request->data['users'][0]);
			$this->request->data['users'][1]=array_filter($this->request->data['users'][1]);
			$this->request->data['users']=array_filter($this->request->data['users']);
			$member_type_id=$this->request->data['company_member_types']['master_member_type_id'];
			//pr($member_type_id);
			unset($this->request->data['company_member_types']['master_member_type_id']);
						
			$master_user = $this->Users->Companies->patchEntity($master_user, $this->request->data);
			
			/* $i=0;
			foreach($member_type_id as $member_type)
			{
				$MembershipDueAmount=$this->Users->company_member_types->newEntity();
				$MembershipDueAmount->member_type_id=$member_type;
				
				$master_user->users[0]->membership_due_amounts[$i]=$MembershipDueAmount;
				$MembershipDueAmount->due_amount=0.00;
				$master_user->users[0]->membership_due_amounts[$i]=$MembershipDueAmount;
				$i++;
			}
			 */

		$i=0;
		foreach($member_type_id as $member_type)
		{
			$MembershipDueAmount=$this->Users->Companies->CompanyMemberTypes->newEntity();

			$MembershipDueAmount->master_member_type_id=$member_type;

			$master_user->company_member_types[$i]=$MembershipDueAmount;
			$MembershipDueAmount->due_amount=0.00;
			$master_user->company_member_types[$i]=$MembershipDueAmount;
			$MembershipDueAmount->master_financial_year_id=$master_financial_year_id;
			$master_user->company_member_types[$i]=$MembershipDueAmount;
			$i++;
		}
		//pr($this->request->data); exit;
			if ($users=$this->Users->Companies->save($master_user)) {
					
				
				if(!empty($member_image['tmp_name']))
			   {
				$id=$users->users[0]->id;
				$ext = substr(strtolower(strrchr($member_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				
				$coverage_path='images/member_user/user_profile_'.$id.'.'.$ext;
								
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($member_image['tmp_name'], WWW_ROOT . '/images/member_user/user_profile_'.$id.'.'.$ext);
				}
				
				$query = $this->Users->query();
				$query->update()
				->set(['image'=>$coverage_path])
				->where(['id' => $id])
				->execute();
			}
			
			if(!empty($alternate_image['tmp_name']))
			{   
				$id1=$users->users[1]->id;
				$ext = substr(strtolower(strrchr($alternate_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				
				$coverage_path='images/member_user/user_profile_'.$id1.'.'.$ext;
					
				
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($alternate_image['tmp_name'], WWW_ROOT . '/images/member_user/user_profile_'.$id1.'.'.$ext);
				}
				
					$query = $this->Users->query();
					$query->update()
					->set(['image'=>$coverage_path])
					->where(['id' => $id1])
					->execute();
			}

		        $this->Flash->success(__('The member has been saved.')); 
                return $this->redirect(['action' => 'member_registration']);
            }
				
            $this->Flash->error(__('Unable to add the member.'));
		}
		$this->set('turn_over' , $this->Users->MasterTurnOvers->find()->toArray());
		$this->set('member_type' , $this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
		$this->set('fetch_master_classification' , $this->Users->MasterClassifications->find()->toArray());
		$state=$this->Users->MasterStates->find('list');
		$this->set(compact('state'));
		$this->set('master_user',$master_user);
	}
	public function MemberView()
	{
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		
		
	
		 $this->set('master_members',$this->Users->Companies->find()
		->where(['Companies.member_flag'=>1])
		->contain(['Users','CompanyMemberTypes'=>['MasterMemberTypes']])
		->order(['Companies.company_organisation ASC'])->toArray());
		$this->set('member_type',$this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray()); 
		
		
		
		
		$conditions['Companies.member_flag']=1;
		if(isset($this->request->query['member_report'])){
			 $member_id = $this->request->query['member_id'];
			 $grade = $this->request->query['grade'];
			 $category = $this->request->query['category'];
			 $member_type_id = $this->request->query['member_type_id'];
			if(!empty($member_id)){
				$conditions['Companies.id']=$member_id;
			}
			if(!empty($grade)){
				$conditions['Companies.grade']=$grade;	
			}
			if(!empty($category)){
				$conditions['Companies.category']=$category;
			}
			if(!empty($member_type_id)){
				$conditions1['CompanyMemberTypes.master_member_type_id']=$member_type_id;
			}else{
				$conditions1='';
			}
		
				$master_member = $this->Users->Companies->find();
				$master_member->where($conditions)
				->contain(['Users'=>function($q){ 
					return $q->where(['Users.member_nominee_type'=>'first']); 
				},'CompanyMemberTypes','MasterTurnOvers'])
				->select(['total'=>$master_member->func()->count('CompanyMemberTypes.id')])->leftJoinWith('CompanyMemberTypes', function($q) use($conditions1){
				return $q->where(@$conditions1);
				})->group(['Companies.id'])
				->having(['total >' => 0])
				->order(['Companies.company_organisation ASC'])
				->autoFields(true);
		
			$master_member = $this->paginate($master_member);
			$this->set(compact('master_member'));


		}else{
			
			$master_member = $this->paginate($this->Users->Companies->find()
			->select(['id','company_organisation','turn_over_id','year_of_joining'])
			->where($conditions)
			->contain(['Users'=>function($q){
				return $q->where(['Users.member_nominee_type'=>'first']);
				},'CompanyMemberTypes','MasterTurnOvers'])
			->order(['Companies.company_organisation ASC'])
			->autoFields(true));
			$this->set(compact('master_member'));
		}
	}
	public function deleteUser($id = null)
	{
		$this->request->allowMethod(['post', 'delete', 'get']);
        $Companies = $this->Users->Companies->get($id,['contain'=>['Users','CompanyMemberTypes']]);
	
		foreach($Companies->company_member_types as $company_member_type){
				$query = $this->Users->Companies->CompanyMemberTypes->query();
				$query->update()
				->set(['flag'=>0])
				->where(['id' => $company_member_type->id])
				->execute();
		}
		
		foreach($Companies->users as $user){
				$query = $this->Users->query();
				$query->update()
				->set(['member_flag'=>0])
				->where(['id' => $user->id])
				->execute();
		}
		
		
		$this->request->data['member_flag']=0;
		$Companies = $this->Users->Companies->patchEntity($Companies, $this->request->data);
		
		if ($this->Users->Companies->save($Companies)) 
		{
            $this->Flash->success(__('The registration has been deleted.'));
        } else 
		{
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'memberView']);
	}
	
	public function MemberViewDetail($auto_id=null){
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		 $Companies = $this->Users->Companies->get($auto_id,['contain'=>['Users','CompanyMemberTypes']]);
	
		if ($this->request->is(['post','put'])) {
			
			
			$member_image = $this->request->data['member_image'];
			$alternate_image = $this->request->data['alternate_image'];
					
			$this->request->data['role_id']=2;
			$this->request->data['password']='ucci';
			$this->request->data['year_of_joining']=date('Y-m-d',strtotime($this->request->data['year_of_joining']));
			$member_type_id=@$this->request->data['company_member_types']['master_member_type_id'];
			
			 
			$this->request->data=array_filter($this->request->data);
			$this->request->data['users'][0]=array_filter($this->request->data['users'][0]);
			$this->request->data['users'][1]=array_filter($this->request->data['users'][1]);
			$this->request->data['users']=array_filter($this->request->data['users']);
			$Companies = $this->Users->Companies->patchEntity($Companies, $this->request->data);
			unset($this->request->data['company_member_types']['master_member_type_id']);
			$i=0;
			if(!empty($member_type_id)){
				foreach($member_type_id as $member_type)
				{
					$MembershipDueAmount=$this->Users->Companies->CompanyMemberTypes->newEntity();
					
					$companyMemberTypes = $this->Users->Companies->CompanyMemberTypes->find()->where(['company_id'=>$auto_id,'master_member_type_id'=>$member_type]);
					if(!empty($companyMemberTypes))
					{
						foreach($companyMemberTypes as $company_member_type)
						{
							$MembershipDueAmount->id=$company_member_type->id;
						}
						$Companies->company_member_types[$i]=$MembershipDueAmount;
						
					}
					$MembershipDueAmount->company_id=$auto_id;

					$Companies->company_id[$i]=$MembershipDueAmount;
					$MembershipDueAmount->master_member_type_id=$member_type;

					$Companies->company_member_types[$i]=$MembershipDueAmount;
					$MembershipDueAmount->due_amount=5.00;
					$Companies->company_member_types[$i]=$MembershipDueAmount;
					$i++;
				}
			}
			
		//	pr($Companies); exit;
			if ($users=$this->Users->Companies->save($Companies)) {

				if(!empty($member_image['tmp_name']))
			   {
							
				$id=$users->users[0]->id;
				$ext = substr(strtolower(strrchr($member_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				
				$coverage_path='images/member_user/user_profile_'.$id.'.'.$ext;
								
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($member_image['tmp_name'], WWW_ROOT . '/images/member_user/user_profile_'.$id.'.'.$ext);
				}
				
				$query = $this->Users->query();
				$query->update()
				->set(['image'=>$coverage_path])
				->where(['id' => $id])
				->execute();
				
			}
			
			if(!empty($alternate_image['tmp_name']))
			{
				$id1=$users->users[1]->id;
				$ext = substr(strtolower(strrchr($alternate_image['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				
				$coverage_path='images/member_user/user_profile_'.$id1.'.'.$ext;
					
				
				if (in_array($ext, $arr_ext)) {
					move_uploaded_file($alternate_image['tmp_name'], WWW_ROOT . '/images/member_user/user_profile_'.$id1.'.'.$ext);
				}
				
					$query = $this->Users->query();
					$query->update()
					->set(['image'=>$coverage_path])
					->where(['id' => $id1])
					->execute();
			}

			
                $this->Flash->success(__('The member has been updated.'));
                return $this->redirect(['action' => 'member_view']);
            }
	
            $this->Flash->error(__('Unable to update the member.'));
		}
		
			$member_details=$this->Users->find('all',array('conditions'=>array('id'=>$auto_id)))->toArray();
			$this->set(compact('member_details'));
			$this->set('turn_over' , $this->Users->MasterTurnOvers->find()->toArray());
			$this->set('member_type' , $this->Users->MasterMemberTypes->find()->toArray());
			$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
			$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
			$this->set('fetch_master_classification' , $this->Users->MasterClassifications->find()->toArray());
		
		$this->set('update',$Companies);
	}
	
	public function profileUpdate(){
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$auto_id=$company_id; 
		$this->viewBuilder()->layout('index_layout');
		 $Companies = $this->Users->Companies->get($auto_id,['contain'=>['Users','CompanyMemberTypes']]);
	
		if ($this->request->is(['post','put'])) {
						
			$member_image = $this->request->data['member_image'];
			$alternate_image = $this->request->data['alternate_image'];
					
			$this->request->data['company_id']=$company_id;
			$this->request->data['role_id']=2;
			$this->request->data['password']='ucci';
			$this->request->data['year_of_joining']=date('Y-m-d',strtotime($this->request->data['year_of_joining']));
			$member_type_id=@$this->request->data['company_member_types']['master_member_type_id'];
						
			$userProfiles=$this->Users->Companies->UserProfiles->newEntity();
			//pr($Companies); 
			
			if(!empty($member_image['tmp_name']))
			   {		
					$ext = substr(strtolower(strrchr($member_image['name'], '.')), 1);  //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					
					
					$dir = new Folder(WWW_ROOT . 'img/user_profile/', true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/user_profile/';
					$coverage_path='img/user_profile/'.$setNewFileName.'.'.$ext;
					
					$this->request->data['image']=$coverage_path;
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($member_image['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
						}
					
				}
				
				
			 if(!empty($alternate_image['tmp_name']))
			   {		
					$ext = substr(strtolower(strrchr($alternate_image['name'], '.')), 1);  //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					$setNewFileName = uniqid();
					
					
					$dir = new Folder(WWW_ROOT . 'img/user_profile/', true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/user_profile/';
					$coverage_path2='img/user_profile/'.$setNewFileName.'.'.$ext;
					
					$this->request->data['alternate_image']=$coverage_path2;
						if (in_array($ext, $arr_ext)) {
							move_uploaded_file($alternate_image['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
						}
					
				}
				
				
			$userProfiles = $this->Users->Companies->UserProfiles->patchEntity($userProfiles, $this->request->data);
			
		if($users=$this->Users->Companies->UserProfiles->save($userProfiles)) {
					
                $this->Flash->success(__('The Member Profile has been updated within 24 Hours your request send for approval.'));
                return $this->redirect(['action' => 'ProfileMemberView']);
            }
	
            $this->Flash->error(__('Unable to update the member.'));
		}
		
			$member_details=$this->Users->find('all',array('conditions'=>array('id'=>$auto_id)))->toArray();
			$this->set(compact('member_details'));
			$this->set('turn_over' , $this->Users->MasterTurnOvers->find()->toArray());
			$this->set('member_type' , $this->Users->MasterMemberTypes->find()->toArray());
			$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
			$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
			$this->set('fetch_master_classification' , $this->Users->MasterClassifications->find()->toArray());
		
		$this->set('update',$Companies);
	}
	public function ProfileMemberView($id=null){
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		if(!empty($id)){
			$company_id=$id;
		}
		
		$this->viewBuilder()->layout('index_layout');	
		$UserProfiles = $this->Users->Companies->find()->where(['Companies.id'=>$company_id])->contain(['MasterGrades','MasterCategories','MasterClassifications','MasterTurnOvers','Users'])->toArray();
		
		$this->set('UserProfiles_new',$UserProfiles);
		
	}

	public function profileUpdateView($id=null){
		$user_id=$this->Auth->User('id');
		if(!empty($id)){
			$company_id=$id;
		}
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
		$UserProfiles = $this->Users->Companies->UserProfiles->find()->where(['company_id'=>$company_id,'flag'=>0])->contain(['MasterGrades','MasterCategories','MasterClassifications','MasterTurnOvers'])->toArray();
		$Companies=$this->Users->Companies->get($company_id);
		$role_id=$Companies->role_id; 
		$UserProfiles_form=$this->Users->Companies->UserProfiles->newEntity();
		
		if ($this->request->is(['post','put'])) {
			
			if(isset($this->request->data['profile_approval']))
			{
				$id=$this->request->data['profile_approval'];
				$UserProfile =$this->Users->Companies->UserProfiles->get($id);
				
				$member_name=$UserProfile->member_name;
				$company_id=$UserProfile->company_id;
				$alternate_member=$UserProfile->alternate_member;
				$email=$UserProfile->email;
				$alternate_email=$UserProfile->alternate_email;
				$mobile=$UserProfile->mobile;
				$alternate_mobile=$UserProfile->alternate_mobile;
				$image=$UserProfile->image;
				$alternate_image=$UserProfile->alternate_image;
				$gst_number=$UserProfile->gst_number;
				$company_organisation=$UserProfile->company_organisation;
				$address=$UserProfile->address;
				$pincode=$UserProfile->pincode;
				$city=$UserProfile->city;

				$end_products_item_dealing_in=$UserProfile->end_products_item_dealing_in;
				$office_telephone=$UserProfile->office_telephone;$residential_telephone=$UserProfile->residential_telephone;
				$grade=$UserProfile->grade;
				$category=$UserProfile->category;
				$classification=$UserProfile->classification;
				$year_of_joining=$UserProfile->year_of_joining;
				$turn_over_id=$UserProfile->turn_over_id;
				
				$Companies = $this->Users->Companies->get($UserProfile->company_id,['contain'=>['Users']]);
				$member_name_ac=$Companies->users[0]->member_name;
				$id_ac=$Companies->users[0]->id;
				$member_name_se_ac=$Companies->users[1]->member_name;
				$id_se_ac=$Companies->users[1]->id;
				
				
				if(!empty($image)){
					$image_path="images/member_user/user_profile_".$id_ac.".jpg";
					rename($image, "images/member_user/user_profile_".$id_ac.".jpg");
					
				}
				
				$query = $this->Users->Companies->query();
				$query->update()
				->set(['gst_number'=>$gst_number,'company_organisation'=>$company_organisation,'address'=>$address,'city'=>$city,'pincode'=>$pincode,'end_products_item_dealing_in'=>$end_products_item_dealing_in,'office_telephone'=>$office_telephone,'residential_telephone'=>$residential_telephone,'grade'=>$grade,'category'=>$category,'classification'=>$classification,'year_of_joining'=>$year_of_joining,'turn_over_id'=>$turn_over_id])
				->where(['id' => $company_id])
				->execute();

		
				$query = $this->Users->query();
				$query->update()
				->set(['member_name'=>$member_name,'email'=>$email,'mobile_no'=>$mobile,'image'=>$image_path])
				->where(['id' => $id_ac])
				->execute();

				if(!empty($id_se_ac)){
					$image_alternate_image="images/member_user/user_profile_".$id_se_ac.".jpg";
						if(!empty($alternate_image)){
							
							rename($alternate_image, "images/member_user/user_profile_".$id_se_ac.".jpg");
							
						}
					
					
					$query = $this->Users->query();
					$query->update()
					->set(['member_name'=>$alternate_member,'email'=>$alternate_email,'mobile_no'=>$alternate_mobile,'image'=>$image_alternate_image])
					->where(['id' => $id_se_ac])
					->execute();
					}
				if(empty($id_se_ac) and !empty($alternate_member)){
					
						$Users=$this->Users->newEntity();
						$Users->member_name=$alternate_member;
						$Users->email=$alternate_email;
						$Users->mobile_no=$alternate_mobile;
						$Users->company_id=$company_id;
						$Users->member_nominee_type='second';
						
						$Users_data=$this->Users->save($Users);
						$Users_data_id=$Users_data->id;
						$image_alternate_image="images/member_user/user_profile_".$Users_data_id.".jpg";
					if(!empty($alternate_image)){
						
						rename($alternate_image, "images/member_user/user_profile_".$Users_data_id.".jpg");
						
					}
							
					$query = $this->Users->query();
					$query->update()
					->set(['image'=>$image_alternate_image])
					->where(['id' => $Users_data_id])
					->execute();
					}
				
					$query = $this->Users->Companies->UserProfiles->query();
					$query->update()
					->set(['flag'=>1])
					->where(['id' => $id])
					->execute();
				
					$this->Flash->success(__('The member updation has been approved.'));
					return $this->redirect(['action' => 'profile-approval']);
		
				}
				
				if(isset($this->request->data['profile_reject']))
				{	
					$id=$this->request->data['profile_reject']; 
					$query = $this->Users->Companies->UserProfiles->query();
					$query->update()
					->set(['flag'=>2])
					->where(['id' => $id])
					->execute();
				
					$this->Flash->success(__('The member updation has been Rejected.'));
					return $this->redirect(['action' => 'profile-approval']);
				}
				
			}
		
		$this->set('UserProfiles_new',$UserProfiles);
		$this->set('role_id',$role_id);
		$this->set('UserProfiles_form',$UserProfiles_form);
	}
	
	public function profileApproval(){
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
		
		$UserProfiles =$this->Users->Companies->UserProfiles->find()->where(['flag'=>0])->contain(['MasterGrades','MasterCategories','MasterClassifications','MasterTurnOvers'])->toArray();
		$this->set('UserProfiles_new',$UserProfiles);
	}
	

	public function MemberList(){
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
			
		 $this->set('master_members',$this->Users->Companies->find()
		->where(['Companies.member_flag'=>1])
		->contain(['Users','CompanyMemberTypes'=>['MasterMemberTypes']])
		->order(['Companies.company_organisation ASC'])->toArray());
		$this->set('member_type',$this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray()); 
		
		
		
		
		$conditions['Companies.member_flag']=1;
		if(isset($this->request->query['member_report'])){
			 $member_id = $this->request->query['member_id'];
			 $grade = $this->request->query['grade'];
			 $category = $this->request->query['category'];
			 $member_type_id = $this->request->query['member_type_id'];
			if(!empty($member_id)){
				$conditions['Companies.id']=$member_id;
			}
			if(!empty($grade)){
				$conditions['Companies.grade']=$grade;	
			}
			if(!empty($category)){
				$conditions['Companies.category']=$category;
			}
			if(!empty($member_type_id)){
				$conditions1['CompanyMemberTypes.master_member_type_id']=$member_type_id;
			}else{
				$conditions1='';
			}
		
				$master_member = $this->Users->Companies->find();
				$master_member->where($conditions)
				->contain(['Users'=>function($q){ 
					return $q->where(['Users.member_nominee_type'=>'first']); 
				},'CompanyMemberTypes','MasterTurnOvers'])
				->select(['total'=>$master_member->func()->count('CompanyMemberTypes.id')])->leftJoinWith('CompanyMemberTypes', function($q) use($conditions1){
				return $q->where(@$conditions1);
				})->group(['Companies.id'])
				->having(['total >' => 0])
				->order(['Companies.company_organisation ASC'])
				->autoFields(true);
		
			$master_member = $this->paginate($master_member);
			$this->set(compact('master_member'));


		}else{
			
			$master_member = $this->paginate($this->Users->Companies->find()
			->select(['id','company_organisation','turn_over_id','year_of_joining'])
			->where($conditions)
			->contain(['Users'=>function($q){
				return $q->where(['Users.member_nominee_type'=>'first']);
				},'CompanyMemberTypes','MasterTurnOvers'])
			->order(['Companies.company_organisation ASC'])
			->autoFields(true));
			$this->set(compact('master_member'));
		}
	}
	
	
	
	
    public function MemberPerformaInvoice()
	{
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		if($this->request->is(['post']))
		{
			
			
			foreach($this->request->data['member_id'] as $company_member_type_id=>$company_id)
			{
				$this->MemberPerformaInvoiceCreate($company_member_type_id,$company_id);
			}
			$this->redirect(array('controller' => 'Users','action' => 'member_performa_invoice'));
		}
		 $master_member=$this->Users->Companies->find()->select(['Companies.id','Companies.company_organisation'])->where(['Companies.member_flag'=>1])->contain(['Users'=>function($q){
			return $q->select(['Users.id','Users.company_id'])->where(['member_nominee_type'=>'first']);
		}])->order(['Companies.company_organisation' => 'ASC'])->toArray(); 

		$this->set('master_member',$master_member);
		
		$this->set('member_type' , $this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
	}
	public function MemberPerformaInvoiceAjax()
	{
		$this->viewBuilder()->layout('ajax_layout');
		
		$table_data = array();
		if(isset($this->request->query['member_id'])){
			$id=$this->request->query['member_id'];
			$conditions=array('member_flag'=>1,'id'=>$id);
		}
		else if(isset($this->request->query['grade'])){
			$grade=$this->request->query['grade'];
			$conditions=array('member_flag'=>1,'grade'=>$grade);
		}
		else if(isset($this->request->query['category'])){
			$category=$this->request->query['category'];
			$conditions=array('member_flag'=>1,'category'=>$category);
		}
		else if(isset($this->request->query['member_type_id'])){
			$member_type_id=$this->request->query['member_type_id'];
			$conditions1=array('flag'=>1,'master_member_type_id'=>$member_type_id);
		}
		if(empty($conditions1)){
			$conditions1='';
			$master_member = $this->Users->Companies->find();
			$master_member->where($conditions)
			->contain(['Users'=>function($q){ 
				return $q->where(['Users.member_nominee_type'=>'first']); 
			},'CompanyMemberTypes'=>['MasterMemberTypes']]);
			
			
		}
		if(empty($conditions)){
			$conditions='';
			
			$master_member = $this->Users->Companies->find();
				$master_member->where($conditions)
				->contain(['Users'=>function($q){ 
					return $q->where(['Users.member_nominee_type'=>'first']); 
				},'CompanyMemberTypes'=>['MasterMemberTypes'],'MasterTurnOvers'])
				->select(['total'=>$master_member->func()->count('CompanyMemberTypes.id')])->leftJoinWith('CompanyMemberTypes', function($q) use($conditions1){
				return $q->where(@$conditions1);
				})->group(['Companies.id'])
				->having(['total >' => 0])
				->order(['Companies.company_organisation ASC'])
				->autoFields(true);
		}
		
			/* $master_member = $this->Users->Companies->find();
				$master_member->where($conditions)
				->contain(['Users'=>function($q){ 
					return $q->where(['Users.member_nominee_type'=>'first']); 
				},'CompanyMemberTypes'=>['MasterMemberTypes']]);
			 */
			/* $master_member = $this->Users->Companies->find();
				$master_member->where($conditions)
				->contain(['Users'=>function($q){ 
					return $q->where(['Users.member_nominee_type'=>'first']); 
				},'CompanyMemberTypes'=>['MasterMemberTypes'],'MasterTurnOvers'])
				->select(['total'=>$master_member->func()->count('CompanyMemberTypes.id')])->leftJoinWith('CompanyMemberTypes', function($q) use($conditions1){
				return $q->where(@$conditions1);
				})->group(['Companies.id'])
				->having(['total >' => 0])
				->order(['Companies.company_organisation ASC'])
				->autoFields(true); */
			
		
		if(!empty($master_member)){
			
			$taxation=$this->Users->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->toArray();
			
			
			foreach($taxation as $data){
				$taxation_rate[$data->tax_name]=$this->Users->MasterTaxationRates->find()->select(['id','tax_percentage'])->where(['master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')])->order(['tax_date' => 'DESC'])->limit(1)->toArray();
						
			}
			
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
				$c_year_of_joining=strtotime($from);
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
				$c_year_of_joining=strtotime($from);
			}
			
			$sr_no=0; 
			
			foreach($master_member as $member_data)
			{
				$company_id=$member_data->id;
				
			 foreach($member_data->company_member_types as $company_member_type)
			 {
				$fee_already_submited=$this->Users->MemberFees->find()->where(['company_id'=>$company_id,'company_member_type_id'=>$company_member_type->id,'date >='=>$from,'date <='=>$to])->count();
				
				if(empty($fee_already_submited))
				{

					//$year_of_joining=date('Y',strtotime($member_data->year_of_joining));
					$year_of_joining=strtotime($member_data->year_of_joining);
					$sr_no++;
	
				if($c_year_of_joining <= $year_of_joining)
				{ 
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id])->toArray();
					
					$sub_total=0;$grand_total=0;$membership_fee=0;$turn_over_fee=0;
					
					if(!empty($master_membership_fee)){
						
						foreach($master_membership_fee as $membership_data){
							 $fee=$membership_data->subscription_amount; 
							 $membership_fee+=$fee;
							 $sub_total+=$fee;
						}
			
							
						if(!empty($member_data->turn_over_id))
						{
														
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
							
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						
							
							
				
							$total_tax=0;
							$grand_total+=$sub_total;
							foreach($taxation_rate as $tax_data => $tax_key)
							{
								foreach($tax_key as $tax_value)
								{
									$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
									$total_tax+=$tax_amount;
									$grand_total+=$tax_amount;
								}
							}
														
							
					}
				
					$table_data[] = array($sr_no,$member_data->company_organisation,$company_id,@$grand_total,$company_member_type->master_member_type->member_type,$company_member_type->id);
					
					
				}
				else
				{
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id,'category_name'=>2])->toArray();
					$sub_total=0;$grand_total=0;$membership_fee=0;$turn_over_fee=0;
					if(!empty($master_membership_fee))
					{ 
						
						foreach($master_membership_fee as $membership_data)
						{
							$fee=$membership_data->subscription_amount;
							$membership_fee+=$fee;
							$sub_total+=$fee;
						}
							
						if(!empty($member_data->turn_over_id))
						{
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
														
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						
						$total_tax=0;
						$grand_total+=$sub_total;
						foreach($taxation_rate as $tax_data => $tax_key)
						{
							foreach($tax_key as $tax_value)
							{
								$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
								$total_tax+=$tax_amount;
								$grand_total+=$tax_amount;
									
							}
						}
						
						$table_data[] = array($sr_no,$member_data->company_organisation,$company_id,$grand_total,$company_member_type->master_member_type->member_type,$company_member_type->id);
					
					
					}
					
				}
					
				}
				
			}
		 }
			$this->set('table_data',$table_data);
		}
			
			
	}
	public function MemberPerformaInvoiceCreate($company_member_type_id=null,$company_id=null)
	{
		$this->viewBuilder()->layout('ajax_layout');
		
		$master_member=$this->Users->Companies->find()->select(['id','due_amount','year_of_joining','turn_over_id','company_organisation'])->where(['id'=>$company_id])->contain(['CompanyMemberTypes'=>function($q) use($company_member_type_id){ return $q->where(['id'=>$company_member_type_id]); 
		}])->toArray();
		
		$master_financial_years=$this->Users->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
		foreach($master_financial_years as $master_financial_year){
			 $master_financial_year_id=$master_financial_year->id;
		}
		
		if(!empty($master_member)){
			
			$taxation=$this->Users->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->toArray();
			
			
			foreach($taxation as $data){
				
				$taxation_rate[$data->tax_name]=$this->Users->MasterTaxationRates->find()->select(['id','tax_percentage', 'master_taxation_id'])->where(['master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')])->order(['tax_date'=>'DESC'])->limit(1)->toArray();
			}
			
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
				$c_year_of_joining=strtotime($from);
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
				$c_year_of_joining=strtotime($from);
			}
			
			$sr_no=0; 
			foreach($master_member as $member_data)
			{
				$company_id=$member_data->id;
				$company_due_amount=$member_data->due_amount;
			 foreach($member_data->company_member_types as $company_member_type)
			{ 
				$fee_already_submited=$this->Users->MemberFees->find()->where(['company_id'=>$company_id,'company_member_type_id'=>$company_member_type_id,'date >='=>$from,'date <='=>$to])->count();
				
				if(empty($fee_already_submited))
				{
										
					$last_performa_invoice_no=$this->Users->MemberFees->find()->order(['performa_invoice_no'=>'DESC'])->limit(1)->toArray();
					
					if(!empty($last_performa_invoice_no))
					{
						$performa_invoice_no = $last_performa_invoice_no[0]['performa_invoice_no'] + 1;
					}
					else
					{
						$performa_invoice_no=1;
					}
					
					$member_fees=$this->Users->MemberFees->newEntity();
					
					$array_insert=array('company_id'=>$company_id,'company_member_type_id'=>$company_member_type_id,'date'=>date('Y-m-d'),'performa_invoice_no'=>$performa_invoice_no,'master_financial_year_id'=>$master_financial_year_id);	
					$member_fees=$this->Users->MemberFees->patchEntity($member_fees,$array_insert);
					
					$this->Users->MemberFees->save($member_fees);	
					$last_insert_id=$member_fees->id;
					
					//$year_of_joining=date('Y',strtotime($member_data->year_of_joining));
					$year_of_joining=strtotime($member_data->year_of_joining);
					$sr_no++;
	
				if($c_year_of_joining <= $year_of_joining)
				{ 
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id])->toArray();
					$sub_total=0;$grand_total=0;$membership_fee=0;$turn_over_fee=0;
					if(!empty($master_membership_fee)){
						
						foreach($master_membership_fee as $membership_data){
							 $fee=$membership_data->subscription_amount; 
							 $membership_fee+=$fee;
							 $sub_total+=$fee;
						}
			
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['membership_fee'=>$membership_fee])
							->where(['id' => $last_insert_id])
							->execute();
							
						if(!empty($member_data->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
							
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['turn_over_fee'=>$turn_over_fee,'sub_total'=>$sub_total])
							->where(['id' => $last_insert_id])
							->execute();
							
				
							$total_tax=0;
							$grand_total+=$sub_total;
							foreach($taxation_rate as $tax_data => $tax_key)
							{
								foreach($tax_key as $tax_value)
								{
									$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
									$total_tax+=$tax_amount;
									$grand_total+=$tax_amount;
									$query = $this->Users->MemberFeeTaxAmounts->query();
									$query->insert(['member_fee_id', 'tax_id', 'tax_percentage', 'amount'])
										->values([
											'member_fee_id' => $last_insert_id,
											'tax_id' => $tax_value->master_taxation_id,
											'tax_percentage' => $tax_value->tax_percentage,
											'amount' => $tax_amount
										])
										->execute();
								}
								
							}
														
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['tax_amount'=>$total_tax,'grand_total'=>$grand_total])
							->where(['id' => $last_insert_id])
							->execute();
							
							$query = $this->Users->Companies->CompanyMemberTypes->query();
							$query->update()
							->set(['due_amount'=>$grand_total])
							->where(['id' => $company_member_type_id])
							->execute();
							$c_due_amount=0;
							$c_due_amount=$company_due_amount+$grand_total;
							$query = $this->Users->Companies->query();
							$query->update()
							->set(['due_amount'=>$c_due_amount])
							->where(['id' => $company_id])
							->execute();
					}
					
					
				}
				else
				{
					
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id,'category_name'=>2])->toArray();
					$sub_total=0;$grand_total=0;$membership_fee=0;$turn_over_fee=0;
					
					if(!empty($master_membership_fee))
					{ 
						
						foreach($master_membership_fee as $membership_data)
						{
							$fee=$membership_data->subscription_amount;
							$membership_fee+=$fee;
							$sub_total+=$fee;
						}
	
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['membership_fee'=>$membership_fee])
						->where(['id' => $last_insert_id])
						->execute();
							
						
						if(!empty($member_data->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
							
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['turn_over_fee'=>$turn_over_fee,'sub_total'=>$sub_total])
						->where(['id' => $last_insert_id])
						->execute();
						$total_tax=0;
						$grand_total+=$sub_total;
						foreach($taxation_rate as $tax_data => $tax_key)
						{
							foreach($tax_key as $tax_value)
							{
								$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
								$total_tax+=$tax_amount;
								$grand_total+=$tax_amount;
								$query = $this->Users->MemberFeeTaxAmounts->query();
								$query->insert(['member_fee_id', 'tax_id', 'tax_percentage', 'amount'])
									->values([
										'member_fee_id' => $last_insert_id,
										'tax_id' => $tax_value->master_taxation_id,
										'tax_percentage' => $tax_value->tax_percentage,
										'amount' => $tax_amount
									])
									->execute();
							}
						}
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['tax_amount'=>$total_tax,'grand_total'=>$grand_total])
						->where(['id' => $last_insert_id])
						->execute();
							
							
						$query = $this->Users->Companies->CompanyMemberTypes->query();
						$query->update()
						->set(['due_amount'=>$grand_total])
						->where(['id' => $company_member_type_id])
						->execute();
							
						$c_due_amount=0;
						$c_due_amount=$company_due_amount+$grand_total;
						$query = $this->Users->Companies->query();
						$query->update()
						->set(['due_amount'=>$c_due_amount])
						->where(['id' => $company_id])
						->execute();
											
					}
				}
					
				}
			 }	
			}
		}
	}
	public function MemberPerformaInvoiceEdit()
	{
		$this->viewBuilder()->layout('ajax_layout');
		
		
		if(isset($this->request->data['edit_performa']))
		{
			$performa_invoice_no = $this->request->data['edit_performa']; 
			//$master_member=$this->Users->find()->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation'])->where(['id'=>$member_id])->toArray();
			
			$master_member=$this->Users->MemberFees->find()->where(['performa_invoice_no'=>$performa_invoice_no])->contain(['CompanyMemberTypes','Companies'=>function($q){
				return $q->where(['member_flag'=>1])->contain(['Users'=>function($q){
				return $q->where(['member_nominee_type'=>'first']);
				}]);
			},'MemberFeeTaxAmounts'=>['MasterTaxations']])->toArray();
			
			$master_financial_years=$this->Users->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
			foreach($master_financial_years as $master_financial_year){
				$master_financial_year_id=$master_financial_year->id;
			}
			
			
			
			$sr_no=0; 
			foreach($master_member as $member_data)
			{
			 $member_id=$member_data->company->id;
			 $company_due_amount=$member_data->due_amount;
			$taxation=$this->Users->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->toArray();
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$c_year_of_joining=strtotime($from);
			
			
			
			$fee_already_submited=$this->Users->MemberFees->find()->where(['company_id'=>$member_data->company->id,'company_member_type_id'=>$member_data->company_member_type->id,'date >='=>$from,'date <='=>$to])->toArray();
			foreach($fee_already_submited as $MemberFees)
			{
				$performa_invoice_no=$MemberFees->performa_invoice_no;
				$performa_invoice_date=$MemberFees->invoice_date;
				$invoice_no=$MemberFees->invoice_no;
				$MemberFees_id=$MemberFees->id;
				$grand_total_member=$MemberFees->grand_total;
				
				
			}
			
			//$user_find_due=$this->Users->find()->select(['due_amount'])->where(['id'=>$member_id])->toArray();
			$due_amount=$member_data->company_member_type->due_amount;
			$actual_amount=$due_amount-$grand_total_member;
			
			foreach($taxation as $data){
				
				$taxation_rate[$data->tax_name]=$this->Users->MasterTaxationRates->find()->select(['id','tax_percentage', 'master_taxation_id'])->where(['master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')])->order(['tax_date'=>'DESC'])->limit(1)->toArray();
			}
			
			
			
			
				
				if(!empty($fee_already_submited))
				{
							
					$this->Users->MemberFees->deleteAll(['id' => $MemberFees_id]);
					$this->Users->MemberFeeTaxAmounts->deleteAll(['member_fee_id' => $MemberFees_id]);
					
					$member_fees=$this->Users->MemberFees->newEntity();
					//$array_insert=array('member_id'=>$member_id,'date'=>date('Y-m-d'),'performa_invoice_no'=>$performa_invoice_no,'invoice_date'=>$performa_invoice_date);	
					
					$array_insert=array('company_id'=>$member_data->company->id,'company_member_type_id'=>$member_data->company_member_type->id,'date'=>date('Y-m-d'),'performa_invoice_no'=>$performa_invoice_no,'master_financial_year_id'=>$master_financial_year_id);	
					
					$member_fees=$this->Users->MemberFees->patchEntity($member_fees,$array_insert);
					
					$this->Users->MemberFees->save($member_fees);	
					$last_insert_id=$member_fees->id;
					
						 /*  $query = $this->Users->MemberReceipts->query();
							$query->update()
							->set(['member_fee_id'=>$last_insert_id])
							->where(['member_fee_id' => $MemberFees_id])
							->execute();
					 */
					
					//$year_of_joining=date('Y',strtotime($member_data->year_of_joining));
					$year_of_joining=strtotime($member_data->company->year_of_joining);
					$sr_no++;
	
				if($c_year_of_joining <= $year_of_joining)
				{ 
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$member_data->company_member_type->master_member_type_id])->toArray();
					
					if(!empty($master_membership_fee)){
						$sub_total=0;
						$grand_total=0;
						$membership_fee=0;
						$turn_over_fee=0;
						foreach($master_membership_fee as $membership_data){
							 $fee=$membership_data->subscription_amount; 
							 $membership_fee+=$fee;
							 $sub_total+=$fee;
						}
			
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['membership_fee'=>$membership_fee])
							->where(['id' => $last_insert_id])
							->execute();
							
						if(!empty($member_data->company->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->company->turn_over_id])->toArray();
							
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['turn_over_fee'=>$turn_over_fee,'sub_total'=>$sub_total])
							->where(['id' => $last_insert_id])
							->execute();
							
				
							$total_tax=0;
							$grand_total+=$sub_total;
							foreach($taxation_rate as $tax_data => $tax_key)
							{
								foreach($tax_key as $tax_value)
								{
									$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
									$total_tax+=$tax_amount;
									$grand_total+=$tax_amount;
									$query = $this->Users->MemberFeeTaxAmounts->query();
									$query->insert(['member_fee_id', 'tax_id', 'tax_percentage', 'amount'])
										->values([
											'member_fee_id' => $last_insert_id,
											'tax_id' => $tax_value->master_taxation_id,
											'tax_percentage' => $tax_value->tax_percentage,
											'amount' => $tax_amount
										])
										->execute();
								}
								
							}
														
							$query = $this->Users->MemberFees->query();
							$query->update()
							->set(['tax_amount'=>$total_tax,'grand_total'=>$grand_total])
							->where(['id' => $last_insert_id])
							->execute();
							$actual_amount+=$grand_total;
																					
							$query = $this->Users->Companies->CompanyMemberTypes->query();
							$query->update()
							->set(['due_amount'=>$actual_amount])
							->where(['id' => $member_data->company_member_type->id])
							->execute();
					}
					
					
				}
				else
				{
					
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$member_data->company_member_type->master_member_type_id,'category_name'=>2])->toArray();
					
					
					if(!empty($master_membership_fee))
					{ 
						$sub_total=0;
						$grand_total=0;
						$membership_fee=0;
						$turn_over_fee=0;
						foreach($master_membership_fee as $membership_data)
						{
							$fee=$membership_data->subscription_amount;
							$membership_fee+=$fee;
							$sub_total+=$fee;
						}
	
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['membership_fee'=>$membership_fee])
						->where(['id' => $last_insert_id])
						->execute();
							
						
						if(!empty($member_data->company->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->company->turn_over_id])->toArray();
							
							foreach($master_turn_over as $turn_over_data)
							{
								$fee=$turn_over_data->subscription_amount;
								$turn_over_fee+=$fee;
								$sub_total+=$fee;
							}
						}
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['turn_over_fee'=>$turn_over_fee,'sub_total'=>$sub_total])
						->where(['id' => $last_insert_id])
						->execute();
						$total_tax=0;
						$grand_total+=$sub_total;
						foreach($taxation_rate as $tax_data => $tax_key)
						{
							foreach($tax_key as $tax_value)
							{
								$tax_amount=($sub_total*$tax_value->tax_percentage)/100;
								$total_tax+=$tax_amount;
								$grand_total+=$tax_amount;
								$query = $this->Users->MemberFeeTaxAmounts->query();
								$query->insert(['member_fee_id', 'tax_id', 'tax_percentage', 'amount'])
									->values([
										'member_fee_id' => $last_insert_id,
										'tax_id' => $tax_value->master_taxation_id,
										'tax_percentage' => $tax_value->tax_percentage,
										'amount' => $tax_amount
									])
									->execute();
							}
						}
						$query = $this->Users->MemberFees->query();
						$query->update()
						->set(['tax_amount'=>$total_tax,'grand_total'=>$grand_total])
						->where(['id' => $last_insert_id])
						->execute();
							
						$actual_amount+=$grand_total;	
											
						$query = $this->Users->Companies->CompanyMemberTypes->query();
						$query->update()
						->set(['due_amount'=>$actual_amount])
						->where(['id' => $member_data->company_member_type->id])
						->execute();
						
						
					}
				}
					
				}
				$this->Flash->success(__('Proforma invoice has been edited.'));
				return $this->redirect(['action' => 'PerformaInvoiceReport','member_id'=>$member_id,'send_unsend'=>0,'from'=>' ','to'=>' ','financial_year'=>' ','invoice_receipt_report'=>'invoice_receipt_report']);
				
			}
			
			
		}
	}
	public function MemberPerformaInvoiceView($company_id = null,$company_member_type_id=null){
		$this->viewBuilder()->layout('ajax_layout');
		 
		 $member_data = $this->Users->Companies->get($company_id,
		 ['contain'=>['Users'=>function($q){ 
			return $q->where(['member_nominee_type'=>'first']);
		 },'CompanyMemberTypes'=>function($q) use($company_member_type_id){ 
			return $q->where(['id'=>$company_member_type_id]);
		 }]]);
		
		$this->set('master_member',$member_data);
		$BankDetails=$this->Users->BankDetails->find();
		$this->set('BankDetails',$BankDetails);
		if(!empty($member_data)){
			
			$taxation_rate=$this->Users->MasterTaxations->find()->where(['tax_flag'=>1])->contain(['MasterTaxationRates']);
			
			
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
				$c_year_of_joining=strtotime($from);
				
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
				$c_year_of_joining=strtotime($from);
			}
			
			$sr_no=0;  
			
				$member_id=$member_data->id;
			foreach($member_data->company_member_types as $company_member_type)
			{ 
			
				$fee_already_submited=$this->Users->MemberFees->find()->where(['company_id'=>$member_id,'company_member_type_id'=>$company_member_type_id,'date >='=>$from,'date <='=>$to])->count();
				
				if(empty($fee_already_submited))
				{
					//$year_of_joining=date('Y-m',strtotime($member_data->year_of_joining));
					$year_of_joining=strtotime($member_data->year_of_joining);
					$sr_no++;
	
				if($c_year_of_joining <= $year_of_joining)
				{  
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id])->toArray();
					$this->set('master_membership_fee',$master_membership_fee);
					if(!empty($master_membership_fee)){
						
							
						if(!empty($member_data->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
							
							$this->set('master_turn_over',$master_turn_over);
							
						}
						
							$this->set('taxation_rate',$taxation_rate);
					}
					
					
				}
				else
				{
					
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where(['member_type_id'=>$company_member_type->master_member_type_id,'category_name'=>2])->toArray();
					
					$this->set('master_membership_fee',$master_membership_fee);
					
					if(!empty($master_membership_fee))
					{ 
						
						if(!empty($member_data->turn_over_id))
						{
							
							$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->turn_over_id])->toArray();
						
							$this->set('master_turn_over',$master_turn_over);
							
						}
						
						
						$this->set('taxation_rate',$taxation_rate);
						
					}
				}
					
				}
			}
		 
		}
		$this->set('member_id',$company_id);
		$MasterCompanies=$this->Users->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
	}
	
function convert_number_to_words($no) {
	
	
	 $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
	if($no == 0)
	{
		$words_blank='';
		$this->response->body($words_blank);
		return $this->response;
	}
	else{
		$novalue='';
		$highno=$no;
		$remainno=0;
		$value=100;
		$value1=1000; 
		
			
				while($no>=100){
					if(($value <= $no) &&($no  < $value1)){
					$novalue=$words["$value"];
					$highno = (int)($no/$value);
					$remainno = $no % $value;
					break;
					}
					$value= $value1;
					$value1 = $value * 100;
				}   
				 	
			  if(array_key_exists("$highno",$words))
			  {  
				 // return $words["$highno"]." ".$novalue." ".$this->convert_number_to_words($remainno);
				$this->response->body($words["$highno"]." ".$novalue." ".$this->convert_number_to_words($remainno));
				
				
				return $this->response;
				
			  }				
			  else { 
				 $unit=$highno%10;
				 $ten =(int)($highno/10)*10;            
				 $words=$words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->convert_number_to_words($remainno);
			   
			   }
			   
			}
		$this->response->body($words);
		return $this->response;
	}
	
	public function IdCardReport()
	{
		$this->viewBuilder()->layout('index_layout');
			
			 $user=$this->Users->find()
			->matching('Companies.CompanyMemberTypes',function($q){
				return $q->where(['master_member_type_id'=>1]);
			})
			->order(['Users.member_name ASC']);
			
		$this->set('master_member' ,$user);
		
		$conditions1['master_member_type_id']=1;
		if(isset($this->request->data['member_idcard_send']))
		{ 
			$mail=$this->request->data['mail'];
			//$alternate_email=@$this->request->data['alternate_email_mail'];
		
			if(sizeof($mail)>0){ 
				foreach($mail as $member_email_id)
				{
					$query = $this->Users->query();
					$query->update()
					->set(['id_card_email' => 1])
					->where(['id' => $member_email_id])
					->execute();
				}
			}
			
			
			$mail_Send=$this->request->query['send_unsend'];
			$member_id=$this->request->query['member_id'];
			if(!empty($mail_Send)){
				if($mail_Send!=3){	
				  $conditions['id_card_email']=$mail_Send;
				}
			}
			if(!empty($member_id)){
				$conditions['id']=$member_id;
			}
			
			$member_user = $this->paginate($this->Users->find()->where($conditions)->order(['Users.member_name ASC']));
			
			$this->set(compact('member_user'));
		}
		else if(isset($this->request->query['id_card_report']))
		{
			
			  $mail_Send=$this->request->query['send_unsend']; 
			  $member_id=$this->request->query['member_id'];
			
			if(!empty($member_id)){
				$conditions['id']=$member_id;
			}
			if($mail_Send!=3){	
			  $conditions['id_card_email']=$mail_Send;
			}
		
			$member_user = $this->paginate($this->Users->find()->where($conditions)->order(['Users.member_name ASC']));
			
			$this->set(compact('member_user'));
		}
		else
		{ 
			/* $conditions['id_card_email']=0;
			$member_user = $this->paginate($this->Users->find()->where($conditions)->order(['Users.member_name ASC']));
			$this->set(compact('member_user'));
			 $r=$this->Users->find()
			->matching('Companies.CompanyMemberTypes',function($q){
				return $q->where(['master_member_type_id'=>1]);
			})
			->where($conditions)
			->order(['Users.member_name ASC']); 
			
			$r=$this->Users->Companies->find()
			->matching('CompanyMemberTypes',function($q){
				return $q->where(['master_member_type_id'=>1]);
			})
			->contain(['Users']);
			 */
			
			$conditions['id_card_email']=0;
			
			 $member_user=$this->paginate($this->Users->find()
			->matching('Companies.CompanyMemberTypes',function($q){
				return $q->where(['master_member_type_id'=>1]);
			})
			->where($conditions)
			->order(['Users.member_name ASC']));
			
			$this->set(compact('member_user'));
			
			
		}
	}
	
	
	
	
	public function PerformaInvoiceReport()
	{
		$this->viewBuilder()->layout('index_layout');
				
		//$this->set('master_member' ,$this->Users->find()->select(['id','company_organisation','email'])->where(['member_flag'=>1])->order(['Users.company_organisation'=>'ASC'])->toArray());
		
		
		
		$this->set('master_member',$this->Users->Companies->find()->where([['member_flag'=>1]])->contain(['Users'=>function($q){
			return $q->where(['member_nominee_type'=>'first']);
		},'CompanyMemberTypes'])); 
		
		if(isset($this->request->data['invoice_receipt_send']))
		{ 
			$mail=$this->request->data['mail'];
			$sms=$this->request->data['sms'];
			
			foreach($mail as $performa_id)
			{
				$query = $this->Users->MemberFees->query();
				$query->update()
				->set(['mail_send' => 1])
				->where(['id' => $performa_id])
				->execute();
			}
			$mail_Send=$this->request->query['send_unsend'];
			$member_id=$this->request->query['member_id'];
			
			if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
				$from=date('Y-m-d', strtotime($this->request->query['from']));
				$to=date('Y-m-d', strtotime($this->request->query['to']));
			}else{
				if(date('m') < 4){
					$from=(date('Y')-1).'-4-1';
					$to=date('Y').'-3-31';
				}else{
					$from=date('Y').'-4-1';
					$to=(date('Y')+1).'-3-31';
				}
			}
			$conditions['date >=']=$from;
			$conditions['date <=']=$to;
			$conditions['mail_Send']=$mail_Send;
			if(!empty($member_id)){
				$conditions['company_id']=$member_id;
			}
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
			$this->set(compact('member_fee'));
		}
		else if(isset($this->request->query['invoice_receipt_report']))
		{	
			$mail_Send=$this->request->query['send_unsend'];
			$member_id=$this->request->query['member_id'];
			if(!empty($member_id)){
				$conditions['company_id']=$member_id;
			}
			$from=$this->request->query['from'];
			$to=$this->request->query['to'];
			if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
				$from=date('Y-m-d', strtotime($this->request->query['from']));
				$to=date('Y-m-d', strtotime($this->request->query['to']));
			}else{
				if(date('m') < 4){
					$from=(date('Y')-1).'-4-1';
					$to=date('Y').'-3-31';
				}else{
					$from=date('Y').'-4-1';
					$to=(date('Y')+1).'-3-31';
				}
			}
			$conditions['date >=']=$from;
			$conditions['date <=']=$to;
			if($mail_Send!=3){
				$conditions['mail_Send']=$mail_Send;
			}
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
			
			$this->set(compact('member_fee'));
		}
		else
		{ 
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$conditions['MemberFees.date >=']=$from;
			$conditions['MemberFees.date <=']=$to;
			$conditions['mail_Send']=0;
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
			$this->set(compact('member_fee'));
		}
	}
	public function PerformaInvoiceReminder()
	{
		$this->viewBuilder()->layout('index_layout');
				
		//$this->set('master_member' ,$this->Users->find()->select(['id','company_organisation','email'])->where(['member_flag'=>1])->order(['Users.company_organisation'=>'ASC'])->toArray());
		
		$this->set('master_member',$this->Users->Companies->find()->where([['member_flag'=>1]])->contain(['Users'=>function($q){
			return $q->where(['member_nominee_type'=>'first']);
		},'CompanyMemberTypes'])); 
		
		
		$conditions['invoice_no']=0;
		if(isset($this->request->data['invoice_receipt_send']))
		{ 
			$mail=$this->request->data['mail'];
			$sms=$this->request->data['sms'];
			
			foreach($mail as $performa_id)
			{
				$query = $this->Users->MemberFees->query();
				$query->update()
				->set(['reminder_mail' => 1])
				->where(['id' => $performa_id])
				->execute();
			}
			$mail_Send=$this->request->query['send_unsend'];
			$member_id=$this->request->query['member_id'];
			
			if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
				$from=date('Y-m-d', strtotime($this->request->query['from']));
				$to=date('Y-m-d', strtotime($this->request->query['to']));
			}else{
				if(date('m') < 4){
					$from=(date('Y')-1).'-4-1';
					$to=date('Y').'-3-31';
				}else{
					$from=date('Y').'-4-1';
					$to=(date('Y')+1).'-3-31';
				}
			}
			$conditions['date >=']=$from;
			$conditions['date <=']=$to;
			$conditions['reminder_mail']=$mail_Send;
			if(!empty($member_id)){
				$conditions['company_id']=$member_id;
			}
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
			$this->set(compact('member_fee'));
		}
		else if(isset($this->request->query['invoice_receipt_report']))
		{	
			$mail_Send=$this->request->query['send_unsend'];
			$member_id=$this->request->query['member_id'];
			if(!empty($member_id)){
				$conditions['company_id']=$member_id;
			}
			$from=$this->request->query['from'];
			$to=$this->request->query['to'];
			if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
				$from=date('Y-m-d', strtotime($this->request->query['from']));
				$to=date('Y-m-d', strtotime($this->request->query['to']));
			}else{
				if(date('m') < 4){
					$from=(date('Y')-1).'-4-1';
					$to=date('Y').'-3-31';
				}else{
					$from=date('Y').'-4-1';
					$to=(date('Y')+1).'-3-31';
				}
			}
			$conditions['date >=']=$from;
			$conditions['date <=']=$to;
			
			if($mail_Send!=3){
				$conditions['reminder_mail']=$mail_Send;
			}
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
		
			$this->set(compact('member_fee'));
		}
		else
		{ 
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$conditions['MemberFees.date >=']=$from;
			$conditions['MemberFees.date <=']=$to;
			$conditions['reminder_mail']=0;
			
			$member_fee = $this->paginate($this->Users->MemberFees->find()->where($conditions)->order(['MemberFees.date DESC']));
			$this->set(compact('member_fee'));
		}
	}
	public function login()
	{
		$this->viewBuilder()->layout('login_layout');
		if ($this->request->is('post')) {
			
			$user = $this->Auth->identify();
			
			if ($user) {

				$this->Auth->setUser($user);
				return $this->redirect(['action' => 'index']);
			}
			
			$this->Flash->error('Your username or password is incorrect.');
		}
	}
	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}
	/*public function authentication()
	{
		
		$user_id=$this->Auth->User('id');
		$conditions=array("user_id"=>$user_id);
		$result = $this->Users->find('all',array('fields'=>array('username'),'conditions'=>$conditions))->toArray();
		if(empty($user_id))
		{
		$this->request->session()->destroy();
		$this->redirect(['Controller' => 'Users' , 'action' => 'login']);
		}
		$this->response->body($result);
		return $this->response;
	}*/
	
	public function UserRights()
	{
		$company_id=$this->Auth->User('company_id');
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		$Companies=$this->Users->Companies->get($company_id);
		$role_id=$Companies->role_id;
		$conditions=array("user_id" => $user_id);
		$fetch_user_right1='';
		$fetch_user_right2='';
		
		$fetch_user_rights = $this->Users->Companies->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_rights as $data){
			$fetch_user_right1 = $data->module_id;
		}
		$conditions=array("role_id" => $role_id);
				
		$fetch_user_roles = $this->Users->Companies->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_roles as $data2){
			$fetch_user_right2 = $data2->module_id;
		}
		$fetch_user_right1_array = explode(',',$fetch_user_right1);
		$fetch_user_right2_array = explode(',',$fetch_user_right2);
		$fetch_user_right_array = array_merge($fetch_user_right1_array,$fetch_user_right2_array);
		$fetch_user_right_array = array_unique($fetch_user_right_array);
		$fetch_user_right = implode(',',$fetch_user_right_array);
		$this->response->body($fetch_user_right);
		return $this->response;
	}
	public function menu()
	{
		$user_id=$this->Auth->User('id');
		
		$fetch_menu = $this->Users->Modules->find()->order(['preferance'=>'ASC'])->toArray();
		
		$this->response->body($fetch_menu);
		return $this->response;
	}
	
	public function MenuSubmenu($main_menu)
	{
		$user_id=$this->Auth->User('id');
		$conditions=array("main_menu" => $main_menu);
		
		$fetch_menu_submenu = $this->Users->Modules->find()->where($conditions)->toArray();
		
		$this->response->body($fetch_menu_submenu);
		return $this->response;
	}
	public function submenu($sub_menu)
	{ 
		$user_id=$this->Auth->User('id');
		$conditions=array("sub_menu" => $sub_menu);
		$fetch_submenu = $this->Users->Modules->find()->where($conditions)->toArray();
		$this->response->body($fetch_submenu);
		return $this->response;
	}
	public function PerformaInvoicePdf(){
		$this->viewBuilder()->layout('ajax_layout');
		if(isset($this->request->data['view_performa']))
		{
			$performa_invoice_no = $this->request->data['view_performa'];
			$master_member=$this->Users->MemberFees->find()->where(['performa_invoice_no'=>$performa_invoice_no])->contain(['Users'=> function($q){
				return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'])->where(['member_flag'=>1]);
			},'MemberFeeTaxAmounts'=>['MasterTaxations']])->toArray();
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$c_year_of_joining=strtotime($from);
			if(!empty($master_member)){
				
				foreach($master_member as $member_data)
				{
					//$year_of_joining=date('Y',strtotime($member_data->user->year_of_joining));
					$year_of_joining=strtotime($member_data->user->year_of_joining);
					if($c_year_of_joining <= $year_of_joining)
					{
						$condition_master_mebership=array('member_type_id'=>$member_data->user->member_type_id);
					}else{
						$condition_master_mebership=array('member_type_id'=>$member_data->user->member_type_id,'category_name'=>2);
					}
										
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where($condition_master_mebership)->toArray();
					
					$this->set('master_membership_fee',$master_membership_fee);
					
					
						if(!empty($master_membership_fee))
						{
							if(!empty($member_data->user->turn_over_id))
							{
								
								$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->user->turn_over_id])->toArray();
								
								$this->set('master_turn_over',$master_turn_over);
							}
						}
				}
			}
			$this->set('master_member',$master_member);
			$MasterCompanies=$this->Users->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
			$BankDetails=$this->Users->BankDetails->find();
			$this->set('BankDetails',$BankDetails);
		}
		
	}
	
	public function PerformaInvoiceNewPdf()
	{
		$this->viewBuilder()->layout('ajax_layout');
		if(isset($this->request->data['view_performa']))
		{
			$performa_invoice_no = $this->request->data['view_performa'];
			
			
			/* $master_member=$this->Users->MemberFees->find()->where(['performa_invoice_no'=>$performa_invoice_no])->contain(['Users'=> function($q){
				return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode','gst_number'])->where(['member_flag'=>1]);
			},'MemberFeeTaxAmounts'=>['MasterTaxations']])->toArray();
			 */
			 
			$master_member=$this->Users->MemberFees->find()->where(['performa_invoice_no'=>$performa_invoice_no])->contain(['CompanyMemberTypes','Companies'=>function($q){
				return $q->where(['member_flag'=>1])->contain(['Users'=>function($q){
				return $q->where(['member_nominee_type'=>'first']);
				}]);
			},'MemberFeeTaxAmounts'=>['MasterTaxations']])->toArray();
			
		
			//pr($master_member); exit;
			
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
			}
			$c_year_of_joining=strtotime($from);
			if(!empty($master_member)){
				
				foreach($master_member as $member_data)
				{
					//pr();exit;
					//$year_of_joining=date('Y',strtotime($member_data->user->year_of_joining));
					$year_of_joining=strtotime($member_data->company->year_of_joining);
					if($c_year_of_joining <= $year_of_joining)
					{
						$condition_master_mebership=array('member_type_id'=>$member_data->company_member_type->master_member_type_id);
					}else{
						$condition_master_mebership=array('member_type_id'=>$member_data->company_member_type->master_member_type_id,'category_name'=>2);
					}
										
					$master_membership_fee=$this->Users->MasterMembershipFees->find()->where($condition_master_mebership)->toArray();
					
					$this->set('master_membership_fee',$master_membership_fee);
					
					
						if(!empty($master_membership_fee))
						{
							if(!empty($member_data->company->turn_over_id))
							{
								
								$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$member_data->company->turn_over_id])->toArray();
								
								$this->set('master_turn_over',$master_turn_over);
							}
						}
				}
				
			}
			$this->set('master_member',$master_member);
			$MasterCompanies=$this->Users->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
			$BankDetails=$this->Users->BankDetails->find();
			$this->set('BankDetails',$BankDetails);
		}
	}
	
	public function InvoiceDueReport()
	{
		$this->viewBuilder()->layout('index_layout');
		
			$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->Users->newEntity();
		$this->set('master_members',$this->Users->Companies->find()->order(['Companies.company_organisation ASC'])->toArray());
		$this->set('member_type',$this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
		$this->set('fetch_master_classification' , $this->Users->MasterClassifications->find()->toArray());
		$this->set('master_user',$master_user);
		if(isset($this->request->query['member_report'])){
			 $conditions = array();
			 $member_id = $this->request->query['member_id'];
			 $grade = $this->request->query['grade'];
			 $category = $this->request->query['category'];
			 $member_type_id = $this->request->query['member_type_id'];
			 $classification_id = $this->request->query['classification_id'];
			 $conditions['Companies.due_amount >']=0;
			 $conditions1['CompanyMemberTypes.master_member_type_id']='1';
			if(!empty($member_id)){
				$conditions['Companies.id']=$member_id;
			}
			if(!empty($grade)){
				$conditions['Companies.grade']=$grade;	
			}
			if(!empty($category)){
				$conditions['Companies.category']=$category;
			} 
			if(!empty($member_type_id)){
				$conditions1['CompanyMemberTypes.master_member_type_id']=$member_type_id;
			}
			if(!empty($classification_id)){
				$conditions['Companies.classification']=$classification_id;
			}
			$master_member = $this->paginate($this->Users->Companies->find()
			->where($conditions)
			->contain(['Users','CompanyMemberTypes'=>function($q) use($conditions1){
				return $q->where($conditions1);
			}])
			->order(['Companies.company_organisation ASC']));
			
			//pr($master_member); exit;
			$this->set(compact('master_member'));
			
			
		}else{
			$master_member = $this->paginate($this->Users->Companies->find()
			->where(['due_amount >'=>0])
			->contain(['Users','CompanyMemberTypes'=>function($q){
				return $q->where(['master_member_type_id'=>1]);
			}])
			->order(['Companies.company_organisation ASC']));
			
			$this->set(compact('master_member'));
		}
		
	}
	public function InvoiceReceivedReport()
	{
		$this->viewBuilder()->layout('index_layout');
		
			$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$master_user=$this->Users->newEntity();
		$this->set('master_members',$this->Users->Companies->find()->order(['Companies.company_organisation ASC'])->toArray());
		$this->set('member_type',$this->Users->MasterMemberTypes->find()->toArray());
		$this->set('fetch_master_grade' , $this->Users->MasterGrades->find()->toArray());
		$this->set('fetch_master_category' , $this->Users->MasterCategories->find()->toArray());
		$this->set('fetch_master_classification' , $this->Users->MasterClassifications->find()->toArray());
		$this->set('master_user',$master_user);
		if(isset($this->request->query['member_report'])){
			 $conditions = array();
			 $member_id = $this->request->query['member_id'];
			 $grade = $this->request->query['grade'];
			 $category = $this->request->query['category'];
			 $member_type_id = $this->request->query['member_type_id'];
			 $classification_id = $this->request->query['classification_id'];
			 $conditions['Companies.due_amount <=']=0;
			 $conditions1['CompanyMemberTypes.master_member_type_id']='1';
			if(!empty($member_id)){
				$conditions['Companies.id']=$member_id;
			}
			if(!empty($grade)){
				$conditions['Companies.grade']=$grade;	
			}
			if(!empty($category)){
				$conditions['Companies.category']=$category;
			}
			if(!empty($member_type_id)){
				$conditions1['CompanyMemberTypes.master_member_type_id']=$member_type_id;
			}
			if(!empty($classification_id)){
				$conditions['Companies.classification']=$classification_id;
			}
			
			
			/* $master_member = $this->paginate($this->Users->find()->where($conditions)->order(['Users.company_organisation ASC'])->contain(['MemberFees'=>['MemberReceipts'=>function($q){
				return $q->select(['member_fee_id','total'=>$q->func()->sum('amount')])->group(['member_fee_id']);
			}]]));
			 */
			/* $master_member = $this->paginate($this->Users->Companies->find()
			->where($conditions)
			->contain(['Users','CompanyMemberTypes'=>function($q) use($conditions1){
				return $q->where($conditions1);
			}])
			->order(['Companies.company_organisation ASC'])
			); */
			
		/* 	$master_member = $this->Users->Companies->find()
			->where($conditions);
			$master_member->select(['total' =>$master_member->func()->sum('MemberReceipts.amount')])
			->group(['company_id'])
			->where(['receipt_type'=>'member_receipt'])
			->contain(['Users','CompanyMemberTypes'=>function($q) use($conditions1) {
				return  $q->where($conditions1);
			}])
			->innerJoinWith('MemberReceipts')
			->autoFields(true)
			->order(['Companies.company_organisation ASC']);
			 */
			$master_member = $this->Users->Companies->find()
			->where($conditions);
			$master_member->select(['total' =>$master_member->func()->sum('MemberReceipts.amount')])
			->where(['receipt_type'=>'member_receipt'])
			->contain(['Users'])
			->innerJoinWith('MemberReceipts')
			->matching('CompanyMemberTypes', function ($q) use($conditions1){
				return  $q->where($conditions1);
			})
			->group(['MemberReceipts.company_id'])
			->autoFields(true)
			->order(['Companies.company_organisation ASC']);
			
			
			$this->set(compact('master_member'));
			
			
		}else{
			
			$master_member = $this->Users->Companies->find()
			->where(['due_amount <='=>0]);
			$master_member->select(['total' =>$master_member->func()->sum('MemberReceipts.amount')])
			->group(['MemberReceipts.company_id'])
			->where(['receipt_type'=>'member_receipt'])
			->contain(['Users','CompanyMemberTypes'=>function($q) {
				return $q->where(['master_member_type_id'=>1]);
			}])
			->innerJoinWith('MemberReceipts')
			->autoFields(true)
			->order(['Companies.company_organisation ASC']);
			
			
			
			$master_member=$this->paginate($master_member);
			
			$this->set(compact('master_member'));
		}
		
	}
	public function invoiceDueExport() {
		
		$master_member = $this->Users->Companies->find()
			->where(['due_amount >'=>0])
			->contain(['MasterCategories','Users','CompanyMemberTypes'=>function($q){
				return $q->where(['master_member_type_id'=>1]);
			}])
			->order(['Companies.company_organisation ASC']);
			
		$sr_no=0;
		$_header=['S.No.', 'Company/Organisation', 'Member Name', 'Alternate Nominee', 'Category', 'Address', 'City','E-mail', 'Mobile No.', 'Alternate Mobile No', 'Due Amount'];
		foreach($master_member as $data) 
		{	
			$contain[]=[ ++$sr_no, $data->company_organisation, $data->users[0]->member_name, $data->users[0]->alternate_nominee, $data->master_category->category_name, $data->address, $data->city, $data->users[0]->email, $data->users[0]->mobile_no, $data->users[1]->alternate_mobile_no, $data->due_amount ];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Invoice due report.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
		
	}
	public function invoiceReceivedExport() {
		
		/* $master_member = $this->Users->find()->order(['Users.company_organisation ASC'])->where(['due_amount <='=>0,'member_type_id'=>'1'])->contain(['MasterCategories','MemberFees'=>['MemberReceipts'=>function($q){
				return $q->select(['member_fee_id','total'=>$q->func()->sum('amount')])->group(['member_fee_id']);
			}]]); */
			
			$master_member = $this->Users->Companies->find()
			->where(['due_amount <='=>0]);
			$master_member->select(['total' =>$master_member->func()->sum('MemberReceipts.amount')])
			->group(['company_id'])
			->where(['receipt_type'=>'member_receipt'])
			->contain(['MasterCategories','Users','CompanyMemberTypes'=>function($q) {
				return $q->where(['master_member_type_id'=>1]);
			}])
			->innerJoinWith('MemberReceipts')
			->autoFields(true)
			->order(['Companies.company_organisation ASC']);
			
			
			
		$sr_no=0;
		$_header=['S.No.', 'Company/Organisation', 'Member Name', 'Alternate Nominee', 'Category', 'Address', 'City','E-mail', 'Mobile No.', 'Alternate Mobile No','Amount Paid'];
		foreach($master_member as $data) 
		{	
			
			$contain[]=[ ++$sr_no, $data->company_organisation, $data->users[0]->member_name, $data->users[1]->member_name, $data->master_category->category_name, $data->address, $data->city, $data->users[0]->email, $data->users[0]->mobile_no, $data->users[1]->mobile_no,$data->total];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Invoice Payment Received report.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
		
	}
	function FetchMasterMembershipFees($condition_master_mebership=Null)
	{
		$master_membership_fee=$this->Users->MasterMembershipFees->find()->where($condition_master_mebership)->toArray();
		$this->response->body($master_membership_fee);
		return $this->response;
	}
	function FetchMasterTurnOvers($id=Null)
	{
		$master_turn_over=$this->Users->MasterTurnOvers->find()->where(['id'=>$id])->toArray();
		$this->response->body($master_turn_over);
		return $this->response;
	}
	function UpdateInvoiceMail($id=Null,$mail_send=Null)
	{
		$query = $this->Users->MemberFees->query();
		$query->update()
		->set(['mail_send' => $mail_send])
		->where(['id' => $id])
		->execute();
		$this->response->body('Ok');
		return $this->response;
	}
	function UpdateInvoiceReminderMail($id=Null,$mail_send=Null)
	{
		$query = $this->Users->MemberFees->query();
		$query->update()
		->set(['reminder_mail' => $mail_send])
		->where(['id' => $id])
		->execute();
		$this->response->body('Ok');
		return $this->response;
	}
	
	public function PerformaInvoiceMailSms()
	{
		$this->viewBuilder()->layout('Email/text/default');
		/* $master_member=$this->Users->MemberFees->find()->where(['mail_send'=>1,'invoice_no'=>0])->contain(['Users'=> function($q){
			return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'])->where(['member_flag'=>1]);
		},'MemberFeeTaxAmounts'=>['MasterTaxations']])->limit(15)->toArray();
		 */
		
		$master_member=$this->Users->MemberFees->find()->where(['mail_send'=>1,'invoice_no'=>0])->contain(['CompanyMemberTypes','Companies'=>function($q){
				return $q->where(['member_flag'=>1])->contain(['Users'=>function($q){
				return $q->where(['member_nominee_type'=>'first']);
				}]);
			},'MemberFeeTaxAmounts'=>['MasterTaxations']])->limit(15)->toArray();
			
			
		
		
		if(!empty($master_member))
		{
			$this->set('master_member',$master_member);
			$MasterCompanies=$this->Users->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
			$BankDetails=$this->Users->BankDetails->find();
			$this->set('BankDetails',$BankDetails);
		}
	}
	public function PerformaInvoiceReminderMail()
	{
		$this->viewBuilder()->layout('Email/text/default');
		$master_member=$this->Users->MemberFees->find()->where(['reminder_mail'=>1,'invoice_no'=>0])->contain(['Users'=> function($q){
			return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'])->where(['member_flag'=>1]);
		},'MemberFeeTaxAmounts'=>['MasterTaxations']])->limit(15)->toArray();
		
		if(!empty($master_member))
		{
			$this->set('master_member',$master_member);
			$MasterCompanies=$this->Users->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
			$BankDetails=$this->Users->BankDetails->find();
			$this->set('BankDetails',$BankDetails);
		}
	}	
	public function AdminChangePassword(){
		$this->viewBuilder()->layout('index_layout');
		$password = $this->Users->newEntity();
		$fetch_login = $this->Users->find()->toArray();
	      if($this->request->is('post')){
			$user_id=$this->request->data['user_id'];
			$this->request->data['id']=$user_id;
            $password = $this->Users->patchEntity($password, $this->request->data);
            if ($this->Users->save($password)) {
                $this->Flash->success(__('Account has been updated.'));
                return $this->redirect(['action' => 'admin_change_password']);
            }
            $this->Flash->error(__('Unable to update account.'));

		  }
		$this->set('fetch_login', $fetch_login);
	    $this->set('password',$password);
	}
	////////////////  Forget Password  ////////////////////////////
	public function forgotPassword()
    {
		$this->viewBuilder()->layout('login_layout');
        if ($this->request->is('post')) {
			
            $query = $this->Users->findByEmail($this->request->data['email']);
            $user = $query->first();
			
            if (is_null($user)) {
                $this->Flash->error('Email address does not exist. Please try again');
            } else {
				
                $passkey = uniqid();
                $url = Router::Url(['controller' => 'users', 'action' => 'reset_password'], true) . '/' . $passkey;
				
                $timeout = time() + DAY;
				
                 if ($this->Users->updateAll(['passkey' => $passkey, 'timeout' => $timeout], ['id' => $user->id])){
					
                    $this->sendResetEmail($url, $user);
					
                    $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error('Error saving reset passkey/timeout');
                }
            }
        }
    }

    private function sendResetEmail($url, $user) {
		
			$email = new Email();
			$email->transport('SendGrid');
			$email->profile('default')
			->template('resetpw')
			->emailFormat('html');

			$email->from(['ucciudaipur@gmail.com' => 'UCCI'])
			->to($user->email, $user->member_name)
			->subject('UCCI - Reset your password')
			->viewVars(['url' => $url, 'email' => $user->email]);

     if ($email->send()) {
		  
            $this->Flash->success(__('Check your email for your reset password link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }  
      
    }

    public function resetPassword($passkey = null) {
		$this->viewBuilder()->layout('login_layout');
        if ($passkey) {
            $query = $this->Users->find('all', ['conditions' => ['passkey' => $passkey, 'timeout >' => time()]]);
            $user = $query->first();
			
			
            if ($user) {
                if (!empty($this->request->data)) {
                    // Clear passkey and timeout
                    $this->request->data['passkey'] = null;
                    $this->request->data['timeout'] = null;
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if ($this->Users->save($user)) {
                        //$this->Flash->success(__('Your password has been updated.'));
                        $this->Auth->setUser($user);
						return $this->redirect(['controller'=>'Users','action' => 'index']);
						
                    } else {
                        $this->Flash->error(__('The password could not be updated. Please, try again.'));
                    }
                }
            } else {
                $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
                $this->redirect(['action' => 'forgot_password']);
            }
            unset($user->password);
            $this->set(compact('user'));
        } else {
            $this->redirect('/');
        }
    }
	
}

?>
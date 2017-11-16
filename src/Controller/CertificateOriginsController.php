<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use UsersController;
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

class CertificateOriginsController extends AppController 
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index','CooSendEmail','cooApproved']);
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

	function CooUpdate($id=Null,$status=Null)
	{
		$query = $this->CertificateOrigins->CooEmailApprovals->query();
		$query->update()
		->set(['status' => $status])
		->where(['id' => $id])
		->execute();
		exit;
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
	
	
	
	public function CertificateOriginViewList() 
	{
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->CertificateOrigins->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
		
		 if($role_id==1 or $role_id==4 ){
			 $certificate_origins = $this->CertificateOrigins->find()->where(['status'=>'approved'])->order(['CertificateOrigins.origin_no'=>'DESC']);
		   }else{
			  $certificate_origins = $this->CertificateOrigins->find()->where(['status'=>'approved','company_id'=>$company_id])->order(['CertificateOrigins.origin_no'=>'DESC']); 
		   }  
       $this->set(compact('certificate_origins','role_id'));
	}
	
	
	
	
	public function CertificateOriginViewListexcel() 
	{
		
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->CertificateOrigins->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
		
		 if($role_id==1 or $role_id==4 ){
			 $certificate_origins = $this->CertificateOrigins->find()->where(['status'=>'approved'])->order(['CertificateOrigins.origin_no'=>'DESC']);
		   }else{
			  $certificate_origins = $this->CertificateOrigins->find()->where(['status'=>'approved','company_id'=>$company_id])->order(['CertificateOrigins.origin_no'=>'DESC']); 
		   }  
       $this->set(compact('certificate_origins','role_id'));
	
		
			
			
			
		$sr_no=0;
		$_header=['S.No.', 'Exporter', 'Origin No', 'Date', 'Consignee', 'Invoice No.', 'Invoice Date','Manufacturer', 'Despatched by'];
		foreach($certificate_origins as $certificate_origin) 
		{	
			if($certificate_origin->despatched_by==0){ 
			$despatched_by='Sea'; 
			}else if( $certificate_origin->despatched_by==1 ){
				$despatched_by= 'Air'; 
			}
			else{ 
				$despatched_by= 'Road';
			} 
			$contain[]=[ ++$sr_no, $certificate_origin->exporter, $certificate_origin->origin_no, $certificate_origin->date_current, $certificate_origin->consignee, $certificate_origin->invoice_no, date('d-m-Y', strtotime($certificate_origin->invoice_date)), $certificate_origin->manufacturer, 
			$despatched_by ];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Coo View List.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
	
	
	
	
	
	
	
	}
	
	
	
	
	public function certificateOriginView()
    {
		$this->viewBuilder()->layout('index_layout');
		$certificate_origin_id=$this->request->data['view'];
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'status'=>'approved'])->contain(['Users','CertificateOriginGoods'])->toArray();
		
		$this->set(compact('certificate_origins'));
    }
	public function CertificateOriginApprove()
    {
       $this->viewBuilder()->layout('index_layout');
       $certificate_origins = $this->CertificateOrigins->find()->where(['payment_status'=>'success','status'=>'verified']);
       $this->set(compact('certificate_origins'));
		
    }
	 
	public function CertificateOriginApproveView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
	  
		if(isset($this->request->data['view']))
		{ 
			$certificate_origin_id=$this->request->data['view'];;
			$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'status'=>'verified'])->contain(['Companies','CertificateOriginGoods'])->toArray();
			
			
			$verify_bys=$certificate_origins[0]->verify_by; 
			$Users_verifys=$this->CertificateOrigins->Companies->Users->get($verify_bys);
			$verify_member=$Users_verifys->member_name; 
			$company_id=$certificate_origins[0]->company_id; 
			$DocumentCheck=$this->CertificateOrigins->Companies->find()
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('certificate_origins','DocumentCheck','verify_member'));
		}
		
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['certificate_approve_submit']))
			{
				 
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['certificate_approve_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['Companies'=>['Users']]]);
				$consignee=$CertificateOrigins->consignee;
				$this->request->data['status']='approved';
				//$this->request->data['approve']=1;
				$this->request->data['approved_by']=$user_id; 
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']=''; 
				
				$coo_verification_code=uniqid(); 
				$this->request->data['coo_verification_code']=$coo_verification_code; 
				
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$query = $this->CertificateOrigins->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				 $email_to=$CertificateOrigins->company->users[0]->email; 
				 $member_name=$CertificateOrigins->company->users[0]->member_name;
				 
				 $Users= $this->CertificateOrigins->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				 
				
				//pr($CertificateOrigins); exit;
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					
					  $sub="Your certificate of origin is approved";
					  $from_name="UCCI";
					  $email_to=trim($email_to,' ');
					 $email_to="rohitkumarjoshi43@gmail.com";
					  if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'consignee'=>$consignee]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Certificate of origin has been approved.'));
					return $this->redirect(['action' => 'certificate_origin_approve']);
				}
				$this->Flash->error(__('Unable to approved certificate of origin.'));
			}
			else if(isset($this->request->data['certificate_notapprove_submit']))
			{
				
				$id=$this->request->data['certificate_notapprove_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id);
				
				//$this->request->data['id']=$this->request->data['certificate_notapprove_submit'];
				$this->request->data['approve']=2;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					$this->Flash->success(__('Certificate of origin has been not approved.'));
					return $this->redirect(['action' => 'certificate_origin_approve']);
				}
				$this->Flash->error(__('Unable to not approved certificate of origin.'));
			}
		}
		
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('CertificateOrigins'));
		 
    }
	
	public function paymentTest($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->CertificateOrigins->Users->get($user_id);
		//$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['CertificateOriginGoods']]);
		
			$sul='http://localhost/ucci/certificate-origins/success';
			$furl='http://localhost/ucci/certificate-origins/failure';
			
			//$sul='http://ucciudaipur.com/app/certificate-origins/success';
			//$furl='http://ucciudaipur.com/app/certificate-origins/failure';
			
			//$sul='http://ucciudaipur.com/uccinew/certificate-origins/success';
			//$furl='http://ucciudaipur.com/uccinew/certificate-origins/failure';
			
			
			$CertificateOrigins = $this->CertificateOrigins->find()
			->where(['CertificateOrigins.id'=>$id]);
			$CertificateOrigins->select(['total' =>$CertificateOrigins->func()->sum('CertificateOriginGoods.value')])
			->group(['certificate_origin_id'])
			->innerJoinWith('CertificateOriginGoods')
			->autoFields(true);
			
		$this->set(compact('Users','CertificateOrigins','id','txnid','sul','furl'));
	}
	
	
	
	public function payment($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->CertificateOrigins->Users->get($user_id);
		//$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['CertificateOriginGoods']]);
		
			//$sul='http://localhost/ucci/certificate-origins/success';
			//$furl='http://localhost/ucci/certificate-origins/failure';
			
			$sul='http://ucciudaipur.com/app/certificate-origins/success';
			$furl='http://ucciudaipur.com/app/certificate-origins/failure';
			
			
			$CertificateOrigins = $this->CertificateOrigins->find()
			->where(['CertificateOrigins.id'=>$id]);
			$CertificateOrigins->select(['total' =>$CertificateOrigins->func()->sum('CertificateOriginGoods.value')])
			->group(['certificate_origin_id'])
			->innerJoinWith('CertificateOriginGoods')
			->autoFields(true);
			
		$this->set(compact('Users','CertificateOrigins','id','txnid','sul','furl'));
	}
 
	public function success()
    {
		$this->viewBuilder()->layout('index_layout');
		$status=$this->request->data["status"];
		$amount=$this->request->data["amount"];
		$txnid=$this->request->data["txnid"];
		$hash=$this->request->data["hash"];
		$key=$this->request->data["key"];
		$udf1=$this->request->data["udf1"];
		$productinfo=$this->request->data["productinfo"];
		$email=$this->request->data["email"];
		$query = $this->CertificateOrigins->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status,'status'=>'published'])
		->where(['id' => $udf1])
		->execute();
		 $this->set(compact('status','amount','id','txnid','sul'));	
		
	// mail should secretary 
	
		//$companies= $this->CertificateOrigins->Companies->find()->where(['id'=>$udf1]);
		/*  $email = new Email();
		 $email->transport('SendGrid');
		$sub='Secretary';
		$sendmails= $this->CertificateOrigins->Companies->find()->where(['role_id'=>1 ])->orwhere(['role_id'=>4])->contain(['Users']);
		foreach($sendmails as $sendmail){
			  
			foreach($sendmail->users as $sendmai){
				$mailsend=$sendmai['email'];
				$name=$sendmai['member_name'];
				$from_name='UCCI';
				  try {
					  $email->from(['ucciudaipur@gmail.com' => $from_name])
					  ->to($mailsend)
					  ->replyTo('uccisec@hotmail.com')
					  ->subject($sub)
					  ->profile('default')
					  ->template('coo_secretary_email')
					  ->emailFormat('html')
					  ->viewVars(['member_name'=>$name]);
					  
						$email->send();
					 
					 
					 
				   } catch (Exception $e) {
					
					echo 'Exception : ',  $e->getMessage(), "\n";

				   }
				
			}
		} */
		 
		 
		 
		 // Mail should Member with receipt attachment
		 
		 
		 $CertificateOrigins=$this->CertificateOrigins->get($udf1);
		 
		 
		 $company_id_coo=$CertificateOrigins->company_id; 
		 $coo_email=$CertificateOrigins->coo_email;
		 $payment_amount=$CertificateOrigins->payment_amount;
		 $payment_tax_amount=$CertificateOrigins->payment_tax_amount;
	if($coo_email=='yes'){
		 
		  $Companies_data=$this->CertificateOrigins->Companies->get($company_id_coo,['contain'=>'Users']);
		
		 $member_name=$Companies_data->users[0]->member_name;
		 $email_to=$Companies_data->users[0]->email;
		 
		 $MasterTaxations= $this->CertificateOrigins->MasterTaxations->find()->where(['tax_flag'=>1,'nmef'=>1])->contain(['MasterTaxationRates'])->toArray();
		 
			$MemberReceipts=$this->CertificateOrigins->MemberReceipts->newEntity();

			$GeneralReceiptPurposes=$this->CertificateOrigins->MemberReceipts->GeneralReceiptPurposes->newEntity();
				
				$fetch_member_receipt=$this->CertificateOrigins->MemberReceipts->find('all')->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
				if(!empty($fetch_member_receipt)){
					$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
				}else{
					$receipt_no='0001';
				}
				$amount=$payment_amount+$payment_tax_amount;
				$act_amount=$amount;
				$this->request->data['amount_type']='Payumoney';
				$this->request->data['narration']='Certificate of Origin';
				$this->request->data['tax_applicable']='Tax';
				$this->request->data['basic_amount']=@$payment_amount;
				$this->request->data['taxamount']=@$payment_tax_amount;
				$this->request->data['amount']=@$amount;
				$this->request->data['company_id']=$company_id_coo;
				$this->request->data['receipt_type']='general_receipt';
				$this->request->data['receipt_no']=@$receipt_no;
				$this->request->data['date_current']=date("Y-m-d");
				
				$this->request->data['general_receipt_purposes']=array();
				$this->request->data['tax_amounts']=array();
		
				
				$MemberReceipts = $this->CertificateOrigins->MemberReceipts->patchEntity($MemberReceipts, $this->request->data);
				
				$GeneralReceiptPurposes->purpose_id=12;
				$GeneralReceiptPurposes->quantity=1;
				$GeneralReceiptPurposes->amount=$payment_amount;
				$GeneralReceiptPurposes->total=$payment_amount;
				$MemberReceipts->general_receipt_purposes[0]=$GeneralReceiptPurposes;
				
				$i=0;
				foreach($MasterTaxations as $co_tax_amount){
					    $total=0;
						$TaxAmounts=$this->CertificateOrigins->MemberReceipts->TaxAmounts->newEntity();
						$tax_id=$co_tax_amount->tax_id;
						$tax_percentage=$co_tax_amount->master_taxation_rates[0]->tax_percentage;
						$total=$payment_amount*$tax_percentage/100;
						$amount=$total;
					
						$TaxAmounts->tax_id=$tax_id;
						$TaxAmounts->tax_percentage=$tax_percentage;
						$TaxAmounts->amount=$amount;
						$MemberReceipts->tax_amounts[$i]=$TaxAmounts;
					$i++;
				}
				
				
				//pr($MemberReceipts); $data_save->receipt_id
				
				$data_save=$this->CertificateOrigins->MemberReceipts->save($MemberReceipts);

				//pr($data_save); 
				//	$receipt_id=1872;

		 	    $options = new Options();
				$options->set('defaultFont', 'Lato-Hairline');
				$dompdf = new Dompdf($options);
				$dompdf = new Dompdf();
		
				$master_member_receipt=$this->CertificateOrigins->MemberReceipts->find()->where(['receipt_id'=> $data_save->receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
				return $q->select(['id','company_organisation','city']);
				},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();

				$MasterCompanies=$this->CertificateOrigins->MemberReceipts->MasterCompanies->find();
				//pr($master_member_receipt);
	foreach($master_member_receipt as $data){			
					$receipt_no = $data->receipt_no; 
					$amount_type = $data->amount_type;
					$cheque_no = $data->cheque_no;
					$bank_id = $data->bank_id;
					$cheque_date = $data->cheque_date;
					$drawn_bank = $data->drawn_bank;
					$narration = $data->narration;	
					$taxamount=$data->taxamount;
					$tds_amount = $data->tds_amount;	
					if(date('m',strtotime($data->date_current)) < 4){
					$from_year=(date('y',strtotime($data->date_current))-1);
					$to_year=date('y',strtotime($data->date_current));
					}else{
						$from_year=date('y',strtotime($data->date_current));
						$to_year=(date('y',strtotime($data->date_current))+1);
					}
			if($taxamount != 0)
			{
				$typeee=1;
			}
			foreach($data->general_receipt_purposes as $purpose)
			{
				$purpose_name[]=$purpose->master_purpose->purpose_name;
			}
			$word_value=explode('.',$data->amount);
			
			
			
			$html='<html>
		<head>
		 <style>
		  @page { margin: 40px 20px 20px 20px; }

			
			@font-face {
				font-family: Lato;
				src: url("https://fonts.googleapis.com/css?family=Lato");
			}
			p{
				margin:0;font-family: Lato;line-height: 1;
			}
			table td{
				margin:0;font-family: Lato;padding:0;line-height: 1;
			}
			
			.table_rows, .table_rows th, .table_rows td {
			   border: 1pt thin solid  #000;border-collapse: collapse;padding:2px; 
			}

			
			
			.table_rows th{
				font-size:14px;
			}
			table_rows1, .table_rows1 th, .table_rows1 td {
			   border: 1pt thin solid  #000 !important;border-collapse: collapse;padding:5px; 
			}
			.border_none, .border_none th, .border_none td {
			   border:none; 
			}
				 .h3, h3 {
			font-size: 25px;
			font-weight: 700;
		}
		.h1, .h2, .h3, h1, h2, h3 {
			margin-top: 5px;
			margin-bottom: 1px;
		}
			</style>
		</head>
		<body><table class="table_rows"><tr><td style="padding-left:1px;">
		<div align="center">
						<div style="float:left;position:absolute;margin-left:7%;top:1%">
							<img src="'.ROOT . DS  . 'webroot' . DS  .'images/project_logo/UCCI LOGO.png" width="90px" height="90px" />
						</div>
						<div style="float:right;width:100%">';
						foreach($MasterCompanies as $MasterCompany) 
						{
							$html.=$MasterCompany->company_information;
							$st_reg_no=$MasterCompany->st_reg_no;
							$pan_no=$MasterCompany->pan_no;
							$gst_number=$MasterCompany->gst_number;
							$compare_date=date("Y-m-d",strtotime($data->date_current)); 
						
							$compare_date=strtotime($compare_date);
							$gst_date=strtotime("2017-07-01");
							if($gst_date<$compare_date){
								$text_type="Gst Number";
								$type_number=$gst_number;
							}else{
								
								$text_type="Service Tax Number";
								$type_number="ABCDE1234FST001";
							}
						}
						if($typeee == 1){
							$html.=''.$text_type.' : '.$type_number.'';
						}
						$html.='</div>
					</div>
		<br/>
						<br/>
						<br/>
						<br/>
						<br/>
						<br/>
						<br/>
						<br/>
						<br/>
							<center>
							<span style="width:100%; text-align:center;font-size: 20px;">
							<u><strong>RECEIPT</strong></u>
						</span>
						</center>
						<br/>
						
							<table style="width: 100%;" class="border_none">
								<tr style="line-height:2;">
									<td style="width: 50%; text-align:left; font-size:13px;">UCCI/PR'.$num_padded = sprintf("%04d", $receipt_no).'/'.$from_year.'-'.$to_year.'</td>
									<td style="width: 50%; text-align:right; font-size:13px;">Date: '.date('d-m-Y', strtotime($data->date_current)).'</td>
								</tr>
							
							<tr>
							<td colspan="2">
							<p style="width: 100%;font-size: 14px; text-align:justify; margin-top:10px;">
							Received with thanks from '.$data->company->company_organisation.', '.$data->company->city.'
							a sum of Rupees '.ucwords($this->convert_number_to_words(($word_value[0])));
							if(!empty($word_value[1])){
							if($word_value[1] != 00){
								$html.=' & paisa '.ucwords($this->convert_number_to_words(($word_value[1])));
							}}
							$html.=' Only vide '.$data->amount_type.' '.$data->cheque_no.' dated ';
							if(!empty($data->bank_id)){
								$html.=date('d-m-Y',strtotime($data->cheque_date));
							}else{
								$html.=date('d-m-Y',strtotime($data->date_current));
							}
							
							if(!empty($data->drawn_bank)){ $html.=' drawn on '.$data->drawn_bank; }    
							$html.=' on account of '.implode(',',$purpose_name);
							if(!empty($data->narration)){ $html.=' ('.$data->narration.')'; }
							
							$html.='. </p>
							</td>
							</tr>
							</table>
							
								<table style="width: 100%;" class="border_none" >
									<tr>';
									
									   
										
									 if($typeee == 1){ 
										  $html.='<td rowspan="2" style="width: 45%; text-align:left;" valign="top">
											<table  class="table_rows1"  style="width: 100%; font-size:14px; margin-top:50px;border-collapse: collapse;padding:2px;" >';
											$html.='<tr>
											<td  style="text-align:right;">Basic Amount</td><td  style="text-align:right;"">'.number_format(($data->basic_amount), 2, '.', '').'</td>
											</tr>';
											foreach($data->tax_amounts as $tax_amount)
											{
												$html.=' <tr>
												 <td style="text-align:right;">'.$tax_amount->master_taxation->tax_name.' @ '.number_format(($tax_amount->tax_percentage), 2, '.', '').'%</td>
												 <td style="text-align:right;">'.number_format(($tax_amount->amount), 2, '.', '').'</td>
												 </tr>';
											}
										   if(!empty($tds_amount)){
											
											$html.='<tr>
											<td style="text-align:right;">Total Amount</td><td style="text-align:right;">
											'.number_format($data->basic_amount+$taxamount, 2, '.', '').'</td>
											</tr>	
									
											<tr>
											<td style="text-align:right;">TDS Amount</td><td style="text-align:right;">
											'.number_format($tds_amount, 2, '.', '').'</td>
											</tr>';
											} 
											$html.='<tr>
											<td style="text-align:right;"><strong>Grand Total</strong></td>
											<td style="text-align:right;"><strong>'.number_format($data->amount, 2, '.', '').'</strong></td>
											</tr>
											</table>';
											
											$html.='</td>
											<td style="width: 55%; text-align:right;font-size: 15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td>';
											$html.='</tr>
											<tr>
											<td style=" text-align:right;font-size: 15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
											</tr>';
										  }else{ 
										 
										 
										 
										 $html.='<td colspan="2" style="width: 60%; text-align:right;font-size: 15px;"><strong>For: Udaipur Chamber of Commerce & Industry</strong></td>';
										$html.='</tr>
											<tr>
											<td  style="width: 30%; text-align:center;font-size:16px;"><br/><br/><br/><br/><table class="table_rows" style="font-size:16px; width:100%;"><tr><td style="text-align:center;">
											Rs. '.number_format($data->amount, 2, '.', '').'
											</td></tr></table></td>
											<td style="width: 70%; text-align:right;font-size: 15px;"><br/><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'images/digital_sign/signature.png" width="100px" height="50px" align="right" /></p><br/><br/><br/><br/>Authorised Signatory</td>
											</tr>';
										 
										 
										   } 
											 
											
										
										$html.='</table></td></tr><tr><td><span style="width: 100%;font-size: 15px;line-height:1;">Note: Cheque/DD subject to clearance in bank.</span></td></tr></table></body></html>';  
						
			 
		}
		
		    $dompdf->loadHtml($html);
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents('coo_payment_receipt.pdf', $output);	
			
			$attachments='';
			$attachments[]='coo_payment_receipt.pdf';
			$sub='Payment Successfully submitted';
			$email_to='rohitkumarjoshi43@gmail.com';
				$from_name='UCCI';
						$email = new Email();
						$email->transport('SendGrid');
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_payment_success')
										->emailFormat('html')
										->viewVars(['member_name'=>ucwords($member_name),'amount'=>$act_amount])
										->attachments($attachments);
										
									   $email->send();
									
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
							
			$query = $this->CertificateOrigins->query();
			$query->update()
			->set(['coo_email'=>'no'])
			->where(['id' => $udf1])
			->execute();		
		
	}
		
		
		
	}
 
 public function failure()
    {
		$this->viewBuilder()->layout('index_layout');
		$status=$this->request->data["status"];
		$amount=$this->request->data["amount"];
		$txnid=$this->request->data["txnid"];
		$hash=$this->request->data["hash"];
		$key=$this->request->data["key"];
		$udf1=$this->request->data["udf1"];
		$productinfo=$this->request->data["productinfo"];
		$email=$this->request->data["email"];
		$query = $this->CertificateOrigins->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status])
		->where(['id' => $udf1])
		->execute();
		
		 $this->set(compact('status','amount','udf1','txnid','try'));	
		
	}
 
 
 
 
/* 	public function CooSendEmail()
    {
	
		$send_emails=$this->CertificateOrigins->CooEmailApprovals->find()->where(['status'=>0])->contain(['Users','CertificateOrigins'=>['MasterCurrencies','CertificateOriginGoods','Companies'=>['Users']]])->limit(1)->toArray();
		
		$this->set(compact('send_emails'));
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
	
		
	} */
	
	
	public function CooSendEmail()
    {
	
		/* $send_emails=$this->CertificateOrigins->CooEmailApprovals->find()->where(['status'=>0])->contain(['Users','CertificateOrigins'=>['Companies'=>['Users']]])->limit(5)->toArray();
		
		$email = new Email();
		$email->transport('SendGrid');
		
		foreach($send_emails as $send_email){
		 
			  $id=$send_email->id;
			  $regards_member_name=$send_email->certificate_origin->company->users[0]->member_name;
			   $payment_status=$send_email->certificate_origin->payment_status;
			  
			  $member_name=$send_email->user->member_name;
			  $to=$send_email->user->email;
			  $sub="Requesting Approval for Coo";
			  $from_name="UCCI";
			  $email_to=trim($to,' ');
			 // $email_to="rohitkumarjoshi43@gmail.com";
			 
			 if($payment_status=='success'){ 
			
					  if(!empty($to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_email_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'regards_member_name'=>$regards_member_name]);
										$email->send();
									$query = $this->CertificateOrigins->CooEmailApprovals->query();
									$query->update()
									->set(['status' => 1])
									->where(['id' => $id])
									->execute();
									
							} catch (Exception $e) {
								$query = $this->CertificateOrigins->CooEmailApprovals->query();
								$query->update()
								->set(['status' => 2])
								->where(['id' => $id])
								->execute();
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}else{
							
							  $query = $this->CertificateOrigins->CooEmailApprovals->query();
								$query->update()
								->set(['status' => 2])
								->where(['id' => $id])
								->execute();
							
						}
					 }elseif($payment_status=='failure'){
 
						$query = $this->CertificateOrigins->CooEmailApprovals->query();
							$query->update()
							->set(['status' => 2])
							->where(['id' => $id])
							->execute();

					 }		 
	  }
	 exit; */
		
	}
	
	
 

	public function CertificateOrigin()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('company_id');
		$certificate_origin_good = $this->CertificateOrigins->newEntity();
		if($this->request->is('post')) 
		{				
			$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['company_id']=$user_id;
			$files=$this->request->data['file']; 
			
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			 
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			
			$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
			$i=0;
			/* foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
				$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
				$this->request->data['coo_email_approvals'][$i]['status']=0;	
				$i++;	
			} */
			$this->request->data['status'] = 'draft';
			$currency_type=$this->request->data['currency'];
			$currency_units=$this->CertificateOrigins->MasterCurrencies->find()->where(['currency_type'=>$currency_type]);	
			foreach($currency_units as $currency_unit){
				$currency_unit = $currency_unit['fractional_unit'];
			}
			$this->request->data['currency_unit'] = $currency_unit;
			 	
			$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
			
			if ($data=$this->CertificateOrigins->save($certificate_origin_good))
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				}
				$last_insert_id=$data->id;
				$this->Flash->success(__('Your certificate origin good has been saved.'));
				return $this->redirect(['action' => 'draftView',$last_insert_id]);
				exit;
				//return $this->redirect('https://test.payu.in/_payment');
				//return $this->redirect(['action' => 'payment',$data->id]);
			}
			
			$this->Flash->error(__('Unable to add your certificate origin goods.'));
		}
		$this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$user_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies'));
			 
		 
	}
	
	
	
	
	public function filterdata(){
		$exporter=$this->request->query['exporter']; 
		$originno=$this->request->query['originno'];
		$datefrom=$this->request->query['datefrom']; 
		$dateto=$this->request->query['dateto'];
		
		
		if(!empty($exporter)){
			//$Users=$this->CertificateOrigins->find()->where(['exporter'=>$exporter])->order(['CertificateOrigins.id'=>'DESC']);
			$condition['exporter Like']='%'.$exporter.'%';
		}
		 if( !empty($originno)){
			//$Users=$this->CertificateOrigins->find()->where(['exporter'=>$exporter,'origin_no '=>$originno])->order(['CertificateOrigins.id'=>'DESC']);
			$condition['origin_no']=$originno;
		}
		
		if(!empty($datefrom) && !empty($dateto)){
			//$Users=$this->CertificateOrigins->find()->where(['CertificateOrigins.invoice_date BETWEEN :start AND :end'])
				///->bind(':start', $datefrom, 'date')
				//->bind(':end',   $dateto, 'date')
				//->order(['CertificateOrigins.id'=>'DESC']);
			$datefrom=date('y-m-d', strtotime($datefrom));
			$dateto=date('y-m-d', strtotime($dateto));
			$condition['date_current >=']=$datefrom;
			$condition['date_current <=']=$dateto;
		}
		
		
		$Users=$this->CertificateOrigins->find()->where($condition)
				->order(['CertificateOrigins.id'=>'DESC']);
				
		
				
		
		$this->set(compact('Users'));
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	//-- DRAFT View
	public function draftView($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$certificate_origin_good = $this->CertificateOrigins->get($id, [
            'contain' => []
        ]);
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$id])->contain(['Companies','CertificateOriginGoods'])->toArray();
		foreach($certificate_origins as $certificate_origin){
			$oldimage=$certificate_origin['invoice_attachment'];
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			if(isset($this->request->data['certificate_origin_draft']))
			{
				
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				//$this->request->data['company_id']=$user_id;
				$files=$this->request->data['file']; 
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
				}
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				
				/*$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				 foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				} */
				$currency_type=$this->request->data['currency'];
				$currency_units=$this->CertificateOrigins->MasterCurrencies->find()->where(['currency_type'=>$currency_type]);	
				foreach($currency_units as $currency_unit){
					$currency_unit = $currency_unit['fractional_unit'];
				}
				
				$this->request->data['currency_unit'] = $currency_unit;	 	
				$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
			
				
				if ($data=$this->CertificateOrigins->save($certificate_origin_good))
				{ 
						
						$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
						$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
						foreach($files as $file){
						  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

						}
					
					$this->Flash->success(__('Your certificate origin good has been saved.'));
					return $this->redirect(['action' => 'certificate-origin-draft-view']);
					 
				}
				
			}
			else if(isset($this->request->data['certificate_origin_publish']))
			{ 
				 
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				//$this->request->data['company_id']=$user_id;
				$files=$this->request->data['file'];
				
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
				}
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				$this->request->data['status']='draft';
				$this->request->data['coo_email']='yes';
				$this->request->data['verify_remarks']='';
				$payment_type=$this->request->data['payment_type'];
				$coupon_code=$this->request->data['coupon_code'];
				
				
				$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				/* foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				} */
				$currency_type=$this->request->data['currency'];
				$currency_units=$this->CertificateOrigins->MasterCurrencies->find()->where(['currency_type'=>$currency_type]);	
				foreach($currency_units as $currency_unit){
					$currency_unit = $currency_unit['fractional_unit'];
				}
			
				$this->request->data['currency_unit'] = $currency_unit;	
				$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);

				if ($data=$this->CertificateOrigins->save($certificate_origin_good))
				{ 
					$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
					foreach($files as $file){
					  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
					}
					 
				if($payment_type=="couponcode"){
					
							$paymented=$this->CertificateOrigins->find('all')
							->where(['id'=>$id,'payment_status'=>'success'])->count();
						if($paymented>0){
								$query = $this->CertificateOrigins->query();
								$query->update()
								->set(['status' => 'published'])
								->where(['id' => $data->id])
								->execute();



								//return $this->redirect('https://test.payu.in/_payment');
								return $this->redirect(['action' => 'certificate-origin-draft-view']);

						}else{

							$coo_company_id=$data->company_id;
							$CooCoupons_count=$this->CertificateOrigins->Companies->CooCoupons->find()->where(['company_id'=>$coo_company_id,'coupon_code'=>$coupon_code,'flag'=>0])->count();
							
								if($CooCoupons_count>0){
										$CooCoupons=$this->CertificateOrigins->Companies->CooCoupons->newEntity();
										$CooCoupons_counts=$this->CertificateOrigins->Companies->CooCoupons->find()->where(['company_id'=>$coo_company_id,'coupon_code'=>$coupon_code,'flag'=>0])->toArray();
										$coupon_id=$CooCoupons_counts[0]->id;
										$CooCoupons->id=$coupon_id;
										$CooCoupons->flag=1;
										
										$this->CertificateOrigins->Companies->CooCoupons->save($CooCoupons);
										
										$query = $this->CertificateOrigins->query();
										$query->update()
										->set(['status' => 'published','payment_status'=>'success','transaction_id'=>$coupon_code])
										->where(['id' => $data->id])
										->execute();
										return $this->redirect(['action' => 'certificate-origin-draft-view']);
										
								}else{
									return $this->redirect(['action' => 'certificate-origin-draft-view']);
								}
							
						}	
				}else{
					
					$paymented=$this->CertificateOrigins->find('all')
						->where(['id'=>$id,'payment_status'=>'success'])->count();
					if($paymented>0){
						$query = $this->CertificateOrigins->query();
							$query->update()
							->set(['status' => 'published'])
							->where(['id' => $data->id])
							->execute();


					
						//return $this->redirect('https://test.payu.in/_payment');
						return $this->redirect(['action' => 'certificate-origin-draft-view']);
					}
					else{
						return $this->redirect(['action' => 'paymentTest',$data->id]);
						//return $this->redirect(['action' => 'payment',$data->id]);
					}
				}	
					
					$this->Flash->success(__('Your certificate origin good has been saved.'));
				}
			
			}
        }
        $this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
	}
	
	
	
	//  edit start 
	
	public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$certificate_origin_good = $this->CertificateOrigins->get($id, [
            'contain' => []
        ]);
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$id,'approve'=>1])->contain(['Companies','CertificateOriginGoods'])->toArray();
		$approved_by=$certificate_origins[0]->approved_by;
		$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			//$this->request->data['company_id']=$user_id;
			
			
			$files=$this->request->data['file']; 
			
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			
			
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			
			$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
			$i=0;
			foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
				$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
				$this->request->data['coo_email_approvals'][$i]['status']=0;	
				$i++;	
			}
						
			$certificate_origin_good = $this->CertificateOrigins->patchEntity($certificate_origin_good, $this->request->data);
			
			
				 	
			if ($data=$this->CertificateOrigins->save($certificate_origin_good))
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice/'.$data->id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice/'.$data->id;
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

				}
				

		
		
		
				$this->Flash->success(__('Your certificate origin good has been saved.'));
				return $this->redirect(['action' => 'edit']);
				//return $this->redirect('https://test.payu.in/_payment');
				//return $this->redirect(['action' => 'payment',$data->id]);
			}
			
			$this->Flash->error(__('Unable to add your certificate origin goods.'));
        }
        $this->set('certificate_origin_good', $certificate_origin_good);
		$Users=$this->CertificateOrigins->Companies->find()->select(['company_organisation'])->where(['id'=>$user_id])->toArray();
		$MasterUnits=$this->CertificateOrigins->MasterUnits->find()->toArray();
		$MasterCurrencies=$this->CertificateOrigins->MasterCurrencies->find()->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
	}
	
	//  edit end
	
	public function CertificateOriginPerformaView(){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$certificate_origin_id=$this->request->data['view'];
		$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'status'=>'approved'])->contain(['Companies','CertificateOriginGoods'])->toArray();
		$approved_by=$certificate_origins[0]->approved_by;
		$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		
		$this->set(compact('certificate_origins','CertificateOriginAuthorizeds'));
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		
	}
	public function certificateOriginDraftView()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$user_id=$this->Auth->User('id'); 
		$Companies=$this->CertificateOrigins->Companies->get($company_id);
		$role_id=$Companies->role_id;
		
		if($this->request->is('post')) 
		{
				//echo "hello";		
			if(isset($this->request->data['certificate_move_submit']))
			{
				
				 $coo_id=$this->request->data['certificate_move_submit'];
				$CertificateOrigins = $this->CertificateOrigins->get($coo_id);
		
				$this->request->data['id']=$this->request->data['certificate_move_submit'];
				$this->request->data['reason_move']=$this->request->data['reason_move'.$coo_id];
				$this->request->data['move_by']=$user_id;
				$this->request->data['payment_status']='success';
				$this->request->data['status']='published';
				
				$CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				
				$this->CertificateOrigins->save($CertificateOrigins);
				
			}
		
		}	
		
		
		if($role_id==1 || $role_id==4){	
			$certificate_origins = $this->CertificateOrigins->find()->where(['status'=>'draft']);
		}
		else{
			$certificate_origins = $this->CertificateOrigins->find()->where(['company_id'=>$company_id,'status'=>'draft']);
		}
		
		$this->set(compact('certificate_origins','role_id'));
	}
	public function certificateOriginViewPublished()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->CertificateOrigins->Companies->get($company_id);
		$role_id=$Companies->role_id;
		if($role_id==1 || $role_id==4){	
			$certificate_origins =$this->CertificateOrigins->find()->where(['status'=>'published','payment_status'=>'success']);
		}
		else{
			$certificate_origins=array();
		}		
		$this->set(compact('certificate_origins'));
	}
 
	public function certificateOriginPublishedView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$Users=$this->CertificateOrigins->Users->get($user_id);
		$regard_member_name=$Users->member_name;
		$CertificateOrigins = $this->CertificateOrigins->newEntity();
				
		if(isset($this->request->data['view']))
		{ 
			$certificate_origin_id=$this->request->data['view'];;
			$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$certificate_origin_id,'status'=>'published'])->contain(['Companies','CertificateOriginGoods'])->toArray();
			$company_id=$certificate_origins[0]->company_id;  
			$DocumentCheck=$this->CertificateOrigins->Companies->find('all')
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('certificate_origins','DocumentCheck'));
		}
		if($this->request->is('post')) 
		{
						
			if(isset($this->request->data['certificate_approve_submit']))
			{
				
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['certificate_approve_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['Companies'=>['Users']]]);
				$exporter_name=$CertificateOrigins->exporter;
				
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='verified';
				$this->request->data['coo_verify_email']='yes';
				
				
				
				$query = $this->CertificateOrigins->find();
 				//pr($this->request->data); exit;
				$CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				/*$email_to=$CertificateOrigins->company->users[0]->email; 
				$member_name=$CertificateOrigins->company->users[0]->member_name;
				$Users= $this->CertificateOrigins->Users->get($user_id);
				$regards_member_name=$Users->member_name;*/

			

				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					
					$certificates_data = base64_encode($id);
					
					//$certificates_data = json_encode($certificates_data);
					
				
					$authorise_person_mails=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->contain(['Users']);
				foreach($authorise_person_mails as $authorise_person_mail){
					$emailperson_id=$authorise_person_mail['user']->id;
					$emailperson=$authorise_person_mail['user']->member_name;
					$emailsend=$authorise_person_mail['user']->email;
					
					$emailperson_id = base64_encode($emailperson_id);
					 // $url="http://localhost/uccinew/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id."";
					 
					$url="http://www.ucciudaipur.com/uccinew/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id.""; 
					
					//$url="http://www.ucciudaipur.com/app/certificate-origins/coo_approved/".$certificates_data."/".$emailperson_id.""; 
					
					$sub="Certificate of origin is Varified";
					$from_name="UCCI";
					$email_to=trim($emailsend,' ');
					$email_to='rohitkumarjoshi43@gmail.com';
					if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('coo_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$emailperson,'url'=>$url,'exporter_name'=>$exporter_name]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
				}	
				
					$this->Flash->success(__('Certificate of origin has been verified.'));
					return $this->redirect(['action' => 'certificate-origin-view-published']);
				}
				$this->Flash->error(__('Unable to verify certificate of origin.'));
			}
			else if(isset($this->request->data['certificate_notapprove_submit']))
			{
				
				$id=$this->request->data['certificate_notapprove_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id , ['contain'=>['Companies'=>['Users']]]);
			
				$remarks=$this->request->data['verify_remarks'];
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='draft';
				$this->request->data['authorised_remarks']='';
				 
				$CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				$email = new Email();
				$email->transport('SendGrid');
			if($this->CertificateOrigins->save($CertificateOrigins))
				{
					
					foreach($CertificateOrigins['company']['users'] as $CertificateOrigin)
					{
						$mailsendtomember=$CertificateOrigin['member_name'];
						$mailsendtoemail=$CertificateOrigin['email'];
						$sub="Certificate of origin is Not Varified";
						$from_name="UCCI";
						$email_to=trim($mailsendtoemail,' ');
						$email_to="anilgurjer371@gmail.com";
					if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('coo_not_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$mailsendtomember,'regard_member_name'=>$regard_member_name,'remarks'=>$remarks]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
					}	
					$this->Flash->success(__('Certificate of origin has been not verify.'));
					return $this->redirect(['action' => 'certificate-origin-view-published']);
				}
				$this->Flash->error(__('Unable to not verify certificate of origin.'));
			}
		}
		
		$MasterCompanies=$this->CertificateOrigins->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('CertificateOrigins'));
		 
    }
	
	
	
	public function cooApproved($coo_id=null,$authorized_id=null)
    {
		$this->viewBuilder()->layout('index_layout');
		
		 $ids = base64_decode($coo_id);
		 $authorized_id = base64_decode($authorized_id);
		$user_id=$authorized_id;  
		
		$certificate_origin_count = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$ids,'status'=>'verified','coo_verify_email'=>'yes'])->count();
		$this->set(compact('certificate_origin_count'));
		if($certificate_origin_count>0){
			$CertificateOrigins = $this->CertificateOrigins->newEntity();

			$certificate_origins = $this->CertificateOrigins->find()->where(['CertificateOrigins.id'=>$ids,'status'=>'verified'])->contain(['Companies','CertificateOriginGoods'])->toArray();


			$verify_bys=$certificate_origins[0]->verify_by; 
			$Users_verifys=$this->CertificateOrigins->Companies->Users->get($verify_bys);
			$verify_member=$Users_verifys->member_name; 
			$company_id=$certificate_origins[0]->company_id; 
			$DocumentCheck=$this->CertificateOrigins->Companies->find()
			->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
			->count();
			
			$this->set(compact('certificate_origins','DocumentCheck','verify_member','CertificateOrigins','certificate_origin_count'));
			
			
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['certificate_approve_submit']))
			{
				 
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['certificate_approve_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['Companies'=>['Users']]]);
				$consignee=$CertificateOrigins->consignee;
				$this->request->data['status']='approved';
				//$this->request->data['approve']=1;
				$this->request->data['approved_by']=$user_id; 
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']=''; 
				$this->request->data['coo_verify_email']='no'; 
				
				$coo_verification_code=uniqid(); 
				$this->request->data['coo_verification_code']=$coo_verification_code; 
				
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$query = $this->CertificateOrigins->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				 $email_to=$CertificateOrigins->company->users[0]->email; 
				 $member_name=$CertificateOrigins->company->users[0]->member_name;
				 
				 $Users= $this->CertificateOrigins->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				 
				
				
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					
					  $sub="Your certificate of origin is approved";
					  $from_name="UCCI";
					  $email_to=trim($email_to,' ');
					$email_to="rohitkumarjoshi43@gmail.com";
					  if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('coo_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'consignee'=>$consignee]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Certificate of origin has been approved.'));
					return $this->redirect(['action' => 'coo_approved']);
				}
				$this->Flash->error(__('Unable to approved certificate of origin.'));
			}
			else if(isset($this->request->data['certificate_notapprove_submit']))
			{
				
				$id=$this->request->data['certificate_notapprove_submit'];
				$CertificateOrigins=$this->CertificateOrigins->get($id);
				
				//$this->request->data['id']=$this->request->data['certificate_notapprove_submit'];
				$this->request->data['approve']=2;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
				$this->request->data['coo_verify_email']='no'; 
				
				 $CertificateOrigins = $this->CertificateOrigins->patchEntity($CertificateOrigins, $this->request->data);
				
				if($this->CertificateOrigins->save($CertificateOrigins))
				{
					$this->Flash->success(__('Certificate of origin has been not approved.'));
					return $this->redirect(['action' => 'coo_approved']);
				}
				$this->Flash->error(__('Unable to not approved certificate of origin.'));
			}
		}
		
			
			
			
			
			
		}else{
			
			$this->Flash->success(__('Certificate of origin has been taken action'));
			
		}
	}
	
	

} 
	
	
 
?>



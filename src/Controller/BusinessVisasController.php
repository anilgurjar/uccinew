<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * BusinessVisas Controller
 *
 * @property \App\Model\Table\BusinessVisasTable $BusinessVisas
 */
class BusinessVisasController extends AppController
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
	
	
	
	
	
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $businessVisas = $this->paginate($this->BusinessVisas);

        $this->set(compact('businessVisas'));
        $this->set('_serialize', ['businessVisas']);
    }

    /**
     * View method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $businessVisa = $this->BusinessVisas->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('businessVisa', $businessVisa);
        $this->set('_serialize', ['businessVisa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
        $businessVisa = $this->BusinessVisas->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
			$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
            $businessVisa = $this->BusinessVisas->patchEntity($businessVisa, $this->request->data);
			
            if ($data=$this->BusinessVisas->save($businessVisa)) {
                $this->Flash->success(__('The business visa has been saved.'));
				$last_insert_id=$data->id;
                return $this->redirect(['action' => 'business-vissa-draft-view',$last_insert_id]);
            } else {
                $this->Flash->error(__('The business visa could not be saved. Please, try again.'));
            }
        }
        $members = $this->BusinessVisas->Companies->find()->where(['id'=>$company_id]);
		$this->set(compact('businessVisa', 'members'));
        $this->set('_serialize', ['businessVisa']);
    }

	//-- DRAFT View
	public function businessVissaDraftView($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$business_visas = $this->BusinessVisas->get($id, [
            'contain' => ['Companies']
        ]);
		
		$business_visa_datas = $this->BusinessVisas->find()->where(['BusinessVisas.id'=>$id])->contain(['Companies'])->toArray();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			if(isset($this->request->data['business_vissa_draft']))
			{
				
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
				$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
            
				$amount=150;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=150;
				$this->request->data['payment_tax_amount']=$Tax;
				$businessvissas = $this->BusinessVisas->patchEntity($business_visas, $this->request->data);
			
				
				if ($data=$this->BusinessVisas->save($businessvissas))
				{ 
					$this->Flash->success(__('Your Business Vissas has been saved.'));
					$last_insert_id=$data->id;
					return $this->redirect(['action' => 'business-vissa-draft-view',$last_insert_id]);
             
				}
				
			}
			else if(isset($this->request->data['business_vissa_publish']))
			{ 
				 
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
				$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
				
				$amount=150;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				$this->request->data['payment_amount']=150;
				$this->request->data['payment_tax_amount']=$Tax;
				$this->request->data['status']='draft';
				$this->request->data['coo_email']='yes';
				$this->request->data['verify_remarks']='';
				
				$i=0;
				
				$businessvissas = $this->BusinessVisas->patchEntity($business_visas, $this->request->data);
				if ($data=$this->BusinessVisas->save($businessvissas))
				{ 
					
					$paymented=$this->BusinessVisas->find('all')
						->where(['id'=>$id,'payment_status'=>'success'])->count();
					if($paymented>0){
						$query = $this->BusinessVisas->query();
							$query->update()
							->set(['status' => 'published'])
							->where(['id' => $data->id])
							->execute();


					
						//return $this->redirect('https://test.payu.in/_payment');
						return $this->redirect(['action' => 'business-vissa-draft-view']);
					}
					else{
						return $this->redirect(['action' => 'paymentTest',$data->id]);
						//return $this->redirect(['action' => 'payment',$data->id]);
					}
					
					
					$this->Flash->success(__('Your Business Vissa has been saved.'));
				}
			
			}
        }
		
        $this->set('business_visas', $business_visas);
		$Users=$this->BusinessVisas->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		$members = $this->BusinessVisas->Companies->find()->where(['id'=>$company_id]);
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('business_visa_datas','members'));
	}
	
	
	
	
	
	
	public function paymentTest($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->BusinessVisas->Users->get($user_id);
		
		
			$sul='http://localhost/uccinew/business-visas/success';
			$furl='http://localhost/uccinew/business-visas/failure';
			
			//$sul='http://ucciudaipur.com/app/business-visas/success';
			//$furl='http://ucciudaipur.com/app/business-visas/failure';
			
			//$sul='http://ucciudaipur.com/uccinew/business-visas/success';
			//$furl='http://ucciudaipur.com/uccinew/business-visas/failure';
			
			
			$BusinessVisas = $this->BusinessVisas->find()
			->where(['BusinessVisas.id'=>$id]);
			
		$this->set(compact('Users','BusinessVisas','id','sul','furl'));
	}
	
	
	
	public function payment($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->BusinessVisas->Users->get($user_id);
		
			//$sul='http://localhost/uccinew/business-visas/success';
			//$furl='http://localhost/uccinew/business-visas/failure';
			
			$sul='http://ucciudaipur.com/app/business-visas/success';
			$furl='http://ucciudaipur.com/app/business-visas/failure';
			
			
			$BusinessVisas = $this->BusinessVisas->find()
			->where(['BusinessVisas.id'=>$id]);
			
			
		$this->set(compact('Users','BusinessVisas','id','sul','furl'));
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
		$query = $this->BusinessVisas->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status,'status'=>'published'])
		->where(['id' => $udf1])
		->execute();
		 $this->set(compact('status','amount','id','txnid','sul'));	
		
	// mail should secretary 
	
		//$companies= $this->BusinessVisas->Companies->find()->where(['id'=>$udf1]);
		/*  $email = new Email();
		 $email->transport('SendGrid');
		$sub='Secretary';
		$sendmails= $this->BusinessVisas->Companies->find()->where(['role_id'=>1 ])->orwhere(['role_id'=>4])->contain(['Users']);
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
		 
		 
		 $BusinessVisas=$this->BusinessVisas->get($udf1);
		 
		 
		 $company_id_coo=$BusinessVisas->company_id; 
		 $business_vissa_email=$BusinessVisas->business_vissa_email;
		 $payment_amount=$BusinessVisas->payment_amount;
		 $payment_tax_amount=$BusinessVisas->payment_tax_amount;
	if($business_vissa_email=='yes'){
		 
		  $Companies_data=$this->BusinessVisas->Companies->get($company_id_coo,['contain'=>'Users']);
		
		 $member_name=$Companies_data->users[0]->member_name;
		 $email_to=$Companies_data->users[0]->email;
		 
		 $MasterTaxations= $this->BusinessVisas->MasterTaxations->find()->where(['tax_flag'=>1,'nmef'=>1])->contain(['MasterTaxationRates'])->toArray();
		 
			$MemberReceipts=$this->BusinessVisas->MemberReceipts->newEntity();

			$GeneralReceiptPurposes=$this->BusinessVisas->MemberReceipts->GeneralReceiptPurposes->newEntity();
				
				$fetch_member_receipt=$this->BusinessVisas->MemberReceipts->find('all')->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
				if(!empty($fetch_member_receipt)){
					$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
				}else{
					$receipt_no='0001';
				}
				$amount=$payment_amount+$payment_tax_amount;
				$act_amount=$amount;
				$this->request->data['amount_type']='Payumoney';
				$this->request->data['narration']='Bussiness Vissa';
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
		
				
				$MemberReceipts = $this->BusinessVisas->MemberReceipts->patchEntity($MemberReceipts, $this->request->data);
				
				$GeneralReceiptPurposes->purpose_id=12;
				$GeneralReceiptPurposes->quantity=1;
				$GeneralReceiptPurposes->amount=$payment_amount;
				$GeneralReceiptPurposes->total=$payment_amount;
				$MemberReceipts->general_receipt_purposes[0]=$GeneralReceiptPurposes;
				
				$i=0;
				foreach($MasterTaxations as $co_tax_amount){
					    $total=0;
						$TaxAmounts=$this->BusinessVisas->MemberReceipts->TaxAmounts->newEntity();
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
				
				$data_save=$this->BusinessVisas->MemberReceipts->save($MemberReceipts);

				//pr($data_save); 
				//	$receipt_id=1872;

		 	    $options = new Options();
				$options->set('defaultFont', 'Lato-Hairline');
				$dompdf = new Dompdf($options);
				$dompdf = new Dompdf();
		
				$master_member_receipt=$this->BusinessVisas->MemberReceipts->find()->where(['receipt_id'=> $data_save->receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
				return $q->select(['id','company_organisation','city']);
				},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();

				$MasterCompanies=$this->BusinessVisas->MemberReceipts->MasterCompanies->find();
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
			file_put_contents('business_vissa_payment_receipt.pdf', $output);	
			
			$attachments='';
			$attachments[]='business_vissa_payment_receipt.pdf';
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
										->template('bussiness_vissa_payment_success')
										->emailFormat('html')
										->viewVars(['member_name'=>ucwords($member_name),'amount'=>$act_amount])
										->attachments($attachments);
										
									   $email->send();
									
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
							
			$query = $this->BusinessVisas->query();
			$query->update()
			->set(['business_vissa_email'=>'no'])
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
		$query = $this->BusinessVisas->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status])
		->where(['id' => $udf1])
		->execute();
		
		 $this->set(compact('status','amount','udf1','txnid','try'));	
		
	}
 
	
	
	
	
	
	public function bussinessVissaViewPublished()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->BusinessVisas->Companies->get($company_id);
		$role_id=$Companies->role_id;
		if($role_id==1 || $role_id==4){	
			$bussiness_vissas =$this->BusinessVisas->find()->where(['status'=>'published','BusinessVisas.payment_status'=>'success'])->contain(['Companies']);
		}
		else{
			$bussiness_vissas=array();
		}		
		$this->set(compact('bussiness_vissas'));
	}
 
	public function bussinessVissaPublishedView()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		$user_id=$this->Auth->User('id');
		$BusinessVisas = $this->BusinessVisas->newEntity();
		if(isset($this->request->data['view']))
		{ 
			$certificate_origin_id=$this->request->data['view'];;
			$bussiness_vissas = $this->BusinessVisas->find()->where(['BusinessVisas.id'=>$certificate_origin_id,'status'=>'published'])->contain(['Companies'])->toArray();
			$membertypes=$this->BusinessVisas->CompanyMemberTypes->find()->where(['company_id'=>$company_id]);
			foreach($membertypes as $membertype){
				$membertype=$membertype['master_member_type_id'];
			}
			$company_id=$bussiness_vissas[0]->company_id;  
			$DocumentCheck=$this->BusinessVisas->Companies->find('all')
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('bussiness_vissas','DocumentCheck','membertype'));
		}
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['bussiness_vissa_approve_submit']))
			{
				
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['bussiness_vissa_approve_submit'];
				$BusinessVisasdatas=$this->BusinessVisas->get($id,['contain'=>['Companies'=>['Users']]]);
				$exporter_name=$BusinessVisas->exporter;
				
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='verified';
				$this->request->data['coo_verify_email']='yes';
				
				
				$query = $this->BusinessVisas->find();
 				//pr($this->request->data); exit;
				$BusinessVisasdatas1 = $this->BusinessVisas->patchEntity($BusinessVisasdatas, $this->request->data);
				
				if($this->BusinessVisas->save($BusinessVisasdatas1))
				{
					$certificates_data = base64_encode($id);
										
					$authorise_person_mails=$this->BusinessVisas->CertificateOriginAuthorizeds->find()->contain(['Users']);
				foreach($authorise_person_mails as $authorise_person_mail){
					$emailperson_id=$authorise_person_mail['user']->id;
					$emailperson=$authorise_person_mail['user']->member_name;
					$emailsend=$authorise_person_mail['user']->email;
					$emailperson_id = base64_encode($emailperson_id);
					
					$url="http://www.ucciudaipur.com/app/business-visas/bussiness_vissa_approved/".$certificates_data."/".$emailperson_id.""; 
					
				
					$sub="Bussiness Vissa is Varified";
					$from_name="UCCI";
					$email_to=trim($emailsend,' ');
					$email_to='anilgurjer371@gmail.com';
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
					$this->Flash->success(__('Bussiness Vissa has been verified.'));
					return $this->redirect(['action' => 'bussiness-vissa-view-published']);
				}
				$this->Flash->error(__('Unable to verify Bussiness Vissa.'));
			}
			else if(isset($this->request->data['bussiness_vissa_notapprove_submit']))
			{
				
				$id=$this->request->data['bussiness_vissa_notapprove_submit'];
				$Business_Visas=$this->BusinessVisas->get($id , ['contain'=>['Companies'=>['Users']]]);
			
				$remarks=$this->request->data['verify_remarks'];
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='draft';
				$this->request->data['authorised_remarks']='';
				 
				$bussiness_vissa_data = $this->BusinessVisas->patchEntity($Business_Visas, $this->request->data);
				
			if($this->BusinessVisas->save($bussiness_vissa_data))
				{
					   
					foreach($bussiness_vissa_data->company['users'] as $business_visa)
					{
						
						$email = new Email();
						$email->transport('SendGrid');
						$mailsendtomember=$business_visa['member_name'];
						$mailsendtoemail=$business_visa['email'];
						$sub="Bussiness Vissa is Not Varified";
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
								->template('bussiness_vissa_not_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$mailsendtomember,'remarks'=>$remarks]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
					}
					
					$this->Flash->success(__('Bussiness Vissa has been not verify.'));
					return $this->redirect(['action' => 'bussiness-vissa-view-published']);
				}
				$this->Flash->error(__('Unable to not verify Bussiness Vissa.'));
			}
		}
		
		
		$MasterCompanies=$this->BusinessVisas->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('BusinessVisas'));
		 
    }
	
	
	public function businessVisaApprove()
    {
       $this->viewBuilder()->layout('index_layout');
       $business_vissas = $this->BusinessVisas->find()->where(['BusinessVisas.payment_status'=>'success','status'=>'verified'])->contain(['Companies']);
	    $this->set(compact('business_vissas'));
		
    }
	 
	public function bussinessVissaApproveView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$BusinessVisas = $this->BusinessVisas->newEntity();
	  
		if(isset($this->request->data['view']))
		{ 
			$business_vissa_id=$this->request->data['view'];;
			$business_vissas = $this->BusinessVisas->find()->where(['BusinessVisas.id'=>$business_vissa_id,'status'=>'verified'])->contain(['Companies'])->toArray();
			
			
			$verify_bys=$business_vissas[0]->verify_by; 
			$Users_verifys=$this->BusinessVisas->Companies->Users->get($verify_bys);
			$verify_member=$Users_verifys->member_name; 
			$membertypes=$this->BusinessVisas->CompanyMemberTypes->find()->where(['company_id'=>$company_id]);
			foreach($membertypes as $membertype){
				$membertype=$membertype['master_member_type_id'];
			}
			$company_id=$business_vissas[0]->company_id; 
			$DocumentCheck=$this->BusinessVisas->Companies->find()
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('business_vissas','DocumentCheck','verify_member','membertype'));
		}
		
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['bussiness_vissa_approve_submit']))
			{
				 
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['bussiness_vissa_approve_submit'];
				$BusinessVisas=$this->BusinessVisas->get($id,['contain'=>['Companies'=>['Users']]]);
				$consignee=$BusinessVisas->consignee;
				$this->request->data['status']='approved';
				//$this->request->data['approve']=1;
				$this->request->data['approve_by']=$user_id; 
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']=''; 
				
				$coo_verification_code=uniqid(); 
				$this->request->data['bs_verification_code']=$coo_verification_code; 
				
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$query = $this->BusinessVisas->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $BusinessVisas = $this->BusinessVisas->patchEntity($BusinessVisas, $this->request->data);
				 $email_to=$BusinessVisas->company->users[0]->email; 
				 $member_name=$BusinessVisas->company->users[0]->member_name;
				 
				 $Users= $this->BusinessVisas->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				 
				
				//pr($CertificateOrigins); exit;
				if($this->BusinessVisas->save($BusinessVisas))
				{
					
					  $sub="Your Bussiness Vissa is approved";
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
										->template('bussiness_vissa_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'consignee'=>$consignee]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Bussiness Vissa has been approved.'));
					return $this->redirect(['action' => 'business_visa_approve']);
				}
				$this->Flash->error(__('Unable to approved Bussiness Vissa.'));
			}
			else if(isset($this->request->data['bussiness_vissa_notapprove_submit']))
			{
				
				$id=$this->request->data['bussiness_vissa_notapprove_submit'];
				$BusinessVisas=$this->BusinessVisas->get($id);
				
				$this->request->data['approve']=2;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
				 $BusinessVisas = $this->BusinessVisas->patchEntity($BusinessVisas, $this->request->data);
				if($this->BusinessVisas->save($BusinessVisas))
				{
					$this->Flash->success(__('Bussiness Vissa has been not approved.'));
					return $this->redirect(['action' => 'business_visa_approve']);
				}
				$this->Flash->error(__('Unable to not approved Bussiness Vissa.'));
			}
		}
		
		$MasterCompanies=$this->BusinessVisas->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('BusinessVisas'));
		 
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function BussinessVissaViewList() 
	{
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->BusinessVisas->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$BusinessVisas = $this->BusinessVisas->newEntity();
		
		 if($role_id==1 or $role_id==4 ){
			 $bussiness_vissas = $this->BusinessVisas->find()->where(['status'=>'approved'])->contain(['Companies'])->order(['BusinessVisas.origin_no'=>'DESC']);
		   }else{
			  $bussiness_vissas = $this->BusinessVisas->find()->where(['status'=>'approved','company_id'=>$company_id])->contain(['Companies'])->order(['BusinessVisas.origin_no'=>'DESC']); 
		   }  
		   
       $this->set(compact('bussiness_vissas','role_id'));
	}
	
	
	
	
	public function BussinessVissaViewListexcel() 
	{
		
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->BusinessVisas->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$BusinessVisas = $this->BusinessVisas->newEntity();
		
		 if($role_id==1 or $role_id==4 ){
			 $bussiness_vissas = $this->BusinessVisas->find()->where(['status'=>'approved'])->contain(['Companies'])->order(['BusinessVisas.origin_no'=>'DESC']);
		   }else{
			  $bussiness_vissas = $this->BusinessVisas->find()->where(['status'=>'approved','company_id'=>$company_id])->contain(['Companies'])->order(['BusinessVisas.origin_no'=>'DESC']); 
		   }  
       $this->set(compact('bussiness_vissas','role_id'));
	
		
			
			
			
		$sr_no=0;
		$_header=['S.No.', 'Company/Organisation','Origin No','Company Manufacture', 'Visitor Name','Visit Country', 'Visit Month', 'Visit Reason.', 'Passport No','Issue Date', 'Issue Place',' Expiry Date'];
		foreach($bussiness_vissas as $bussiness_vissa) 
		{	
			
			$contain[]=[ ++$sr_no, $bussiness_vissa['company']['company_organisation'], $bussiness_vissa['origin_no'], $bussiness_vissa['company_manufacture'], $bussiness_vissa['visitor_name'], $bussiness_vissa['visit_country'],$bussiness_vissa['visit_month'],$bussiness_vissa['visit_reason'],$bussiness_vissa['passport_no'],date('d-m-Y', strtotime($bussiness_vissa['issue_date'])),$bussiness_vissa['issue_place'],date('d-m-Y', strtotime($bussiness_vissa['expiry_date']))];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Bussiness Vissa View List.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
	
	
	
	
	
	
	
	}
	
	
	
	
	
	
	
	public function bussinessVissaPerformaView(){
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		$user_id=$this->Auth->User('id');
		$certificate_origin_id=$this->request->data['view'];
		$bussiness_vissas = $this->BusinessVisas->find()->where(['BusinessVisas.id'=>$certificate_origin_id,'status'=>'approved'])->contain(['Companies'])->toArray();
		$approved_by=$bussiness_vissas[0]['approve_by'];
		$CertificateOriginAuthorizeds=$this->BusinessVisas->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		$membertypes=$this->BusinessVisas->CompanyMemberTypes->find()->where(['company_id'=>$company_id]);
			foreach($membertypes as $membertype){
				$membertype=$membertype['master_member_type_id'];
			}
		$this->set(compact('bussiness_vissas','CertificateOriginAuthorizeds','membertype'));
		$MasterCompanies=$this->BusinessVisas->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		
	}
	
	
	
	
	
	public function businessvissaView()
    {
		$this->viewBuilder()->layout('index_layout');
		$certificate_origin_id=$this->request->data['view'];
		$business_vissas = $this->BusinessVisas->find()->where(['BusinessVisas.id'=>$certificate_origin_id,'status'=>'approved'])->contain(['Users'])->toArray();
		
		$this->set(compact('business_vissas'));
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
    /**
     * Edit method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $businessVisa = $this->BusinessVisas->get($id, [
            'contain' => ['Companies']
        ]);
		$company_id=$businessVisa->company->id; 
         if ($this->request->is('post')) {
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['issue_date']=date('Y-m-d',strtotime($this->request->data['issue_date']));
			$this->request->data['expiry_date']=date('Y-m-d',strtotime($this->request->data['expiry_date']));
            $businessVisa = $this->BusinessVisas->patchEntity($businessVisa, $this->request->data);
			
            if ($this->BusinessVisas->save($businessVisa)) {
                $this->Flash->success(__('The business visa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The business visa could not be saved. Please, try again.'));
            }
        }
        $members = $this->BusinessVisas->Companies->find()->select(['id','company_organisation'])->toArray();
        $this->set(compact('businessVisa', 'members','company_id'));
        $this->set('_serialize', ['businessVisa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Business Visa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $businessVisa = $this->BusinessVisas->get($id);
        if ($this->BusinessVisas->delete($businessVisa)) {
            $this->Flash->success(__('The business visa has been deleted.'));
        } else {
            $this->Flash->error(__('The business visa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

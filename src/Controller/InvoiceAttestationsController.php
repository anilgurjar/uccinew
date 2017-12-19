<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use UsersController;
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');

require_once(ROOT . DS  .'vendor' . DS  . 'pdfs' . DS . 'fpdf.php');
require_once(ROOT . DS  .'vendor' . DS  . 'pdfs' . DS . 'src' . DS . 'autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use setasign\Fpdi\Fpdi;


/**
 * InvoiceAttestations Controller
 *
 * @property \App\Model\Table\InvoiceAttestationsTable $InvoiceAttestations
 */
class InvoiceAttestationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index','CooSendEmail','invoiceAttestationApproved','success','failure']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $invoiceAttestations = $this->paginate($this->InvoiceAttestations);

        $this->set(compact('invoiceAttestations'));
        $this->set('_serialize', ['invoiceAttestations']);
    }
	
	
	///filter data start
	public function filterdata(){
		$exporter=$this->request->query['exporter']; 
		$originno=$this->request->query['originno'];
		$datefrom=$this->request->query['datefrom']; 
		$dateto=$this->request->query['dateto'];
		
		$condition['status']='approved';
		if(!empty($exporter)){
			$condition['exporter Like']='%'.$exporter.'%';
		}
		 if( !empty($originno)){
			$condition['origin_no']=$originno;
		}
		
		if(!empty($datefrom) && !empty($dateto)){
			$datefrom=date('y-m-d', strtotime($datefrom));
			$dateto=date('y-m-d', strtotime($dateto));
			$condition['date_current >=']=$datefrom;
			$condition['date_current <=']=$dateto;
		}
		
		
		$Users=$this->InvoiceAttestations->find()->where($condition)
				->order(['InvoiceAttestations.origin_no'=>'DESC']);
			
		
		$this->set(compact('Users'));
		
	}
	
	///filter data end
	
	
	
	
	
	
	
	
	
	//invoice view start
	public function InvoiceAttestationViewList() 
	{
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->InvoiceAttestations->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$InvoiceAttestations = $this->InvoiceAttestations->newEntity();
		
		
		
		
		if(isset($this->request->data['view']))
		{ 
		
			 $invoice_attestaions=$this->request->data['view']; 
			 $invoiceattestations=$this->InvoiceAttestations->get($invoice_attestaions);
			
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$invoice_attestaions.'/'.$invoiceattestations['file_name'];
				
				$current_date=$invoiceattestations->date_current;
				$approved_by=$invoiceattestations->approved_by;
				
				$CertificateOriginAuthorizeds=$this->InvoiceAttestations->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
				
				$signature=$CertificateOriginAuthorizeds[0]->signature;
				
				$current_date = date('d.m.Y',strtotime($current_date));

				if(date('m',strtotime($current_date)) < 4)
				{
					$from_year=(date('Y',strtotime($current_date))-1);
					$to_year=date('y',strtotime($current_date));
				}
				else
				{
					$from_year=date('Y',strtotime($current_date));
					$to_year=(date('y',strtotime($current_date))+1);
				}
			
				
				$origin_no=$invoiceattestations->origin_no;
				$ucci_invoice_number="UCCI/INV/".$from_year."-".$to_year."/".$origin_no."";
				// initiate FPDI
					$pdf = new Fpdi();
					// add a page
					//$pdf->AddPage();
					// set the source file
					$pageCount =$pdf->setSourceFile($file_path);
					 //$this->setSourceFile($filess);
						for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
							$pageId = $pdf->ImportPage($pageNo);
							$s = $pdf->getTemplatesize($pageId);
							$pdf->AddPage($s['orientation'], $s);
							//$pdf->useTemplate($pageId, 1, 1, 180);
							$pdf->useTemplate($pageId, true);
							//$pdf->useTemplate($pageId,0,0);
							//$pdf->useImportedPage($pageId);
							//$pdf->Image('img/coo_signature/coo_authorized_1.png',150,200,20);
						$pdf->SetFont('Arial','I',8);
						$pdf->Cell(0,10,$pdf->Image($signature,15,250,20));
						$pdf->Cell(0,10,$pdf->Image('img/coo_invoice_attestation/seal.png',25,238,25));
						$pdf->SetTextColor(255,0,0);
						$pdf->SetFont('Arial','I',10);
						$pdf->Text(18,268,'ATTESTED');
						$pdf->Text(12,272,$ucci_invoice_number);
				
							//$pdf->Image('img/coo_signature/2.png',150,200,20);
						
						}
					// import page 1
					//$tplIdx = $pdf->importPage(1);
					// use the imported page and place it at position 10,10 with a width of 100 mm
					//$pdf->useTemplate($tplIdx, 5, 5, 200);

					// now write some text above the imported page
					$pdf->SetFont('Helvetica');
					$pdf->SetTextColor(255, 0, 0);
					$pdf->SetXY(30, 30);
					// Page footer
					

					
					$pdf->Output();
		}
		
		
		
		
		 if($role_id==1 or $role_id==4 ){
			 $invoice_attestation = $this->InvoiceAttestations->find()->where(['status'=>'approved'])->order(['InvoiceAttestations.origin_no'=>'DESC']);
		   }else{
			  $invoice_attestation = $this->InvoiceAttestations->find()->where(['status'=>'approved','company_id'=>$company_id])->order(['InvoiceAttestations.origin_no'=>'DESC']); 
		   }  
       $this->set(compact('invoice_attestation','role_id'));
	}
	
	
	
	
	public function InvoiceAttestationViewListexcel() 
	{
		
		$company_id=$this->Auth->User('company_id'); 
		
		$Companies=$this->InvoiceAttestations->Companies->get($company_id);
		
		$role_id=$Companies->role_id;
		$InvoiceAttestations = $this->InvoiceAttestations->newEntity();
		
		 if($role_id==1 or $role_id==4 ){
			 $invoice_attestation = $this->InvoiceAttestations->find()->where(['status'=>'approved'])->order(['InvoiceAttestations.origin_no'=>'DESC']);
		   }else{
			  $invoice_attestation = $this->InvoiceAttestations->find()->where(['status'=>'approved','company_id'=>$company_id])->order(['InvoiceAttestations.origin_no'=>'DESC']); 
		   }  
		  
       $this->set(compact('invoice_attestation','role_id'));
	
		
			
			
			
		$sr_no=0;
		$_header=['S.No.', 'Exporter', 'Origin No', 'Date', 'Consignee', 'Invoice No.', 'Invoice Date','Manufacturer', 'Despatched by'];
		foreach($invoice_attestation as $invoice_attestation) 
		{	
			if($invoice_attestation['despatched_by']==0){ 
			$despatched_by='Sea'; 
			}else if( $invoice_attestation['despatched_by']==1 ){
				$despatched_by= 'Air'; 
			}
			else{ 
				$despatched_by= 'Road';
			} 
			$contain[]=[ ++$sr_no, $invoice_attestation['exporter'], $invoice_attestation['origin_no'], $invoice_attestation['date_current'], $invoice_attestation['consignee'], $invoice_attestation['invoice_no'], date('d-m-Y', strtotime($invoice_attestation['invoice_date'])), $invoice_attestation['manufacturer'], 
			$despatched_by ];
		}
		
		$_serialize = 'contain';
		
   		$this->response->download('Invoice Attestation View List.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('_header', 'contain', '_serialize'));
	
	}
	
	
	//invoice view end
	
	
	
	
	public function InvoiceAttestationPerformaView(){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$certificate_origin_id=$this->request->data['view'];
		$invoice_attestaions = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$certificate_origin_id,'status'=>'approved'])->contain(['Companies'])->toArray();
		$approved_by=$invoice_attestaions[0]->approved_by;
	
		
		$CertificateOriginAuthorizeds=$this->InvoiceAttestations->CertificateOriginAuthorizeds->find()->where(['user_id'=>$approved_by])->contain(['Users'])->toArray();
		
		$this->set(compact('invoice_attestaions','CertificateOriginAuthorizeds'));
		$MasterCompanies=$this->InvoiceAttestations->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		
	}
	
	
	
	
	
	
	
	//view for approve screen
	
	public function InvoiceAttestationApprove()
    {
       $this->viewBuilder()->layout('index_layout');
       $invoice_attestations = $this->InvoiceAttestations->find()->where(['payment_status'=>'success','status'=>'verified']);
       $this->set(compact('invoice_attestations'));
		
    }
	 
	public function InvoiceAttestationApproveView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$InvoiceAttestations = $this->InvoiceAttestations->newEntity();
	  
		if(isset($this->request->data['view']))
		{ 
			$invoice_attestation_id=$this->request->data['view'];
			$invoice_attestations = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$invoice_attestation_id,'status'=>'verified'])->contain(['Companies'])->toArray();
			
			
			$verify_bys=$invoice_attestations[0]->verify_by; 
			$Users_verifys=$this->InvoiceAttestations->Companies->Users->get($verify_bys);
			$verify_member=$Users_verifys->member_name; 
			$company_id=$invoice_attestations[0]->company_id; 
			$DocumentCheck=$this->InvoiceAttestations->Companies->find()
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('invoice_attestations','DocumentCheck','verify_member'));
		}
		
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['invoice_attestation_approve_submit']))
			{
				 
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['invoice_attestation_approve_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id,['contain'=>['Companies'=>['Users']]]);
				$consignee=$InvoiceAttestations->consignee;
				$this->request->data['status']='approved';
				//$this->request->data['approve']=1;
				$this->request->data['approved_by']=$user_id; 
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']=''; 
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$query = $this->InvoiceAttestations->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				 $email_to=$InvoiceAttestations->company->users[0]->email; 
				 $member_name=$InvoiceAttestations->company->users[0]->member_name;
				 
				 $Users= $this->InvoiceAttestations->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				
				if($this->InvoiceAttestations->save($InvoiceAttestations))
				{
					
					  $sub="Your Invoice Attestation is approved";
					  $from_name="UCCI";
					  $email_to=trim($email_to,' ');
					  //$email_to="anilgurjer371@gmail.com";
					  //$email_to="acc.uccisec@gmail.com";
					  if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('invoice_attestation_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'consignee'=>$consignee]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Invoice Attestation has been approved.'));
					return $this->redirect(['action' => 'invoice_attestation_approve']);
				}
				$this->Flash->error(__('Unable to approved Invoice Attestation.'));
			}
			else if(isset($this->request->data['invoice_attestation_notapprove_submit']))
			{
				
				$id=$this->request->data['invoice_attestation_notapprove_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id);
				
				//$this->request->data['id']=$this->request->data['certificate_notapprove_submit'];
				$this->request->data['approve']=2;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
				 $InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				if($this->InvoiceAttestations->save($InvoiceAttestations))
				{
					$this->Flash->success(__('Invoice Attestation has been not approved.'));
					return $this->redirect(['action' => 'invoice_attestation_approve']);
				}
				$this->Flash->error(__('Unable to not approved Invoice Attestation.'));
			}
		}
		
		$MasterCompanies=$this->InvoiceAttestations->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('InvoiceAttestations'));
		 
    }
	
	//view for approve screen
	
	
	
	
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
     * View method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('invoiceAttestation', $invoiceAttestation);
        $this->set('_serialize', ['invoiceAttestation']);
    }
	
	
	// function for view attestation for draft view start
	
	
	
	
	public function invoiceAttestationDraftView()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$user_id=$this->Auth->User('id'); 
		$Companies=$this->InvoiceAttestations->Companies->get($company_id);
		$role_id=$Companies->role_id;
		
		if($this->request->is('post')) 
		{
					
			if(isset($this->request->data['invoice_attestation_move_submit']))
			{
				
				$coo_id=$this->request->data['invoice_attestation_move_submit'];
				$InvoiceAttestations = $this->InvoiceAttestations->get($coo_id);
		
				$this->request->data['id']=$this->request->data['invoice_attestation_move_submit'];
				$this->request->data['reason_move']=$this->request->data['reason_move'.$coo_id];
				$this->request->data['move_by']=$user_id;
				$this->request->data['payment_status']='success';
				$this->request->data['status']='published';
				
				$InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				
				$this->InvoiceAttestations->save($InvoiceAttestations);
				
			}
		
		}	
		
		
		if($role_id==1 || $role_id==4){	
			$certificate_origins = $this->InvoiceAttestations->find()->where(['status'=>'draft']);
		}
		else{
			$certificate_origins = $this->InvoiceAttestations->find()->where(['company_id'=>$company_id,'status'=>'draft']);
		}
		
		$this->set(compact('certificate_origins','role_id'));
	}
	
	
	
	
	
	
	

	public function attestationDraftView($id = null){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$InvoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => []
        ]);
		$invoice_attestations = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$id])->contain(['Companies'])->toArray();
		foreach($invoice_attestations as $invoice_attestation){
			$oldimage=$invoice_attestation['invoice_attachment'];
			$oldfile_name=$invoice_attestation['file_name'];
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			if(isset($this->request->data['invoice_attestation_draft']))
			{
				
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['company_id']=$company_id;
				$files=$this->request->data['file']; 
				$file_name=$this->request->data['file'][0]['name']; 
			
				
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
					$this->request->data['file_name']=$file_name;
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
					$this->request->data['file_name']=$oldfile_name;
				}
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				
				
				
				
				$invoice_attestation = $this->InvoiceAttestations->patchEntity($invoice_attestation, $this->request->data);
				if ($data=$this->InvoiceAttestations->save($invoice_attestation))
				{ 	
						$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
						$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
						foreach($files as $file){
						  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

						}
					
					$last_insert_id=$data['id'];
					$this->Flash->success(__('Your certificate origin good has been saved.'));
					return $this->redirect(['action' => 'attestation-draft-view',$last_insert_id]);
					 
				}
				
			}
			else if(isset($this->request->data['invoice_attestation_publish']))
			{ 
				 
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['company_id']=$company_id;
				$files=$this->request->data['file'];
				$file_name=$this->request->data['file'][0]['name']; 

				$this->request->data['file_name']=$file_name;

			

				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
					$this->request->data['file_name']=$oldfile_name;
				}
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				$this->request->data['status']='draft';
				$this->request->data['coo_email']='yes';
				$this->request->data['verify_remarks']='';
				
				
				
				$invoice_attestation = $this->InvoiceAttestations->patchEntity($invoice_attestation, $this->request->data);
				
				if ($data=$this->InvoiceAttestations->save($invoice_attestation))
				{ 
					$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
					foreach($files as $file){
					  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
					}
					 
				/* if($payment_type=="couponcode"){
					
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
				}else{ */
					
					$paymented=$this->InvoiceAttestations->find('all')
						->where(['id'=>$id,'payment_status'=>'success'])->count();
					if($paymented>0){
						$query = $this->InvoiceAttestations->query();
							$query->update()
							->set(['status' => 'published'])
							->where(['id' => $data['id']])
							->execute();

						$last_insert_id=$data['id'];
					
						//return $this->redirect('https://test.payu.in/_payment');
						return $this->redirect(['action' => 'invoice-attestation-draft-view']);
					}
					else{
						//return $this->redirect(['action' => 'paymentTest',$data['id']]);
						return $this->redirect(['action' => 'payment',$data['id']]);
						$query = $this->InvoiceAttestations->query();
							$query->update()
							->set(['status' => 'published','payment_status'=>'success'])
							->where(['id' => $data['id']])
							->execute();
							return $this->redirect(['action' => 'invoice-attestation-draft-view']);
					
					}
				//}	
					
					$this->Flash->success(__('Your certificate origin good has been saved.'));
				}
			
			}
        }
			
        $this->set('invoice_attestation', $invoice_attestation);
		$Users=$this->InvoiceAttestations->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
		
		
	}
	// function for view attestation for draft view end
	
	
	
	
	
	//payment start 
	public function paymentTest($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->InvoiceAttestations->Users->get($user_id);
		//$CertificateOrigins=$this->CertificateOrigins->get($id,['contain'=>['CertificateOriginGoods']]);
		
			//$sul='http://localhost/uccinew/InvoiceAttestations/success';
			//$furl='http://localhost/uccinew/InvoiceAttestations/failure';
			
			//$sul='http://ucciudaipur.com/app/InvoiceAttestations/success';
			//$furl='http://ucciudaipur.com/app/InvoiceAttestations/failure';
			
			$sul='http://ucciudaipur.com/uccinew/InvoiceAttestations/success';
			$furl='http://ucciudaipur.com/uccinew/InvoiceAttestations/failure';
			
		$InvoiceAttestations = $this->InvoiceAttestations->find()
			->where(['InvoiceAttestations.id'=>$id]);
			
		
		$this->set(compact('Users','InvoiceAttestations','id','sul','furl'));
	}
	
	public function payment($id=null)
    {
		
		$this->viewBuilder()->layout('');
		// $user_id=$this->Auth->User('company_id');
		 $user_id=$this->Auth->User('id'); 
		$Users=$this->InvoiceAttestations->Users->get($user_id);
		//$InvoiceAttestations=$this->InvoiceAttestations->get($id]);
		
			//$sul='http://localhost/uccinew/InvoiceAttestations/success';
			//$furl='http://localhost/uccinew/InvoiceAttestations/failure';
			
			$sul='http://ucciudaipur.com/app/InvoiceAttestations/success';
			$furl='http://ucciudaipur.com/app/InvoiceAttestations/failure';
			
			
			$InvoiceAttestations = $this->InvoiceAttestations->find()
			->where(['InvoiceAttestations.id'=>$id]);
			
		$this->set(compact('Users','InvoiceAttestations','id','txnid','sul','furl'));
	}
	
	
	//payment end
	
	
	
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
		
		$query = $this->InvoiceAttestations->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status,'status'=>'published'])
		->where(['id' => $udf1])
		->execute();
		 $this->set(compact('status','amount','id','txnid','sul'));	
		
	// mail should secretary 
	
		//$companies= $this->InvoiceAttestations->Companies->find()->where(['id'=>$udf1]);
		/*  $email = new Email();
		 $email->transport('SendGrid');
		$sub='Secretary';
		$sendmails= $this->InvoiceAttestations->Companies->find()->where(['role_id'=>1 ])->orwhere(['role_id'=>4])->contain(['Users']);
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
		 
		 
		 $InvoiceAttestations=$this->InvoiceAttestations->get($udf1);
		 
		 
		 $company_id_coo=$InvoiceAttestations['company_id']; 
		 $coo_email=$InvoiceAttestations['coo_email'];
		 $payment_amount=$InvoiceAttestations['payment_amount'];
		 $payment_tax_amount=$InvoiceAttestations['payment_tax_amount'];
	
	if($coo_email=='yes'){
		 
		  $Companies_data=$this->InvoiceAttestations->Companies->get($company_id_coo,['contain'=>'Users']);
		
		 $member_name=$Companies_data->users[0]->member_name;
		 $email_to=$Companies_data->users[0]->email;
		 
		 $MasterTaxations= $this->InvoiceAttestations->MasterTaxations->find()->where(['tax_flag'=>1,'nmef'=>1])->contain(['MasterTaxationRates'])->toArray();
		
			$MemberReceipts=$this->InvoiceAttestations->MemberReceipts->newEntity();

			$GeneralReceiptPurposes=$this->InvoiceAttestations->MemberReceipts->GeneralReceiptPurposes->newEntity();
				
				$fetch_member_receipt=$this->InvoiceAttestations->MemberReceipts->find('all')->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
				if(!empty($fetch_member_receipt)){
					$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
				}else{
					$receipt_no='0001';
				}
				$amount=$payment_amount+$payment_tax_amount;
				$act_amount=$amount;
				$this->request->data['amount_type']='Payumoney';
				$this->request->data['narration']='Invoice Attestation';
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
				
				$MemberReceipts = $this->InvoiceAttestations->MemberReceipts->patchEntity($MemberReceipts, $this->request->data);
				
				$GeneralReceiptPurposes->purpose_id=28;
				$GeneralReceiptPurposes->quantity=1;
				$GeneralReceiptPurposes->amount=$payment_amount;
				$GeneralReceiptPurposes->total=$payment_amount;
				$MemberReceipts->general_receipt_purposes[0]=$GeneralReceiptPurposes;
				
				$i=0;
				foreach($MasterTaxations as $co_tax_amount){
					    $total=0;
						$TaxAmounts=$this->InvoiceAttestations->MemberReceipts->TaxAmounts->newEntity();
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
				
				$data_save=$this->InvoiceAttestations->MemberReceipts->save($MemberReceipts);

				//pr($data_save); 
				//	$receipt_id=1872;

		 	    $options = new Options();
				$options->set('defaultFont', 'Lato-Hairline');
				$dompdf = new Dompdf($options);
				$dompdf = new Dompdf();
		
				$master_member_receipt=$this->InvoiceAttestations->MemberReceipts->find()->where(['receipt_id'=> $data_save->receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
				return $q->select(['id','company_organisation','city']);
				},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();

				$MasterCompanies=$this->InvoiceAttestations->MemberReceipts->MasterCompanies->find();
				//pr($master_member_receipt);
				foreach($master_member_receipt as $data)
				{			
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
			file_put_contents('attestation_payment_receipt.pdf', $output);	
			
			$attachments='';
			$attachments[]='attestation_payment_receipt.pdf';
			$sub='Payment Successfully submitted';
				$from_name='UCCI';
						$email = new Email();
						$email->transport('SendGrid');
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('invoice_attestation_payment_success')
										->emailFormat('html')
										->viewVars(['member_name'=>ucwords($member_name),'amount'=>$act_amount])
										->attachments($attachments);
										
									   $email->send();
									
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
							
			$query = $this->InvoiceAttestations->query();
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
		$query = $this->InvoiceAttestations->query();
		$query->update()
		->set(['transaction_id' => $txnid,'payment_status'=>$status])
		->where(['id' => $udf1])
		->execute();
		
		 $this->set(compact('status','amount','udf1','txnid','try'));	
		
	}
 
	
	
	
	
	
	
	
	public function invoiceattestAtionViewPublished()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->InvoiceAttestations->Companies->get($company_id);
		$role_id=$Companies->role_id;
		if($role_id==1 || $role_id==4){	
			$certificate_origins =$this->InvoiceAttestations->find()->where(['status'=>'published','payment_status'=>'success']);
		}
		else{
			$certificate_origins=array();
		}		
		$this->set(compact('certificate_origins'));
	}
 
	public function invoiceattestationPublishedView()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$Users=$this->InvoiceAttestations->Users->get($user_id);
		$regard_member_name=$Users->member_name;
		$InvoiceAttestations_new = $this->InvoiceAttestations->newEntity();
				
		if(isset($this->request->data['view']))
		{ 
			$certificate_origin_id=$this->request->data['view'];;
			$InvoiceAttestations = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$certificate_origin_id,'status'=>'published'])->contain(['Companies'])->toArray();
			$company_id=$InvoiceAttestations[0]->company_id;  
			$DocumentCheck=$this->InvoiceAttestations->Companies->find('all')
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('InvoiceAttestations','DocumentCheck'));
		}
		if($this->request->is('post')) 
		{  	
			if(isset($this->request->data['invoice_attestation_approve_submit']))
			{
				
				$email = new Email();
				$email->transport('SendGrid');
				
				$id=$this->request->data['invoice_attestation_approve_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id,['contain'=>['Companies'=>['Users']]]);
				
				$exporter_name=$InvoiceAttestations->exporter;
				
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='verified';
				$this->request->data['coo_verify_email']='yes';
				
				
				
				$query = $this->InvoiceAttestations->find();
 				//pr($this->request->data); exit;
				$InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				/*$email_to=$CertificateOrigins->company->users[0]->email; 
				$member_name=$CertificateOrigins->company->users[0]->member_name;
				$Users= $this->CertificateOrigins->Users->get($user_id);
				$regards_member_name=$Users->member_name;*/

			
				if($this->InvoiceAttestations->save($InvoiceAttestations))
				{ 
					$certificates_data = json_encode($id);
					$certificates_data = base64_encode($certificates_data);
					
					//$certificates_data = json_encode($certificates_data);
					

					$authorise_person_mails=$this->InvoiceAttestations->CertificateOriginAuthorizeds->find()->contain(['Users']);
				foreach($authorise_person_mails as $authorise_person_mail){
					$emailperson_id=$authorise_person_mail['user']->id;
					$emailperson=$authorise_person_mail['user']->member_name;
					$emailsend=$authorise_person_mail['user']->email;
					
					 $emailperson_id_new = json_encode($emailperson_id);
				     $emailperson_id_new = base64_encode($emailperson_id_new);
					
					 //$url="http://localhost/uccinew/invoice-attestations/invoice_attestation_approved/".$certificates_data."/".$emailperson_id_new."";
					 
				//$url="http://www.ucciudaipur.com/uccinew/invoice-attestations/invoice_attestation_approved/".$certificates_data."/".$emailperson_id_new.""; 
					
				$url="http://www.ucciudaipur.com/app/invoice-attestations/invoice_attestation_approved/".$certificates_data."/".$emailperson_id_new.""; 
					
					$sub="Invoice Attestation is Varified";
					$from_name="UCCI";
					$email_to=trim($emailsend,' ');
					if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('invoice_attestation_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$emailperson,'url'=>$url,'exporter_name'=>$exporter_name]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
				}	
				
					$this->Flash->success(__('Invoice Attestation has been verified.'));
					return $this->redirect(['action' => 'invoice-attestation-view-published']);
				}
				$this->Flash->error(__('Unable to verify Invoice Attestation.'));
			}
			else if(isset($this->request->data['invoice_attestation_notapprove_submit']))
			{
				$id=$this->request->data['invoice_attestation_notapprove_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id , ['contain'=>['Companies'=>['Users']]]);
				
				$remarks=$this->request->data['verify_remarks'];
				$this->request->data['verify_by']=$user_id;
				$this->request->data['verify_on']=date('Y-m-d h:i:s');
				$this->request->data['status']='draft';
				$this->request->data['authorised_remarks']='';
				 
				$InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				$email = new Email();
				$email->transport('SendGrid');
			if($this->InvoiceAttestations->save($InvoiceAttestations))
				{
					
					foreach($InvoiceAttestations['company']['users'] as $InvoiceAttestation)
					{
						$mailsendtomember=$InvoiceAttestation['member_name'];
						$mailsendtoemail=$InvoiceAttestation['email'];
						$sub="Certificate of origin is Not Varified";
						$from_name="UCCI";
						$email_to=trim($mailsendtoemail,' ');
						if(!empty($email_to)){		
						try {
							$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('uccisec@hotmail.com')
								->subject($sub)
								->profile('default')
								->template('invoice_attestation_not_varify')
								->emailFormat('html')
								->viewVars(['member_name'=>$mailsendtomember,'regard_member_name'=>$regard_member_name,'remarks'=>$remarks]);
								$email->send();
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
					}	
					$this->Flash->success(__('Invoice Attestation has been not verify.'));
					return $this->redirect(['action' => 'invoice-attestation-view-published']);
				}
				$this->Flash->error(__('Unable to not verify Invoice Attestation.'));
			}
		}
		
		$MasterCompanies=$this->InvoiceAttestations->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set(compact('InvoiceAttestations_new'));
		 
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
		
        $invoiceAttestation = $this->InvoiceAttestations->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['company_id']=$company_id;
			
			
			
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			$this->request->data['status'] = 'draft';
			$files=$this->request->data['file']; 
			$file_name=$this->request->data['file'][0]['name']; 
			$this->request->data['file_name']=$file_name;
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			
			$invoiceAttestation = $this->InvoiceAttestations->patchEntity($invoiceAttestation, $this->request->data);
			
            if ($data=$this->InvoiceAttestations->save($invoiceAttestation)) 
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				}
				$last_insert_id=$data['id'];
				$this->Flash->success(__('The invoice attestation has been saved.'));
				return $this->redirect(['action' => 'attestationDraftView',$last_insert_id]);
				exit;
			} else {
                $this->Flash->error(__('The invoice attestation could not be saved. Please, try again.'));
            }
        }
       $Users=$this->InvoiceAttestations->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		
       $this->set(compact('invoiceAttestation', 'companies'));
        $this->set('_serialize', ['invoiceAttestation']);
		$this->set('company_organisation' , $Users[0]->company_organisation);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceAttestation = $this->InvoiceAttestations->patchEntity($invoiceAttestation, $this->request->data);
            if ($this->InvoiceAttestations->save($invoiceAttestation)) {
                $this->Flash->success(__('The invoice attestation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice attestation could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InvoiceAttestations->Companies->find('list');
        $this->set(compact('invoiceAttestation', 'companies'));
        $this->set('_serialize', ['invoiceAttestation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceAttestation = $this->InvoiceAttestations->get($id);
        if ($this->InvoiceAttestations->delete($invoiceAttestation)) {
            $this->Flash->success(__('The invoice attestation has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice attestation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	
	
		
	public function invoiceAttestationApproved($coo_id=null,$authorized_id=null)
    {
		$this->viewBuilder()->layout('index_layout');
		
		$ids = base64_decode($coo_id);
		$ids = json_decode($ids);
		$authorized_id = base64_decode($authorized_id); 
		$authorized_id = json_decode($authorized_id);
		$user_id=$authorized_id;  
		
		
		$certificate_origin_count = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$ids,'status'=>'verified','coo_verify_email'=>'yes'])->count();
		$this->set(compact('certificate_origin_count'));
		if($certificate_origin_count>0){
			$InvoiceAttestations = $this->InvoiceAttestations->newEntity();
	  
			$invoice_attestations = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$ids,'status'=>'verified'])->contain(['Companies'])->toArray();
			
			
			$verify_bys=$invoice_attestations[0]->verify_by; 
			$Users_verifys=$this->InvoiceAttestations->Companies->Users->get($verify_bys);
			$verify_member=$Users_verifys->member_name; 
			$company_id=$invoice_attestations[0]->company_id; 
			$DocumentCheck=$this->InvoiceAttestations->Companies->find()
				->where(['id'=>$company_id,'pan_card'=>'','company_registration'=>'','ibc_code'=>''])
				->count();
			$this->set(compact('invoice_attestations','DocumentCheck','verify_member','InvoiceAttestations','certificate_origin_count'));
			
		if($this->request->is('post')) 
		{
			if(isset($this->request->data['invoice_attestation_approve_submit']))
			{
				 
				$email = new Email();
				$email->transport('SendGrid');
											
				$id=$this->request->data['invoice_attestation_approve_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id,['contain'=>['Companies'=>['Users']]]);
				$consignee=$InvoiceAttestations->consignee;
				$this->request->data['status']='approved';
				//$this->request->data['approve']=1;
				$this->request->data['approved_by']=$user_id; 
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['verify_remarks']=''; 
				$this->request->data['authorised_remarks']=''; 
				$this->request->data['coo_verify_email']='no'; 
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$query = $this->InvoiceAttestations->find();
				$origin_no=$query->select(['max_value' => $query->func()->max('origin_no')])->toArray();
				$this->request->data['origin_no']=($origin_no[0]->max_value)+1;
				
				 $InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				
				 $email_to=$InvoiceAttestations->company->users[0]->email; 
				 $member_name=$InvoiceAttestations->company->users[0]->member_name;
				 
				 $Users= $this->InvoiceAttestations->Users->get($user_id);
				
				 $regards_member_name=$Users->member_name;
				
				
				
				
				
				if($this->InvoiceAttestations->save($InvoiceAttestations))
				{
					
					  $sub="Your Invoice Attestation is approved";
					  $from_name="UCCI";
					  $email_to=trim($email_to,' ');
					  if(!empty($email_to)){		
								
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('invoice_attestation_approve')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'consignee'=>$consignee]);
										$email->send();
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
						}
								
					
					
					$this->Flash->success(__('Invoice Attestation has been approved.'));
					return $this->redirect(['action' => 'invoice_attestation_approved']);
				}
				$this->Flash->error(__('Unable to approved certificate of origin.'));
			}
			else if(isset($this->request->data['invoice_attestation_notapprove_submit']))
			{
				
				$id=$this->request->data['invoice_attestation_notapprove_submit'];
				$InvoiceAttestations=$this->InvoiceAttestations->get($id);
				
				//$this->request->data['id']=$this->request->data['certificate_notapprove_submit'];
				$this->request->data['approve']=2;
				$this->request->data['authorised_on']=date('Y-m-d h:i:s');
				$this->request->data['authorised_by']=$user_id;
				$this->request->data['status']='published';
				$this->request->data['coo_verify_email']='no'; 
				
				 $InvoiceAttestations = $this->InvoiceAttestations->patchEntity($InvoiceAttestations, $this->request->data);
				
				if($this->InvoiceAttestations->save($InvoiceAttestations))
				{
					$this->Flash->success(__('Invoice Attestation has been not approved.'));
					return $this->redirect(['action' => 'invoice_attestation_approved']);
				}
				$this->Flash->error(__('Unable to not approved Invoice Attestation.'));
			}
			
			
			
		}
			
		}else{
			
			$this->Flash->success(__('Certificate of origin has been taken action'));
			
		}
	}
	
	
	
}

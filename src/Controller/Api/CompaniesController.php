<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use App\Controller\Users;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use Cake\Mailer\Email;
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
	
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
	
	
	
	public function nonmemberwpsuccess()
	{
		
		 $company_id=$this->request->query['company_id'];
		 $status=$this->request->query['status'];
		 $txnid=$this->request->query['taxnid'];
		 
		 
		$companies= $this->Companies->get($company_id,['contain'=>['Users','CoRegistrations'=>['CoTaxAmounts']]]);
	   
		$non_member_exporter_email=$companies->non_memeber_exporter_email;
		
		if($non_member_exporter_email=='yes'){
			
				$user_ids=$companies->users[0]->id;
				$email_to=$companies->users[0]->email;
				$member_name=$companies->users[0]->member_name;
				$to=$email_to;
				$MemberReceipts=$this->Companies->MemberReceipts->newEntity();
				
				$GeneralReceiptPurposes=$this->Companies->MemberReceipts->GeneralReceiptPurposes->newEntity();
				
				$fetch_member_receipt=$this->Companies->MemberReceipts->find('all')->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
				if(!empty($fetch_member_receipt)){
					$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
				}else{
					$receipt_no='0001';
				}
			
				
				$co_tax_amounts=$companies['co_registrations'][0]->co_tax_amounts;
				$basic_amount=$companies['co_registrations'][0]->amount;
				$taxamount=$companies['co_registrations'][0]->tax_amount;
				$amount=$companies['co_registrations'][0]->total_amount;
				$this->request->data['amount_type']='Cash';
				$this->request->data['narration']='Non Member Exporters Registration Fees';
				$this->request->data['tax_applicable']='Tax';
				$this->request->data['basic_amount']=@$basic_amount;
				$this->request->data['taxamount']=@$taxamount;
				$this->request->data['amount']=@$amount;
				$this->request->data['company_id']=$company_id;
				$this->request->data['receipt_type']='general_receipt';
				$this->request->data['receipt_no']=@$receipt_no;
				$this->request->data['date_current']=date("Y-m-d");
				
				$this->request->data['general_receipt_purposes']=array();
				$this->request->data['tax_amounts']=array();
				
				$MemberReceipts = $this->Companies->MemberReceipts->patchEntity($MemberReceipts, $this->request->data);
				
				$GeneralReceiptPurposes->purpose_id=26;
				$GeneralReceiptPurposes->quantity=1;
				$GeneralReceiptPurposes->amount=$basic_amount;
				$GeneralReceiptPurposes->total=$basic_amount;
				$MemberReceipts->general_receipt_purposes[0]=$GeneralReceiptPurposes;	
				$i=0;
				
				foreach($co_tax_amounts as $co_tax_amount){
						$TaxAmounts=$this->Companies->MemberReceipts->TaxAmounts->newEntity();
						$tax_id=$co_tax_amount->tax_id;
						$tax_percentage=$co_tax_amount->tax_percentage;
						$amount=$co_tax_amount->amount;
					
						$TaxAmounts->tax_id=$tax_id;
						$TaxAmounts->tax_percentage=$tax_percentage;
						$TaxAmounts->amount=$amount;
						$MemberReceipts->tax_amounts[$i]=$TaxAmounts;
					$i++;
				}
				
			
				$data_save=$this->Companies->MemberReceipts->save($MemberReceipts);
				
	/// pdf generate 
	
				$options = new Options();
				$options->set('defaultFont', 'Lato-Hairline');
				$dompdf = new Dompdf($options);
				$dompdf = new Dompdf();
		
				$master_member_receipt=$this->Companies->MemberReceipts->find()->where(['receipt_id'=>$data_save->receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
				return $q->select(['id','company_organisation','city']);
				},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();

				$MasterCompanies=$this->Companies->MemberReceipts->MasterCompanies->find();
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
			file_put_contents('non_member_export_receipt.pdf', $output);	
			
			$attachments='';
			$attachments[]='non_member_export_receipt.pdf';
			$sub='Non Member Registration Fees';
			
				$email_to='rohitkumarjoshi43@gmail.com';
				$to=explode('@',$to);

				$password=uniqid();
				$user_save = $this->Companies->Users->newEntity();
				$this->request->data['id']=$user_ids;
				$this->request->data['username']=$to[0];
				$this->request->data['password']=$password;
				$user_save = $this->Companies->Users->patchEntity($user_save, $this->request->data);

					$this->Companies->Users->save($user_save);
					$from_name='UCCI';
						$email = new Email();
						$email->transport('SendGrid');
						 try {
							   $email->from(['ucciudaipur@gmail.com' => $from_name])
										->to($email_to)
										->replyTo('uccisec@hotmail.com')
										->subject($sub)
										->profile('default')
										->template('non_member_exporter')
										->emailFormat('html')
										->viewVars(['member_name'=>$member_name,'username'=>$to[0],'password'=>$password])
										->attachments($attachments);
										
									   $email->send();
									
									
									
							} catch (Exception $e) {
								
								echo 'Exception : ',  $e->getMessage(), "\n";

							} 
			
			$query = $this->Companies->query();
			$query->update()
			->set(['non_memeber_exporter_email'=>'no'])
			->where(['id' => $company_id])
			->execute();

		}
		
			$query = $this->Companies->query();
			$query->update()
			->set(['payment_status' => $status,'transaction_id'=>$txnid])
			->where(['id' => $company_id])
			->execute();

		 
		exit;
		
		
		
	}	
	
	public function nonmemberwpfail()
	{
		$company_id=$this->request->query['company_id'];
		$status=$this->request->query['status'];
		$txnid=$this->request->query['taxnid'];
		
			 $query = $this->Companies->query();
			$query->update()
			->set(['payment_status' => $status,'transaction_id'=>$txnid,'member_flag'=>0])
			->where(['id' => $company_id])
			->execute();
		exit;
	}	
	
	
	public function nonmemberdata()
	{
		
		
		$master_financial_years=$this->Companies->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
		foreach($master_financial_years as $master_financial_year){
			$master_financial_year_id=$master_financial_year->id;
		}
		$taxations=$this->Companies->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1,'nmef'=>1])->contain(['MasterTaxationRates'])->toArray();
		$master_membership_fees=$this->Companies->MasterMembershipFees->find()->where(['member_type_id'=>3])->toArray();
		
		$success=true;
		$error='';
			$this->set(compact('success', 'error', 'taxations','master_membership_fees','master_financial_year_id'));
        	$this->set('_serialize', ['success', 'error', 'taxations','master_membership_fees','master_financial_year_id']);
	}

	public function nonmemberexporter()
	{
	
		$Companies=$this->Companies->newEntity();
		
		
		if($this->request->is(['post','put']))
		{
			$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
			 $form_number=$result_Companies->form_number+1;
			$this->request->data['year_of_joining']=date("Y-m-d");
			$this->request->data['form_number']=$form_number;
			$this->request->data['role_id']=2;
			$Companies=$this->Companies->patchEntity($Companies,$this->request->data,['associated'=>['Users','CompanyMemberTypes','CoRegistrations','CoRegistrations.CoTaxAmounts']]);
			//pr($Companies); exit;
			if($result=$this->Companies->save($Companies)){
			 $Companies_datas = base64_encode($result);
			 
			 $Companies_data = json_encode($Companies_datas);
			 
			 
			 $this->redirect('http://www.ucciudaipur.com/getway?tyqazwersdfxasd='.$Companies_data);
			// return $this->redirect();
			
			}
			//$this->Flash->error(__('Unable to add the non member.'));
		}
	
	
	
	}
	
	public function nonmemberexportertemp(){
		$Companies=$this->Companies->newEntity();
		
		
		if($this->request->is(['post','put']))
		{  
 
			$organisation_name=$this->request->data['company_organisation'];
			$gst_number=$this->request->data['gst_number'];
			$export=$this->request->data['export'];
			$address=$this->request->data['address'];
			$this->request->data['non_member_exporter_email']='yes';
			$office_telephone=$this->request->data['office_telephone'];
			$nationality=$this->request->data['nationality'];
			$member_name=$this->request->data['users'][0]['member_name'];
			$email=$this->request->data['users'][0]['email'];
			$mobile_no=$this->request->data['users'][0]['mobile_no'];
			$amount=$this->request->data['co_registrations'][0]['amount'];
			$tax_amount=$this->request->data['co_registrations'][0]['tax_amount'];
			$total_amount=$this->request->data['co_registrations'][0]['total_amount'];
			$master_financial_year_id=$this->request->data['co_registrations'][0]['master_financial_year_id'];
			$co_tax_amounts=$this->request->data['co_registrations'][0]['co_tax_amounts'];
			
			
			$find_id_Companies=$this->Companies->find()->where(['company_organisation LIKE'=>$organisation_name])->count();
			if($find_id_Companies>0){
				$find_id_Companies=$this->Companies->find()->where(['company_organisation LIKE'=>$organisation_name]);
				foreach($find_id_Companies as $find_id_Companie){
					$find_id=$find_id_Companie->id;
					$form_numbers=$find_id_Companie->form_number;
				}
				if(empty($form_numbers)){
					$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
					$form_numbers=$result_Companies->form_number+1;
					
				}
				
				$query = $this->Companies->query();
				$query->update()
					->set(['company_organisation'=>$organisation_name,'gst_number'=>$gst_number,'form_number'=>$form_numbers,'address'=>$address,'office_telephone'=>$office_telephone,'non_memeber_exporter_email'=>'yes','nationality'=>$nationality])
					->where(['id' => $find_id])
					->execute();
				$query = $this->Companies->Users->query();
				$query->update()
					->set(['member_name'=>$member_name,'email'=>$email,'mobile_no'=>$mobile_no])
					->where(['company_id' => $find_id,'member_nominee_type'=>'first'])
					->execute();
				$find_id_CoRegistration=$this->Companies->CoRegistrations->find()->where(['company_id'=>$find_id])->count();
				
				if($find_id_CoRegistration>0){
					$find_id_CoRegistrations=$this->Companies->CoRegistrations->find()->where(['company_id'=>$find_id]);
					foreach($find_id_CoRegistrations as $find_id_CoRegistration){
						
						$find_id_CoRegistration_id=$find_id_CoRegistration->id;
						
					}
					
						$query = $this->Companies->CoRegistrations->query();
						$query->update()
							->set(['amount'=>$amount,'tax_amount'=>$tax_amount,'total_amount'=>$total_amount,'master_financial_year_id'=>$master_financial_year_id])
							->where(['company_id' => $find_id])
							->execute();
						
						
						foreach($co_tax_amounts as $co_tax_amoun){

								 
								$tax_id=$co_tax_amoun['tax_id'];
								$tax_percentage=$co_tax_amoun['tax_percentage'];
								$co_amount=$co_tax_amoun['amount'];  
								
								$querys = $this->Companies->CoRegistrations->CoTaxAmounts->query();
								$querys->update()
								->set(['tax_id'=>$tax_id,'tax_percentage'=>$tax_percentage,'amount'=>$co_amount])
								->where(['co_registration_id' => $find_id_CoRegistration_id,'tax_id'=>$tax_id])
								->execute();								
							
						}
					
					}
					else
					{
						$query = $this->Companies->CoRegistrations->query();
						$query->insert(['amount', 'tax_amount','total_amount','master_financial_year_id','company_id'])
							->values([
								'amount' => $amount,
								'tax_amount' => $tax_amount,
								'total_amount' => $total_amount,
								'master_financial_year_id' => $master_financial_year_id,
								'company_id' => $find_id,
							])
							->execute();
						$idlsts= $this->Companies->CoRegistrations->find()->where(['company_id'=>$find_id]); 
						foreach($idlsts as $idlst){
							$idlast=$idlst['id'];
						}
						
						foreach($co_tax_amounts as $co_tax_amoun){
							$tax_id=$co_tax_amoun['tax_id'];
								$tax_percentage=$co_tax_amoun['tax_percentage'];
								$co_amount=$co_tax_amoun['amount'];  
							$query = $this->Companies->CoRegistrations->CoTaxAmounts->query();
							$query->insert(['tax_id', 'tax_percentage','amount','co_registration_id'])
								->values([
									'tax_id' => $tax_id,
									'tax_percentage' => $tax_percentage,
									'amount' => $co_amount,
									'co_registration_id' => $idlast,
								])
							->execute(); 
						}
					
					}
				//$Companies=$this->Companies->find()->where(['id'=>$find_id])->contain(['Users','CoRegistrations'=>['CoTaxAmounts']]);
				$Companies=$this->Companies->get($find_id, ['contain'=>['Users','CoRegistrations'=>['CoTaxAmounts']]]);
				 $Companies_datas = base64_encode($Companies);
				 
				 $Companies_data = json_encode($Companies_datas);
				 
				 
				//$this->redirect('http://www.ucciudaipur.com/getway?tyqazwersdfxasd='.$Companies_data);
				$this->redirect('http://www.ucciudaipur.com/nonmembertesting?tyqazwersdfxasd='.$Companies_data);
				
			
				
			}else{
			
				$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
				 $form_number=$result_Companies->form_number+1;
				$this->request->data['year_of_joining']=date("Y-m-d");
				$this->request->data['form_number']=$form_number;
				$this->request->data['role_id']=2;
				$Companies=$this->Companies->patchEntity($Companies,$this->request->data,['associated'=>['Users','CompanyMemberTypes','CoRegistrations','CoRegistrations.CoTaxAmounts']]);
				  
				if($result=$this->Companies->save($Companies)){
					
				 $Companies_datas = base64_encode($result);
				 
				 $Companies_data = json_encode($Companies_datas);
				 
				 
				//$this->redirect('http://www.ucciudaipur.com/getway?tyqazwersdfxasd='.$Companies_data);
				$this->redirect('http://www.ucciudaipur.com/nonmembertesting?tyqazwersdfxasd='.$Companies_data);
				
				// return $this->redirect();
				
				}
				//$this->Flash->error(__('Unable to add the non member.'));
			}
		}
	
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		
		
        $companies = $this->Companies->find()->contain(['Users']);
			
		
		
        $this->set(compact('companies'));
        $this->set('_serialize', ['companies']);
    }

	public function NonMemberRegistration()
	{
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$Companies=$this->Companies->newEntity();
		
		if($this->request->is(['post','put']))
		{
			$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
			 $form_number=$result_Companies->form_number+1;
			$this->request->data['year_of_joining']=date("Y-m-d",strtotime($this->request->data['year_of_joining']));
			$this->request->data['form_number']=$form_number;
			$this->request->data['role_id']=2;
			$Companies=$this->Companies->patchEntity($Companies,$this->request->data,['associated'=>['Users','CompanyMemberTypes','CoRegistrations','CoRegistrations.CoTaxAmounts']]);
			
			if($result=$this->Companies->save($Companies)){
			
				 $this->Flash->success(__('The Non member has been saved.')); 
                 return $this->redirect(['action' => 'view',$result->id]);
			}
			$this->Flash->error(__('Unable to add the non member.'));
		}
		
		
		$master_financial_years=$this->Companies->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
		foreach($master_financial_years as $master_financial_year){
			$master_financial_year_id=$master_financial_year->id;
		}
		$taxations=$this->Companies->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->contain(['MasterTaxationRates'])->toArray();
		$master_membership_fees=$this->Companies->MasterMembershipFees->find()->where(['member_type_id'=>3])->toArray();
		
		$this->set(compact('Companies','taxations','master_membership_fees','master_financial_year_id'));
	}

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function view($id = null)
	{
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$company = $this->Companies->get($id, [
			'contain' => ['CompanyMemberTypes', 'Users','CoRegistrations'=>['CoTaxAmounts']]
		]);
	      $MasterCompanies=$this->Companies->MasterCompanies->find()->toArray();
		  $taxations=$this->Companies->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->contain(['MasterTaxationRates'])->toArray();
			$master_membership_fees=$this->Companies->MasterMembershipFees->find()->where(['member_type_id'=>3])->toArray();
		//pr($company); exit;
		$this->set(compact('company','taxations','master_membership_fees','MasterCompanies'));
		$this->set('_serialize', ['company']);
	}

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Companies->Roles->find('list', ['limit' => 200]);
        $companyEmails = $this->Companies->CompanyEmails->find('list', ['limit' => 200]);
        $memberTypes = $this->Companies->MemberTypes->find('list', ['limit' => 200]);
        $turnOvers = $this->Companies->TurnOvers->find('list', ['limit' => 200]);
        $this->set(compact('company', 'roles', 'companyEmails', 'memberTypes', 'turnOvers'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Companies->Roles->find('list', ['limit' => 200]);
        $companyEmails = $this->Companies->CompanyEmails->find('list', ['limit' => 200]);
        $memberTypes = $this->Companies->MemberTypes->find('list', ['limit' => 200]);
        $turnOvers = $this->Companies->TurnOvers->find('list', ['limit' => 200]);
        $this->set(compact('company', 'roles', 'companyEmails', 'memberTypes', 'turnOvers'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

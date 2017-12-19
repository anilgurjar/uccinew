<?php
namespace App\Controller;
use Cake\View\View;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Email\Email;
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


class MemberReceiptsController extends AppController
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
		$this->loadComponent('RequestHandler');
		$this->response->type('ajax');
	}
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['UpdateReceiptMail','InvoiceReceiptMailSms','logout']);
    }
	public function generalReceiptAjaxNonMember()
	{
		$this->viewBuilder()->layout('ajax_layout');
		$this->request->data=array_filter($this->request->data);
		$member_user = $this->MemberReceipts->Companies->newEntity();
		
		$master_financial_years=$this->MemberReceipts->MasterFinancialYears->find()->order(['id'=>'DESC'])->limit(1);
		foreach($master_financial_years as $master_financial_year){
			 $master_financial_year_id=$master_financial_year->id;
		}
		
		if(isset($this->request->data['year_of_joining']))
		{
			$this->request->data['year_of_joining']=date('Y-m-d', strtotime($this->request->data['year_of_joining']));
		}
		//$this->request->data['member_type_id']=3;
		$this->request->data['role_id']=2;
		
		
			
		$member_user = $this->MemberReceipts->Companies->patchEntity($member_user, $this->request->data);
		//pr($member_user);
		
		$CompanyMemberType = $this->MemberReceipts->Companies->CompanyMemberTypes->newEntity();
		$CompanyMemberType->master_member_type_id=3;
		$CompanyMemberType->due_amount=0.00;
		$CompanyMemberType->master_financial_year_id=$master_financial_year_id;
		$member_user->company_member_types[0]=$CompanyMemberType;
		//pr($this->request->data);
		$result=$this->MemberReceipts->Companies->save($member_user);
		$record_id=$result->id;
		$company_organisation=$result->company_organisation;
		echo'<option value="'.$record_id.'" >'.$company_organisation.'</option>';
		exit;
	}
    public function MemberReceipt()
    {
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('index_layout');
		$member_receipts = $this->MemberReceipts->newEntity();
		
		


		if ($this->request->is('post'))
		{ 
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
				$from_year=(date('y')-1);
				$to_year=date('y');
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
				$from_year=date('y');
				$to_year=(date('y')+1);
			}
			$company_member_type_ids= $this->request->data['company_member_type_id'];
			$company_id=$this->request->data['member_id'];
		
			$cheque_date=date('Y-m-d', strtotime($this->request->data['cheque_date']));
				

			$fetch_member_receipt=$this->MemberReceipts->find()->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
			if(!empty($fetch_member_receipt)){
				$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
			}else{
				$receipt_no='0001';
			}
		
				$this->request->data['receipt_no']=$receipt_no;
				$this->request->data['receipt_type']='member_receipt';
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['cheque_date']=$cheque_date;
				$this->request->data['company_id']=$company_id;
				$receipt_amount=$this->request->data['amount']+@$this->request->data['tds_amount'];
				$actual_amount=$receipt_amount;
		
				$this->request->data=array_filter($this->request->data);
						
				$member_receipts=$this->MemberReceipts->patchEntity($member_receipts,$this->request->data);
				
				
		
		if($last_receipt=$this->MemberReceipts->save($member_receipts)){
			
			
			$last_receipt_id=$last_receipt->receipt_id;
			foreach($company_member_type_ids as $company_member_type_id){	

				$fetch_member_fee=$this->MemberReceipts->MemberFees->find('all',array('fields'=>array('id','date','grand_total','invoice_no'),'conditions'=>array('company_id'=>$company_id,'company_member_type_id'=>$company_member_type_id,'date >='=>$from,'date <='=>$to)))->toArray();
			
				$member_fee_id=$fetch_member_fee[0]['id'];
				//$this->request->data['member_fee_id']=$member_fee_id;

			if($fetch_member_fee[0]['invoice_no']==0)
			{
				$query = $this->MemberReceipts->MemberFees->find();
				$invoice_no_get=$query->select(['max_value' => $query->func()->max('invoice_no')])->toArray();
				 $invoice_no=$invoice_no_get[0]->max_value+1;
				
				$query = $this->MemberReceipts->MemberFees->query();
				$query->update()
				->set(['invoice_no' => $invoice_no,
						'invoice_date' => date('Y-m-d')
						])
			->where(['company_id'=>$company_id,'company_member_type_id'=>$company_member_type_id])
				->execute();
			}
			
			/* $CompanyMember=$this->MemberReceipts->Companies->CompanyMemberTypes->get($company_member_type_id);
			$CompanyMember_type_due_amount=0;
			
			 $CompanyMember_type_due_amount=$CompanyMember->due_amount; 
			 $receipt_amount=$receipt_amount-$CompanyMember_type_due_amount; 
				if($receipt_amount>0){
					$CompanyMember_type_due_amount=0;
					
				}else{
					
					$CompanyMember_type_due_amount=abs($receipt_amount);
					$receipt_amount=0;
				}
				$query = $this->MemberReceipts->Companies->CompanyMemberTypes->query();
				$query->update()
				->set(['due_amount' => $CompanyMember_type_due_amount])
				->where(['id'=>$company_member_type_id])
				->execute();
				 */
				$MemberFeeMemberReceipts=$this->MemberReceipts->MemberFeeMemberReceipts->newEntity();
				$MemberFeeMemberReceipts->member_fee_id=$member_fee_id;
				$MemberFeeMemberReceipts->member_receipt_id=$last_receipt_id;
				$this->MemberReceipts->MemberFeeMemberReceipts->save($MemberFeeMemberReceipts);	
				
				
			}
			
		}


			$master_member=$this->MemberReceipts->Companies->find()->where(['member_flag'=>1,'id' => $company_id])->toArray();

			foreach($master_member as $member_data){
				$due_amount=$member_data->due_amount;
				$due_amount=$due_amount-$actual_amount;
				$query = $this->MemberReceipts->Companies->query();
				$query->update()
				->set(['due_amount' => $due_amount])
				->where(['id' => $company_id])
				->execute();
			}
	
			$this->redirect(['action' => 'member_receipt']);
		}
		
		/* $master_member = $this->MemberReceipts->Users->find()->where(['member_flag'=>1])->order(['Users.company_organisation ASC']);
		$master_member->select(['id', 'company_organisation','total_rows' => $master_member->func()->count('MemberFees.id')])
			->leftJoinWith('MemberFees')
			->group(['Users.id'])
			->having(['total_rows >'=>0]);
			 */
			
		$master_member = $this->MemberReceipts->Companies->find()->where(['member_flag'=>1])->order(['Companies.company_organisation ASC']);
		$master_member->select(['id', 'company_organisation','total_rows' => $master_member->func()->count('MemberFees.id')])
		->leftJoinWith('MemberFees')
		->group(['Companies.id'])
		->having(['total_rows >'=>0]);
		
		$this->set('master_member' ,$master_member);
		$this->set('member_type' , $this->MemberReceipts->MasterMemberTypes->find('all')->toArray());
		$this->set('master_bank' , $this->MemberReceipts->MasterBanks->find('all')->toArray());
		$this->set('master_purpose' , $this->MemberReceipts->MasterPurposes->find('all')->toArray());
		$this->set('member_receipts',$member_receipts);
	}
	public function EditMemberReceipt($member_fee_id=null,$member_receipt_id=null)
    {
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
		$member_receipts = $this->MemberReceipts->get($member_receipt_id);
		$master_member1=$this->MemberReceipts->Companies->find()->where(['member_flag'=>1,'id' => $member_receipts->company_id])->toArray();
		
		foreach($master_member1 as $member_data)
		{
			 $due_amount=$member_data->due_amount;
		}
		 $due_amount+=$member_receipts->amount+$member_receipts->tds_amount; 
		
		if ($this->request->is(['patch', 'post', 'put']))
		{
			if(date('m') < 4){
				$from=(date('Y')-1).'-4-1';
				$to=date('Y').'-3-31';
				$from_year=(date('y')-1);
				$to_year=date('y');
			}else{
				$from=date('Y').'-4-1';
				$to=(date('Y')+1).'-3-31';
				$from_year=date('y');
				$to_year=(date('y')+1);
			}
			
			//$fetch_member_fee=$this->MemberReceipts->MemberFees->find('all',array('fields'=>array('id','date','grand_total','invoice_no'),'conditions'=>array('company_id'=>$member_receipts->company_id,'date >='=>$from,'date <='=>$to)))->toArray();
			
			$cheque_date=date('Y-m-d', strtotime($this->request->data['cheque_date']));
				
		
		//$member_fee_id=$fetch_member_fee[0]['id'];
		//$this->request->data['member_fee_id']=$member_fee_id;
		
		$this->request->data['cheque_date']=$cheque_date;
		
		$this->request->data=array_filter($this->request->data);
		$this->request->data['receipt_id']=$member_receipt_id;
		
		$member_receipts=$this->MemberReceipts->patchEntity($member_receipts,$this->request->data);
		
		$this->MemberReceipts->save($member_receipts);
				
			
			$actual_amount=$this->request->data['amount']+@$this->request->data['tds_amount'];
			$due_amount=$due_amount-$actual_amount;
				
				
				$query = $this->MemberReceipts->Companies->query();
				$query->update()
				->set(['due_amount' => $due_amount])
				->where(['id' => $member_receipts->company_id])
				->execute();
			
			$this->redirect(['Controller' => 'MemberReceipts' , 'action' => 'InvoiceReceiptReport']);
		}
		$master_member = $this->MemberReceipts->Companies->find()->where(['member_flag'=>1])->order(['Companies.company_organisation ASC']);
		$master_member->select(['id', 'company_organisation','total_rows' => $master_member->func()->count('MemberFees.id')])
			->leftJoinWith('MemberFees')
			->group(['Companies.id'])
			->having(['total_rows >'=>0]);
		
		$this->set('master_member' ,$master_member);
		$this->set('company_id' ,$member_receipts->company_id);
		$this->set('member_type' , $this->MemberReceipts->MasterMemberTypes->find()->toArray());
		$this->set('master_bank' , $this->MemberReceipts->MasterBanks->find()->toArray());
		$this->set('master_purpose' , $this->MemberReceipts->MasterPurposes->find()->toArray());
		$this->set('member_receipts',$member_receipts);
		$this->set('due_amount',$due_amount);
	}
	public function MemberReceiptAmountAjax(){
		//$this->viewBuilder()->layout(null);
		$member_id = $this->request->data['member_id'];
		$Companies=$this->MemberReceipts->Companies->get($member_id);
		echo $Companies->due_amount;
	/* 	$Companies->where(['id'=>$member_id])
		->contain(['CompanyMemberTypes'=>function($q) use($Companies){
		return $q->select(['company_id','total'=>$Companies->func()->sum('CompanyMemberTypes.due_amount')]);
		}]);  */

		/* $Companies=$this->MemberReceipts->Companies->find();
			$Companies->select(['total_due_amount' => $Companies->func()->sum('CompanyMemberTypes.due_amount')])
			->innerJoinWith('CompanyMemberTypes')
			->autoFields(true)
			->where(['Companies.id'=>$member_id]);


		foreach($Companies as $Company){
			echo $Company->total_due_amount;
			//echo $Company->company_member_types[0]->total;
		} */

	}


public function MemberReceiptAjaxType(){

//$this->viewBuilder()->layout(null);
	$member_id = $this->request->data['member_id']; 
	$Companies=$this->MemberReceipts->Companies->get($member_id,
				['contain'=>['CompanyMemberTypes'=>['MasterMemberTypes']]])->toArray();
	$this->set('Companies',$Companies);
}
	public function	MemberReceiptAjax()
	{
		$this->viewBuilder()->layout('ajax_layout');
		$purpose_id=$this->request->data['purpose_id'];
		$narration=$this->request->data['narration'];
		$amount_type=$this->request->data['amount_type'];
		$member_id=$this->request->data['member_id'];
		$amount=$this->request->data['amount'];
		if(!empty($this->request->data['bank_id'])){
			$bank_id=$this->request->data['bank_id'];
			$drawn_bank=$this->request->data['drawn_bank'];
			$cheque_date=date('Y-m-d', strtotime($this->request->data['cheque_date']));
			$cheque_no=$this->request->data['cheque_no'];
		}else{
			$bank_id=''; 
			$drawn_bank='';
			$cheque_date='';
			$cheque_no='';
		} 
		if(date('m') < 4){
			$from=(date('Y')-1).'-4-1';
			$to=date('Y').'-3-31';
			$from_year=(date('y')-1);
			$to_year=date('y');
		}else{
			$from=date('Y').'-4-1';
			$to=(date('Y')+1).'-3-31';
			$from_year=date('y');
			$to_year=(date('y')+1);
		}
		$fetch_member_receipt=$this->MemberReceipts->find('all',array('fields'=>array('receipt_no'),'order'=>'receipt_no DESC','limit'=>1))->toArray();
		if(!empty($fetch_member_receipt)){
			$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
		}else{
			$receipt_no='0001';
		}
		$master_purpose=$this->MemberReceipts->MasterPurposes->find('all',array('fields'=>array('purpose_name'),'conditions'=>array('id'=>$purpose_id,'purpose_flag'=>1)))->toArray();
		$fetch_member_fee=$this->MemberReceipts->MemberFees->find('all',array('fields'=>array('id','date','grand_total','invoice_no'),'conditions'=>array('member_id'=>$member_id,'date >='=>$from,'date <='=>$to)))->toArray();
		$this->set('master_purpose',$master_purpose);		
		$invoice_no=$fetch_member_fee[0]['invoice_no'];
		$tax_date=$fetch_member_fee[0]['date'];
		$member_fee_id=$fetch_member_fee[0]['id'];
		$this->set('tax_date',$tax_date);
		$conditions=array('member_flag'=>1,'id' => $member_id);
		$member_receipt_count=$this->MemberReceipts->find('all',array('conditions'=>array('member_fee_id'=>$member_fee_id)))->toArray();
		$cc=array('member_fee_id' => $member_fee_id,'member_id' => $member_id,'purpose_id' => $purpose_id,'receipt_no' => $receipt_no,'amount_type' => $amount_type,'bank_id' => $bank_id, 'drawn_bank' => $drawn_bank,'cheque_no' => $cheque_no,'cheque_date' => $cheque_date,'amount' => $amount,'narration' => $narration,'date_current' => date('Y-m-d'));
		$save_condition=array_filter($cc);
		$member_receipt=$this->MemberReceipts->newEntity();
		$member_receipt=$this->MemberReceipts->patchEntity($member_receipt,$save_condition);
		$this->MemberReceipts->save($member_receipt);
		$master_member=$this->MemberReceipts->Users->find('all',array('fields'=>array('id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'),'conditions'=>$conditions))->toArray();
		$this->set('master_member',$master_member);
		$this->set('invoice_no',$invoice_no);
		$this->set('from_year',$from_year);
		$this->set('to_year',$to_year);
		if(!empty($master_member))
		{ ?> <div class="col-xs-12"> <?php
			$taxation=$this->MemberReceipts->MasterTaxations->find('all',array('fields' => array('tax_name','tax_id'),'conditions'=>array('tax_flag'=>1)))->toArray();
			foreach($taxation as $data){
				$taxation_rate[$data->tax_name]=$this->MemberReceipts->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data->tax_id,'tax_date <='=>$tax_date),'order'=>'tax_date DESC','limit'=>1))->toArray();
			}
			foreach($master_member as $member_data){
				$due_amount=$member_data->due_amount;
				$due_amount=$due_amount-$amount;
				$query = $this->MemberReceipts->Users->query();
							$query->update()
							->set(['due_amount' => $due_amount])
							->where(['id' => $member_id])
							->execute();
				$this->set('member_receipt_count',$member_receipt_count);			
				if(empty($member_receipt_count)){
					$year_of_joining=date('Y',strtotime($member_data->year_of_joining));
					if(date('Y')==$year_of_joining){
						$condition_master_mebership=array('member_type_id'=>$member_data->member_type_id);
					}else{
						$condition_master_mebership=array('member_type_id'=>$member_data->member_type_id,'category_name'=>2);
					}
					$master_membership_fee=$this->MemberReceipts->MasterMembershipFees->find('all',array('conditions'=>$condition_master_mebership))->toArray();
					$this->set('master_membership_fee',$master_membership_fee);
					if(!empty($master_membership_fee)){							
						if(!empty($member_data->turn_over_id)){
						$master_turn_over=$this->MemberReceipts->MasterTurnOvers->find('all',array('conditions'=>array('id'=>$member_data->turn_over_id)))->toArray();
						$this->set('master_turn_over',$master_turn_over);
						}
					$this->set('taxation_rate',$taxation_rate);
					}}
				$this->set('amount',$amount);
				$this->set('narration',$narration);
				$this->set('receipt_no',$receipt_no);
				$this->set('amount_type',$amount_type);
				$this->set('cheque_no',$cheque_no);
		}} 
	
		?>
		
		</div>
		<?php 
	}

	public function MemberReceiptPdf($receipt_id = null,$member_fee_id=null)
	{
		$this->viewBuilder()->layout('ajax_layout');
		/* 
		$master_member=$this->MemberReceipts->find()->where(['receipt_no'=>$receipt_no])->contain(['MasterPurposes','MemberFees'=>['Users'=> function($q){
			return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'])->where(['member_flag'=>1]);
		},'MemberFeeTaxAmounts'=>['MasterTaxations']]])->toArray();
		 */
		
		/* $master_member=$this->MemberReceipts->MemberFeeMemberReceipts->find()
		->where(['receipt_no'=>$receipt_no])
		->contain(['Companies','MasterPurposes','MemberFeeMemberReceipts'=>['MemberFees'=>['MemberFeeTaxAmounts'=>['MasterTaxations']]]])->toArray();
		 */
		$master_member=$this->MemberReceipts->MemberFeeMemberReceipts->find()
		->where(['member_fee_id'=>$member_fee_id,'member_receipt_id'=>$receipt_id])->contain(['MemberReceipts'=>['MasterPurposes'],'MemberFees'=>['Companies'=>['Users'],'CompanyMemberTypes','MemberFeeTaxAmounts'=>['MasterTaxations']]]);
		
		
		
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
			//$year_of_joining=date('Y',strtotime($member_data->member_fee->user->year_of_joining));
				$year_of_joining=strtotime($member_data->member_fee->company->year_of_joining);
				if($c_year_of_joining <= $year_of_joining){
					$condition_master_mebership=array('member_type_id'=>$member_data->member_fee->company_member_type->master_member_type_id);
				}else{
					$condition_master_mebership=array('member_type_id'=>$member_data->member_fee->company_member_type->master_member_type_id,'category_name'=>2);
				}
									
				$master_membership_fee=$this->MemberReceipts->MasterMembershipFees->find()->where($condition_master_mebership)->toArray();
				
				$this->set('master_membership_fee',$master_membership_fee);
				
				
					if(!empty($master_membership_fee))
					{
						if(!empty($member_data->member_fee->company->turn_over_id))
						{
							
							$master_turn_over=$this->MemberReceipts->MasterTurnOvers->find()->where(['id'=>$member_data->member_fee->company->turn_over_id])->toArray();
							
							$this->set('master_turn_over',$master_turn_over);
						}
					}
			}
		}
		$MasterCompanies=$this->MemberReceipts->MasterCompanies->find();
		$signature=$this->MemberReceipts->MasterSignature->find()->where(['flag'=>1]);
		
			$this->set('MasterCompanies',$MasterCompanies);
		$this->set('master_member',$master_member);
		$this->set('signature',$signature);
		$BankDetails=$this->MemberReceipts->MasterBanks->find();
			$this->set('BankDetails',$BankDetails);
	}
	
	
	
	
	public function GeneralReceipt()
	{
		$this->viewBuilder()->layout('index_layout');
		$member_receipts = $this->MemberReceipts->newEntity();
		$member_users = $this->MemberReceipts->Companies->newEntity();
		
		if($this->request->is(['post','put']))
		{
			 
			@$amount_date = $this->request->data['amount_date'];
			@$cheque_date = $this->request->data['cheque_date'];
			@$this->request->data['cheque_date'] = date('Y-m-d',strtotime($cheque_date));
		  
			$fetch_member_receipt=$this->MemberReceipts->find('all')->select(['receipt_no'])->order(['receipt_no' => 'DESC'])->limit(1)->toArray();
			if(!empty($fetch_member_receipt)){
				$receipt_no=$fetch_member_receipt[0]['receipt_no']+1;
			}else{
				$receipt_no='0001';
			}
			
			$company_id=$this->request->data['member_id'];
			$this->request->data['company_id']=$company_id;
			$this->request->data['receipt_type']='general_receipt';
			$this->request->data['receipt_no']=$receipt_no;
			$this->request->data['date_current']=date('Y-m-d');
			//$this->request->data['date_current']="2017-06-30";
			$this->request->data=array_filter($this->request->data);
			
			$member_receipts=$this->MemberReceipts->patchEntity($member_receipts,$this->request->data);
		
			$result=$this->MemberReceipts->save($member_receipts);
			
			$this->redirect(array('controller' => 'MemberReceipts','action' => 'general_receipt_performa_view','?' => array('id'=>$result->receipt_id)));
		}
		
		$master_member=$this->MemberReceipts->Companies->find()
		->where(['member_flag'=>1])
		->contain(['CompanyMemberTypes'])
		->order(['Companies.company_organisation ASC'])
		->toArray();
		$this->set('master_member' ,$master_member);
		//$this->set('master_member' , $this->MemberReceipts->Users->find('all',array('fields'=>array('id','company_organisation','member_type_id'),'conditions'=>array('member_flag'=>1)))->order(['Users.company_organisation ASC'])->toArray());
		
		$this->set('member_type' , $this->MemberReceipts->MasterMemberTypes->find()->toArray());
		$this->set('master_purpose' , $this->MemberReceipts->MasterPurposes->find()->toArray());
		$this->set('master_bank' , $this->MemberReceipts->MasterBanks->find()->toArray()); 
		$state=$this->MemberReceipts->MasterStates->find('list');
		$this->set(compact('state'));
		$this->set('member_receipts', $member_receipts);
		$this->set('member_users',$member_users);
	}
	public function EditGeneralReceipt($id=Null)
	{
		$this->viewBuilder()->layout('index_layout');
		$member_receipts = $this->MemberReceipts->get($id, [
            'contain' => ['TaxAmounts','GeneralReceiptPurposes']
        ]);
		
		if($this->request->is(['post','put']))
		{ 
			@$amount_date = $this->request->data['amount_date'];
			@$cheque_date = $this->request->data['cheque_date'];
			@$this->request->data['cheque_date'] = date('Y-m-d',strtotime($cheque_date));
		  						
			//$this->request->data['date_current']=date('Y-m-d');
			$this->request->data=array_filter($this->request->data);
								
			$member_receipts=$this->MemberReceipts->patchEntity($member_receipts,$this->request->data);
			
			$result=$this->MemberReceipts->save($member_receipts);
			
			$this->redirect(array('controller' => 'MemberReceipts','action' => 'general_receipt_performa_view','?' => array('id'=>$result->receipt_id)));
		}
		
		$users=$this->MemberReceipts->Companies->find()
		->where(['member_flag'=>1,'id'=>$member_receipts->company_id])
		->toArray();
		
		//$users=$this->MemberReceipts->Users->find()->select(['id','company_organisation','member_type_id'])->where(['member_flag'=>1,'id'=>$member_receipts->member_id])->toArray();
		
		$this->set('master_member' , $users);
		//$this->set('member_type' , $this->MemberReceipts->MasterMemberTypes->find('all')->where(['id'=>$users[0]->member_type_id])->toArray());
		$this->set('master_purpose' , $this->MemberReceipts->MasterPurposes->find()->toArray());
		$this->set('master_bank' , $this->MemberReceipts->MasterBanks->find()->toArray()); 
		$state=$this->MemberReceipts->MasterStates->find('list');
		$this->set(compact('state'));
		$this->set('member_receipts', $member_receipts);
	}
	public function deleteMemberReceipt($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$query = $this->MemberReceipts->query();
				$query->update()
				->set(['receipt_flag' => 0])
				->where(['receipt_id' => $id]);
        if ($query->execute()) {
            $this->Flash->success(__('The member receipt has been deleted.'));
        } else {
            $this->Flash->error(__('The member receipt could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'invoice_receipt_report']);
    }
	public function	GeneralReceiptPdf($receipt_id = null){
		
		$this->viewBuilder()->layout('ajax_layout'); 
		 
		
		
		$master_member_receipt=$this->MemberReceipts->find()->where(['receipt_id'=>$receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
		return $q->select(['id','company_organisation','city']);
	},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();

		$MasterCompanies=$this->MemberReceipts->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set('master_member_receipt',$master_member_receipt);	
	}	
	
	public function InvoiceReceiptReport()
	{
		$this->viewBuilder()->layout('index_layout');
		$receipt = $this->MemberReceipts->newEntity();
		
		$this->set('master_member' ,$this->MemberReceipts->Companies->find()
		->where(['member_flag'=>1])
		->contain(['Users'=>function($q){
			return $q->where(['Users.member_nominee_type'=>'first']);
		}])
		->order(['Companies.company_organisation ASC'])->toArray());
		$this->set('master_purpose' , $this->MemberReceipts->MasterPurposes->find()->toArray());
		$this->set('master_bank' , $this->MemberReceipts->MasterBanks->find()->toArray());
		$this->set('receipt',$receipt);
		$conditions['MemberReceipts.receipt_flag']=1;
		
		if(isset($this->request->data['invoice_receipt_send']))
		{
			
			$mail=$this->request->data['mail'];
			
			foreach($mail as $receipt_id)
			{
				$query = $this->MemberReceipts->query();
				$query->update()
				->set(['mail_send' => 1])
				->where(['receipt_id' => $receipt_id])
				->execute();
			}
			
			$mail_Send=$this->request->query['send_unsend'];
			$purpose_id=$this->request->query['purpose_id'];
			$bank_id=$this->request->query['bank_id'];
			$member_id=$this->request->query['company_id'];
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
			
			$conditions['MemberReceipts.mail_Send']=$mail_Send;
			$conditions['MemberReceipts.date_current >=']=$from;
			$conditions['MemberReceipts.date_current <=']=$to;
			if(!empty($purpose_id)){
				$conditions['MemberReceipts.purpose_id']=$purpose_id;
			}
			if(!empty($bank_id)){
				$conditions['MemberReceipts.bank_id']=$bank_id;
			}
			if(!empty($member_id)){
				$conditions['MemberReceipts.company_id']=$member_id;
			}
			
			if($this->request->query['receipt_type']=='Invoice')
			{
				$conditions['MemberReceipts.receipt_type']='member_receipt';
			}
			else
			{
				$conditions['MemberReceipts.receipt_type']='general_receipt';
			}
			
			if($this->request->query['receipt_type']=='Invoice')
			{
				$conditions['MemberReceipts.receipt_type ']='member_receipt';
				/* $member_receipt = $this->paginate($this->MemberReceipts->find()->where($conditions)->order(['MemberReceipts.date_current DESC'])->contain(['MemberFees'=>function($q){
					return $q->select(['invoice_no']);
				},'Users'=>function($q1){
					return $q1->select(['company_organisation']);
				}])); */
				
				$member_receipt = $this->paginate($this->MemberReceipts->find()
				->where($conditions)
				->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']])
				->order(['MemberReceipts.date_current DESC']));
				
				
				$this->set(compact('member_receipt'));
			}
			else
			{
				$conditions['MemberReceipts.receipt_type']='general_receipt';
				
				/* $general_receipt = $this->paginate($this->MemberReceipts->find()->where($conditions)->order(['MemberReceipts.date_current DESC'])->contain(['Users'=>function($q1){
					return $q1->select(['company_organisation']);
				}])); */
				
				$general_receipt = $this->paginate($this->MemberReceipts->find()
				->where($conditions)
				->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']])
				->order(['MemberReceipts.date_current DESC']));
				
				$this->set(compact('general_receipt'));
			}	
		}
		
		else
		{
			
			if(date('m') < 4){
				$from=(date('Y')-1).'-04-1';
				$to=date('Y').'-03-31';
			}else{
				$from=date('Y').'-04-01';
				$to=(date('Y')+1).'-03-31';
			}
			
			$member_receipt = $this->paginate($this->MemberReceipts->find()
			->where(['date_current >='=>$from,'date_current <='=>$to,'receipt_type'=> 'member_receipt','MemberReceipts.mail_Send'=>0,'MemberReceipts.receipt_flag'=>1])
			->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']])
			->order(['MemberReceipts.receipt_no ASC']));
			
				
			$this->set(compact('member_receipt'));
		} 
	}
	public function MasterPurposeDetail($purpose_id){
		$master_purpose=$this->MemberReceipts->MasterPurposes->find('all',array('fields'=>array('purpose_tax','purpose_name'),'conditions'=>array('id'=>$purpose_id,'purpose_flag'=>1)))->toArray();
		$this->response->body($master_purpose);
		return $this->response;
	}
	public function MasterTaxationsDetail(){
		$taxation=$this->MemberReceipts->MasterTaxations->find('all',array('fields' => array('tax_name','tax_id'),'conditions'=>array('tax_flag'=>1)));
		$this->response->body($taxation);
		return $this->response;
	}	
	public function MasterTaxationRatesDetail($tax_id){
	$result = $this->MemberReceipts->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$tax_id,'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1)); 
	$this->response->body($result);
	return $this->response;
	}
	public function GeneralReceiptPurposesDetail($receipt_id){
	$result = $this->MemberReceipts->GeneralReceiptPurposes->find('all',array('conditions'=>array('member_receipt_id'=>$receipt_id)))->toArray(); 
	$this->response->body($result);
	return $this->response;
	}
 
  public function GeneralReceiptPerformaView()
  {
	$this->viewBuilder()->layout('index_layout'); 
    $receipt_id = $this->request->query['id'];
	
	$master_member_receipt=$this->MemberReceipts->find()->where(['receipt_id'=>$receipt_id])->contain(['TaxAmounts'=>['MasterTaxations'],'Companies'=>function($q){
		return $q->select(['id','company_organisation','city']);
	},'GeneralReceiptPurposes'=>['MasterPurposes']])->toArray();
	
	$MasterCompanies=$this->MemberReceipts->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
	
	$this->set('master_member_receipt',$master_member_receipt);
  }
  public function CalculateTaxGeneralReceipt()
  {
	$this->viewBuilder()->layout('ajax_layout');
	$total_amount=$this->request->data['total_amount'];
	$tds_amount=$this->request->data['tds_amount']; 
	$state_id=$this->request->data['state_id']; 
	$total_tax=0;		
	$grand_total_amount = 0;
	$total_basic_amount = 0;
	$total_service_tax=0;
	
	$i=0;
	
	$taxation=$this->MemberReceipts->MasterTaxations->find('all',array('fields' => array('tax_name','tax_id'),'conditions'=>array('tax_flag'=>1)))->toArray();
	
	foreach($taxation as $data)
	{  
		if($state_id==20){
			if($data['tax_name']!='IGST'){
				$taxation_rate = $this->MemberReceipts->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1))->toArray(); 
				
				foreach($taxation_rate as $tax_value)
				{
					
					$tax_amount=($total_amount*$tax_value->tax_percentage)/100;
					$tax_amount=number_format($tax_amount, 4, '.', '');
					$total_tax+=$tax_amount; 
					$tax[$data->tax_id][$data->tax_name][(string) $tax_value->tax_percentage][$i]=$tax_amount;
					$i++;
				}
			}
			
		}else{
			if($data['tax_name']=='IGST'){
				$taxation_rate = $this->MemberReceipts->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1))->toArray(); 
				foreach($taxation_rate as $tax_value)
				{
					
					$tax_amount=($total_amount*$tax_value->tax_percentage)/100;
					$tax_amount=number_format($tax_amount, 4, '.', '');
					$total_tax+=$tax_amount; 
					$tax[$data->tax_id][$data->tax_name][(string) $tax_value->tax_percentage][$i]=$tax_amount;
					$i++;
				}
			}
			
		}
	}
	
	$total_basic_amount = $total_amount; 
		
	$grand_total_amount = $total_amount + $total_tax;
	
	echo '<tr class="Tax">
	<td colspan="3" align="right">Basic Amount</td>
	<td><input type="hidden" name="basic_amount" value="'.number_format($total_basic_amount, 2, '.', '').'">'.number_format($total_basic_amount, 2, '.', '').'</td>
	</tr>';
	$sr=0;
	foreach($tax as $tax_data1=>$tax_key11)
	{
		
		$tax_amounts_add=0;
		foreach($tax_key11 as $tax_data=>$tax_key)
		{
			
			
			foreach($tax_key as $tax_key1=>$tax_key2)
			{
				foreach($tax_key2 as $tax_amounts)
				{
					$tax_amounts_add+=$tax_amounts;
				}
			}
			echo '<tr class="Tax">
			<td colspan="3" align="right"><input type="hidden" name="tax_amounts['.$sr.'][tax_id]" value="'.$tax_data1.'"><input type="hidden" name="tax_amounts['.$sr.'][tax_percentage]" value="'.number_format($tax_key1, 2, '.', '').'">'.$tax_data.' @ '.number_format($tax_key1, 2, '.', '').'%</td><td><input type="hidden" name="tax_amounts['.$sr.'][amount]" value="'.number_format($tax_amounts_add, 2, '.', '').'">'.number_format($tax_amounts_add, 2, '.', '').'</td></tr>';
			
		}
		$sr++;
	}
	echo '<tr class="Tax">
	<td colspan="3" align="right">Total Tax</td>
	<td><input type="hidden" name="taxamount" value="'.number_format($total_tax, 2, '.', '').'">'.number_format($total_tax, 2, '.', '').'</td>
	</tr>
		<tr>
		<td colspan="3" align="right">Total Amount</td>
		<td id="grand_total">'.number_format(round($grand_total_amount), 2, '.', '').'</td>
	</tr>
	<tr>
		<td colspan="3" align="right">TDS Amount</td>
		<td id="grand_total">'.number_format(round($tds_amount), 2, '.', '').'</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><strong>Grant Total</strong></td>
		<td id="grand_total"><input type="hidden" name="amount" value="'.number_format(round($grand_total_amount-$tds_amount), 2, '.', '').'"><strong>'.number_format(round($grand_total_amount-$tds_amount), 2, '.', '').'</strong></td>
	</tr>';
	exit;
  }
/*
  public function CalculateTaxGeneralReceipt()
  {
	$this->viewBuilder()->layout('ajax_layout');
	$purpose_array=$this->request->data['purpose_array'];
	$purpose_array=explode(',',$purpose_array);
	
	$total_tax=0;		
	$grand_total_amount = 0;
	$total_basic_amount = 0;
	$total_service_tax=0;
	$i=0;
	
	$taxation=$this->MemberReceipts->MasterTaxations->find('all',array('fields' => array('tax_name','tax_id'),'conditions'=>array('tax_flag'=>1)))->toArray();
	
	foreach($purpose_array as $purpose_array_data)
	{
		$sub_array = explode('/',$purpose_array_data);
		$purpose_id = $sub_array[0];
		$quantity = $sub_array[1];
		$amount = $sub_array[2];
		$total_amount = $sub_array[3];
		
		
		$master_purpose=$this->MemberReceipts->MasterPurposes->find('all',array('fields'=>array('purpose_tax','purpose_name'),'conditions'=>array('id'=>$purpose_id,'purpose_flag'=>1)))->toArray();
		
		if(!empty($master_purpose))
		{
			if(!empty($master_purpose[0]['purpose_tax']))
			{
				
				
				foreach($taxation as $data)
				{
					$taxation_rate = $this->MemberReceipts->MasterTaxationRates->find('all',array('fields' => array('id','tax_percentage'),'conditions'=>array('master_taxation_id'=>$data->tax_id,'tax_date <='=>date('Y-m-d')),'order'=>'tax_date DESC','limit'=>1))->toArray(); 
					foreach($taxation_rate as $tax_value)
					{
						
						$tax_amount=($total_amount*$tax_value->tax_percentage)/100;
						$tax_amount=number_format($tax_amount, 4, '.', '');
						$total_tax+=$tax_amount; 
						$tax[$data->tax_id][$data->tax_name][(string) $tax_value->tax_percentage][$i]=$tax_amount;
						$i++;
					}
				}
				
				$total_basic_amount = $total_basic_amount + $total_amount; 
				
			}
			else
			{
				$total_basic_amount = $total_basic_amount + $total_amount; 
			}
		}
		
	}
	$grand_total_amount = $total_basic_amount + $total_tax;
	
	echo '<tr>
	<td colspan="3" align="right">Basic Amount</td>
	<td><input type="hidden" name="basic_amount" value="'.number_format($total_basic_amount, 2, '.', '').'">'.number_format($total_basic_amount, 2, '.', '').'</td>
	</tr>';
	$sr=0;
	foreach($tax as $tax_data1=>$tax_key11)
	{
		
		$tax_amounts_add=0;
		foreach($tax_key11 as $tax_data=>$tax_key)
		{
			
			
			foreach($tax_key as $tax_key1=>$tax_key2)
			{
				foreach($tax_key2 as $tax_amounts)
				{
					$tax_amounts_add+=$tax_amounts;
				}
			}
			echo '<tr>
			<td colspan="3" align="right"><input type="hidden" name="tax_amounts['.$sr.'][tax_id]" value="'.$tax_data1.'"><input type="hidden" name="tax_amounts['.$sr.'][tax_percentage]" value="'.number_format($tax_key1, 2, '.', '').'">'.$tax_data.' @ '.number_format($tax_key1, 2, '.', '').'%</td><td><input type="hidden" name="tax_amounts['.$sr.'][amount]" value="'.number_format($tax_amounts_add, 2, '.', '').'">'.number_format($tax_amounts_add, 2, '.', '').'</td></tr>';
			
		}
		$sr++;
	}
	echo '<tr>
	<td colspan="3" align="right">Total Tax</td>
	<td><input type="hidden" name="taxamount" value="'.number_format($total_tax, 2, '.', '').'">'.number_format($total_tax, 2, '.', '').'</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><strong>Grant Total</strong></td>
		<td><input type="hidden" name="amount" value="'.number_format(round($grand_total_amount), 2, '.', '').'"><strong>'.number_format(round($grand_total_amount), 2, '.', '').'</strong></td>
	</tr>';
	exit;
  }
  */
	function UpdateReceiptMail($receipt_id=Null,$mail_send=Null)
	{
		$query = $this->MemberReceipts->query();
		$query->update()
		->set(['mail_send' => $mail_send])
		->where(['receipt_id' => $receipt_id])
		->execute();
		$this->response->body('Ok');
		return $this->response;
	}
	public function InvoiceReceiptMailSms()
	{
		$this->viewBuilder()->layout('Email/text/default');
		$MemberReceipts=$this->MemberReceipts->find()->where(['MemberReceipts.member_fee_id !='=>0,'MemberReceipts.mail_send'=>1])->contain(['MasterPurposes','MemberFees'=>['Users'=> function($q){
			return $q->select(['id','member_type_id','year_of_joining','turn_over_id','company_organisation','due_amount','address','office_telephone','email','member_name','city','pincode'])->where(['member_flag'=>1]);
		},'MemberFeeTaxAmounts'=>['MasterTaxations']]])->limit(30)->toArray();
		
		if(!empty($MemberReceipts))
		{
			$this->set('MemberReceipts',$MemberReceipts);
			$MasterCompanies=$this->MemberReceipts->MasterCompanies->find();
			$this->set('MasterCompanies',$MasterCompanies);
			
		}
		
	}
	public function GeneralReceiptMailSms()
	{
		$this->viewBuilder()->layout('Email/text/default');
		$master_member_receipt=$this->MemberReceipts->find()->where(['member_fee_id'=>0,'mail_send'=>1])->contain(['TaxAmounts'=>['MasterTaxations'],'Users'=>function($q){
				return $q->select(['id','company_organisation','city','email']);
			},'GeneralReceiptPurposes'=>['MasterPurposes']])->limit(1)->toArray();
		
		$MasterCompanies=$this->MemberReceipts->MasterCompanies->find();
		$this->set('MasterCompanies',$MasterCompanies);
		$this->set('master_member_receipt',$master_member_receipt);	
	}





	public function MemberRecieptsViewListExcel() 
	{
		
		$company_id=$this->Auth->User('company_id'); 
		$Companies=$this->MemberReceipts->Companies->get($company_id);
		$role_id=$Companies->role_id;
		@$member_id=$this->request->query['company_id']; 
		@$amount_type=$this->request->query['payment_mode']; 
		@$mail_Send=$this->request->query['sendtype']; 
		@$reciept_type=$this->request->query['reciept_type']; 
		@$purpose_id=$this->request->query['purpose_id']; 
		@$bank_id=$this->request->query['bank_id']; 
		if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
			$from=date('Y-m-d', strtotime($this->request->query['datefrom']));
			$to=date('Y-m-d', strtotime($this->request->query['dateto']));
		}else{
			if(date('m') < 4){
				$from=(date('Y')-1).'-04-1';
				$to=date('Y').'-03-31';
			}else{
				$from=date('Y').'-04-01';
				$to=(date('Y')+1).'-03-31';
			}
		}
		
			if($mail_Send!=3){
				$conditions['MemberReceipts.mail_Send']=$mail_Send;
			}
			$conditions['MemberReceipts.date_current >=']=$from;
			$conditions['MemberReceipts.date_current <=']=$to;
			
			
			if(!empty($purpose_id) && $reciept_type=='Invoice'){
				$conditions['memberReceipts.purpose_id']=$purpose_id;
			}
			if(!empty($amount_type)){
				$conditions['MemberReceipts.amount_type']=$amount_type;
			}
			if(!empty($bank_id)){
				$conditions['MemberReceipts.bank_id']=$bank_id;
			}
			if(!empty($member_id)){
				$conditions['MemberReceipts.company_id']=$member_id;
			}
			if($reciept_type=='Invoice')
			{
				$conditions['MemberReceipts.receipt_type']='member_receipt';
				
				$member_receipt = $this->paginate($this->MemberReceipts->find()
				->where($conditions)
				->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']])
				->order(['MemberReceipts.date_current DESC']));
				
				$this->set(compact('member_receipt'));
			}
			else
			{
				$conditions['MemberReceipts.receipt_type']='general_receipt';
				
				$general_receipt = $this->MemberReceipts->find()->where($conditions)->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']]);
				if(!empty($general_receipt and !empty($purpose_id))){
				$general_receipt->select(['total_rows' => $general_receipt->func()->count('GeneralReceiptPurposes.member_receipt_id')])
				->innerJoinWith('GeneralReceiptPurposes', function($q) use($purpose_id){   
				return $q->where(['GeneralReceiptPurposes.purpose_id'=>$purpose_id]);
				})
				->group(['GeneralReceiptPurposes.member_receipt_id'])
				->having(['total_rows >'=>0])
				->autoFields(true);
				}
				
				$this->set(compact('general_receipt'));
			}
			
			
			
			
			
			
		
		if(!empty($member_receipt) || !empty($general_receipt))
		{ 
			if(!empty($member_receipt))
			{
				$_header=['S.No.','Date','Invoice No','Reciept No.','Company','Reciept Type','Mode Of Payment','Total Amount','Narration','Status'];
			}else{
				$_header=['S.No.','Date','Reciept No.','Company','Reciept Type','Mode Of Payment','Total Amount','Narration','Status'];
			}	
			$sr_no=0;
			$grand_total=0;
			if(!empty($member_receipt)){
				foreach($member_receipt as $data){
					$member_fee_member_receipts=$data->member_fee_member_receipts;
					foreach($member_fee_member_receipts as $member_fee_member_receipt){
						$status=$data->mail_send;
						if($status==0){
								$send_type='Unsend'; 
							}elseif($status==1){ 
								$send_type='Pending'; 
							}else{ $send_type='Sent'; 
							}
							
						$total=0;
						$contain[]=[ ++$sr_no,date('d-m-Y', strtotime($data->date_current)),$member_fee_member_receipt->member_fee->invoice_no,$data->receipt_no,$data->company->company_organisation,$data->receipt_type,$data->amount_type,$total=$data->amount,$data->narration,$send_type];
					} 
				}
			}
			if(!empty($general_receipt)){
				foreach($general_receipt as $general_data)
				{
					
					$status=$general_data->mail_send;
					if($status==0){
							$send_type='Unsend'; 
						}elseif($status==1){ 
							$send_type='Pending'; 
						}else{ $send_type='Sent'; 
						}
						$total=0;
						
					
					$contain[]=[ ++$sr_no,date('d-m-Y', strtotime($general_data->date_current)),$general_data->receipt_no,$general_data->company->company_organisation,$general_data->receipt_type,$general_data->amount_type,$total=$general_data->amount,$general_data->narration,$send_type ];
					$grand_total+=$total;
				}
			}
			
			
			$_serialize = 'contain';
			
			$this->response->download('Member Reciepts View List.csv');
			$this->viewBuilder()->className('CsvView.Csv');
			$this->set(compact('_header', 'contain', '_serialize'));	

		}	
		}



	public function filterdata(){
			$mail_Send=$this->request->query['send_unsend'];
			$purpose_id=$this->request->query['purpose_id'];
			$bank_id=$this->request->query['bank_id'];
			$member_id=$this->request->query['member_id'];
			$amount_type=$this->request->query['amount_type'];
			$receipt_type=$this->request->query['reciept_type'];
			if(!empty($this->request->query['from']) && !empty($this->request->query['to'])){
				$from=date('Y-m-d', strtotime($this->request->query['from']));
				$to=date('Y-m-d', strtotime($this->request->query['to']));
			}else{
				if(date('m') < 4){
					$from=(date('Y')-1).'-04-1';
					$to=date('Y').'-03-31';
				}else{
					$from=date('Y').'-04-01';
					$to=(date('Y')+1).'-03-31';
				}
			}
			if($mail_Send!=3){
				$conditions['MemberReceipts.mail_Send']=$mail_Send;
			}
			$conditions['MemberReceipts.date_current >=']=$from;
			$conditions['MemberReceipts.date_current <=']=$to;
			
			
			if(!empty($purpose_id) && $receipt_type=='Invoice'){
				$conditions['memberReceipts.purpose_id']=$purpose_id;
			}
			if(!empty($amount_type)){
				$conditions['MemberReceipts.amount_type']=$amount_type;
			}
			if(!empty($bank_id)){
				$conditions['MemberReceipts.bank_id']=$bank_id;
			}
			if(!empty($member_id)){
				$conditions['MemberReceipts.company_id']=$member_id;
			}
			//pr($conditions);    exit;
			if($receipt_type=='Invoice')
			{
				$conditions['MemberReceipts.receipt_type']='member_receipt';
			
				$member_receipt = $this->paginate($this->MemberReceipts->find()
				->where($conditions)
				->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']])
				->order(['MemberReceipts.date_current DESC']));
				
				$this->set(compact('member_receipt'));
			}
			else
			{
				$conditions['MemberReceipts.receipt_type']='general_receipt';
					$general_receipt = $this->MemberReceipts->find()->where($conditions)->contain(['Companies','MemberFeeMemberReceipts'=>['MemberFees']]);
		//pr($conditions); pr($general_receipt->toArray());  
		
			if(!empty($general_receipt and !empty($purpose_id))){
				$general_receipt->select(['total_rows' => $general_receipt->func()->count('GeneralReceiptPurposes.member_receipt_id')])
				->innerJoinWith('GeneralReceiptPurposes', function($q) use($purpose_id){   
			return $q->where(['GeneralReceiptPurposes.purpose_id'=>$purpose_id]);
			})
				->group(['GeneralReceiptPurposes.member_receipt_id'])
				->having(['total_rows >'=>0])
				->autoFields(true);

			}	
						
				$this->set(compact('general_receipt'));
			}
			
	}
			
}
?>

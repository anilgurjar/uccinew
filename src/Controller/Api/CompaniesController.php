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
/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
	
	public function nonmemberwpsuccess()
	{
		
		 $company_id=$this->request->query['company_id'];
		 $status=$this->request->query['status'];
		 $txnid=$this->request->query['taxnid'];
		 
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
		$taxations=$this->Companies->MasterTaxations->find()->select(['tax_name','tax_id'])->where(['tax_flag'=>1])->contain(['MasterTaxationRates'])->toArray();
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
			$office_telephone=$this->request->data['office_telephone'];
			$nationality=$this->request->data['nationality'];
			$member_name=$this->request->data['member_name'];
			$email=$this->request->data['email'];
			$mobile_no=$this->request->data['mobile_no'];
			$amount=$this->request->data['amount'];
			$tax_amount=$this->request->data['tax_amount'];
			$total_amount=$this->request->data['total_amount'];
			$master_financial_year_id=$this->request->data['master_financial_year_id'];
			$co_tax_amounts=$this->request->data['co_tax_amounts'];
			
			foreach($co_tax_amounts as $co_tax_amoun){

					  
					$tax_id=$co_tax_amoun['tax_id'];
					$tax_percentage=$co_tax_amoun['tax_percentage'];
					$co_amount=$co_tax_amoun['amount'];   
				
			}
			$find_id_Companies=$this->Companies->find()->where(['company_organisation LIKE'=>$organisation_name])->count();
			if($find_id_Companies>0){
				$find_id_Companies=$this->Companies->find()->where(['company_organisation LIKE'=>$organisation_name]);
				foreach($find_id_Companies as $find_id_Companie){
					$find_id=$find_id_Companie->id;
				}
				$query = $this->Companies->query();
				$query->update()
					->set(['company_organisation'=>$organisation_name,'gst_number'=>$gst_number,'address'=>$address,'office_telephone'=>$office_telephone,'nationality'=>$nationality])
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
						$query = $this->Companies->CoRegistrations->CoTaxAmounts->query();
						$query->update()
							->set(['tax_id'=>$tax_id,'tax_percentage'=>$tax_percentage,'amount'=>$co_amount])
							->where(['co_registration_id' => $find_id_CoRegistration_id])
							->execute();	
					}else{
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
							pr($query->toArray());
						echo $idlst= $query->id;   exit; 
						 
						$query = $this->Companies->CoRegistrations->CoTaxAmounts->query();
						$query->insert(['tax_id', 'tax_percentage','amount','co_registration_id'])
							->values([
								'tax_id' => $tax_id,
								'tax_percentage' => $tax_percentage,
								'amount' => $co_amount,
								'co_registration_id' => $idlst,
							])
							->execute(); 
					
					}
				
			}else{
			echo "anil";   exit;
				$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
				 $form_number=$result_Companies->form_number+1;
				$this->request->data['year_of_joining']=date("Y-m-d");
				$this->request->data['form_number']=$form_number;
				$this->request->data['role_id']=2;
				$Companies=$this->Companies->patchEntity($Companies,$this->request->data,['associated'=>['Users','CompanyMemberTypes','CoRegistrations','CoRegistrations.CoTaxAmounts']]);
				
				if($result=$this->Companies->save($Companies)){
				 $Companies_datas = base64_encode($result);
				 
				 $Companies_data = json_encode($Companies_datas);
				 
				 
				$this->redirect('http://www.ucciudaipur.com/getway?tyqazwersdfxasd='.$Companies_data);
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

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
		{   pr($this->request->data); exit;
			$result_Companies=$this->Companies->find()->select(['form_number'])->order(['form_number' => 'DESC'])->first();
			 $form_number=$result_Companies->form_number+1;
			$this->request->data['year_of_joining']=date("Y-m-d");
			$this->request->data['form_number']=$form_number;
			$this->request->data['role_id']=2;
			$Companies=$this->Companies->patchEntity($Companies,$this->request->data,['associated'=>['Users','CompanyMemberTypes','CoRegistrations','CoRegistrations.CoTaxAmounts']]);
			pr($Companies); exit;
			if($result=$this->Companies->save($Companies)){
			 $Companies_datas = base64_encode($result);
			 
			 $Companies_data = json_encode($Companies_datas);
			 
			 
			 $this->redirect('http://www.ucciudaipur.com/getway?tyqazwersdfxasd='.$Companies_data);
			// return $this->redirect();
			
			}
			//$this->Flash->error(__('Unable to add the non member.'));
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

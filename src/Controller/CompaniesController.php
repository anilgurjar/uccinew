<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout','payment']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		header('Content-type: text/html');
		header('Access-Control-Allow-Origin: *'); 
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
			$this->request->data['year_of_joining']=date("Y-m-d");
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

	public function UcciStaffLogin(){
  
	  $this->viewBuilder()->layout('index_layout');
			$Users = $this->Companies->Users->newEntity();
	  
	  $Companies_data=$this->Companies->find()->where(['role_id'=>4])->toArray();
	  $company_id=$Companies_data[0]->id; 
	  
	   if($this->request->is('post')) {
		
		$this->request->data['company_id']=$company_id;
	   
		$Users=$this->Companies->Users->patchEntity($Users,$this->request->data);
		if ($this->Companies->Users->save($Users)) {
					$this->Flash->success(__('The Users has been saved.'));

					return $this->redirect(['action' => 'UcciStaffLogin']);
				} else {
					$this->Flash->error(__('The Users could not be saved. Please, try again.'));
				}
		
	   }
	   $staff_logins=$this->Companies->find()->where(['role_id'=>4])->contain(['Users'])->toArray();
	  
	  $this->set(compact('Users','staff_logins'));
	  
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
	
	public function documents()
    {
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
        $company = $this->Companies->newEntity();
        if ($this->request->is('post')) 
		{
			$pan_card=$this->request->data['pan_card'];
			$company_registration=$this->request->data['company_registration'];
			$ibc_code=$this->request->data['ibc_code']; 
			//-- PAN 
			$dir = new Folder(WWW_ROOT . 'images/company_document/'.$company_id, true, 0755);
			if(!empty($pan_card['tmp_name']))
			{
				
				$ext = substr(strtolower(strrchr($pan_card['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				$pancard_path='images/company_document/'.$company_id.'/pan_card.'.$ext;
				move_uploaded_file($pan_card['tmp_name'], WWW_ROOT . '/images/company_document/'.$company_id.'/pan_card.'.$ext);
				$query = $this->Companies->query();
				$query->update()
				->set(['pan_card'=>$pancard_path])
				->where(['id' => $company_id])
				->execute();
			}
			//-- COMAPANY REGISTRATION
			if(!empty($company_registration['tmp_name']))
			{
			 
				$ext = substr(strtolower(strrchr($company_registration['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				$company_registration_path='images/company_document/'.$company_id.'/company_registration.'.$ext;
				move_uploaded_file($company_registration['tmp_name'], WWW_ROOT . '/images/company_document/'.$company_id.'/company_registration.'.$ext);
				$query = $this->Companies->query();
				$query->update()
				->set(['company_registration'=>$company_registration_path])
				->where(['id' => $company_id])
				->execute();
			}
			//-- IBC CODE
			if(!empty($ibc_code['tmp_name']))
			{
			 
				$ext = substr(strtolower(strrchr($ibc_code['name'], '.')), 1); //get the extension
				$arr_ext = array('jpg', 'jpeg'); //set allowed extensions
				$ibc_code_path='images/company_document/'.$company_id.'/ibc_code.'.$ext;
				move_uploaded_file($ibc_code['tmp_name'], WWW_ROOT . '/images/company_document/'.$company_id.'/ibc_code.'.$ext);
				$query = $this->Companies->query();
				$query->update()
				->set(['ibc_code'=>$ibc_code_path])
				->where(['id' => $company_id])
				->execute();
			}
			 
            $this->Flash->success(__('The company has been saved.'));
            return $this->redirect(['action' => 'documents']);
        }
		$companies_data = $this->Companies->find()->where(['id' => $company_id])->first();
 		
		$this->set(compact('company','companies_data'));
        $this->set('_serialize', ['company','companies_data']);
    }
}

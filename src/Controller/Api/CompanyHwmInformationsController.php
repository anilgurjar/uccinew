<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

 
class CompanyHwmInformationsController extends AppController
{

    public function initialize()
	{
		parent::initialize();
	}
	
	public function hwmSecondForm()
	{
		$companyHwmInformation = $this->CompanyHwmInformations->newEntity();
		$CompanyWasteInformations = $this->CompanyHwmInformations->CompanyWasteInformations->newEntity();
		$CompanyWastageInformations = $this->CompanyHwmInformations->CompanyWastageInformations->newEntity();
         if ($this->request->is('post')) {
			pr($this->request->data); exit; 
			$company_waste_informations=$this->request->data['company_waste_informations'];
			$CompanyWasteInformations = $this->CompanyHwmInformations->CompanyWasteInformations->newEntities($company_waste_informations);
			if ($this->CompanyHwmInformations->CompanyWasteInformations->saveMany($CompanyWasteInformations)) {
			}
			$company_wastage_informations=$this->request->data['company_wastage_informations'];
			$CompanyWastageInformations = $this->CompanyHwmInformations->CompanyWastageInformations->newEntities($company_wastage_informations);
			if ($this->CompanyHwmInformations->CompanyWastageInformations->saveMany($CompanyWastageInformations)) {
			}
			
			$this->request->data['company_id']=$company_waste_informations[0]['company_id'];
			
			$constituents_present=$this->request->data['constituents_present'];
			$impload_data=implode(',',$constituents_present);
			$this->request->data['constituents_present']=$impload_data;
			
			$principal_components=$this->request->data['principal_components'];
			$impload_principal_components=implode(',',$principal_components);
			$this->request->data['principal_components']=$impload_principal_components;
			
			$acidic_basic=$this->request->data['acidic_basic'];
			$impload_acidic_basic=implode(',',$acidic_basic);
			$this->request->data['acidic_basic']=$impload_acidic_basic;
			
			$waste_combustible=$this->request->data['waste_combustible'];
			$impload_waste_combustible=implode(',',$waste_combustible);
			$this->request->data['waste_combustible']=$impload_waste_combustible;
			
			$chemical_composition_sheet=$this->request->data['chemical_composition_sheet'];
			$potential_reuse=$this->request->data['potential_reuse'];
			$impload_potential_reuse=implode(',',$potential_reuse);
			$this->request->data['potential_reuse']=$impload_potential_reuse;
			if(!empty($chemical_composition_sheet['tmp_name']))
			{
				$ext = substr(strtolower(strrchr($chemical_composition_sheet['name'], '.')), 1); //get the extension
				$dir = new Folder(WWW_ROOT . 'hwm_documents/'.$company_waste_informations[0]['company_id'], true, 0755);
				$setNewFileName = 'chemical_composition_sheet_'.$company_waste_informations[0]['company_id'].'.'.$ext;
			
				move_uploaded_file($chemical_composition_sheet['tmp_name'], WWW_ROOT . '/hwm_documents/'.$company_waste_informations[0]['company_id'].'/'.$setNewFileName);
				$UploadURL='hwm_documents/'.$company_waste_informations[0]['company_id'].'/'.$setNewFileName;
				$this->request->data['chemical_composition_sheet']=$UploadURL;
			}
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
			//pr($companyHwmInformation); exit;
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
				$this->redirect('http://www.ucciudaipur.com/hwm3?CaaOdaMsdaPsaArefNdsY__IdsadcD='.$company_waste_informations[0]['company_id']);
            } 
        }
	}
 	
     
    public function add()
    {
        $companyHwmInformation = $this->CompanyHwmInformations->newEntity();
        if ($this->request->is('post')) {
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
                $this->Flash->success(__('The company hwm information has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company hwm information could not be saved. Please, try again.'));
            }
        }
        $companies = $this->CompanyHwmInformations->Companies->find('list', ['limit' => 200]);
        $this->set(compact('companyHwmInformation', 'companies'));
        $this->set('_serialize', ['companyHwmInformation']);
    }
}

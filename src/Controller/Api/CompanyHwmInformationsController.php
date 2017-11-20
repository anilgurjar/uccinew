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
         if ($this->request->is('post')) {
			pr($this->request->data); exit; 
			$company_waste_informations=$this->request->data['company_waste_informations'];
		 
			$CompanyWasteInformations = $this->CompanyHwmInformations->CompanyWasteInformations->newEntities($company_waste_informations);
			if ($this->CompanyHwmInformations->CompanyWasteInformations->saveMany($CompanyWasteInformations)) {
			}
			$this->request->data['company_id']=$company_waste_informations[0]['company_id'];
			$constituents_present=$this->request->data['constituents_present'];
			//$impload_data=implode(',',$constituents_present);
			//$this->request->data['constituents_present']=$impload_data;
			
            $companyHwmInformation = $this->CompanyHwmInformations->patchEntity($companyHwmInformation, $this->request->data);
			pr($companyHwmInformation); exit;
            if ($this->CompanyHwmInformations->save($companyHwmInformation)) {
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

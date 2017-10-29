<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
/**
 * MasterFinancialYears Controller
 *
 * @property \App\Model\Table\MasterFinancialYearsTable $MasterFinancialYears
 */
class MasterFinancialYearsController extends AppController
{

    public function initialize()
	{
		parent::initialize();
	}
	
    public function index()
    {
        $masterFinancialYears = $this->MasterFinancialYears->find()->count();
		if($masterFinancialYears > 0)
		{
			 
			$FinancialYears = $this->MasterFinancialYears->find()
								->select(['id','financial_year'])
								->where(['flag'=>0]);
			$success=true;
			$error='';
			$FinancialYears;
		}
		else
		{
			$success=false;
			$error="Something went wrong.";
			$FinancialYears="";
		}
		$this->set(compact('success','error','FinancialYears'));
        $this->set('_serialize', ['success','error','FinancialYears']);
	}
}

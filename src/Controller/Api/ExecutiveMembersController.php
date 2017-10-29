<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event; 

/**
 * ExecutiveMembers Controller
 *
 * @property \App\Model\Table\ExecutiveMembersTable $ExecutiveMembers
 */
class ExecutiveMembersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
	}
     
    public function view()
    {
        $id = $this->request->query('financial_years_id');
		$master_financial_years=$this->ExecutiveMembers->MasterFinancialYears->find()->where(['id'=>$id])->toArray();
		//pr($master_financial_years); exit;
		 $financial_year=$master_financial_years[0]->financial_year;
		
        $executiveMembers = $this->ExecutiveMembers->find()->where(['master_financial_year_id'=>$id])->count(); 
		if($executiveMembers>0)
		{
			$executiveMember=$this->ExecutiveMembers->ExecutiveCategories->find()
			->where(['master_financial_year_id'=>$id])
			->contain(['ExecutiveMembers'=> function($q) use ($id) {
				return $q
				->where(['ExecutiveMembers.master_financial_year_id'=>$id])->contain(['Users'=>function($qq){
					return $qq->find('all')->select(['id','member_name','image'])->contain(['Companies']);
				},'Designations'=>function($qqq){
					return $qqq->find('all');
				}]);
			}]);
			
			foreach($executiveMember as $executiveMembers)
			{
				foreach($executiveMembers->executive_members as $data)
				{
					if(empty($data->designation_id))
					{
						$data->designation_id= 0; 
					}
					if(empty($data->designation))
					{
						$data->designation = (object)[]; 
					}
					$id_card_no=$data->user->company->id_card_no;
					$company_organisation=$data->user->company->company_organisation;
					$data->user->id_card_no=$id_card_no;
					$data->user->company_organisation=$company_organisation;
				}
			}
			$success=true;
			$year=$financial_year;
			$error='';
			$MemberList=$executiveMember;
		}
		else
		{
			$success=false;
			$error="No data found.";
			$MemberList='';
			$financial_year='';
		}
		

		
        $this->set(compact('success','error','MemberList','financial_year'));
        $this->set('_serialize', ['success','error','MemberList','financial_year']);
    }

}
 
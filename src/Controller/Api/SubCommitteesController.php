<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event; 

/**
 * SubCommittees Controller
 *
 * @property \App\Model\Table\SubCommitteesTable $SubCommittees
 */
class SubCommitteesController extends AppController
{
 
    public function view()
    {
  		$financial_years_id = $this->request->query('financial_years_id');
		$SubCommittees=$this->SubCommittees->find()->contain(['Users'=>function($qq){
				return $qq->find('all')->select(['id','member_name','image'])->contain(['Companies']);
			},'Designations'=>function($qqq){
				return $qqq->find('all');
			}])
			->where(['master_financial_year_id' => $financial_years_id]);
		
		if($SubCommittees)
		{
			foreach($SubCommittees as $data)
			{
				if(empty($data->designation_id))
				{
					$data->designation=(object)[];
					$data->designation_id=0;
				} 
				$id_card_no=$data->user->company->id_card_no;
				$company_organisation=$data->user->company->company_organisation;
				$data->user->id_card_no=$id_card_no;
				$data->user->company_organisation=$company_organisation;
			}
			$success=true;
			$error='';
			$SubCommittees=$SubCommittees;
		}
		else
		{
			$success=false;
			$error="No data found.";
			$SubCommittees='';
		}
		$this->set(compact('success','error','SubCommittees'));
        $this->set('_serialize', ['success','error','SubCommittees']);     
 
    }
}

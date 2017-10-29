<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserLoginsTable extends Table
{
    public function initialize(array $config)
    {
		$this->belongsTo('UserRights');
		$this->belongsTo('Roles');
		$this->belongsTo('Modules');
		$this->belongsTo('MasterMembers');
		$this->belongsTo('MemberFees');
		$this->belongsTo('MemberReceipts');
		$this->belongsTo('MasterTurnOvers');
		$this->belongsTo('MasterMemberTypes');
		$this->belongsTo('MasterGrades');
		$this->belongsTo('MasterCategories');
		$this->belongsTo('MasterClassifications');
		$this->belongsTo('Roles');
		$this->belongsTo('MasterBanks');
		$this->belongsTo('MasterPurposes');
		$this->belongsTo('MasterMembershipFees');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('MasterTaxationRates');
		
		
		
	}
	
}
?>
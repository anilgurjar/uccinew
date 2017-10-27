<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MasterMembersTable extends Table
{
    public function initialize(array $config)
    {
		$this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'member_type_id',
			'joinType' => 'inner'
        ]);
	}
	
}
?>
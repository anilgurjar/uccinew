<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberReceipts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Receipts
 * @property \Cake\ORM\Association\BelongsTo $MemberFees
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Purposes
 * @property \Cake\ORM\Association\BelongsTo $Banks
 * @property \Cake\ORM\Association\HasMany $GeneralReceiptPurposes
 * @property \Cake\ORM\Association\HasMany $TaxAmounts
 *
 * @method \App\Model\Entity\MemberReceipt get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberReceipt newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberReceipt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberReceipt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberReceipt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberReceipt[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberReceipt findOrCreate($search, callable $callback = null)
 */
class MemberReceiptsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('member_receipts');
        $this->displayField('receipt_id');
        $this->primaryKey('receipt_id');

        $this->belongsTo('Receipts', [
            'foreignKey' => 'receipt_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MemberFees', [
            'foreignKey' => 'member_fee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);

	/* 	$this->belongsTo('MemberFeeMemberReceipts', [
			'foreignKey' => 'member_receipt_id',
			'joinType' => 'INNER'
		]);
 */
 
		 $this->belongsTo('MasterStates', [
            'foreignKey' => 'master_state_id',
            'joinType' => 'INNER'
        ]);
   
		$this->belongsTo('MasterPurposes', [
            'foreignKey' => 'purpose_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Banks', [  
            'foreignKey' => 'bank_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('GeneralReceiptPurposes', [
            'foreignKey' => 'member_receipt_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('TaxAmounts', [
            'foreignKey' => 'member_receipt_id',
			'saveStrategy'=>'replace'
        ]);
		
		 $this->hasMany('MemberFeeMemberReceipts', [
            'foreignKey' => 'member_receipt_id'
        ]);
		
		
		$this->belongsTo('MasterTaxationRates');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('MasterMemberTypes');
		$this->belongsTo('MasterBanks');
		$this->belongsTo('MasterMembershipFees');
		$this->belongsTo('MasterFinancialYears');
		$this->belongsTo('MasterCompanies');
		$this->belongsTo('MasterTurnOvers');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('receipt_no')
            ->requirePresence('receipt_no', 'create')
            ->notEmpty('receipt_no');

      /*   $validator
            ->requirePresence('amount_type', 'create')
            ->notEmpty('amount_type');

        $validator
            ->requirePresence('drawn_bank', 'create')
            ->notEmpty('drawn_bank');

        $validator
            ->requirePresence('cheque_no', 'create')
            ->notEmpty('cheque_no');

        $validator
            ->date('cheque_date')
            ->requirePresence('cheque_date', 'create')
            ->notEmpty('cheque_date');

        $validator
            ->decimal('basic_amount')
            ->requirePresence('basic_amount', 'create')
            ->notEmpty('basic_amount');

        $validator
            ->decimal('taxamount')
            ->requirePresence('taxamount', 'create')
            ->notEmpty('taxamount');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->decimal('tds_amount')
            ->requirePresence('tds_amount', 'create')
            ->notEmpty('tds_amount');

        $validator
            ->requirePresence('narration', 'create')
            ->notEmpty('narration');
 
        $validator
            ->integer('mail_send')
            ->requirePresence('mail_send', 'create')
            ->notEmpty('mail_send');

        $validator
            ->integer('sms_send')
            ->requirePresence('sms_send', 'create')
            ->notEmpty('sms_send');

        $validator
            ->dateTime('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current');

        $validator
            ->integer('receipt_flag')
            ->requirePresence('receipt_flag', 'create')
            ->notEmpty('receipt_flag');
*/
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->existsIn(['receipt_id'], 'Receipts'));
        $rules->add($rules->existsIn(['member_fee_id'], 'MemberFees'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        //$rules->add($rules->existsIn(['purpose_id'], 'Purposes'));
        //$rules->add($rules->existsIn(['bank_id'], 'Banks'));

        return $rules;
    }
}

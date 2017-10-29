<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberFees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $CompanyMemberTypes
 * @property \Cake\ORM\Association\BelongsTo $MasterFinancialYears
 * @property \Cake\ORM\Association\HasMany $MemberFeeTaxAmounts
 * @property \Cake\ORM\Association\HasMany $MemberReceipts
 *
 * @method \App\Model\Entity\MemberFee get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberFee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberFee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberFee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberFee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberFee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberFee findOrCreate($search, callable $callback = null)
 */
class MemberFeesTable extends Table
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

        $this->table('member_fees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CompanyMemberTypes', [
            'foreignKey' => 'company_member_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterFinancialYears', [
            'foreignKey' => 'master_financial_year_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MemberFeeTaxAmounts', [
            'foreignKey' => 'member_fee_id'
        ]);
        $this->hasMany('MemberReceipts', [
            'foreignKey' => 'member_fee_id'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

       /*  $validator
            ->integer('invoice_no')
            ->requirePresence('invoice_no', 'create')
            ->notEmpty('invoice_no');

        $validator
            ->integer('performa_invoice_no')
            ->requirePresence('performa_invoice_no', 'create')
            ->notEmpty('performa_invoice_no');

        $validator
            ->decimal('turn_over_fee')
            ->requirePresence('turn_over_fee', 'create')
            ->notEmpty('turn_over_fee');

        $validator
            ->decimal('membership_fee')
            ->requirePresence('membership_fee', 'create')
            ->notEmpty('membership_fee');

        $validator
            ->decimal('sub_total')
            ->requirePresence('sub_total', 'create')
            ->notEmpty('sub_total');

        $validator
            ->decimal('tax_amount')
            ->requirePresence('tax_amount', 'create')
            ->notEmpty('tax_amount');

        $validator
            ->decimal('grand_total')
            ->requirePresence('grand_total', 'create')
            ->notEmpty('grand_total');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->date('invoice_date')
            ->requirePresence('invoice_date', 'create')
            ->notEmpty('invoice_date');

        $validator
            ->integer('mail_send')
            ->requirePresence('mail_send', 'create')
            ->notEmpty('mail_send');

        $validator
            ->integer('reminder_mail')
            ->requirePresence('reminder_mail', 'create')
            ->notEmpty('reminder_mail');

        $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag'); */

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['company_member_type_id'], 'CompanyMemberTypes'));
        $rules->add($rules->existsIn(['master_financial_year_id'], 'MasterFinancialYears'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberFeeMemberReceipts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MemberFees
 * @property \Cake\ORM\Association\BelongsTo $MemberReceipts
 *
 * @method \App\Model\Entity\MemberFeeMemberReceipt get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberFeeMemberReceipt findOrCreate($search, callable $callback = null)
 */
class MemberFeeMemberReceiptsTable extends Table
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

        $this->table('member_fee_member_receipts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MemberFees', [
            'foreignKey' => 'member_fee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MemberReceipts', [
            'foreignKey' => 'member_receipt_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['member_fee_id'], 'MemberFees'));
        $rules->add($rules->existsIn(['member_receipt_id'], 'MemberReceipts'));

        return $rules;
    }
}

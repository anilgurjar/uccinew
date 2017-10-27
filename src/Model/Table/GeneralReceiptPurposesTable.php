<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GeneralReceiptPurposes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MemberReceipts
 * @property \Cake\ORM\Association\BelongsTo $Purposes
 *
 * @method \App\Model\Entity\GeneralReceiptPurpose get($primaryKey, $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GeneralReceiptPurpose findOrCreate($search, callable $callback = null)
 */
class GeneralReceiptPurposesTable extends Table
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

        $this->table('general_receipt_purposes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MemberReceipts', [
            'foreignKey' => 'member_receipt_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterPurposes', [
            'foreignKey' => 'purpose_id',
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

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->decimal('total')
            ->requirePresence('total', 'create')
            ->notEmpty('total');

       /*  $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag');

        $validator
            ->dateTime('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current'); */

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
        $rules->add($rules->existsIn(['member_receipt_id'], 'MemberReceipts'));
      //  $rules->add($rules->existsIn(['purpose_id'], 'Purposes'));

        return $rules;
    }
}

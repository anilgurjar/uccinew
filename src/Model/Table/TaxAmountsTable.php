<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxAmounts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MemberReceipts
 * @property \Cake\ORM\Association\BelongsTo $Taxes
 *
 * @method \App\Model\Entity\TaxAmount get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxAmount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxAmount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxAmount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxAmount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxAmount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxAmount findOrCreate($search, callable $callback = null)
 */
class TaxAmountsTable extends Table
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

        $this->table('tax_amounts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MemberReceipts', [
            'foreignKey' => 'member_receipt_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterTaxations', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER'
        ]);
		
		//$this->belongsTo('MasterTaxationRates');
		//$this->belongsTo('MasterTaxations');
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
            ->decimal('tax_percentage')
            ->requirePresence('tax_percentage', 'create')
            ->notEmpty('tax_percentage');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        //$rules->add($rules->existsIn(['tax_id'], 'Taxes'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProposeBudgets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MasterPurposes
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ProposeBudget get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProposeBudget newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProposeBudget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProposeBudget|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProposeBudget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProposeBudget[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProposeBudget findOrCreate($search, callable $callback = null)
 */
class ProposeBudgetsTable extends Table
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

        $this->table('propose_budgets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MasterPurposes', [
            'foreignKey' => 'master_purpose_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->date('financial_year_from')
            ->requirePresence('financial_year_from', 'create')
            ->notEmpty('financial_year_from');

        $validator
            ->date('financial_year_to')
            ->requirePresence('financial_year_to', 'create')
            ->notEmpty('financial_year_to');

        $validator
            ->decimal('expenditure_amount')
            ->requirePresence('expenditure_amount', 'create')
            ->notEmpty('expenditure_amount');

        $validator
            ->decimal('receipt_amount')
            ->requirePresence('receipt_amount', 'create')
            ->notEmpty('receipt_amount');

        $validator
            ->dateTime('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current');

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
        $rules->add($rules->existsIn(['master_purpose_id'], 'MasterPurposes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}

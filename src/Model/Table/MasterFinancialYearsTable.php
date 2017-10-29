<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterFinancialYears Model
 *
 * @property \Cake\ORM\Association\HasMany $ExecutiveMembers
 * @property \Cake\ORM\Association\HasMany $MemberFees
 * @property \Cake\ORM\Association\HasMany $SubCommittees
 *
 * @method \App\Model\Entity\MasterFinancialYear get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterFinancialYear newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterFinancialYear[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterFinancialYear|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterFinancialYear patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterFinancialYear[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterFinancialYear findOrCreate($search, callable $callback = null)
 */
class MasterFinancialYearsTable extends Table
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

        $this->table('master_financial_years');
        $this->displayField('financial_year');
        $this->primaryKey('id');

        $this->hasMany('ExecutiveMembers', [
            'foreignKey' => 'master_financial_year_id'
        ]);
        $this->hasMany('MemberFees', [
            'foreignKey' => 'master_financial_year_id'
        ]);
        $this->hasMany('SubCommittees', [
            'foreignKey' => 'master_financial_year_id'
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
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag');

        $validator
            ->requirePresence('financial_year', 'create')
            ->notEmpty('financial_year');

        return $validator;
    }
}

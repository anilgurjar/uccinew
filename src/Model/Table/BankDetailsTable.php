<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankDetails Model
 *
 * @method \App\Model\Entity\BankDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankDetail findOrCreate($search, callable $callback = null)
 */
class BankDetailsTable extends Table
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

        $this->table('bank_details');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('account_holder_name', 'create')
            ->notEmpty('account_holder_name');

        $validator
            ->requirePresence('bank_name_and_address', 'create')
            ->notEmpty('bank_name_and_address');

        $validator
            ->requirePresence('bank_account_number', 'create')
            ->notEmpty('bank_account_number');

        $validator
            ->requirePresence('rtgs_neft_ifs_code', 'create')
            ->notEmpty('rtgs_neft_ifs_code');

        return $validator;
    }
}

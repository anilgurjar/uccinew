<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterCompanies Model
 *
 * @method \App\Model\Entity\MasterCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterCompany newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterCompany|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCompany[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCompany findOrCreate($search, callable $callback = null)
 */
class MasterCompaniesTable extends Table
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

        $this->table('master_companies');
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
            ->requirePresence('company_information', 'create')
            ->notEmpty('company_information');

        $validator
            ->requirePresence('st_reg_no', 'create')
            ->notEmpty('st_reg_no');

        $validator
            ->requirePresence('pan_no', 'create')
            ->notEmpty('pan_no');

        $validator
            ->requirePresence('gst_number', 'create')
            ->notEmpty('gst_number');

        return $validator;
    }
}

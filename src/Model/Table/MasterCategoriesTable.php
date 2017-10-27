<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterCategories Model
 *
 * @method \App\Model\Entity\MasterCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCategory findOrCreate($search, callable $callback = null)
 */
class MasterCategoriesTable extends Table
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

        $this->table('master_categories');
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
            ->requirePresence('category_name', 'create')
            ->notEmpty('category_name');

        return $validator;
    }
}

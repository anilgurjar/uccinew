<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExecutiveCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $ExecutiveMembers
 *
 * @method \App\Model\Entity\ExecutiveCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExecutiveCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExecutiveCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExecutiveCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveCategory findOrCreate($search, callable $callback = null)
 */
class ExecutiveCategoriesTable extends Table
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

        $this->table('executive_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('ExecutiveMembers', [
            'foreignKey' => 'executive_category_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('member_limit')
            ->requirePresence('member_limit', 'create')
            ->notEmpty('member_limit');

        return $validator;
    }
}

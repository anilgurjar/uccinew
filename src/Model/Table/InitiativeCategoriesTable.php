<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InitiativeCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $Initiatives
 *
 * @method \App\Model\Entity\InitiativeCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\InitiativeCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InitiativeCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InitiativeCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InitiativeCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InitiativeCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InitiativeCategory findOrCreate($search, callable $callback = null)
 */
class InitiativeCategoriesTable extends Table
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

        $this->table('initiative_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Initiatives', [
            'foreignKey' => 'initiative_category_id'
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

        return $validator;
    }
}

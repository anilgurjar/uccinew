<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $EventHistories
 * @property \Cake\ORM\Association\HasMany $Events
 *
 * @method \App\Model\Entity\EventCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventCategory findOrCreate($search, callable $callback = null)
 */
class EventCategoriesTable extends Table
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

        $this->table('event_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('EventHistories', [
            'foreignKey' => 'event_category_id'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'event_category_id'
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

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Initiatives Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InitiativeCategories
 *
 * @method \App\Model\Entity\Initiative get($primaryKey, $options = [])
 * @method \App\Model\Entity\Initiative newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Initiative[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Initiative|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Initiative patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Initiative[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Initiative findOrCreate($search, callable $callback = null)
 */
class InitiativesTable extends Table
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

        $this->table('initiatives');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('InitiativeCategories', [
            'foreignKey' => 'initiative_category_id',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
			
		 $validator
            ->requirePresence('initiative_category_id', 'create')
            ->notEmpty('initiative_category_id');

       /*  $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->integer('edited_by')
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by');

        $validator
            ->requirePresence('photo', 'create')
            ->notEmpty('photo'); */

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
        $rules->add($rules->existsIn(['initiative_category_id'], 'InitiativeCategories'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndustrialGrievanceFollows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $IndustrialGrievances
 *
 * @method \App\Model\Entity\IndustrialGrievanceFollow get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceFollow findOrCreate($search, callable $callback = null)
 */
class IndustrialGrievanceFollowsTable extends Table
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

        $this->table('industrial_grievance_follows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('IndustrialGrievances', [
            'foreignKey' => 'industrial_grievance_id',
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

       /*  $validator
            ->requirePresence('department_content', 'create')
            ->notEmpty('department_content');

        $validator
            ->requirePresence('ucci_content', 'create')
            ->notEmpty('ucci_content');

        $validator
            ->dateTime('follow_date')
            ->requirePresence('follow_date', 'create')
            ->notEmpty('follow_date'); */

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
        $rules->add($rules->existsIn(['industrial_grievance_id'], 'IndustrialGrievances'));

        return $rules;
    }
}

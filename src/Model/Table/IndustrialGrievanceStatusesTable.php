<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndustrialGrievanceStatuses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $IndustrialGrievances
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\IndustrialGrievanceStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievanceStatus findOrCreate($search, callable $callback = null)
 */
class IndustrialGrievanceStatusesTable extends Table
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

        $this->table('industrial_grievance_statuses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('IndustrialGrievances', [
            'foreignKey' => 'industrial_grievance_id',
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
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('action_date')
            ->requirePresence('action_date', 'create')
            ->notEmpty('action_date');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->requirePresence('reopen_reason', 'create')
            ->notEmpty('reopen_reason');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GrievanceIssueRelateds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $GrievanceIssues
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievances
 *
 * @method \App\Model\Entity\GrievanceIssueRelated get($primaryKey, $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceIssueRelated findOrCreate($search, callable $callback = null)
 */
class GrievanceIssueRelatedsTable extends Table
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

        $this->table('grievance_issue_relateds');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('GrievanceIssues', [
            'foreignKey' => 'grievance_issue_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('IndustrialGrievances', [
            'foreignKey' => 'grievance_issue_related_id'
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['grievance_issue_id'], 'GrievanceIssues'));

        return $rules;
    }
}

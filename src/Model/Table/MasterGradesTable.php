<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterGrades Model
 *
 * @method \App\Model\Entity\MasterGrade get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterGrade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterGrade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterGrade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterGrade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterGrade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterGrade findOrCreate($search, callable $callback = null)
 */
class MasterGradesTable extends Table
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

        $this->table('master_grades');
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
            ->requirePresence('grade_name', 'create')
            ->notEmpty('grade_name');

        return $validator;
    }
}

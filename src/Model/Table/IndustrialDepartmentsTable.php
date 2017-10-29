<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndustrialDepartments Model
 *
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievances
 *
 * @method \App\Model\Entity\IndustrialDepartment get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndustrialDepartment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndustrialDepartment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialDepartment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndustrialDepartment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialDepartment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialDepartment findOrCreate($search, callable $callback = null)
 */
class IndustrialDepartmentsTable extends Table
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

        $this->table('industrial_departments');
        $this->displayField('department_name');
        $this->primaryKey('id');

		$this->belongsTo('Companies');
		
        $this->hasMany('IndustrialGrievances', [
            'foreignKey' => 'industrial_department_id'
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
            ->requirePresence('department_name', 'create')
            ->notEmpty('department_name');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GrievanceCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievances
 *
 * @method \App\Model\Entity\GrievanceCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\GrievanceCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GrievanceCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GrievanceCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GrievanceCategory findOrCreate($search, callable $callback = null)
 */
class GrievanceCategoriesTable extends Table
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

        $this->table('grievance_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('IndustrialGrievances', [
            'foreignKey' => 'grievance_category_id'
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

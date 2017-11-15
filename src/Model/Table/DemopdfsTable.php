<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Demopdfs Model
 *
 * @method \App\Model\Entity\Demopdf get($primaryKey, $options = [])
 * @method \App\Model\Entity\Demopdf newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Demopdf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Demopdf|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demopdf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Demopdf[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Demopdf findOrCreate($search, callable $callback = null)
 */
class DemopdfsTable extends Table
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

        $this->table('demopdfs');
        $this->displayField('name');
        $this->primaryKey('id');
		
		$this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('file_attachment', 'create')
            ->notEmpty('file_attachment');
 */
        return $validator;
    }
}

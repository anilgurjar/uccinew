<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterClassifications Model
 *
 * @method \App\Model\Entity\MasterClassification get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterClassification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterClassification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterClassification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterClassification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterClassification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterClassification findOrCreate($search, callable $callback = null)
 */
class MasterClassificationsTable extends Table
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

        $this->table('master_classifications');
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
            ->requirePresence('classification_name', 'create')
            ->notEmpty('classification_name');

        return $validator;
    }
}

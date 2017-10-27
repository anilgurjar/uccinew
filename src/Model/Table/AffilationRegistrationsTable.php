<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AffilationRegistrations Model
 *
 * @method \App\Model\Entity\AffilationRegistration get($primaryKey, $options = [])
 * @method \App\Model\Entity\AffilationRegistration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AffilationRegistration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AffilationRegistration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AffilationRegistration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AffilationRegistration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AffilationRegistration findOrCreate($search, callable $callback = null)
 */
class AffilationRegistrationsTable extends Table
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

        $this->table('affilation_registrations');
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
            ->requirePresence('logo', 'create')
            ->notEmpty('logo');

       /*  $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on'); */

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        return $validator;
    }
}

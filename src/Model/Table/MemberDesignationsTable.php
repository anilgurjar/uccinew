<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberDesignations Model
 *
 * @method \App\Model\Entity\MemberDesignation get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberDesignation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberDesignation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberDesignation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberDesignation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberDesignation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberDesignation findOrCreate($search, callable $callback = null)
 */
class MemberDesignationsTable extends Table
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

        $this->table('member_designations');
        $this->displayField('name');
        $this->primaryKey('name');
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

        $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modules Model
 *
 * @property \Cake\ORM\Association\HasMany $UserRights
 *
 * @method \App\Model\Entity\Module get($primaryKey, $options = [])
 * @method \App\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Module|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Module findOrCreate($search, callable $callback = null)
 */
class ModulesTable extends Table
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

        $this->table('modules');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('UserRights', [
            'foreignKey' => 'module_id'
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

        $validator
            ->requirePresence('main_menu', 'create')
            ->notEmpty('main_menu');

        $validator
            ->requirePresence('main_menu_icon', 'create')
            ->notEmpty('main_menu_icon');

        $validator
            ->requirePresence('sub_menu', 'create')
            ->notEmpty('sub_menu');

        $validator
            ->requirePresence('sub_menu_icon', 'create')
            ->notEmpty('sub_menu_icon');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->requirePresence('page_name_url', 'create')
            ->notEmpty('page_name_url');

        $validator
            ->requirePresence('icon_class_name', 'create')
            ->notEmpty('icon_class_name');

        $validator
            ->requirePresence('query_string', 'create')
            ->notEmpty('query_string');

        $validator
            ->requirePresence('target', 'create')
            ->notEmpty('target');

        $validator
            ->requirePresence('tooltips', 'create')
            ->notEmpty('tooltips');

        $validator
            ->integer('preferance')
            ->requirePresence('preferance', 'create')
            ->notEmpty('preferance');

        return $validator;
    }
}

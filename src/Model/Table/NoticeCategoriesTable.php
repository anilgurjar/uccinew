<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NoticeCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $Notices
 *
 * @method \App\Model\Entity\NoticeCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\NoticeCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NoticeCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NoticeCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NoticeCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NoticeCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NoticeCategory findOrCreate($search, callable $callback = null)
 */
class NoticeCategoriesTable extends Table
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

        $this->table('notice_categories');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Notices', [
            'foreignKey' => 'notice_category_id'
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
            ->requirePresence('category_name', 'create')
            ->notEmpty('category_name');

        return $validator;
    }
}

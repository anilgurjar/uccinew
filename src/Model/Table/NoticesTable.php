<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notices Model
 *
 * @property \Cake\ORM\Association\BelongsTo $NoticeCategories
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 * @property \Cake\ORM\Association\HasMany $NoticeMails
 *
 * @method \App\Model\Entity\Notice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Notice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Notice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Notice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Notice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notice findOrCreate($search, callable $callback = null)
 */
class NoticesTable extends Table
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

        $this->table('notices');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('NoticeCategories', [
            'foreignKey' => 'notice_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'member_type_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('NoticeMails', [
            'foreignKey' => 'notice_id'
        ]);
		
		 $this->belongsTo('Users');
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
            ->integer('type_of_member')
            ->requirePresence('type_of_member', 'create')
            ->notEmpty('type_of_member');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

       /*  $validator
            ->requirePresence('file', 'create')
            ->notEmpty('file');
 */
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
        $rules->add($rules->existsIn(['notice_category_id'], 'NoticeCategories'));
        $rules->add($rules->existsIn(['master_member_type_id'], 'MasterMemberTypes'));

        return $rules;
    }
}

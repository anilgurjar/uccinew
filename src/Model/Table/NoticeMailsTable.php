<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NoticeMails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Notices
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\NoticeMail get($primaryKey, $options = [])
 * @method \App\Model\Entity\NoticeMail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NoticeMail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NoticeMail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NoticeMail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NoticeMail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NoticeMail findOrCreate($search, callable $callback = null)
 */
class NoticeMailsTable extends Table
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

        $this->table('notice_mails');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Notices', [
            'foreignKey' => 'notice_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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

        $validator
            ->requirePresence('alternate', 'create')
            ->notEmpty('alternate');

       /*  $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status'); */

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
        $rules->add($rules->existsIn(['notice_id'], 'Notices'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserOlds Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 * @property \Cake\ORM\Association\BelongsTo $TurnOvers
 * @property \Cake\ORM\Association\BelongsTo $Socials
 * @property \Cake\ORM\Association\BelongsTo $FbUsers
 *
 * @method \App\Model\Entity\UserOld get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserOld newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserOld[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserOld|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserOld patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserOld[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserOld findOrCreate($search, callable $callback = null)
 */
class UserOldsTable extends Table
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

        $this->table('user_olds');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MemberTypes', [
            'foreignKey' => 'member_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TurnOvers', [
            'foreignKey' => 'turn_over_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Socials', [
            'foreignKey' => 'social_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FbUsers', [
            'foreignKey' => 'fb_user_id',
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
            ->requirePresence('gst_number', 'create')
            ->notEmpty('gst_number');

        $validator
            ->integer('id_card_no')
            ->requirePresence('id_card_no', 'create')
            ->notEmpty('id_card_no');

        $validator
            ->requirePresence('company_organisation', 'create')
            ->notEmpty('company_organisation');

        $validator
            ->requirePresence('member_name', 'create')
            ->notEmpty('member_name');

        $validator
            ->requirePresence('alternate_nominee', 'create')
            ->notEmpty('alternate_nominee');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->integer('pincode')
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->requirePresence('pan_no', 'create')
            ->notEmpty('pan_no');

        $validator
            ->requirePresence('end_products_item_dealing_in', 'create')
            ->notEmpty('end_products_item_dealing_in');

        $validator
            ->requirePresence('office_telephone', 'create')
            ->notEmpty('office_telephone');

        $validator
            ->requirePresence('residential_telephone', 'create')
            ->notEmpty('residential_telephone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('alternate_email', 'create')
            ->notEmpty('alternate_email');

        $validator
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

        $validator
            ->requirePresence('alternate_mobile_no', 'create')
            ->notEmpty('alternate_mobile_no');

        $validator
            ->integer('grade')
            ->requirePresence('grade', 'create')
            ->notEmpty('grade');

        $validator
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->integer('classification')
            ->requirePresence('classification', 'create')
            ->notEmpty('classification');

        $validator
            ->date('year_of_joining')
            ->requirePresence('year_of_joining', 'create')
            ->notEmpty('year_of_joining');

        $validator
            ->decimal('due_amount')
            ->requirePresence('due_amount', 'create')
            ->notEmpty('due_amount');

        $validator
            ->integer('id_card_email')
            ->requirePresence('id_card_email', 'create')
            ->notEmpty('id_card_email');

        $validator
            ->integer('id_card_alternate_email')
            ->requirePresence('id_card_alternate_email', 'create')
            ->notEmpty('id_card_alternate_email');

        $validator
            ->requirePresence('passkey', 'create')
            ->notEmpty('passkey');

        $validator
            ->requirePresence('timeout', 'create')
            ->notEmpty('timeout');

        $validator
            ->integer('member_flag')
            ->requirePresence('member_flag', 'create')
            ->notEmpty('member_flag');

        $validator
            ->requirePresence('facebook_account', 'create')
            ->notEmpty('facebook_account');

        $validator
            ->requirePresence('gmail_account', 'create')
            ->notEmpty('gmail_account');

        $validator
            ->requirePresence('device_token', 'create')
            ->notEmpty('device_token');

        $validator
            ->requirePresence('member_designation', 'create')
            ->notEmpty('member_designation');

        $validator
            ->requirePresence('alternate_designation', 'create')
            ->notEmpty('alternate_designation');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website');

        $validator
            ->requirePresence('login_by', 'create')
            ->notEmpty('login_by');

        $validator
            ->requirePresence('fb_token', 'create')
            ->notEmpty('fb_token');

        $validator
            ->requirePresence('google_token', 'create')
            ->notEmpty('google_token');

        $validator
            ->requirePresence('google_auth', 'create')
            ->notEmpty('google_auth');

        $validator
            ->requirePresence('tag', 'create')
            ->notEmpty('tag');

        $validator
            ->requirePresence('infrastructure', 'create')
            ->notEmpty('infrastructure');

        $validator
            ->requirePresence('products_services', 'create')
            ->notEmpty('products_services');

        $validator
            ->requirePresence('brief_description', 'create')
            ->notEmpty('brief_description');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));
        $rules->add($rules->existsIn(['turn_over_id'], 'TurnOvers'));
        $rules->add($rules->existsIn(['social_id'], 'Socials'));
        $rules->add($rules->existsIn(['fb_user_id'], 'FbUsers'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $TurnOvers
 *
 * @method \App\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserProfile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile findOrCreate($search, callable $callback = null)
 */
class UserProfilesTable extends Table
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

        $this->table('user_profiles');
        $this->displayField('id');
        $this->primaryKey('id');

		 $this->belongsTo('MasterGrades', [
            'foreignKey' => 'grade',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('MasterCategories', [
            'foreignKey' => 'category',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('MasterClassifications', [
            'foreignKey' => 'classification',
            'joinType' => 'INNER'
        ]);
		
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterTurnOvers', [
            'foreignKey' => 'turn_over_id',
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
            ->requirePresence('member_name', 'create')
            ->notEmpty('member_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        /* $validator
            ->requirePresence('alternate_email', 'create')
            ->notEmpty('alternate_email');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->requirePresence('alternate_mobile', 'create')
            ->notEmpty('alternate_mobile');

        $validator
            ->requirePresence('alternate_member', 'create')
            ->notEmpty('alternate_member');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->requirePresence('alternate_image', 'create')
            ->notEmpty('alternate_image');

        $validator
            ->requirePresence('gst_number', 'create')
            ->notEmpty('gst_number');

        $validator
            ->requirePresence('company_organisation', 'create')
            ->notEmpty('company_organisation');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

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
            ->notEmpty('year_of_joining'); */

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
       // $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
       // $rules->add($rules->existsIn(['turn_over_id'], 'TurnOvers'));

        return $rules;
    }
}

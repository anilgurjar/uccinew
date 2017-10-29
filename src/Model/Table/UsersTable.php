<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Emails
 * @property \Cake\ORM\Association\BelongsTo $Socials
 * @property \Cake\ORM\Association\BelongsTo $FbUsers
 * @property \Cake\ORM\Association\HasMany $BlogLikes
 * @property \Cake\ORM\Association\HasMany $EventAttendees
 * @property \Cake\ORM\Association\HasMany $ExecutiveMembers
 * @property \Cake\ORM\Association\HasMany $GratitudeLetters
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievanceStatuses
 * @property \Cake\ORM\Association\HasMany $MemberRequests
 * @property \Cake\ORM\Association\HasMany $NoticeMails
 * @property \Cake\ORM\Association\HasMany $ProposeBudgets
 * @property \Cake\ORM\Association\HasMany $SendEmailAlls
 * @property \Cake\ORM\Association\HasMany $SubCommittees
 * @property \Cake\ORM\Association\HasMany $UserRights
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('member_name');
        $this->primaryKey('id');
		
		$this->belongsTo('UserOrigins');
		$this->belongsTo('CompanyNews');
		$this->belongsTo('CompanyMembers');
		$this->belongsTo('UserNews');
		$this->belongsTo('MemberFeeNews');
		$this->belongsTo('MemberReceiptNews');
		$this->belongsTo('MemberFeeMemberReceipts');
		
		
		$this->belongsTo('Elections');
		$this->belongsTo('Roles');
		$this->belongsTo('MemberFees');
		$this->belongsTo('MemberReceipts');
		$this->belongsTo('MasterFinancialYears');
		$this->belongsTo('Modules');
		$this->belongsTo('UserRights');
		$this->belongsTo('MasterTurnOvers');
		$this->belongsTo('MasterMemberTypes');
		$this->belongsTo('MasterGrades');
		$this->belongsTo('MasterCategories');
		$this->belongsTo('MasterClassifications');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('MasterTaxationRates');
		$this->belongsTo('MasterMembershipFees');
		$this->belongsTo('CertificateOrigins');
		$this->belongsTo('MemberFeeTaxAmounts');
		$this->belongsTo('MasterCompanies');
		$this->belongsTo('BankDetails');
		
		//-- Dsu Menaria //--- Use for Home screen API 
 		$this->hasMany('Blogs', [
            'foreignKey' => 'created_by'
        ]);
		$this->belongsTo('Events');
		$this->belongsTo('GalleryPhotos');
		$this->belongsTo('Initiatives');
		$this->belongsTo('Galleries');
		$this->belongsTo('Advertisements');
		$this->belongsTo('AffilationRegistrations');
		$this->belongsTo('HomeMenus');
 		//--Use for Home screen API 

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		
		 $this->belongsTo('MasterStates', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('EmailShots', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
       
	  
	    $this->belongsTo('IndustrialDepartments');
       
	   
        $this->belongsTo('Modules');
       
        $this->hasMany('BlogLikes', [
            'foreignKey' => 'user_id'
        ]);
		
        $this->hasMany('EventAttendees', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ExecutiveMembers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('GratitudeLetters', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('IndustrialGrievanceStatuses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('MemberRequests', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NoticeMails', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ProposeBudgets', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SendEmailAlls', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SubCommittees', [
            'foreignKey' => 'user_id'
        ]);
       
	    $this->hasMany('Logs', [
            'foreignKey' => 'user_id'
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

      /*   $validator
            ->requirePresence('member_name', 'create')
            ->notEmpty('member_name');

        $validator
            ->requirePresence('member_nominee_type', 'create')
            ->notEmpty('member_nominee_type');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no');

        $validator
            ->integer('id_card_email')
            ->requirePresence('id_card_email', 'create')
            ->notEmpty('id_card_email');

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
            ->requirePresence('image', 'create')
            ->notEmpty('image');
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
     //   $rules->add($rules->existsIn(['email_id'], 'Emails'));
       // $rules->add($rules->existsIn(['social_id'], 'Socials'));
      //  $rules->add($rules->existsIn(['fb_user_id'], 'FbUsers'));

        return $rules;
    }
}

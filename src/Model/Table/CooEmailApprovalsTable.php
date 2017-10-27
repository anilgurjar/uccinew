<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CooEmailApprovals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CertificateOrigins
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CooEmailApproval get($primaryKey, $options = [])
 * @method \App\Model\Entity\CooEmailApproval newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CooEmailApproval[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CooEmailApproval|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CooEmailApproval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CooEmailApproval[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CooEmailApproval findOrCreate($search, callable $callback = null)
 */
class CooEmailApprovalsTable extends Table
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

        $this->table('coo_email_approvals');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CertificateOrigins', [
            'foreignKey' => 'certificate_origin_id',
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
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['certificate_origin_id'], 'CertificateOrigins'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}

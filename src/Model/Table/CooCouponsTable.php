<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CooCoupons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CooCoupon get($primaryKey, $options = [])
 * @method \App\Model\Entity\CooCoupon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CooCoupon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CooCoupon|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CooCoupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CooCoupon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CooCoupon findOrCreate($search, callable $callback = null)
 */
class CooCouponsTable extends Table
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

        $this->table('coo_coupons');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
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

       /*  $validator
            ->dateTime('valid_from')
            ->requirePresence('valid_from', 'create')
            ->notEmpty('valid_from');

        $validator
            ->dateTime('valid_to')
            ->requirePresence('valid_to', 'create')
            ->notEmpty('valid_to');

        $validator
            ->requirePresence('coupon_code', 'create')
            ->notEmpty('coupon_code');

          $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag'); */

		$validator
            ->requirePresence('coupon_number', 'create')
            ->notEmpty('coupon_number');

      

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}

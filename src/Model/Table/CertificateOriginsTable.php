<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CertificateOrigins Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Units
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\HasMany $CertificateOriginGoods
 *
 * @method \App\Model\Entity\CertificateOrigin get($primaryKey, $options = [])
 * @method \App\Model\Entity\CertificateOrigin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CertificateOrigin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CertificateOrigin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CertificateOrigin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CertificateOrigin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CertificateOrigin findOrCreate($search, callable $callback = null)
 */
class CertificateOriginsTable extends Table
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

        $this->table('certificate_origins');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterUnits', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterCurrencies', [
            'foreignKey' => 'currency_id',
            
        ]);
        $this->hasMany('CertificateOriginGoods', [
            'foreignKey' => 'certificate_origin_id',
			'saveStrategy'=>'replace'
        ]);
		
		
		$this->hasMany('CooEmailApprovals', [
            'foreignKey' => 'certificate_origin_id'
        ]);
				
		
		$this->belongsTo('MasterCompanies');
		$this->belongsTo('MemberReceipts');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('CertificateOriginAuthorizeds');
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
            ->allowEmpty('id', 'create');

       /*  $validator
            ->requirePresence('origin_no', 'create')
            ->notEmpty('origin_no');

        $validator
            ->requirePresence('exporter', 'create')
            ->notEmpty('exporter');

        $validator
            ->requirePresence('consignee', 'create')
            ->notEmpty('consignee');

        $validator
            ->requirePresence('invoice_no', 'create')
            ->notEmpty('invoice_no');

        $validator
            ->date('invoice_date')
            ->requirePresence('invoice_date', 'create')
            ->notEmpty('invoice_date');

        $validator
            ->requirePresence('manufacturer', 'create')
            ->notEmpty('manufacturer');

        $validator
            ->requirePresence('despatched_by', 'create')
            ->notEmpty('despatched_by');

        $validator
            ->requirePresence('port_of_loading', 'create')
            ->notEmpty('port_of_loading');

        $validator
            ->requirePresence('final_destination', 'create')
            ->notEmpty('final_destination');

        $validator
            ->requirePresence('port_of_discharge', 'create')
            ->notEmpty('port_of_discharge');

        $validator
            ->date('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current');

        $validator
            ->integer('approve')
            ->requirePresence('approve', 'create')
            ->notEmpty('approve'); */

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
        $rules->add($rules->existsIn(['unit_id'], 'MasterUnits'));
       // $rules->add($rules->existsIn(['currency_id'], 'MasterCurrencies'));

        return $rules;
    }
}

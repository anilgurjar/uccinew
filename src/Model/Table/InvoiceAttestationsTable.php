<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InvoiceAttestations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Units
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\BelongsTo $Transactions
 *
 * @method \App\Model\Entity\InvoiceAttestation get($primaryKey, $options = [])
 * @method \App\Model\Entity\InvoiceAttestation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InvoiceAttestation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceAttestation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InvoiceAttestation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceAttestation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InvoiceAttestation findOrCreate($search, callable $callback = null)
 */
class InvoiceAttestationsTable extends Table
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

        $this->table('invoice_attestations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('MasterCompanies');
		$this->belongsTo('MemberReceipts');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('CertificateOriginAuthorizeds');
		$this->belongsTo('Users');
		
		
        /* $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'joinType' => 'INNER'
        ]); */
       
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
            ->notEmpty('origin_no'); */

       /* $validator
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
            ->notEmpty('approve');

        $validator
            ->requirePresence('payment_status', 'create')
            ->notEmpty('payment_status');

        $validator
            ->integer('approved_by')
            ->requirePresence('approved_by', 'create')
            ->notEmpty('approved_by');

        $validator
            ->dateTime('approve_on')
            ->allowEmpty('approve_on');

        $validator
            ->requirePresence('payment_amount', 'create')
            ->notEmpty('payment_amount');

        $validator
            ->requirePresence('payment_tax_amount', 'create')
            ->notEmpty('payment_tax_amount');

        $validator
            ->requirePresence('show_amount', 'create')
            ->notEmpty('show_amount');

        $validator
            ->requirePresence('invoice_attachment', 'create')
            ->notEmpty('invoice_attachment');

        $validator
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

        $validator
            ->requirePresence('currency_unit', 'create')
            ->notEmpty('currency_unit');

        $validator
            ->requirePresence('other_info', 'create')
            ->notEmpty('other_info');

        $validator
            ->numeric('total_before_discount')
            ->requirePresence('total_before_discount', 'create')
            ->notEmpty('total_before_discount');

        $validator
            ->numeric('discount')
            ->requirePresence('discount', 'create')
            ->notEmpty('discount');

        $validator
            ->numeric('freight_amount')
            ->requirePresence('freight_amount', 'create')
            ->notEmpty('freight_amount');

        $validator
            ->numeric('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('coo_mail', 'create')
            ->notEmpty('coo_mail');

        $validator
            ->integer('verify_by')
            ->requirePresence('verify_by', 'create')
            ->notEmpty('verify_by');

        $validator
            ->dateTime('verify_on')
            ->requirePresence('verify_on', 'create')
            ->notEmpty('verify_on');

        $validator
            ->requirePresence('verify_remarks', 'create')
            ->notEmpty('verify_remarks');

        $validator
            ->requirePresence('authorised_remarks', 'create')
            ->notEmpty('authorised_remarks');

        $validator
            ->integer('authorised_by')
            ->requirePresence('authorised_by', 'create')
            ->notEmpty('authorised_by');

        $validator
            ->dateTime('authorised_on')
            ->requirePresence('authorised_on', 'create')
            ->notEmpty('authorised_on');

        $validator
            ->requirePresence('payment_type', 'create')
            ->notEmpty('payment_type'); */

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
        //$rules->add($rules->existsIn(['company_id'], 'Companies'));
        //$rules->add($rules->existsIn(['unit_id'], 'Units'));
        //$rules->add($rules->existsIn(['currency_id'], 'Currencies'));
       // $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));

        return $rules;
    }
}

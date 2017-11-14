<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Suppliers
 * @property \Cake\ORM\Association\HasMany $PurchaseOrderRows
 *
 * @method \App\Model\Entity\PurchaseOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrder findOrCreate($search, callable $callback = null)
 */
class PurchaseOrdersTable extends Table
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

        $this->table('purchase_orders');
        $this->displayField('id');
        $this->primaryKey('id');
	
		
		$this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		
		
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PurchaseOrderRows', [
            'foreignKey' => 'purchase_order_id',
			'saveStrategy'=>'replace',
			'dependent'=>true,
			'casecadeCallbacks'=>true
        ]);
		 $this->belongsTo('MasterCompanies');
		
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
            ->integer('purchase_order_no')
            ->requirePresence('purchase_order_no', 'create')
            ->notEmpty('purchase_order_no');

        $validator
            ->requirePresence('delivery', 'create')
            ->notEmpty('delivery');

        $validator
            ->requirePresence('payment_type', 'create')
            ->notEmpty('payment_type');

       

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');
/* 
        $validator
            ->requirePresence('tin_no', 'create')
            ->notEmpty('tin_no');

        $validator
            ->requirePresence('freight', 'create')
            ->notEmpty('freight');
			
			 $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');
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
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'));

        return $rules;
    }
}

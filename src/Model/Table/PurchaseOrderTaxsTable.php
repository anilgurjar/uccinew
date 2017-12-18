<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrderTaxs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PurchaseOrders
 * @property \Cake\ORM\Association\BelongsTo $Taxes
 *
 * @method \App\Model\Entity\PurchaseOrderTax get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderTax findOrCreate($search, callable $callback = null)
 */
class PurchaseOrderTaxsTable extends Table
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

        $this->table('purchase_order_taxs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'purchase_order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterTaxations', [
            'foreignKey' => 'tax_id',
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
            ->decimal('tax_percentage')
            ->requirePresence('tax_percentage', 'create')
            ->notEmpty('tax_percentage');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['purchase_order_id'], 'PurchaseOrders'));
        //$rules->add($rules->existsIn(['tax_id'], 'Taxes'));

        return $rules;
    }
}

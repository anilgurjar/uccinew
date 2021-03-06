<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseOrderRows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PurchaseOrders
 *
 * @method \App\Model\Entity\PurchaseOrderRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseOrderRow findOrCreate($search, callable $callback = null)
 */
class PurchaseOrderRowsTable extends Table
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

        $this->table('purchase_order_rows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PurchaseOrders', [
            'foreignKey' => 'purchase_order_id',
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
            ->requirePresence('item_name', 'create')
            ->notEmpty('item_name');

        $validator
            ->requirePresence('quty', 'create')
            ->notEmpty('quty');

        $validator
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

       /*  $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->requirePresence('time', 'create')
            ->notEmpty('time');
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
        $rules->add($rules->existsIn(['purchase_order_id'], 'PurchaseOrders'));

        return $rules;
    }
}

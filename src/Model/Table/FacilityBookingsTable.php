<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FacilityBookings Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Venues
 *
 * @method \App\Model\Entity\FacilityBooking get($primaryKey, $options = [])
 * @method \App\Model\Entity\FacilityBooking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FacilityBooking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FacilityBooking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacilityBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FacilityBooking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FacilityBooking findOrCreate($search, callable $callback = null)
 */
class FacilityBookingsTable extends Table
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

        $this->table('facility_bookings');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Venues', [
            'foreignKey' => 'venue_id',
            'joinType' => 'INNER'
        ]); 
		
		$this->belongsTo('Users', [
            'foreignKey' => 'created_by'
            
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('expected_person', 'create')
            ->notEmpty('expected_person');

        $validator
            ->dateTime('date_from')
            ->requirePresence('date_from', 'create')
            ->notEmpty('date_from');

        $validator
            ->dateTime('date_to')
            ->requirePresence('date_to', 'create')
            ->notEmpty('date_to');
 
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
        $rules->add($rules->existsIn(['venue_id'], 'Venues'));

        return $rules;
    }
}

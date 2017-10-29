<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SendEmails Model
 *
 * @property \Cake\ORM\Association\HasMany $SendEmailAlls
 *
 * @method \App\Model\Entity\SendEmail get($primaryKey, $options = [])
 * @method \App\Model\Entity\SendEmail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SendEmail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SendEmail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SendEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SendEmail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SendEmail findOrCreate($search, callable $callback = null)
 */
class SendEmailsTable extends Table
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

        $this->table('send_emails');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('SendEmailAlls', [
            'foreignKey' => 'send_email_id'
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
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->date('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag');

        return $validator;
    }
}

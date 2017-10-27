<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NewsLetters Model
 *
 * @method \App\Model\Entity\NewsLetter get($primaryKey, $options = [])
 * @method \App\Model\Entity\NewsLetter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NewsLetter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NewsLetter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NewsLetter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NewsLetter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NewsLetter findOrCreate($search, callable $callback = null)
 */
class NewsLettersTable extends Table
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

        $this->table('news_letters');
        $this->displayField('title');
        $this->primaryKey('id');
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

      
        $validator
            ->requirePresence('pdf_attachment', 'create')
            ->notEmpty('pdf_attachment');

       /*  $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
			
		$validator
            ->requirePresence('cover_image', 'create')
            ->notEmpty('cover_image');


        $validator
            ->date('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->date('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->integer('edited_by')
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted'); */

        return $validator;
    }
}

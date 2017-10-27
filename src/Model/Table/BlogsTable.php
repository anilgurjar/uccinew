<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blogs Model
 *
 * @property \Cake\ORM\Association\HasMany $BlogLikes
 * @property \Cake\ORM\Association\HasMany $Galleries
 *
 * @method \App\Model\Entity\Blog get($primaryKey, $options = [])
 * @method \App\Model\Entity\Blog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Blog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Blog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Blog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Blog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Blog findOrCreate($search, callable $callback = null)
 */
class BlogsTable extends Table
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

        $this->table('blogs');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('BlogLikes', [
            'foreignKey' => 'blog_id'
        ]);
        $this->hasMany('Likers', [
			'className' => 'BlogLikes',
			'foreignKey' => 'blog_id',
			'propertyName' => 'likers',
		]);
        $this->hasMany('Galleries', [
            'foreignKey' => 'blog_id'
        ]);
		$this->belongsTo('Users', [
            'foreignKey' => 'created_by'
        ]);
		$this->belongsTo('Companies');
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

      /*   $validator
            ->requirePresence('cover_image', 'create')
            ->notEmpty('cover_image');

        $validator
            ->integer('published_by')
            ->requirePresence('published_by', 'create')
            ->notEmpty('published_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->integer('edited_by')
            ->requirePresence('edited_by', 'create')
            ->notEmpty('edited_by');

        $validator
            ->dateTime('published_on')
            ->requirePresence('published_on', 'create')
            ->notEmpty('published_on');
 */
        return $validator;
    }
}

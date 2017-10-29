<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GalleryPhotos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Galleries
 *
 * @method \App\Model\Entity\GalleryPhoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\GalleryPhoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GalleryPhoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GalleryPhoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GalleryPhoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GalleryPhoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GalleryPhoto findOrCreate($search, callable $callback = null)
 */
class GalleryPhotosTable extends Table
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

        $this->table('gallery_photos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Galleries', [
            'foreignKey' => 'gallery_id',
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
            ->requirePresence('description', 'create')
            ->notEmpty('description');

       /*  $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');
			
		   $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

 */
        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

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
        $rules->add($rules->existsIn(['gallery_id'], 'Galleries'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Formations Model
 *
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\FrequenciesTable|\Cake\ORM\Association\BelongsTo $Frequencies
 * @property \App\Model\Table\ModalitiesTable|\Cake\ORM\Association\BelongsTo $Modalities
 *
 * @method \App\Model\Entity\Formation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Formation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Formation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Formation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Formation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Formation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Formation findOrCreate($search, callable $callback = null, $options = [])
 */
class FormationsTable extends Table
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
        
        $this->addBehavior('Search.Search');

        // Setup search filter using search manager
        $this->searchManager()
                ->value('number')
                // Here we will alias the 'q' query param to search the `Articles.title`
                // field and the `Articles.content` field, using a LIKE match, with `%`
                // both before and after.
                ->add('number', 'Search.Like', [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'field' => ['number']
                ])
                ->add('title', 'Search.Like', [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'field' => ['title']
        ]);

        $this->setTable('formations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'categorie_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Frequencies', [
            'foreignKey' => 'frequencie_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Modalities', [
            'foreignKey' => 'modalitie_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Notifications', [
            'foreignKey' => 'notification_id',
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
            ->requirePresence('number', 'create')
            ->notEmpty('number')
            ->add('number' , ['unique' => [
            'rule' => 'validateUnique', 
            'provider' => 'table', 
            'message' => 'Not unique']
        ]);

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->decimal('duration')
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

        $validator
            ->allowEmpty('note');

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
        $rules->add($rules->existsIn(['categorie_id'], 'Categories'));
        $rules->add($rules->existsIn(['frequencie_id'], 'Frequencies'));
        $rules->add($rules->existsIn(['notification_id'], 'Notifications'));
        $rules->add($rules->existsIn(['modalitie_id'], 'Modalities'));

        return $rules;
    }
}

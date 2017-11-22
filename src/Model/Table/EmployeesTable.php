<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\CivilitiesTable|\Cake\ORM\Association\BelongsTo $Civilities
 * @property \App\Model\Table\LanguagesTable|\Cake\ORM\Association\BelongsTo $Languages
 * @property \App\Model\Table\PositionTitlesTable|\Cake\ORM\Association\BelongsTo $PositionTitles
 * @property \App\Model\Table\BuildingsTable|\Cake\ORM\Association\BelongsTo $Buildings
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $ParentEmployees
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\HasMany $ChildEmployees
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeesTable extends Table
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
        $this->searchManager()
                ->value('number')
                ->add('number', 'Search.Like', [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'field' => ['number']
                ])
                ->add('last_name', 'Search.Like', [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'field' => ['last_name']
                ])
                ->add('first_name', 'Search.Like', [
                    'before' => true,
                    'after' => true,
                    'fieldMode' => 'OR',
                    'comparison' => 'LIKE',
                    'wildcardAny' => '*',
                    'wildcardOne' => '?',
                    'field' => ['first_name']
                ]);
        
        
        $this->setTable('employees');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Civilities', [
            'foreignKey' => 'civilitie_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PositionTitles', [
            'foreignKey' => 'position_title_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Buildings', [
            'foreignKey' => 'building_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentEmployees', [
            'className' => 'Employees',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildEmployees', [
            'className' => 'Employees',
            'foreignKey' => 'parent_id'
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
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->allowEmpty('cell_number')
            ->integer('cell_number', 'This field must be only digits')
            ->lengthBetween('cell_number', ['10','10'], 'This field must have 10 digits');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->allowEmpty('additional_Infos');

        $validator
            ->dateTime('last_sent_formation_plan')
            ->allowEmpty('last_sent_formation_plan');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');
        
        $validator
            ->boolean('isSupervisor')
            ->requirePresence('isSupervisor', 'create')
            ->notEmpty('isSupervisor');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['civilitie_id'], 'Civilities'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['position_title_id'], 'PositionTitles'));
        $rules->add($rules->existsIn(['building_id'], 'Buildings'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentEmployees'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormationsPositionTitles Model
 *
 * @property \App\Model\Table\FormationsTable|\Cake\ORM\Association\BelongsTo $Formations
 * @property \App\Model\Table\PositionTitlesTable|\Cake\ORM\Association\BelongsTo $PositionTitles
 *
 * @method \App\Model\Entity\FormationsPositionTitle get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormationsPositionTitle findOrCreate($search, callable $callback = null, $options = [])
 */
class FormationsPositionTitlesTable extends Table
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

        $this->setTable('formations_positionTitles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Formations', [
            'foreignKey' => 'formation_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PositionTitles', [
            'foreignKey' => 'position_title_id',
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
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['formation_id'], 'Formations'));
        $rules->add($rules->existsIn(['position_title_id'], 'PositionTitles'));

        return $rules;
    }
}

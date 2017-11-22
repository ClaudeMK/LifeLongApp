<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FormationsPositionTitlesTable extends Table
{
    public function intialize(array $config)
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
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('status');

        return $validator;
    }
    
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['formation_id'], 'Formations'));
        $rules->add($rules->existsIn(['position_title_id'], 'PositionTitles'));

        return $rules;
    }
}

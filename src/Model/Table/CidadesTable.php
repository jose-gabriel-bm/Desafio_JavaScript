<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;


class CidadesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('cidades');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Estados', [
            'foreignKey' => 'id_estado',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Enderecos', [
            'foreignKey' => 'id_cidade',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('id_estado')
            ->requirePresence('id_estado', 'create')
            ->notEmptyString('id_estado');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        return $validator;
    }
}

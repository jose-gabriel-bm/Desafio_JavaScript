<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EstadosTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('estados');
        $this->setDisplayField('uf');
        $this->setPrimaryKey('id');

        $this->hasMany('Cidades', [
            'foreignKey' => 'id_estado',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('uf')
            ->maxLength('uf', 5)
            ->requirePresence('uf', 'create')
            ->notEmptyString('uf');

        return $validator;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContatosTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('contatos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('id_cliente')
            ->requirePresence('id_cliente', 'create')
            ->notEmptyString('id_cliente');

        $validator
            ->scalar('codigo_pais')
            ->maxLength('codigo_pais', 2)
            ->allowEmptyString('codigo_pais');

        $validator
            ->scalar('ddd')
            ->maxLength('ddd', 2)
            ->allowEmptyString('ddd');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 9,'Valor maximo de caracteres ')
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        return $validator;
    }
}

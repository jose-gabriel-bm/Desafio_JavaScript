<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EnderecosTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('enderecos');
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
            ->integer('id_cidade')
            ->requirePresence('id_cidade', 'create')
            ->notEmptyString('id_cidade');

        $validator
            ->scalar('logradouro')
            ->maxLength('logradouro', 100,'Campo logradouro contem mais de 100 caracteres ')
            ->requirePresence('logradouro', 'create')
            ->notEmptyString('logradouro');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 10,'Campo numero contem mais de 10 caracteres ')
            ->allowEmptyString('numero');

        $validator
            ->scalar('complemento')
            ->maxLength('complemento', 100,'Campo complemento contem mais de 100 caracteres')
            ->allowEmptyString('complemento');

        $validator
            ->scalar('bairro')
            ->maxLength('bairro', 100,'Campo bairro contem mais de 100 caracteres')
            ->requirePresence('bairro', 'create')
            ->notEmptyString('bairro');

        $validator
            ->scalar('cep')
            ->maxLength('cep', 8,'Formato de CEP inválido')
            ->allowEmptyString('cep');

        return $validator;
    }
}

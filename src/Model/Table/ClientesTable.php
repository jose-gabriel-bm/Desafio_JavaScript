<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ClientesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('clientes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Enderecos', [
            'foreignKey' => 'id_cliente'
        ]);

        $this->hasMany('Contatos', [
            'foreignKey' => 'id_cliente'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100,'O nome possui mais de 100 caracteres')
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cpf')
            ->minLength('cpf', 11,'Formato de CPF invalido')
            ->maxLength('cpf', 11,'Formato de CPF invalido')
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf')
            ->add('cpf', 'unique', [
                'rule' => 'validateUnique', 
                'provider' => 'table',
                'message' => 'CPF já cadastrado'
            ]);

        $validator
            ->email('email')
            ->allowEmptyString('email')
            ->add('email', 'unique', [
                'rule' => 'validateUnique', 
                'provider' => 'table',
                'message' => 'email já cadastrado'
            ]);

        $validator
            ->boolean('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['cpf']));

        return $rules;
    }
    
}

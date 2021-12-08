<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Cliente extends Entity
{
    protected $_accessible = [
        'nome' => true,
        'cpf' => true,
        'email' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'enderecos' => true,
        'contatos' => true,
    ];

    protected function _getOpcoesStatus()
    {
        return $this->status ? 'Ativo' : 'Inativo';
    }
}

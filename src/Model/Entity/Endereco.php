<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Endereco extends Entity
{
    protected $_accessible = [
        'id_cliente' => true,
        'id_cidade' => true,
        'logradouro' => true,
        'numero' => true,
        'complemento' => true,
        'bairro' => true,
        'cep' => true,
    ];
}

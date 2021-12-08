<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Contato extends Entity
{
    protected $_accessible = [
        'id_cliente' => true,
        'codigo_pais' => true,
        'ddd' => true,
        'numero' => true,
    ];
}

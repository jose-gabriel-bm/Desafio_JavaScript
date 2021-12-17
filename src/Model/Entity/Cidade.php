<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Cidade extends Entity
{
    protected $_accessible = [
        'id_estado' => true,
        'nome' => true,
    ];
}

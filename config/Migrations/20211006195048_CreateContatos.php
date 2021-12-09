<?php
use Migrations\AbstractMigration;

class CreateContatos extends AbstractMigration
{
       public function change()
    {
        $table = $this->table('contatos');

        $table->addColumn('id_cliente','integer',[
            'null'=>false,
        ]);
        $table->addForeignKey('id_cliente','clientes','id');

        $table->addColumn('codigo_pais','string',[
            'limit'=>2,
            'default' => '55',
            'null'=>true,
        ]);
        $table->addColumn('ddd','string',[
            'limit'=>2,
            'default' => '62',
            'null'=>true,
        ]);
        $table->addColumn('numero','string',[
            'limit'=>9,
            'null'=>false,
        ]);       
        
        $table->create();
    }
}

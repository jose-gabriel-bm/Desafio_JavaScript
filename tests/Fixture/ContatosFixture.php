<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContatosFixture
 */
class ContatosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_cliente' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'codigo_pais' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => '55', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ddd' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => '62', 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'numero' => ['type' => 'string', 'length' => 9, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'id_cliente' => ['type' => 'index', 'columns' => ['id_cliente'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'contatos_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_cliente'], 'references' => ['clientes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'id_cliente' => 1,
                'codigo_pais' => 'Lo',
                'ddd' => 'Lo',
                'numero' => 'Lorem i',
            ],
        ];
        parent::init();
    }
}

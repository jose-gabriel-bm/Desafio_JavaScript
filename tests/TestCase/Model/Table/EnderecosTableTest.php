<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnderecosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnderecosTable Test Case
 */
class EnderecosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EnderecosTable
     */
    public $Enderecos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Enderecos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Enderecos') ? [] : ['className' => EnderecosTable::class];
        $this->Enderecos = TableRegistry::getTableLocator()->get('Enderecos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enderecos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

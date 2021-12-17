<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CidadesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CidadesTable Test Case
 */
class CidadesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CidadesTable
     */
    public $Cidades;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Cidades',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Cidades') ? [] : ['className' => CidadesTable::class];
        $this->Cidades = TableRegistry::getTableLocator()->get('Cidades', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cidades);

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

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

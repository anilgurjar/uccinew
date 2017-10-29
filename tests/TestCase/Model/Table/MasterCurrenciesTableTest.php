<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterCurrenciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterCurrenciesTable Test Case
 */
class MasterCurrenciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterCurrenciesTable
     */
    public $MasterCurrencies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_currencies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterCurrencies') ? [] : ['className' => 'App\Model\Table\MasterCurrenciesTable'];
        $this->MasterCurrencies = TableRegistry::get('MasterCurrencies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterCurrencies);

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

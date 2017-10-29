<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterTaxationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterTaxationsTable Test Case
 */
class MasterTaxationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterTaxationsTable
     */
    public $MasterTaxations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_taxations',
        'app.taxes',
        'app.master_taxation_rates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterTaxations') ? [] : ['className' => 'App\Model\Table\MasterTaxationsTable'];
        $this->MasterTaxations = TableRegistry::get('MasterTaxations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterTaxations);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

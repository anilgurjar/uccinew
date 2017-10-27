<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterTaxationRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterTaxationRatesTable Test Case
 */
class MasterTaxationRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterTaxationRatesTable
     */
    public $MasterTaxationRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_taxation_rates',
        'app.master_taxations',
        'app.taxes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterTaxationRates') ? [] : ['className' => 'App\Model\Table\MasterTaxationRatesTable'];
        $this->MasterTaxationRates = TableRegistry::get('MasterTaxationRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterTaxationRates);

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

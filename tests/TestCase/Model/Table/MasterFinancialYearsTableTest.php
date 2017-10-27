<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterFinancialYearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterFinancialYearsTable Test Case
 */
class MasterFinancialYearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterFinancialYearsTable
     */
    public $MasterFinancialYears;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_financial_years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterFinancialYears') ? [] : ['className' => 'App\Model\Table\MasterFinancialYearsTable'];
        $this->MasterFinancialYears = TableRegistry::get('MasterFinancialYears', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterFinancialYears);

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

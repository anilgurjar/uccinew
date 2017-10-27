<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterCompaniesTable Test Case
 */
class MasterCompaniesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterCompaniesTable
     */
    public $MasterCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterCompanies') ? [] : ['className' => 'App\Model\Table\MasterCompaniesTable'];
        $this->MasterCompanies = TableRegistry::get('MasterCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterCompanies);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterUnitsTable Test Case
 */
class MasterUnitsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterUnitsTable
     */
    public $MasterUnits;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterUnits') ? [] : ['className' => 'App\Model\Table\MasterUnitsTable'];
        $this->MasterUnits = TableRegistry::get('MasterUnits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterUnits);

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

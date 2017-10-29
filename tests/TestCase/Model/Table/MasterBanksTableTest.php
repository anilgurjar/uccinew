<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterBanksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterBanksTable Test Case
 */
class MasterBanksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterBanksTable
     */
    public $MasterBanks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_banks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterBanks') ? [] : ['className' => 'App\Model\Table\MasterBanksTable'];
        $this->MasterBanks = TableRegistry::get('MasterBanks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterBanks);

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

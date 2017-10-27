<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterTurnOversTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterTurnOversTable Test Case
 */
class MasterTurnOversTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterTurnOversTable
     */
    public $MasterTurnOvers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_turn_overs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterTurnOvers') ? [] : ['className' => 'App\Model\Table\MasterTurnOversTable'];
        $this->MasterTurnOvers = TableRegistry::get('MasterTurnOvers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterTurnOvers);

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

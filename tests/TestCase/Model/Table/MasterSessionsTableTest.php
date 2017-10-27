<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterSessionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterSessionsTable Test Case
 */
class MasterSessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterSessionsTable
     */
    public $MasterSessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterSessions') ? [] : ['className' => 'App\Model\Table\MasterSessionsTable'];
        $this->MasterSessions = TableRegistry::get('MasterSessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterSessions);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnilsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnilsTable Test Case
 */
class AnilsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnilsTable
     */
    public $Anils;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.anils'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Anils') ? [] : ['className' => 'App\Model\Table\AnilsTable'];
        $this->Anils = TableRegistry::get('Anils', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Anils);

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

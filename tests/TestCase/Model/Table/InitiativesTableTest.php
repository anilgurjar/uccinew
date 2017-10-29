<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InitiativesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InitiativesTable Test Case
 */
class InitiativesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InitiativesTable
     */
    public $Initiatives;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.initiatives',
        'app.initiative_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Initiatives') ? [] : ['className' => 'App\Model\Table\InitiativesTable'];
        $this->Initiatives = TableRegistry::get('Initiatives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Initiatives);

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

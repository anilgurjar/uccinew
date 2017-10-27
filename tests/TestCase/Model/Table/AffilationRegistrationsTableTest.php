<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AffilationRegistrationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AffilationRegistrationsTable Test Case
 */
class AffilationRegistrationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AffilationRegistrationsTable
     */
    public $AffilationRegistrations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.affilation_registrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AffilationRegistrations') ? [] : ['className' => 'App\Model\Table\AffilationRegistrationsTable'];
        $this->AffilationRegistrations = TableRegistry::get('AffilationRegistrations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AffilationRegistrations);

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

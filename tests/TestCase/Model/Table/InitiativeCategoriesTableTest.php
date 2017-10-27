<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InitiativeCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InitiativeCategoriesTable Test Case
 */
class InitiativeCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InitiativeCategoriesTable
     */
    public $InitiativeCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.initiative_categories',
        'app.initiatives'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InitiativeCategories') ? [] : ['className' => 'App\Model\Table\InitiativeCategoriesTable'];
        $this->InitiativeCategories = TableRegistry::get('InitiativeCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InitiativeCategories);

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

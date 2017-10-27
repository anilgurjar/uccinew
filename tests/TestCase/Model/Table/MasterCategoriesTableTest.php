<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterCategoriesTable Test Case
 */
class MasterCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterCategoriesTable
     */
    public $MasterCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterCategories') ? [] : ['className' => 'App\Model\Table\MasterCategoriesTable'];
        $this->MasterCategories = TableRegistry::get('MasterCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterCategories);

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

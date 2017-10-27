<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterClassificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterClassificationsTable Test Case
 */
class MasterClassificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterClassificationsTable
     */
    public $MasterClassifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_classifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterClassifications') ? [] : ['className' => 'App\Model\Table\MasterClassificationsTable'];
        $this->MasterClassifications = TableRegistry::get('MasterClassifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterClassifications);

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

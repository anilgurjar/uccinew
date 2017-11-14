<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DemopdfsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DemopdfsTable Test Case
 */
class DemopdfsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DemopdfsTable
     */
    public $Demopdfs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.demopdfs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Demopdfs') ? [] : ['className' => 'App\Model\Table\DemopdfsTable'];
        $this->Demopdfs = TableRegistry::get('Demopdfs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Demopdfs);

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

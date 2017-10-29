<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterGradesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterGradesTable Test Case
 */
class MasterGradesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterGradesTable
     */
    public $MasterGrades;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_grades'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterGrades') ? [] : ['className' => 'App\Model\Table\MasterGradesTable'];
        $this->MasterGrades = TableRegistry::get('MasterGrades', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterGrades);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BankDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BankDetailsTable Test Case
 */
class BankDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BankDetailsTable
     */
    public $BankDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bank_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BankDetails') ? [] : ['className' => 'App\Model\Table\BankDetailsTable'];
        $this->BankDetails = TableRegistry::get('BankDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BankDetails);

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

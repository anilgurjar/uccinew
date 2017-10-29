<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MemberFeeTaxAmountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MemberFeeTaxAmountsTable Test Case
 */
class MemberFeeTaxAmountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MemberFeeTaxAmountsTable
     */
    public $MemberFeeTaxAmounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.member_fee_tax_amounts',
        'app.master_taxations',
        'app.taxes',
        'app.master_taxation_rates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MemberFeeTaxAmounts') ? [] : ['className' => 'App\Model\Table\MemberFeeTaxAmountsTable'];
        $this->MemberFeeTaxAmounts = TableRegistry::get('MemberFeeTaxAmounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MemberFeeTaxAmounts);

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
}

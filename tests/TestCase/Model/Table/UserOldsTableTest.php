<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserOldsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserOldsTable Test Case
 */
class UserOldsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserOldsTable
     */
    public $UserOlds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_olds',
        'app.roles',
        'app.member_types',
        'app.turn_overs',
        'app.socials',
        'app.fb_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserOlds') ? [] : ['className' => 'App\Model\Table\UserOldsTable'];
        $this->UserOlds = TableRegistry::get('UserOlds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserOlds);

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

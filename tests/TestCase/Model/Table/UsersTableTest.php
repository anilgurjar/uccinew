<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.elections',
        'app.roles',
        'app.member_fees',
        'app.member_receipts',
        'app.master_member_types',
        'app.master_banks',
        'app.master_purposes',
        'app.master_taxations',
        'app.taxes',
        'app.master_taxation_rates',
        'app.master_membership_fees',
        'app.master_turn_overs',
        'app.general_receipt_purposes',
        'app.tax_amounts',
        'app.master_companies',
        'app.bank_details',
        'app.member_fee_tax_amounts',
        'app.modules',
        'app.user_rights',
        'app.master_grades',
        'app.master_categories',
        'app.master_classifications',
        'app.certificate_origins',
        'app.master_units',
        'app.master_currencies',
        'app.certificate_origin_goods',
        'app.blogs',
        'app.blog_likes',
        'app.likers',
        'app.galleries',
        'app.events',
        'app.event_attendees',
        'app.event_guets',
        'app.event_guests',
        'app.event_categories',
        'app.event_histories',
        'app.gallery_photos',
        'app.initiatives',
        'app.initiative_categories',
        'app.advertisements',
        'app.affilation_registrations',
        'app.home_menus',
        'app.company_masters',
        'app.membership_due_amounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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
     * Test findAuth method
     *
     * @return void
     */
    public function testFindAuth()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

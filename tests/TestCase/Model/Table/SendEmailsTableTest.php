<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SendEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SendEmailsTable Test Case
 */
class SendEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SendEmailsTable
     */
    public $SendEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.send_emails',
        'app.users',
        'app.elections',
        'app.roles',
        'app.member_fees',
        'app.member_receipts',
        'app.users',
        'app.modules',
        'app.user_rights',
        'app.master_turn_overs',
        'app.master_member_types',
        'app.master_grades',
        'app.master_categories',
        'app.master_classifications',
        'app.master_taxations',
        'app.taxes',
        'app.master_taxation_rates',
        'app.master_membership_fees',
        'app.certificate_origins',
        'app.master_units',
        'app.master_currencies',
        'app.certificate_origin_goods',
        'app.master_companies',
        'app.member_fee_tax_amounts',
        'app.bank_details',
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
        'app.membership_due_amounts',
        'app.master_banks',
        'app.master_purposes',
        'app.general_receipt_purposes',
        'app.tax_amounts',
        'app.send_email_alls',
        'app.send_email_all'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SendEmails') ? [] : ['className' => 'App\Model\Table\SendEmailsTable'];
        $this->SendEmails = TableRegistry::get('SendEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SendEmails);

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

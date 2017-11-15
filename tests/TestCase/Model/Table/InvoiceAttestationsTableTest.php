<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceAttestationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceAttestationsTable Test Case
 */
class InvoiceAttestationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceAttestationsTable
     */
    public $InvoiceAttestations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_attestations',
        'app.companies',
        'app.roles',
        'app.user_olds',
        'app.member_types',
        'app.turn_overs',
        'app.socials',
        'app.fb_users',
        'app.user_rights',
        'app.users',
        'app.user_origins',
        'app.company_news',
        'app.company_members',
        'app.user_news',
        'app.member_fee_news',
        'app.member_receipt_news',
        'app.member_fee_member_receipts',
        'app.member_fees',
        'app.company_member_types',
        'app.master_member_types',
        'app.member_requests',
        'app.master_financial_years',
        'app.executive_members',
        'app.executive_categories',
        'app.designations',
        'app.sub_committees',
        'app.member_fee_tax_amounts',
        'app.taxes',
        'app.master_taxations',
        'app.master_taxation_rates',
        'app.member_receipts',
        'app.receipts',
        'app.master_signature',
        'app.master_states',
        'app.master_purposes',
        'app.propose_budgets',
        'app.banks',
        'app.general_receipt_purposes',
        'app.tax_amounts',
        'app.master_banks',
        'app.master_membership_fees',
        'app.master_companies',
        'app.master_turn_overs',
        'app.elections',
        'app.modules',
        'app.master_grades',
        'app.master_categories',
        'app.master_classifications',
        'app.certificate_origins',
        'app.master_units',
        'app.master_currencies',
        'app.certificate_origin_goods',
        'app.coo_email_approvals',
        'app.certificate_origin_authorizeds',
        'app.bank_details',
        'app.blogs',
        'app.blog_likes',
        'app.likers',
        'app.galleries',
        'app.events',
        'app.event_categories',
        'app.event_histories',
        'app.event_attendees',
        'app.event_guests',
        'app.gallery_photos',
        'app.initiatives',
        'app.initiative_categories',
        'app.advertisements',
        'app.affilation_registrations',
        'app.home_menus',
        'app.email_shots',
        'app.industrial_departments',
        'app.industrial_grievances',
        'app.grievance_categories',
        'app.grievance_issues',
        'app.grievance_issue_relateds',
        'app.industrial_grievance_follows',
        'app.industrial_grievance_statuses',
        'app.gratitude_letters',
        'app.notice_mails',
        'app.notices',
        'app.notice_categories',
        'app.send_email_alls',
        'app.send_emails',
        'app.logs',
        'app.users2',
        'app.business_visas',
        'app.coo_coupons',
        'app.co_registrations',
        'app.co_tax_amounts',
        'app.master_taxes',
        'app.user_profiles',
        'app.units',
        'app.currencies',
        'app.transactions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceAttestations') ? [] : ['className' => 'App\Model\Table\InvoiceAttestationsTable'];
        $this->InvoiceAttestations = TableRegistry::get('InvoiceAttestations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceAttestations);

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

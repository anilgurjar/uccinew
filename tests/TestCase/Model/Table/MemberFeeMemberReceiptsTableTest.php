<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MemberFeeMemberReceiptsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MemberFeeMemberReceiptsTable Test Case
 */
class MemberFeeMemberReceiptsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MemberFeeMemberReceiptsTable
     */
    public $MemberFeeMemberReceipts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.member_fee_member_receipts',
        'app.member_fees',
        'app.companies',
        'app.roles',
        'app.user_olds',
        'app.member_types',
        'app.turn_overs',
        'app.socials',
        'app.fb_users',
        'app.user_rights',
        'app.users',
        'app.elections',
        'app.member_receipts',
        'app.receipts',
        'app.purposes',
        'app.banks',
        'app.general_receipt_purposes',
        'app.tax_amounts',
        'app.taxes',
        'app.master_member_types',
        'app.company_member_types',
        'app.member_requests',
        'app.master_banks',
        'app.master_purposes',
        'app.propose_budgets',
        'app.master_financial_years',
        'app.executive_members',
        'app.executive_categories',
        'app.designations',
        'app.sub_committees',
        'app.modules',
        'app.master_turn_overs',
        'app.master_grades',
        'app.master_categories',
        'app.master_classifications',
        'app.master_taxations',
        'app.master_taxation_rates',
        'app.master_membership_fees',
        'app.certificate_origins',
        'app.units',
        'app.currencies',
        'app.certificate_origin_goods',
        'app.member_fee_tax_amounts',
        'app.master_companies',
        'app.bank_details',
        'app.blog_likes',
        'app.blogs',
        'app.galleries',
        'app.events',
        'app.event_categories',
        'app.event_histories',
        'app.event_attendees',
        'app.event_guests',
        'app.gallery_photos',
        'app.gratitude_letters',
        'app.industrial_grievance_statuses',
        'app.industrial_grievances',
        'app.grievance_categories',
        'app.industrial_departments',
        'app.grievance_issues',
        'app.grievance_issue_relateds',
        'app.industrial_grievance_follows',
        'app.notice_mails',
        'app.notices',
        'app.notice_categories',
        'app.send_email_alls',
        'app.send_emails',
        'app.users2',
        'app.business_visas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MemberFeeMemberReceipts') ? [] : ['className' => 'App\Model\Table\MemberFeeMemberReceiptsTable'];
        $this->MemberFeeMemberReceipts = TableRegistry::get('MemberFeeMemberReceipts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MemberFeeMemberReceipts);

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

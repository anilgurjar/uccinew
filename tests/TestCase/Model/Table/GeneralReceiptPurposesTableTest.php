<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GeneralReceiptPurposesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GeneralReceiptPurposesTable Test Case
 */
class GeneralReceiptPurposesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GeneralReceiptPurposesTable
     */
    public $GeneralReceiptPurposes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.general_receipt_purposes',
        'app.member_receipts',
        'app.users',
        'app.elections',
        'app.roles',
        'app.member_fees',
        'app.member_fee_tax_amounts',
        'app.master_taxations',
        'app.taxes',
        'app.master_taxation_rates',
        'app.modules',
        'app.user_rights',
        'app.master_turn_overs',
        'app.master_member_types',
        'app.master_grades',
        'app.master_categories',
        'app.master_classifications',
        'app.master_membership_fees',
        'app.certificate_origins',
        'app.master_units',
        'app.master_currencies',
        'app.certificate_origin_goods',
        'app.master_companies',
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
        'app.tax_amounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GeneralReceiptPurposes') ? [] : ['className' => 'App\Model\Table\GeneralReceiptPurposesTable'];
        $this->GeneralReceiptPurposes = TableRegistry::get('GeneralReceiptPurposes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GeneralReceiptPurposes);

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

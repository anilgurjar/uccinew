<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CertificateOriginsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CertificateOriginsTable Test Case
 */
class CertificateOriginsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CertificateOriginsTable
     */
    public $CertificateOrigins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.certificate_origins',
        'app.master_units',
        'app.master_currencies',
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
        'app.certificate_origin_goods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CertificateOrigins') ? [] : ['className' => 'App\Model\Table\CertificateOriginsTable'];
        $this->CertificateOrigins = TableRegistry::get('CertificateOrigins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CertificateOrigins);

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

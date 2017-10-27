<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvertisementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvertisementsTable Test Case
 */
class AdvertisementsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvertisementsTable
     */
    public $Advertisements;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.advertisements'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Advertisements') ? [] : ['className' => 'App\Model\Table\AdvertisementsTable'];
        $this->Advertisements = TableRegistry::get('Advertisements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Advertisements);

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

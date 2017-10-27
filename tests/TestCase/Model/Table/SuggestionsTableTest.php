<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SuggestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SuggestionsTable Test Case
 */
class SuggestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SuggestionsTable
     */
    public $Suggestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.suggestions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Suggestions') ? [] : ['className' => 'App\Model\Table\SuggestionsTable'];
        $this->Suggestions = TableRegistry::get('Suggestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Suggestions);

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

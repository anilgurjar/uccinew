<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewsLettersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewsLettersTable Test Case
 */
class NewsLettersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewsLettersTable
     */
    public $NewsLetters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.news_letters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('NewsLetters') ? [] : ['className' => 'App\Model\Table\NewsLettersTable'];
        $this->NewsLetters = TableRegistry::get('NewsLetters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NewsLetters);

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

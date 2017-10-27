<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SurveyQuestionRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SurveyQuestionRowsTable Test Case
 */
class SurveyQuestionRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SurveyQuestionRowsTable
     */
    public $SurveyQuestionRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.survey_question_rows',
        'app.survey_questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SurveyQuestionRows') ? [] : ['className' => 'App\Model\Table\SurveyQuestionRowsTable'];
        $this->SurveyQuestionRows = TableRegistry::get('SurveyQuestionRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SurveyQuestionRows);

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

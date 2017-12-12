<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MemberDesignationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MemberDesignationsTable Test Case
 */
class MemberDesignationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MemberDesignationsTable
     */
    public $MemberDesignations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.member_designations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MemberDesignations') ? [] : ['className' => 'App\Model\Table\MemberDesignationsTable'];
        $this->MemberDesignations = TableRegistry::get('MemberDesignations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MemberDesignations);

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

<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormationCompletesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormationCompletesTable Test Case
 */
class FormationCompletesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormationCompletesTable
     */
    public $FormationCompletes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formation_completes',
        'app.employees',
        'app.civilities',
        'app.languages',
        'app.position_titles',
        'app.formations',
        'app.categories',
        'app.frequencies',
        'app.modalities',
        'app.notifications',
        'app.formations_position_titles',
        'app.buildings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormationCompletes') ? [] : ['className' => FormationCompletesTable::class];
        $this->FormationCompletes = TableRegistry::get('FormationCompletes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormationCompletes);

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

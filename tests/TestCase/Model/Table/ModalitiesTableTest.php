<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModalitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModalitiesTable Test Case
 */
class ModalitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ModalitiesTable
     */
    public $Modalities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.modalities',
        'app.formations',
        'app.categories',
        'app.frequencies',
        'app.start_notifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Modalities') ? [] : ['className' => ModalitiesTable::class];
        $this->Modalities = TableRegistry::get('Modalities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modalities);

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

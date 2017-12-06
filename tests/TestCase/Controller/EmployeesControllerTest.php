<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EmployeesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EmployeesController Test Case
 */
class EmployeesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employees',
        'app.civilities',
        'app.languages',
        'app.position_titles',
        'app.buildings'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    
    /**
 * test fnish() method
 *
 * @return void
 */
  public function testEditPhoneDots() {
      $data = '1234567890';
      $employee = new EmployeesController();
      $this->assertEquals('123.456.7890',  $employee->editPhoneDots($data));
  }
  
  public function testFirstUpper(){
      $dataLetter = 'allo';
      $employee = new EmployeesController();
      $this->assertEquals('Allo',  $employee->editFirstLetterUpper($dataLetter));
  }
  
  public function testSendFP(){
      $employees = new EmployeesController();
      $employee->Employees->get(1);
      $employees->nouvelleMethode($employee);
      $this->assertNotNull($employee->last_sent_formation_plan);
  }
  // Prochainement Test Erroné!
  public function testDelete(){
      $employee = new EmployeesController();
      $this->assertEquals(null, $employee->delete());
  }
}

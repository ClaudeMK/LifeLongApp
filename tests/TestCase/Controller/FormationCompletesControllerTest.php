<?php
namespace App\Test\TestCase\Controller;

use App\Controller\FormationCompletesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\FormationCompletesController Test Case
 */
class FormationCompletesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formation_completes',
        
    ];

    /*
    public function testExtCSV()
    {
        $controller = new FormationCompletesController();
        $filePath = "D:/Claude/Documents/aaa_TESTS/testExtCSV.csv";
        $ext = end(explode('.', $filePath));
        $this->assertTrue($controller->fileOK($ext));
    }
    
    public function testExtTXT()
    {
        $controller = new FormationCompletesController();
        $filePath = "D:/Claude/Documents/aaa_TESTS/testExtTXT.txt";
        $ext = end(explode('.', $filePath));
        $this->assertTrue($controller->fileOK($ext));
    }
    
    public function testExtPNG()
    {
        $controller = new FormationCompletesController();
        $filePath = "D:/Claude/Documents/aaa_TESTS/testExtPNG.png";
        $ext = end(explode('.', $filePath));
        $this->assertFalse($controller->fileOK($ext));
    }
    
    public function testEmptyFile()
    {
        $controller = new FormationCompletesController();
        $file = fopen("D:/Claude/Documents/aaa_TESTS/testEmptyFile.csv", "r");
        $lineContent = fgets($file);
        fclose($file);
        $this->assertTrue($controller->fileNotEmptyForTest($lineContent) == 0);
    }
    */
    public function testFileOK()
    {
        
        $controller = new FormationCompletesController();
        $file = fopen("D:/Claude/Documents/aaa_TESTS/testFileOK.csv", "r");
        $lineContent = fgets($file);
        fclose($file);
        $this->assertTrue($controller->fileNotEmptyForTest($lineContent) > 0);
    }
    /*
    public function testInvalidDate()
    {
        $controller = new FormationCompletesController();
        $this->assertFalse($controller->dateValid("99", "32", "1990"));
    }
    
    public function testvalidDate()
    {
        $controller = new FormationCompletesController();

        $this->assertTrue($controller->dateValid("05", "12", "1990"));
    }*/
}

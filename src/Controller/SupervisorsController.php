<?php

namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\Mailer\Email;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[] paginate($object = null, array $settings = [])
 */
class SupervisorsController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'lookup']
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->loadModel('Employees');

        $supervisors = $this->Employees->find('all')
                ->where(['Employees.isSupervisor' => true, 'Employees.id !=' => 1]);
        $this->paginate = [
            'contain' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees'],
            'limit' => 10
        ];
        $this->set('supervisors', $this->paginate($supervisors));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->loadModel('Employees');
        $supervisor = $this->Employees->get($id, [
            'contain' => ['Civilities', 'Languages', 'PositionTitles' => ['Formations' => ['Categories', 'Frequencies', 'Modalities', 'Notifications', 'PositionTitles']], 'Buildings', 'ParentEmployees',
                'ChildEmployees' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings']]
        ]);


        $this->set('supervisor', $supervisor);
        $this->set('_serialize', ['supervisor']);
    }

    public function editFirstLetterUpper($dataLetter) {
        return (ucfirst($dataLetter));
    }

    public function editPhoneDots($data) {
        return(substr($data, 0, 3) . '.' . substr($data, 3, 3) . '.' . substr($data, 6));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $employee = $this->Employees->get($id, [
            'contain' => ['PositionTitles' => ['Formations' => ['Categories', 'Frequencies', 'Modalities', 'Notifications', 'PositionTitles']]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->first_name = $this->editFirstLetterUpper($employee->first_name);
            $employee->last_name = $this->editFirstLetterUpper($employee->last_name);
            $employee->additional_Infos = $this->editFirstLetterUpper($employee->additional_Infos);
            $data = $employee->cell_number;
            $data = str_replace('.', '', $data);
            if (is_numeric($data) && strlen($data) == 10) {
                $employee->cell_number = $this->editPhoneDots($data);
            }
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $civilities = $this->Employees->Civilities->find('list', ['limit' => 200]);
        $languages = $this->Employees->Languages->find('list', ['limit' => 200]);
        $positionTitles = $this->Employees->PositionTitles->find('list', ['limit' => 200]);
        $buildings = $this->Employees->Buildings->find('list', ['limit' => 200]);
        $parentEmployees = $this->Employees->ParentEmployees->find('list', ['limit' => 200]);

        $this->loadModel('FormationCompletes');
        $formationComplete = $this->FormationCompletes->find('all')
                ->where(['FormationCompletes.employee_id = ' => $employee->id]);

        $formationComplete = $formationComplete->toArray();


        $this->set(compact('employee', 'civilities', 'languages', 'positionTitles', 'buildings', 'parentEmployees', 'formationComplete'));
        $this->set('_serialize', ['employee']);
    }

    /*
     * Toutes modifications à cette fonction doivent être apportées à la fonction
     * sendFormationPlan du controller Users.
     */

    public function rapportTwo($id = null) {
        $this->loadModel('Employees');
        $curr_timestamp = date('Y-m-d H:i:s');
        $supervisor = $this->Employees->get($id, [
            'contain' => ['Civilities', 'Languages', 'PositionTitles', 'ChildEmployees' => ['PositionTitles']]
        ]);
        $tabEmployeeEtFormations = array();
        foreach ($supervisor->child_employees as $employee) {
            $this->loadModel('FormationCompletes');
            $formationCompletes = $this->FormationCompletes->find('all')
                    ->where(['FormationCompletes.employee_id = ' => $employee->id]);
            $formationCompletes = $formationCompletes->toArray();
            array_push($tabEmployeeEtFormations, [$employee, $formationCompletes]);
        }
        ob_start();
        include "/rapports/rapport2.php";
        $html = ob_get_clean();
        ob_end_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();


        // Output the generated PDF to Browser
        $dompdf->stream('/rapports/rapport2.pdf', array("Attachment" => false));
        $this->setAction('index');
    }

    public function rapportFour() {
        $this->loadModel('Employees');
        $curr_timestamp = date('Y-m-d H:i:s');

        $supervisors = $this->Employees->find('all', [
                    'contain' => ['ChildEmployees' => ['PositionTitles']]
                ])->where(['Employees.isSupervisor' => true, 'Employees.id !=' => 1, 'Employees.active' => true]);
        $tabSuperviseurEmployeesFormations = array();
        foreach ($supervisors as $supervisor) {
            $employees = $supervisor->child_employees;
            $tabEmployeeEtFormations = array();
            foreach ($employees as $employee) {
                $this->loadModel('FormationCompletes');
                $formationCompletes = $this->FormationCompletes->find('all')
                        ->where(['FormationCompletes.employee_id = ' => $employee->id]);
                $formationCompletes = $formationCompletes->toArray();
                array_push($tabEmployeeEtFormations, [$employee, $formationCompletes]);
            }
            array_push($tabSuperviseurEmployeesFormations, [$supervisor, $tabEmployeeEtFormations]);
        }
        ob_start();
        include "/rapports/rapport4.php";
        $html = ob_get_clean();
        ob_end_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();


        // Output the generated PDF to Browser
        $dompdf->stream('/rapports/rapport4.pdf', array("Attachment" => false));
        $this->setAction('index');
    }

}

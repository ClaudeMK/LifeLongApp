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
class EmployeesController extends AppController {

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
        $this->paginate = [
            'contain' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees'],
            'limit' => 10
        ];
        //$employees = $this->paginate($this->Employees);
        //$this->set(compact('employees'));
        //$this->set('_serialize', ['employees']);

        $query = $this->Employees
                // Use the plugins 'search' custom finder and pass in the
                // processed query params
                ->find('search', ['search' => $this->request->query]);

        $this->set('employees', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $employee = $this->Employees->get($id, [
            'contain' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees',
                'ChildEmployees' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings']]
        ]);


        $this->set('employee', $employee);
        $this->set('_serialize', ['employee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->first_name = ucfirst($employee->first_name);
            $employee->last_name = ucfirst($employee->last_name);
            $employee->additional_Infos = ucfirst($employee->additional_Infos);
            $data = $employee->cell_number;
            if (is_numeric($data) && strlen($data) == 10) {
                $employee->cell_number = substr($data, 0, 3) . '.' . substr($data, 3, 3) . '.' . substr($data, 6);
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
        $this->set(compact('employee', 'civilities', 'languages', 'positionTitles', 'buildings', 'parentEmployees'));
        $this->set('_serialize', ['employee']);
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->first_name = ucfirst($employee->first_name);
            $employee->last_name = ucfirst($employee->last_name);
            $employee->additional_Infos = ucfirst($employee->additional_Infos);
            $data = $employee->cell_number;
            $data = str_replace('.', '', $data);
            if (is_numeric($data) && strlen($data) == 10) {
                $employee->cell_number = substr($data, 0, 3) . '.' . substr($data, 3, 3) . '.' . substr($data, 6);
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
        $this->set(compact('employee', 'civilities', 'languages', 'positionTitles', 'buildings', 'parentEmployees'));
        $this->set('_serialize', ['employee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function sendFormationPlan($id = null, $action) {
        $employee = $this->Employees->get($id, [
            'contain' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees',
                'ChildEmployees' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings']]
        ]);
        $this->nouvelleMethode($employee);
        if ($action == 'index') {
            $this->setAction($action);
        } else {
            return $this->redirect(
                            ['action' => 'view', $id]
            );
        }
    }

    public function nouvelleMethode($employee) {
        $curr_timestamp = date('Y-m-d H:i:s');
        $emailEmp = $employee->email;


        ob_start();
        include "C:/Program Files (x86)/Ampps/www/LifeLongApp/src/Template/Employees/TemplateFormationPlan/formation_plan.php";
        $html = ob_get_clean();
        ob_end_clean();

// instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $pdf_gen = $dompdf->output();
        if (file_put_contents('C:/Program Files (x86)/Ampps/www/LifeLongApp/src/Template/Employees/TemplateFormationPlan/formationPlan.pdf', $pdf_gen)) {
            $email = new Email('default');
            $email->to($emailEmp)
                    ->setAttachments(['formationPlan.pdf' => 'C:/Program Files (x86)/Ampps/www/LifeLongApp/src/Template/Employees/TemplateFormationPlan/formationPlan.pdf'])
                    ->subject("Formation plan of " . $curr_timestamp)
                    ->send("Formation plan");
            $employee->last_sent_formation_plan = $curr_timestamp;
            $this->Employees->save($employee);
            $this->Flash->success(__('Your formation plan has been sent to your email. Thank you!'));
        }
    }

}

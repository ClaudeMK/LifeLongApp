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
                        ->where(['Employees.isSupervisor' => true]);
//                        
//        $supervisors = $supervisors->toArray();
//        debug($supervisors);
//        die();
        $this->set(compact('supervisors'));
        $this->set('_serialize', ['supervisors']);
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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->first_name = $this->editFirstLetterUpper($employee->first_name);
            $employee->last_name = $this->editFirstLetterUpper($employee->last_name);
            $employee->additional_Infos = $this->editFirstLetterUpper($employee->additional_Infos);

            $data = $employee->cell_number;
            if ($employee->parent_id == null) {
                $employee->parent_id = 1;
            }
            if (is_numeric($data) && strlen($data) == 10) {

                $employee->cell_number = $this->editPhoneDots($data);
            }
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
                $this->addAllFormationComplete($employee->id);
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
            $this->loadModel('FormationCompletes');
            $this->FormationCompletes->deleteAll([
                'employee_id' => $id
            ]);
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addAllFormationComplete($id = null) {
        $employee = $this->Employees->get($id, [
            'contain' => ['PositionTitles' => ['Formations' => ['Categories', 'Frequencies', 'Modalities', 'Notifications', 'PositionTitles']]]
        ]);

        $this->loadModel('FormationsPositionTitles');
        $FormationsPositionTitles = $this->FormationsPositionTitles->find('all')
                ->where(['FormationsPositionTitles.position_title_id = ' => $employee->position_title->id]);

        $FormationsPositionTitles = $FormationsPositionTitles->toArray();

        if (!empty($FormationsPositionTitles)) {
            $this->loadModel('FormationCompletes');
            foreach ($FormationsPositionTitles as $FormationsPositionTitle) {

                $formationComplete = $this->FormationCompletes->newEntity();
                $formationComplete->employee_id = $employee->id;
                $formationComplete->formation_id = $FormationsPositionTitle->formation_id;
                $this->FormationCompletes->save($formationComplete);
            }
        }
    }

    /*
     * Toutes modifications à cette fonction doivent être apportées à la fonction
     * sendFormationPlan du controller Users.
     */

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
                            ['action' => 'edit', $id]
            );
        }
    }

    public function nouvelleMethode($employee) {
        $curr_timestamp = date('Y-m-d H:i:s');
        $emailEmp = $employee->email;
        $lang = $employee->language_id;
        $this->loadModel('FormationCompletes');
        $formationCompletes = $this->FormationCompletes->find('all')
                ->where(['FormationCompletes.employee_id = ' => $employee->id]);

        $formationCompletes = $formationCompletes->toArray();
        ob_start();
        if ($lang == 1) {
            include "C:/Program Files (x86)/Ampps/www/LifeLongApp/src/Template/Employees/TemplateFormationPlan/formation_plan_fr.php";
        } else {
            include "C:/Program Files (x86)/Ampps/www/LifeLongApp/src/Template/Employees/TemplateFormationPlan/formation_plan_en.php";
        }
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

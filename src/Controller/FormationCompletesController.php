<?php
namespace App\Controller;

use App\Controller\AppController;
use DateTime;

/**
 * FormationCompletes Controller
 *
 * @property \App\Model\Table\FormationCompletesTable $FormationCompletes
 *
 * @method \App\Model\Entity\FormationComplete[] paginate($object = null, array $settings = [])
 */
class FormationCompletesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'Formations']
        ];
        $formationCompletes = $this->paginate($this->FormationCompletes);

        $this->set(compact('formationCompletes'));
        $this->set('_serialize', ['formationCompletes']);
    }

    /**
     * View method
     *
     * @param string|null $id Formation Complete id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $formationComplete = $this->FormationCompletes->get($id, [
            'contain' => ['Employees', 'Formations', 'Attachments']
        ]);

        $this->set('formationComplete', $formationComplete);
        $this->set('_serialize', ['formationComplete']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $formationComplete = $this->FormationCompletes->newEntity();
        if ($this->request->is('post')) {
            $formationComplete = $this->FormationCompletes->patchEntity($formationComplete, $this->request->getData());
            if ($this->FormationCompletes->save($formationComplete)) {
                $this->Flash->success(__('The formation complete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The formation complete could not be saved. Please, try again.'));
        }
        $employees = $this->FormationCompletes->Employees->find('list', ['limit' => 200]);
        $formations = $this->FormationCompletes->Formations->find('list', ['limit' => 200]);
        $this->set(compact('formationComplete', 'employees', 'formations'));
        $this->set('_serialize', ['formationComplete']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Formation Complete id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $formationComplete = $this->FormationCompletes->get($id, [
            'contain' => ['Attachments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formationComplete = $this->FormationCompletes->patchEntity($formationComplete, $this->request->getData());
            
            if($this->saveAttachment($formationComplete))
            {
                if ($this->FormationCompletes->save($formationComplete)) {
                    $this->Flash->success(__('The formation complete has been saved.'));

                    return $this->redirect(['controller' => 'Employees',
                        'action' => 'edit', $formationComplete->employee_id]);
                }
                $this->Flash->error(__('The formation complete could not be saved. Please, try again.'));
            }
        }

        $this->loadModel('Formations');
        $this->loadModel('Employees');

        $employees = $this->Employees->get($formationComplete->employee_id);
        $formations = $this->Formations->get($formationComplete->formation_id);

        $this->set(compact('formationComplete', 'employees', 'formations'));
        $this->set('_serialize', ['formationComplete']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Formation Complete id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $formationComplete = $this->FormationCompletes->get($id);
        if ($this->FormationCompletes->delete($formationComplete)) {
            $this->Flash->success(__('The formation complete has been deleted.'));
        } else {
            $this->Flash->error(__('The formation complete could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function quickUpdate($employee_id = null) {
        $employees = $this->FormationCompletes->Employees->find('list', ['limit' => 200]);
        
        if($employee_id == null) {
            $employees = $employees->toArray();
            reset($employees);
            $employee_id = key($employees);
        }

        $selectedEmployee = $this->FormationCompletes->Employees->get($employee_id, [
            'contain' => ['PositionTitles' => ['Formations']]
        ]);
        
        $selectedPositionTitle = $selectedEmployee->position_title;
 
        $formations = $selectedPositionTitle->formations;
        
        foreach($formations as $formation) :
            $cleanFormations[$formation->id] = $formation->title;
        endforeach;

        reset($cleanFormations);
        $formation_id = key($cleanFormations);
        
        $formationComplete = $this->getFormationsCompletesDatesFiles($employee_id, $formation_id);
        
        if($this->request->is(['patch', 'post', 'put'])) {
            $formationComplete = $this->getFormationsCompletesDatesFiles(
                    $this->request->data['employee_id'], $this->request->data['formation_id']);

            if($this->request->data['lastTime_completed'] != '') {
                $timeToConvert = strtotime($this->request->data['lastTime_completed']);
                $formationComplete->lastTime_completed = date('Y-m-d', $timeToConvert);
                $formationComplete->comment = $this->request->data['comment'];
            
            
                if($this->saveAttachment($formationComplete))
                {
                    if ($this->FormationCompletes->save($formationComplete)) {
                        $this->Flash->success(__('The formation complete has been saved.'));

                        return $this->redirect(['controller' => 'FormationCompletes',
                            'action' => 'quickUpdate', $formationComplete->employee_id]);
                    } else {
                        $this->Flash->error(__('The formation complete could not be saved. Please, try again.'));
                    }
                }
            } else {
                $this->Flash->error(__('The formation complete could not be saved. Please, enter a date.'));
            }
        }
        
        $this->set(compact('formationComplete', 'employees', 'cleanFormations', 'selectedEmployee'));
        $this->set('_serialize', ['formationComplete', 'employees', 'cleanFormations', 'selectedEmployee']);
    }
    
    public function getFormations() {
        $employee_id = $this->request->query('employee_id');
        
        $selectedEmployee = $this->FormationCompletes->Employees->get($employee_id, [
            'contain' => ['PositionTitles' => ['Formations']]
        ]);
        $selectedPositionTitle = $selectedEmployee->position_title;
        
        $formations = $selectedPositionTitle->formations;
        
        foreach($formations as $formation) :
            $cleanFormations[$formation->id] = $formation->title;
        endforeach;
        
        reset($cleanFormations);
        $formation_id = key($cleanFormations);
        
        $formationComplete = $this->getFormationsCompletesDatesFiles($employee_id, $formation_id);

        $this->set('formations', $cleanFormations);
    }
    
    public function getFormationsCompletesDatesFiles($employee_id, $formation_id) {
        $currentFormation = $this->FormationCompletes->find()
                ->where(['employee_id' => $employee_id, 'formation_id' => $formation_id])
                ->first();

        $id = $currentFormation->id;
        
        $formationComplete = $this->FormationCompletes->get($id, [
                'contain' => ['Attachments']
            ]);
         
        return $formationComplete;     
    }
    
    public function saveAttachment($currentFormation) {
        $attachmentOK = false;

        if($this->request->data['pieceJointe']['size'] > 0) {
            $attachmentNEW = $this->request->data['pieceJointe'];
            $attachementToOutput = $this->FormationCompletes->newEntity();
            $filename = $attachmentNEW['name'];
            $uploadFile = 'Files/'.$filename;

            if($currentFormation->attachments == null) {
                if(move_uploaded_file($this->request->data['pieceJointe']['tmp_name'], 'img/'.$uploadFile)) {
                    $attachementToOutput->formation_complete_id = $currentFormation->id;
                    $attachementToOutput->name = $attachmentNEW['name'];
                    $attachementToOutput->path = 'Files/';

                    if($this->FormationCompletes->Attachments->save($attachementToOutput)) {
                        return ($attachmentOK = true);
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again. FUCK'));
                        return $attachmentOK;
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                    return $attachmentOK;
                }
            }
            else
            {
                if(move_uploaded_file($this->request->data['pieceJointe']['tmp_name'], 'img/'.$uploadFile)) {
                    $attachementToOutput = $this->FormationCompletes->Attachments->find()
                            ->where(['formation_complete_id' => $currentFormation->id])
                            ->first();

                    $id = $attachementToOutput->id;

                    $attachementToOutput = $this->FormationCompletes->Attachments->get($id, [
                            'contain' => []
                        ]);

                    $attachementToOutput->name = $attachmentNEW['name'];

                    if($this->FormationCompletes->Attachments->save($attachementToOutput)) {
                        return ($attachmentOK = true);
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again. FUCK'));
                        return $attachmentOK;
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                    return $attachmentOK;
                }
            }
        } else {
            return ($attachmentOK = true);
        }
        
    }
    
    public function quickUpdateCsv() {
        $formationComplete = null;
        $csvErrors = [];
        
        if ($this->request->is('post')) {
            $csvFile = $this->request->data['csvFile'];
            
            $formationComplete = $this->csvFileRead($formationComplete, $csvFile, $csvErrors);
        }

        $this->set(compact('formationComplete', 'csvErrors'));
        $this->set('_serialize', ['formationComplete', 'csvErrors']);
    }
    
    public function csvFileRead(&$formationComplete, $csvFile, &$csvErrors) {
        if($this->fileNotEmpty($csvFile)) {
            $filename = $csvFile['name'];
            $uploadFile = 'Files/csv/'.$filename;
            $ext = pathinfo($uploadFile, PATHINFO_EXTENSION);

            if($this->fileOK($ext)) {
                if(move_uploaded_file($this->request->data['csvFile']['tmp_name'], 'img/'.$uploadFile)) {
                    $filePath = ROOT . DS . "webroot" . DS . "/img/Files/csv/" . $filename;
                    $isRead = fopen($filePath, "r");
                    if ($isRead) {
                        while (($line = fgets($isRead)) !== false) {
                            $lineOK = true;
                            $data = explode(';', $line);
                            
                            
                            $employee = $this->employeeValid($csvErrors, $lineOK, $line, $data[1]);
                            
                            $formation = $this->formationValid($csvErrors, $lineOK, $line, $data[0]);
                            
                            if($lineOK) {
                                $formationComplete = $this->formationCompleteValid($csvErrors, $lineOK, $line, $data, $employee, $formation);
                            }
                            
                            if($lineOK) {
                                if (!$this->FormationCompletes->save($formationComplete)) {
                                    $this->Flash->error(__('The formation complete could not be saved. Please, try again.'));
                                    return $this->redirect(['controller' => 'FormationCompletes', 'action' => 'quickUpdateCsv']);
                                }
                            }
                        }
                        fclose($isRead);
                        unlink($filePath);

                        if(empty($csvErrors)) {
                            $this->Flash->success(__('All the formations have been saved.'));
                            return $this->redirect(['controller' => 'Employees', 'action' => 'index']);
                        } else {
                            $this->Flash->error(__('There were some errors in the csv file.'));
                        }
                    } else {
                        $this->Flash->error(__('Unable to read the file, please try again.'));
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->Flash->error(__('The file has the wrong extension. File must be of type \'csv\' or \'txt\'.'));
            }
        } else {
            $this->Flash->error(__('This file is empty, please try again.'));
        }
        
        return $formationComplete;
    }
    
    public function employeeValid(&$csvErrors, &$lineOK, $line, $data) {
        $employee = $this->FormationCompletes->Employees->find()
                ->where(['number' => (int)$data])
                ->first();

        if($employee == null)  {
            array_push($csvErrors, [$line, "The employee #". $data ." doesn't exist."]);
            $lineOK = false;
        }
        
        return $employee;
    }
    
    public function formationValid(&$csvErrors, &$lineOK, $line, $data) {
        $formation = $this->FormationCompletes->Formations->find()
                ->where(['number' => (int)$data])
                ->first();

        if($formation == null)  {
            array_push($csvErrors, [$line, "The formation #". $data ." doesn't exist."]);
            $lineOK = false;
        }
        
        return $formation;
    }
    
    public function formationCompleteValid(&$csvErrors, &$lineOK, $line, $data, $employee, $formation) {
        $formationComplete = $this->FormationCompletes->find()
            ->where(['formation_id' => $formation->id, 'employee_id' => $employee->id])
            ->first();

        $data[2] = str_replace("\r\n", '', $data[2]);
        $tabDate = explode("-", $data[2]);
        if($this->dateValid($tabDate[1], $tabDate[2], $tabDate[0])) {
            $date = DateTime::createFromFormat("Y-m-d", $data[2]);

            $formationComplete->lastTime_completed = $date;
        } else {
            array_push($csvErrors, [$line, "The date must have this format : 2017-05-12 (Y-m-d)."]);
            $lineOK = false;
        }
        
        return $formationComplete;
    }
    
    public function fileOK($ext) {
        return (strcasecmp($ext, "csv") == 0 || strcasecmp($ext, "txt") == 0);
    }
    
    public function fileNotEmpty($csvFile) {
        return ($csvFile['size'] > 0);
    }
    
    public function fileNotEmptyFortest($line) {
        return strlen($line);
    }
    
    public function dateValid($month, $day, $year) {
        return (@checkdate($month, $day, $year));
    }
}

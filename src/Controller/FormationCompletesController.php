<?php
namespace App\Controller;

use App\Controller\AppController;

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
    }
    
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[] paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{

    
    public function initialize()
    {
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
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            $employee->first_name = ucfirst($employee->first_name);
            $employee->last_name = ucfirst($employee->last_name);
            $employee->additional_Infos = ucfirst($employee->additional_Infos);
            $data = $employee->cell_number;
            if(is_numeric($data) && strlen($data) == 10) {
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
    public function edit($id = null)
    {
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
            if(is_numeric($data) && strlen($data) == 10) {
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

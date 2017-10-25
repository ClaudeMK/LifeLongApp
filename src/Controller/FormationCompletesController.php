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
            'contain' => ['Employees', 'Formations']
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formationComplete = $this->FormationCompletes->patchEntity($formationComplete, $this->request->getData());
            if ($this->FormationCompletes->save($formationComplete)) {
                $this->Flash->success(__('The formation complete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The formation complete could not be saved. Please, try again.'));
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
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Civilities Controller
 *
 * @property \App\Model\Table\CivilitiesTable $Civilities
 *
 * @method \App\Model\Entity\Civility[] paginate($object = null, array $settings = [])
 */
class CivilitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $civilities = $this->paginate($this->Civilities);

        $this->set(compact('civilities'));
        $this->set('_serialize', ['civilities']);
    }

    /**
     * View method
     *
     * @param string|null $id Civility id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $civility = $this->Civilities->get($id, [
            'contain' => ['Employees' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees']]
        ]);

        $this->set('civility', $civility);
        $this->set('_serialize', ['civility']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $civility = $this->Civilities->newEntity();
        if ($this->request->is('post')) {
            $civility = $this->Civilities->patchEntity($civility, $this->request->getData());
            if ($this->Civilities->save($civility)) {
                $this->Flash->success(__('The civility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The civility could not be saved. Please, try again.'));
        }
        $this->set(compact('civility'));
        $this->set('_serialize', ['civility']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Civility id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $civility = $this->Civilities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $civility = $this->Civilities->patchEntity($civility, $this->request->getData());
            if ($this->Civilities->save($civility)) {
                $this->Flash->success(__('The civility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The civility could not be saved. Please, try again.'));
        }
        $this->set(compact('civility'));
        $this->set('_serialize', ['civility']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Civility id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $civility = $this->Civilities->get($id);
        if ($this->Civilities->delete($civility)) {
            $this->Flash->success(__('The civility has been deleted.'));
        } else {
            $this->Flash->error(__('The civility could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user) {
        if(isset($user['role']) && $user['role'] === 'Administrator') {
            return true;
        }
        
        return false;
    }
}

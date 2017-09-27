<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PositionTitles Controller
 *
 * @property \App\Model\Table\PositionTitlesTable $PositionTitles
 *
 * @method \App\Model\Entity\PositionTitle[] paginate($object = null, array $settings = [])
 */
class PositionTitlesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $positionTitles = $this->paginate($this->PositionTitles);

        $this->set(compact('positionTitles'));
        $this->set('_serialize', ['positionTitles']);
    }

    /**
     * View method
     *
     * @param string|null $id Position Title id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $positionTitle = $this->PositionTitles->get($id, [
            'contain' => ['Employees' => ['Civilities', 'Languages', 'PositionTitles', 'Buildings', 'ParentEmployees']]
        ]);

        $this->set('positionTitle', $positionTitle);
        $this->set('_serialize', ['positionTitle']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $positionTitle = $this->PositionTitles->newEntity();
        if ($this->request->is('post')) {
            $positionTitle = $this->PositionTitles->patchEntity($positionTitle, $this->request->getData());
            if ($this->PositionTitles->save($positionTitle)) {
                $this->Flash->success(__('The position title has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The position title could not be saved. Please, try again.'));
        }
        $this->set(compact('positionTitle'));
        $this->set('_serialize', ['positionTitle']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Position Title id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $positionTitle = $this->PositionTitles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $positionTitle = $this->PositionTitles->patchEntity($positionTitle, $this->request->getData());
            if ($this->PositionTitles->save($positionTitle)) {
                $this->Flash->success(__('The position title has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The position title could not be saved. Please, try again.'));
        }
        $this->set(compact('positionTitle'));
        $this->set('_serialize', ['positionTitle']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Position Title id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $positionTitle = $this->PositionTitles->get($id);
        if ($this->PositionTitles->delete($positionTitle)) {
            $this->Flash->success(__('The position title has been deleted.'));
        } else {
            $this->Flash->error(__('The position title could not be deleted. Please, try again.'));
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

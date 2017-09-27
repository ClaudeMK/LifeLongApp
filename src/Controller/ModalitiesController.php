<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Modalities Controller
 *
 * @property \App\Model\Table\ModalitiesTable $Modalities
 *
 * @method \App\Model\Entity\Modality[] paginate($object = null, array $settings = [])
 */
class ModalitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $modalities = $this->paginate($this->Modalities);

        $this->set(compact('modalities'));
        $this->set('_serialize', ['modalities']);
    }

    /**
     * View method
     *
     * @param string|null $id Modality id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modality = $this->Modalities->get($id, [
            'contain' => ['Formations' => ['Categories', 'Frequencies', 'Modalities', 'Notifications']]
        ]);

        $this->set('modality', $modality);
        $this->set('_serialize', ['modality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $modality = $this->Modalities->newEntity();
        if ($this->request->is('post')) {
            $modality = $this->Modalities->patchEntity($modality, $this->request->getData());
            if ($this->Modalities->save($modality)) {
                $this->Flash->success(__('The modality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The modality could not be saved. Please, try again.'));
        }
        $this->set(compact('modality'));
        $this->set('_serialize', ['modality']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Modality id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $modality = $this->Modalities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modality = $this->Modalities->patchEntity($modality, $this->request->getData());
            if ($this->Modalities->save($modality)) {
                $this->Flash->success(__('The modality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The modality could not be saved. Please, try again.'));
        }
        $this->set(compact('modality'));
        $this->set('_serialize', ['modality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Modality id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $modality = $this->Modalities->get($id);
        if ($this->Modalities->delete($modality)) {
            $this->Flash->success(__('The modality has been deleted.'));
        } else {
            $this->Flash->error(__('The modality could not be deleted. Please, try again.'));
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

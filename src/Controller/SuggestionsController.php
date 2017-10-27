<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Suggestions Controller
 *
 * @property \App\Model\Table\SuggestionsTable $Suggestions
 */
class SuggestionsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$Suggestions_data = $this->Suggestions->newEntity();
        $suggestions = $this->paginate($this->Suggestions->find('all')->where(['flag' =>0])->order(['id' => 'DESC']));
        $this->set(compact('suggestions','Suggestions_data'));
        $this->set('_serialize', ['suggestions','Suggestions_data']);
    }

    /**
     * View method
     *
     * @param string|null $id Suggestion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suggestion = $this->Suggestions->get($id, [
            'contain' => []
        ]);

        $this->set('suggestion', $suggestion);
        $this->set('_serialize', ['suggestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $suggestion = $this->Suggestions->newEntity();
        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success(__('The suggestion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The suggestion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('suggestion'));
        $this->set('_serialize', ['suggestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Suggestion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suggestion = $this->Suggestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success(__('The suggestion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The suggestion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('suggestion'));
        $this->set('_serialize', ['suggestion']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suggestion = $this->Suggestions->get($id, [
            'contain' => []
        ]);
			$this->request->data['flag']=1;
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
				$this->Flash->success(__('The suggestion has been deleted.'));
			} else {
				$this->Flash->error(__('The suggestion could not be deleted. Please, try again.'));
			}
		

        return $this->redirect(['action' => 'index']);
    }
}

<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SurveyQuestionRows Controller
 *
 * @property \App\Model\Table\SurveyQuestionRowsTable $SurveyQuestionRows
 */
class SurveyQuestionRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SurveyQuestions']
        ];
        $surveyQuestionRows = $this->paginate($this->SurveyQuestionRows);

        $this->set(compact('surveyQuestionRows'));
        $this->set('_serialize', ['surveyQuestionRows']);
    }

    /**
     * View method
     *
     * @param string|null $id Survey Question Row id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $surveyQuestionRow = $this->SurveyQuestionRows->get($id, [
            'contain' => ['SurveyQuestions']
        ]);

        $this->set('surveyQuestionRow', $surveyQuestionRow);
        $this->set('_serialize', ['surveyQuestionRow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $surveyQuestionRow = $this->SurveyQuestionRows->newEntity();
        if ($this->request->is('post')) {
            $surveyQuestionRow = $this->SurveyQuestionRows->patchEntity($surveyQuestionRow, $this->request->data);
            if ($this->SurveyQuestionRows->save($surveyQuestionRow)) {
                $this->Flash->success(__('The survey question row has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The survey question row could not be saved. Please, try again.'));
            }
        }
        $surveyQuestions = $this->SurveyQuestionRows->SurveyQuestions->find('list', ['limit' => 200]);
        $this->set(compact('surveyQuestionRow', 'surveyQuestions'));
        $this->set('_serialize', ['surveyQuestionRow']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Survey Question Row id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $surveyQuestionRow = $this->SurveyQuestionRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $surveyQuestionRow = $this->SurveyQuestionRows->patchEntity($surveyQuestionRow, $this->request->data);
            if ($this->SurveyQuestionRows->save($surveyQuestionRow)) {
                $this->Flash->success(__('The survey question row has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The survey question row could not be saved. Please, try again.'));
            }
        }
        $surveyQuestions = $this->SurveyQuestionRows->SurveyQuestions->find('list', ['limit' => 200]);
        $this->set(compact('surveyQuestionRow', 'surveyQuestions'));
        $this->set('_serialize', ['surveyQuestionRow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Survey Question Row id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $surveyQuestionRow = $this->SurveyQuestionRows->get($id);
        if ($this->SurveyQuestionRows->delete($surveyQuestionRow)) {
            $this->Flash->success(__('The survey question row has been deleted.'));
        } else {
            $this->Flash->error(__('The survey question row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

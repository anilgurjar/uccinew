<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * SurveyQuestions Controller
 *
 * @property \App\Model\Table\SurveyQuestionsTable $SurveyQuestions
 */
class SurveyQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	 
	 public function initialize()
	{
		parent::initialize();
	}
	 
	 
    public function survey()
    {
       $user_id=$this->request->query['user_id']; 
	  // $user_id=1;
	  $SurveyQuestions= $this->SurveyQuestions->find()
	  ->contain(['SurveyQuestionRows'])
	  ->toArray();
	  $Survey='';
		foreach($SurveyQuestions as $SurveyQuestion){
			$id=$SurveyQuestion->id;
			$SurveyAnswers=$this->SurveyQuestions->SurveyAnswers->find()
			->where(['user_id'=>$user_id,'survey_question_id'=>$id])->count();
			if($SurveyAnswers==0){
					$success=true;
					$error='';
					$Survey=$SurveyQuestion;
					break;
				
				
			}
			
		}
		
		if(empty($Survey)){ 
			$success=false;
		}
			$this->set(compact('success', 'error', 'Survey'));
			$this->set('_serialize', ['success', 'error', 'Survey']);
    }
	
	public function surveyadd()
    {
		$SurveyAnswers = $this->SurveyQuestions->SurveyAnswers->newEntity();
		if($this->request->is('post')){
			//$this->request->data['survey_answer_rows']['survey_question_row_id']=array(1,3);
			$type=base64_decode($this->request->data['type']);
			$this->request->data['type']=base64_decode($this->request->data['type']);
			$this->request->data['survey_question_id']=base64_decode($this->request->data['survey_question_id']);
			$this->request->data['user_id']=base64_decode($this->request->data['user_id']);
			//$this->request->data['answer']=base64_decode(@$this->request->data['answer']);
			$this->request->data['survey_question_row_id']=base64_decode(@$this->request->data['survey_question_row_id']);
			
			$SurveyAnswers=$this->SurveyQuestions->SurveyAnswers->patchEntity($SurveyAnswers,$this->request->data);
			if($type=='checkbox'){
				$i=0;
				$survey_question_row_ids=$this->request->data['survey_answer_rows']['survey_question_row_id'];
				$this->request->data['survey_question_row_id']='';
				foreach($survey_question_row_ids as $survey_question_row){
					$SurveyAnswerRows = $this->SurveyQuestions->SurveyAnswers->SurveyAnswerRows->newEntity();
					$SurveyAnswerRows->survey_question_row_id=base64_decode($survey_question_row);
					$SurveyAnswers->survey_answer_rows[$i]=$SurveyAnswerRows;
					
					$i++;
					
				}
			}	
			
				if($this->SurveyQuestions->SurveyAnswers->save($SurveyAnswers)){
					
						echo "<script> window.location='http://www.ucciudaipur.in/web/homes';</script>";
						exit;
				 }else{
					 
					$success=false;
					$error="Something went wrong.";
					$response="";
				 }
						
		}
		
		$this->set(compact('success', 'error', 'response'));
        $this->set('_serialize', ['success', 'error', 'response']);
		
		
	}

    /**
     * View method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $surveyQuestion = $this->SurveyQuestions->get($id, [
            'contain' => ['SurveyQuestionRows']
        ]);

        $this->set('surveyQuestion', $surveyQuestion);
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $surveyQuestion = $this->SurveyQuestions->newEntity();
        if ($this->request->is('post')) {
            $surveyQuestion = $this->SurveyQuestions->patchEntity($surveyQuestion, $this->request->data);
			
			
            if ($this->SurveyQuestions->save($surveyQuestion)) {
                $this->Flash->success(__('The survey question has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The survey question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('surveyQuestion'));
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $surveyQuestion = $this->SurveyQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $surveyQuestion = $this->SurveyQuestions->patchEntity($surveyQuestion, $this->request->data);
            if ($this->SurveyQuestions->save($surveyQuestion)) {
                $this->Flash->success(__('The survey question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The survey question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('surveyQuestion'));
        $this->set('_serialize', ['surveyQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Survey Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $surveyQuestion = $this->SurveyQuestions->get($id);
        if ($this->SurveyQuestions->delete($surveyQuestion)) {
            $this->Flash->success(__('The survey question has been deleted.'));
        } else {
            $this->Flash->error(__('The survey question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

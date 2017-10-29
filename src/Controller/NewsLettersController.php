<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * NewsLetters Controller
 *
 * @property \App\Model\Table\NewsLettersTable $NewsLetters
 */
class NewsLettersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
		$this->set('role_id',$this->Auth->User('role_id'));
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
        $newsLetters = $this->paginate($this->NewsLetters->find()
									->where(['is_deleted !=' => '1'])
									->order(['NewsLetters.id'=>'DESC'])
									);
        
        $this->set(compact('newsLetters'));
        $this->set('_serialize', ['newsLetters']);
    }

    /**
     * View method
     *
     * @param string|null $id News Letter id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $newsLetter = $this->NewsLetters->get($id, [
            'contain' => []
        ]);

        $this->set('newsLetter', $newsLetter);
        $this->set('_serialize', ['newsLetter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $newsLetter = $this->NewsLetters->newEntity();
		$user_id=$this->Auth->User('id');
		if ($this->request->is('post')) {
			$this->request->data['created_on']=date("Y-m-d");
			$this->request->data['created_by']=$user_id;
			$files    =$this->request->data['cover_image'];
			$pdf_file =$this->request->data['pdf_attachment'];
			
            $newsLetter = $this->NewsLetters->patchEntity($newsLetter, $this->request->data);
            if ($newsletter_data=$this->NewsLetters->save($newsLetter)) { 
				
				$newsletter_id=$newsletter_data->id; 
				if ($pdf_file["type"] == "application/pdf"){
				$dir = new Folder(WWW_ROOT . 'pdf/newsletter/'.$newsletter_id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'pdf/newsletter/'.$newsletter_id;
				$pdf_path='pdf/newsletter/'.$newsletter_id.'/'.$pdf_file['name'];
				move_uploaded_file($pdf_file['tmp_name'], $file_path.'/' . $pdf_file['name']);
				}
				$dir = new Folder(WWW_ROOT . 'img/newsletter/'.$newsletter_id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/newsletter/'.$newsletter_id;
				$coverage_path='img/newsletter/'.$newsletter_id.'/'.$files[0]['name'];
				move_uploaded_file($files[0]['tmp_name'], $file_path.'/' . $files[0]['name']);
				
				
				$query = $this->NewsLetters->query();
				$query->update()
				->set(['cover_image'=>$coverage_path,'pdf_attachment' => @$pdf_path])
				->where(['id' => $newsletter_id])
				->execute();
				
                $this->Flash->success(__('The news letter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
				//pr($newsLetter->errors()); exit;
                $this->Flash->error(__('The news letter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('newsLetter'));
        $this->set('_serialize', ['newsLetter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News Letter id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $newsLetter = $this->NewsLetters->get($id, [
            'contain' => []
        ]);
		;
		$user_id=$this->Auth->User('id');
        if ($this->request->is(['patch', 'post', 'put'])) {
			$this->request->data['edited_on']=date("Y-m-d");
			$this->request->data['edited_by']=$user_id;
			$image =$this->request->data['cover_image'];
			
			$pdf_file =$this->request->data['attachment'];
			$hidden_image =$newsLetter->cover_image;
			$hidden_pdf =$newsLetter->pdf_attachment;
			
			if(!empty($image['name']))
			{
				echo $files =$image;
			}
		
            $newsLetter = $this->NewsLetters->patchEntity($newsLetter, $this->request->data);
            if ($newsletter_data=$this->NewsLetters->save($newsLetter)) {
				
				$newsletter_id=$newsletter_data->id;
              if(!empty($pdf_file['name']))
			   {				
				   if ($pdf_file["type"] == "application/pdf"){
					$dir = new Folder(WWW_ROOT . 'pdf/newsletter/'.$newsletter_id, true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'pdf/newsletter/'.$newsletter_id;
					$pdf_path='pdf/newsletter/'.$newsletter_id.'/'.$pdf_file['name'];
					move_uploaded_file($pdf_file['tmp_name'], $file_path.'/' . $pdf_file['name']);
					}
			   }
			   else
			   {
				   $pdf_path=$hidden_pdf;
			   }
			  if(!empty($image['name']))
			   {
				 $dir = new Folder(WWW_ROOT . 'img/newsletter/'.$newsletter_id, true, 0755);
				 $file_path = str_replace("\\","/",WWW_ROOT).'img/newsletter/'.$newsletter_id;
				 $coverage_path='img/newsletter/'.$newsletter_id.'/'.$files['name'];
				 move_uploaded_file($files['tmp_name'], $file_path.'/' . $files['name']);
			   }
			   else
			   {
				   $coverage_path=$hidden_image;
			   }
				
				$query = $this->NewsLetters->query();
				$query->update()
				->set(['cover_image'=>$coverage_path,'pdf_attachment' => @$pdf_path])
				->where(['id' => $newsletter_id])
				->execute();
				
                $this->Flash->success(__('The news letter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news letter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('newsLetter'));
        $this->set('_serialize', ['newsLetter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News Letter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
	
		$this->request->allowMethod(['post', 'delete']);
        $newsLetter = $this->NewsLetters->get($id);
		$this->request->data['is_deleted']=1;	
         if ($this->request->is(['patch', 'post', 'put'])) {
            $newsLetter = $this->NewsLetters->patchEntity($newsLetter, $this->request->data);
            if ($this->NewsLetters->save($newsLetter)) {
                $this->Flash->success(__('Data has been Deleted'));
                return $this->redirect(['action' => 'index']);
            } 
        }
    }
}

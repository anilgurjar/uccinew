<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * CertificateOriginAuthorizeds Controller
 *
 * @property \App\Model\Table\CertificateOriginAuthorizedsTable $CertificateOriginAuthorizeds
 */
class CertificateOriginAuthorizedsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index']);
		$member_name=$this->Auth->User('member_name');
		$this->set('member_name',$member_name);
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $this->paginate = [
            'contain' => ['Users']
        ];
        $certificateOriginAuthorizeds = $this->paginate($this->CertificateOriginAuthorizeds);

        $this->set(compact('certificateOriginAuthorizeds'));
        $this->set('_serialize', ['certificateOriginAuthorizeds']);
    }

    /**
     * View method
     *
     * @param string|null $id Certificate Origin Authorized id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('certificateOriginAuthorized', $certificateOriginAuthorized);
        $this->set('_serialize', ['certificateOriginAuthorized']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->newEntity();
        if ($this->request->is('post')) {
			
			$signature=$this->request->data['signature'];
			
						
            $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->patchEntity($certificateOriginAuthorized, $this->request->data);
            if ($data=$this->CertificateOriginAuthorizeds->save($certificateOriginAuthorized)) {
				
				if(!empty($signature['name'])){
					
					$ext = substr(strtolower(strrchr($signature['name'], '.')), 1); //get the extension
					$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
					//$setNewFileName = uniqid();
					$setNewFileName="coo_authorized_".$data->id;
					
					$dir = new Folder(WWW_ROOT . 'img/coo_signature/', true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_signature/';
					$coverage_path='img/coo_signature/'.$setNewFileName.'.'.$ext;
					
					if (in_array($ext, $arr_ext)) {
						move_uploaded_file($signature['tmp_name'], $file_path.'/' .$setNewFileName.'.'.$ext);
					}
					
				$query = $this->CertificateOriginAuthorizeds->query();
				$query->update()
				->set(['signature'=>$coverage_path])
				->where(['id' => $data->id])
				->execute();
				}	
				
				
				
				
				
                $this->Flash->success(__('The certificate origin authorized has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The certificate origin authorized could not be saved. Please, try again.'));
            }
        }
		$certificateOrigins = $this->CertificateOriginAuthorizeds->find()->contain(['Users'=>['Companies']]);
		//pr($certificateOrigins->toArray()); exit;
        $users = $this->CertificateOriginAuthorizeds->Users->find('list');
        $this->set(compact('certificateOriginAuthorized', 'users','certificateOrigins'));
        $this->set('_serialize', ['certificateOriginAuthorized']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Certificate Origin Authorized id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
        $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->patchEntity($certificateOriginAuthorized, $this->request->data);
            if ($this->CertificateOriginAuthorizeds->save($certificateOriginAuthorized)) {
                $this->Flash->success(__('The certificate origin authorized has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The certificate origin authorized could not be saved. Please, try again.'));
            }
        }
        $users = $this->CertificateOriginAuthorizeds->Users->find('list');
        $this->set(compact('certificateOriginAuthorized', 'users'));
        $this->set('_serialize', ['certificateOriginAuthorized']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Certificate Origin Authorized id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $certificateOriginAuthorized = $this->CertificateOriginAuthorizeds->get($id);
        if ($this->CertificateOriginAuthorizeds->delete($certificateOriginAuthorized)) {
            $this->Flash->success(__('The certificate origin authorized has been deleted.'));
        } else {
            $this->Flash->error(__('The certificate origin authorized could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

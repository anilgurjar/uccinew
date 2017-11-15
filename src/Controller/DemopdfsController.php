<?php
namespace App\Controller;

use setasign\Fpdi\Fpdi;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use App\Controller\AppController;
use UsersController;

use Dompdf\Options;
//require_once('vendor/pdfs/fpdf.php');
//require_once('vendor/pdfs/src/autoload.php');
require_once(ROOT . DS  .'vendor' . DS  . 'pdfs' . DS . 'fpdf.php');
require_once(ROOT . DS  .'vendor' . DS  . 'pdfs' . DS . 'src' . DS . 'autoload.php');
/**
 * Demopdfs Controller
 *
 * @property \App\Model\Table\DemopdfsTable $Demopdfs
 */
class DemopdfsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $demopdfs = $this->paginate($this->Demopdfs);

        $this->set(compact('demopdfs'));
        $this->set('_serialize', ['demopdfs']);
    }

    /**
     * View method
     *
     * @param string|null $id Demopdf id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $demopdf = $this->Demopdfs->get($id, [
            'contain' => []
        ]);

        $this->set('demopdf', $demopdf);
        $this->set('_serialize', ['demopdf']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    /* 
        $demopdf = $this->Demopdfs->newEntity();
        if ($this->request->is('post')) {
            $demopdf = $this->Demopdfs->patchEntity($demopdf, $this->request->data);
            if ($this->Demopdfs->save($demopdf)) {
                $this->Flash->success(__('The demopdf has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The demopdf could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('demopdf'));
        $this->set('_serialize', ['demopdf']);
    } */
	
	
	
	public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		
		$Companies=$this->Demopdfs->Companies->get($company_id);
		$role_id=$Companies->role_id;
		$certificate_origin_good = $this->Demopdfs->newEntity();
		if($this->request->is('post')) 
		{	
			$files=$this->request->data['file']; 
			if(!empty($files[0]['name'])){
				$this->request->data['file']=$files['name'];
			}
			$filess=$this->request->data['file']['name'];
			
			$this->request->data['file']=$filess;
			$certificate_origin_good = $this->Demopdfs->patchEntity($certificate_origin_good, $this->request->data);
			
			if ($data=$this->Demopdfs->save($certificate_origin_good))
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice_pdf/'.$data->id, true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_pdf/'.$data->id.'/'.$filess;
				
			
				   move_uploaded_file($files['tmp_name'], $file_path);
				
				$query = $this->Demopdfs->query();
				$query->update()
					->set(['file_attachment' => $file_path])
					->where(['id' => $data->id])
					->execute();
				if($role_id==1 || $role_id==4){
					$fileget=$this->Demopdfs->get($data->id);
					
						
				

					// initiate FPDI
					$pdf = new Fpdi();
					// add a page
					//$pdf->AddPage();
					// set the source file
					$pageCount =$pdf->setSourceFile($fileget['file_attachment']);
					 //$this->setSourceFile($filess);
						for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
							$pageId = $pdf->ImportPage($pageNo);
							$s = $pdf->getTemplatesize($pageId);
							$pdf->AddPage($s['orientation'], $s);
							$pdf->useImportedPage($pageId);
						}
					// import page 1
					//$tplIdx = $pdf->importPage(1);
					// use the imported page and place it at position 10,10 with a width of 100 mm
					//$pdf->useTemplate($tplIdx, 5, 5, 200);

					// now write some text above the imported page
					$pdf->SetFont('Helvetica');
					$pdf->SetTextColor(255, 0, 0);
					$pdf->SetXY(30, 30);
					$pdf->Image('img/coo_signature/coo_authorized_1.png',170,240,20);
					$pdf->Output();
				}	
				
				
				
				$this->Flash->success(__('Your Demo PDF  has been saved.'));
				return $this->redirect(['action' => 'add']);
				exit;
				//return $this->redirect('https://test.payu.in/_payment');
				//return $this->redirect(['action' => 'payment',$data->id]);
			}
			
			$this->Flash->error(__('Unable to add your certificate origin goods.'));
		}
		$this->set('certificate_origin_good', $certificate_origin_good);
			 
		 
	}

    /**
     * Edit method
     *
     * @param string|null $id Demopdf id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $demopdf = $this->Demopdfs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $demopdf = $this->Demopdfs->patchEntity($demopdf, $this->request->data);
            if ($this->Demopdfs->save($demopdf)) {
                $this->Flash->success(__('The demopdf has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The demopdf could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('demopdf'));
        $this->set('_serialize', ['demopdf']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Demopdf id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $demopdf = $this->Demopdfs->get($id);
        if ($this->Demopdfs->delete($demopdf)) {
            $this->Flash->success(__('The demopdf has been deleted.'));
        } else {
            $this->Flash->error(__('The demopdf could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

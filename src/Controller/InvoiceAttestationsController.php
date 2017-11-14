<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use UsersController;
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * InvoiceAttestations Controller
 *
 * @property \App\Model\Table\InvoiceAttestationsTable $InvoiceAttestations
 */
class InvoiceAttestationsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'index','CooSendEmail']);
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
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $invoiceAttestations = $this->paginate($this->InvoiceAttestations);

        $this->set(compact('invoiceAttestations'));
        $this->set('_serialize', ['invoiceAttestations']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('invoiceAttestation', $invoiceAttestation);
        $this->set('_serialize', ['invoiceAttestation']);
    }
	
	
	// function for view attestation for draft view start
	public function attestationDraftView($id = null){
		$this->viewBuilder()->layout('index_layout');
		$user_id=$this->Auth->User('id');
		$company_id=$this->Auth->User('company_id');
		$InvoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => []
        ]);
		$invoice_attestations = $this->InvoiceAttestations->find()->where(['InvoiceAttestations.id'=>$id])->contain(['Companies'])->toArray();
		foreach($invoice_attestations as $invoice_attestation){
			$oldimage=$invoice_attestation['invoice_attachment'];
		}
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			if(isset($this->request->data['coo_attestation_draft']))
			{
				
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				$this->request->data['company_id']=$company_id;
				$files=$this->request->data['file']; 
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
				}
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				
				
				/*$CertificateOriginAuthorizeds=$this->CertificateOrigins->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				 foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				} */
				
				
				$invoice_attestation = $this->InvoiceAttestations->patchEntity($invoice_attestation, $this->request->data);
				
				if ($data=$this->InvoiceAttestations->save($invoice_attestation))
				{ 	
						$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
						$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
						foreach($files as $file){
						  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);

						}
					$last_insert_id=$data['id'];
					$this->Flash->success(__('Your certificate origin good has been saved.'));
					return $this->redirect(['action' => 'attestation-draft-view',$last_insert_id]);
					 
				}
				
			}
			else if(isset($this->request->data['certificate_origin_publish']))
			{ 
				 
				$this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
				$this->request->data['date_current']=date('Y-m-d');
				//$this->request->data['company_id']=$user_id;
				$files=$this->request->data['file'];
				
				if(!empty($files[0]['name'])){
					$this->request->data['invoice_attachment']='true';
				}else{
					$this->request->data['invoice_attachment']=$oldimage;
				}
				
				$amount=200;
				$Tax=$amount*18/100;
				$include_tax_amount=$amount+$Tax;
				
				$this->request->data['payment_amount']=200;
				$this->request->data['payment_tax_amount']=$Tax;
				$this->request->data['status']='draft';
				$this->request->data['coo_email']='yes';
				$this->request->data['verify_remarks']='';
				$payment_type=$this->request->data['payment_type'];
				$coupon_code=$this->request->data['coupon_code'];
				
				
				$CertificateOriginAuthorizeds=$this->InvoiceAttestations->CertificateOriginAuthorizeds->find()->toArray();
				$i=0;
				/* foreach($CertificateOriginAuthorizeds as $CertificateAuthorized){
					$this->request->data['coo_email_approvals'][$i]['user_id']=$CertificateAuthorized->user_id;	
					$this->request->data['coo_email_approvals'][$i]['status']=0;	
					$i++;	
				} */
				$currency_type=$this->request->data['currency'];
				$currency_units=$this->InvoiceAttestations->MasterCurrencies->find()->where(['currency_type'=>$currency_type]);	
				foreach($currency_units as $currency_unit){
					$currency_unit = $currency_unit['fractional_unit'];
				}
			
				$this->request->data['currency_unit'] = $currency_unit;	
				$invoice_attestation = $this->InvoiceAttestations->patchEntity($invoice_attestation, $this->request->data);

				if ($data=$this->InvoiceAttestations->save($invoice_attestation))
				{ 
					$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
					$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
					foreach($files as $file){
					  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
					}
					 
				/* if($payment_type=="couponcode"){
					
							$paymented=$this->CertificateOrigins->find('all')
							->where(['id'=>$id,'payment_status'=>'success'])->count();
						if($paymented>0){
								$query = $this->CertificateOrigins->query();
								$query->update()
								->set(['status' => 'published'])
								->where(['id' => $data->id])
								->execute();



								//return $this->redirect('https://test.payu.in/_payment');
								return $this->redirect(['action' => 'certificate-origin-draft-view']);

						}else{

							$coo_company_id=$data->company_id;
							$CooCoupons_count=$this->CertificateOrigins->Companies->CooCoupons->find()->where(['company_id'=>$coo_company_id,'coupon_code'=>$coupon_code,'flag'=>0])->count();
							
								if($CooCoupons_count>0){
										$CooCoupons=$this->CertificateOrigins->Companies->CooCoupons->newEntity();
										$CooCoupons_counts=$this->CertificateOrigins->Companies->CooCoupons->find()->where(['company_id'=>$coo_company_id,'coupon_code'=>$coupon_code,'flag'=>0])->toArray();
										$coupon_id=$CooCoupons_counts[0]->id;
										$CooCoupons->id=$coupon_id;
										$CooCoupons->flag=1;
										
										$this->CertificateOrigins->Companies->CooCoupons->save($CooCoupons);
										
										$query = $this->CertificateOrigins->query();
										$query->update()
										->set(['status' => 'published','payment_status'=>'success','transaction_id'=>$coupon_code])
										->where(['id' => $data->id])
										->execute();
										return $this->redirect(['action' => 'certificate-origin-draft-view']);
										
								}else{
									return $this->redirect(['action' => 'certificate-origin-draft-view']);
								}
							
						}	
				}else{ */
					
					$paymented=$this->InvoiceAttestations->find('all')
						->where(['id'=>$id,'payment_status'=>'success'])->count();
					if($paymented>0){
						$query = $this->InvoiceAttestations->query();
							$query->update()
							->set(['status' => 'published'])
							->where(['id' => $data->id])
							->execute();


					
						//return $this->redirect('https://test.payu.in/_payment');
						return $this->redirect(['action' => 'certificate-origin-draft-view']);
					}
					else{
						//return $this->redirect(['action' => 'paymentTest',$data->id]);
						return $this->redirect(['action' => 'payment',$data->id]);
					}
				//}	
					
					$this->Flash->success(__('Your certificate origin good has been saved.'));
				}
			
			}
        }
			
        $this->set('invoice_attestation', $invoice_attestation);
		$Users=$this->InvoiceAttestations->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		$this->set('company_organisation' , $Users[0]->company_organisation);
		$this->set(compact('MasterUnits','MasterCurrencies','certificate_origins'));
		
		
	}
	// function for view attestation for draft view end
	
	
	
	
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		
        $invoiceAttestation = $this->InvoiceAttestations->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['invoice_date']=date('Y-m-d',strtotime($this->request->data['invoice_date']));
			$this->request->data['date_current']=date('Y-m-d');
			$this->request->data['company_id']=$company_id;
			
			
			
			$amount=200;
			$Tax=$amount*18/100;
			$include_tax_amount=$amount+$Tax;
			
			
			$this->request->data['payment_amount']=200;
			$this->request->data['payment_tax_amount']=$Tax;
			$this->request->data['status'] = 'draft';
			$files=$this->request->data['file']; 
			if(!empty($files[0]['name'])){
				$this->request->data['invoice_attachment']='true';
			}else{
				$this->request->data['invoice_attachment']='false';
			}
			$invoiceAttestation = $this->InvoiceAttestations->patchEntity($invoiceAttestation, $this->request->data);
            if ($data=$this->InvoiceAttestations->save($invoiceAttestation)) 
			{ 
				$dir = new Folder(WWW_ROOT . 'img/coo_invoice_attestation/'.$data['id'], true, 0755);
				$file_path = str_replace("\\","/",WWW_ROOT).'img/coo_invoice_attestation/'.$data['id'];
				foreach($files as $file){
				  move_uploaded_file($file['tmp_name'], $file_path.'/' . $file['name']);
				}
				$last_insert_id=$data['id'];
				$this->Flash->success(__('The invoice attestation has been saved.'));
				return $this->redirect(['action' => 'attestationDraftView',$last_insert_id]);
				exit;
			} else {
                $this->Flash->error(__('The invoice attestation could not be saved. Please, try again.'));
            }
        }
       $Users=$this->InvoiceAttestations->Companies->find()->select(['company_organisation'])->where(['id'=>$company_id])->toArray();
		
       $this->set(compact('invoiceAttestation', 'companies'));
        $this->set('_serialize', ['invoiceAttestation']);
		$this->set('company_organisation' , $Users[0]->company_organisation);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceAttestation = $this->InvoiceAttestations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceAttestation = $this->InvoiceAttestations->patchEntity($invoiceAttestation, $this->request->data);
            if ($this->InvoiceAttestations->save($invoiceAttestation)) {
                $this->Flash->success(__('The invoice attestation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice attestation could not be saved. Please, try again.'));
            }
        }
        $companies = $this->InvoiceAttestations->Companies->find('list');
        $this->set(compact('invoiceAttestation', 'companies'));
        $this->set('_serialize', ['invoiceAttestation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Attestation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceAttestation = $this->InvoiceAttestations->get($id);
        if ($this->InvoiceAttestations->delete($invoiceAttestation)) {
            $this->Flash->success(__('The invoice attestation has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice attestation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

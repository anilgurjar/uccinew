<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use App\Controller\Users;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use Cake\Mailer\Email;
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


class CertificateOriginsController extends AppController 
{

	public function initialize()
	{
		parent::initialize();
	
	}
	
	
	public function coosearch()
	{
			
		if($this->request->is(['post','put']))
		{  
 
			 $organisation_name=$this->request->data['company_organisation'];
			 $consignee=$this->request->data['consignee'];
			 $coo_number=$this->request->data['coo_number'];
			
			if(!empty($organisation_name) and !empty($consignee) and !empty($coo_number))
			{
			 $CertificateOrigins_count=$this->CertificateOrigins->find()
			 ->Where(['exporter LIKE' => '%'.$organisation_name.'%','consignee LIKE' => '%'.$consignee.'%','origin_no'=>$coo_number])
			->count();  
		  if($CertificateOrigins_count>0){
					
					$CertificateOrigins=$this->CertificateOrigins->find()
					->Where(['exporter LIKE' => '%'.$organisation_name.'%','consignee LIKE' => '%'.$consignee.'%','origin_no'=>$coo_number])->toArray();
					 
					$coo_verification_code=$CertificateOrigins[0]->coo_verification_code;
					if(!empty($coo_verification_code)){
						$fath='http://app.ucciudaipur.com/app/co_pdf/'.$coo_verification_code.'.pdf';
					}else{
						$fath='http://app.ucciudaipur.com/app/co_pdf/'.$coo_number.'.pdf';					
					}
					
					$success=true;
					$error='';
					
				}else{
					
					$success=false;
					$error='';
					$fath='';
								
				}
				
			$this->set(compact('success', 'error', 'fath'));
        	$this->set('_serialize', ['success', 'error', 'fath']);
			}
			
					
		}
		
	}
	
	
} 
	
	
 
?>



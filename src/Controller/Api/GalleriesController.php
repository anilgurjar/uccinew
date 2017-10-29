<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
/**
 * Galleries Controller
 *
 * @property \App\Model\Table\GalleriesTable $Galleries
 */
class GalleriesController extends AppController
{

    public function initialize()
	{
		parent::initialize();
 	} 
	
	public function GalleryList()
	{
		$Galleries=array();
		$Galleries_data = $this->Galleries->find();			
 		if($Galleries_data)
		{	$x=0;
			foreach($Galleries_data as $Galleries_record)
			{
				$count=$this->Galleries->Galleryphotos->find()->where(['gallery_id' => $Galleries_record->id])->count();
				if($count >= 2)
				{
					$Galleries[]=$Galleries_record;
 				}
			}
  			$success=true;
			$error='';
			$response=$Galleries;
		}
		else 
		{
			$success=false;
			$error='No data found.';
			$response='';
		}
		$this->set(compact('success', 'error', 'response'));
		$this->set('_serialize', ['success', 'error', 'response']);
	}
 }

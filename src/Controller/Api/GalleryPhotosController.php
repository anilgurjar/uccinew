<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;

/**
 * GalleryPhotos Controller
 *
 * @property \App\Model\Table\GalleryPhotosTable $GalleryPhotos
 */
class GalleryPhotosController extends AppController
{

    public function initialize()
	{
		parent::initialize();
 	}
	
	public function GalleryDetails()
	{
		$gallery_id=$this->request->query('gallery_id');
		$GalleryPhotos=$this->GalleryPhotos->find()
			->where(['gallery_id' => $gallery_id]);
		if($GalleryPhotos)
		{
			$success=true;
			$error='';
			$response=$GalleryPhotos;
		}
		else
		{
			$success=false;
			$error='No data found';
			$response=$GalleryPhotos;
		}
		$this->set(compact('success', 'error', 'response'));
		$this->set('_serialize', ['success', 'error', 'response']);
	}
	 
}

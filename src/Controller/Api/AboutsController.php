<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Abouts Controller
 *
 * @property \App\Model\Table\AboutsTable $Abouts
 */
class AboutsController extends AppController
{
    public function view()
    {
        $Abouts = $this->Abouts->find()->count();
		if($Abouts>0)
		{
			$Abouts = $this->Abouts->find()->first();
			$success=true;
			$error='';
			
		}
		else
		{
			$success=false;
			$error="No data found";
			$Abouts='';;
		}
		$this->set(compact('success', 'error', 'Abouts'));
        $this->set('_serialize', ['success', 'error', 'Abouts']);
    }
}

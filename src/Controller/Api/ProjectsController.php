<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    public function view()
    {
        $Projects = $this->Projects->find()->count();
		if($Projects>0)
		{
			$Projects = $this->Projects->find()->first();
			$success=true;
			$error='';
			
		}
		else
		{
			$success=false;
			$error="No data found";
			$Projects='';;
		}
		$this->set(compact('success', 'error', 'Projects'));
        $this->set('_serialize', ['success', 'error', 'Projects']);
    }
}

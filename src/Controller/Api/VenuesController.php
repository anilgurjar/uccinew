<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event; 

/**
 * Venues Controller
 *
 * @property \App\Model\Table\VenuesTable $Venues
 */
class VenuesController extends AppController
{
	public function initialize()
	{
		parent::initialize();
	}
     
    public function index()
    {
        $venues = $this->Venues->find()->where(['flag'=> 0])->count();
		if ($venues) {
			$venues = $this->Venues->find()->where(['flag'=> 0]);
                $success=true;
				$error='';
             } 
			else { 
					$success=false;
					$error="No data found.";
					$venues="";
            }
        $this->set(compact('success','error','venues'));
        $this->set('_serialize', ['success','error','venues']);
    }
}

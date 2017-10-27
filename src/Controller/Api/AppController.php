<?php
namespace App\Controller\Api;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;


class AppController extends Controller
{
    public function initialize()
    {
		Time::setJsonEncodeFormat('dd-MM-yyyy HH:mm:ss');
		FrozenTime::setJsonEncodeFormat('hh:mm a');
		Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');
		FrozenDate::setJsonEncodeFormat('dd-MM-yyyy');

		
		$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]);
		$coreVariable = [
            'SiteUrl' => 'http://app.ucciudaipur.in/webroot/',
         ];
		$this->coreVariable = $coreVariable;
		$this->set(compact('coreVariable'));
	}
	
	
    public function beforeFilter(Event $event)
    {
         if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
   function isAuthorized() 
   {

    return true;

	}
   
}

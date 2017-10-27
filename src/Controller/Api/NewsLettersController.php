<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
/**
 * NewsLetters Controller
 *
 * @property \App\Model\Table\NewsLettersTable $NewsLetters
 */
class NewsLettersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
 	}

    public function newsletterlist()
	{
		$NewsLetters=$this->NewsLetters->find()->count();
		if($NewsLetters>0)
		{
 			$NewsLetters=$this->NewsLetters->find()
				->order(['created_on'=>'DESC']);
			$success=true;
			$error='';
			$response=$NewsLetters;
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
	public function NewsSearch()
	{
		$search_data=$this->request->query['search_data'];
		$NewsLetters=$this->NewsLetters->find()->where(['title LIKE '=>'%'.$search_data.'%'])->count();
		if($NewsLetters)
		{
			$NewsLetters=$this->NewsLetters->find()->where(['title LIKE '=>'%'.$search_data.'%']);
 			$NewsLetters->select(['cover_image_fullpath' => $NewsLetters->func()->concat([$this->coreVariable['SiteUrl'],'cover_image' => 'identifier' ]),'attachment_fullpath' => $NewsLetters->func()->concat([$this->coreVariable['SiteUrl'],'pdf_attachment' => 'identifier' ])])
			->order(['id'=>'DESC'])
			->autofields(true);
			
			$success=true;
			$error='';
			$response=$NewsLetters;
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

<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class BlogLikesController extends AppController
{

	public function initialize()
	{
		parent::initialize();
	}
	
	public function LikeAction()
	{
		$blog_id=$this->request->data['blog_id'];
		$user_id=$this->request->data['user_id'];
		$BlogLikes = $this->BlogLikes->newEntity();
		$IfBlogLikes=$this->BlogLikes->find()->where(['user_id'=>$user_id,'blog_id'=>$blog_id])->first();
		if($IfBlogLikes)
		{
			$BlogLikesID=$this->BlogLikes->get($IfBlogLikes->id);
			$this->BlogLikes->delete($BlogLikesID);
			$success=true;
			$error="";
			$response="successfully disliked";
		}
		else
		{
			$data=$this->BlogLikes->patchEntity($BlogLikes,$this->request->data());
            if ($this->BlogLikes->save($data)) {
				$success=true;
				$error="";
				$response="successfully liked";
			}
			else
			{
				$success=false;
				$error="No data found";
				$response="";
			}
		}
		$this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
	}
}

<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Blogs Controller
 *
 * @property \App\Model\Table\BlogsTable $Blogs
 */
class BlogsController extends AppController
{
 	public function initialize()
	{
		parent::initialize();
	}
	
	public function BlogList()
	{
		$Blogs=$this->Blogs->find()->where(['status' => 'published'])->count();
		$user_id=$this->request->query('user_id');
		if($Blogs > 0)
		{
			$blogs=$this->Blogs->find()
				->where(['status' => 'published'])
				->order(['published_on' => 'DESC','id'=>'DESC'])
				->contain([
					'Likers' => function($q){ 
						$q->select([
							 'Likers.blog_id',
							 'total_likers' => $q->func()->count('Likers.blog_id')							 
						])
						->group(['Likers.blog_id']);
						return $q;
					},
					'BlogLikes' => function($q) use($user_id){
						$q->select([
							 'BlogLikes.blog_id',
							 'self_user_count' => $q->func()->count('BlogLikes.blog_id')
						])
						->where(['user_id'=>$user_id])
						->group(['BlogLikes.blog_id']);
						return $q;
					}])
				->autoFields(true);	
			$success=true;
			$error="";
			foreach($blogs as $blog){  
				// check total Likes 
				if(@$blog->likers[0]->total_likers>0){
					$blog->total_likes=@$blog->likers[0]->total_likers;
				}else{
					$blog->total_likes=0;
				}
				// self user like or not 
				if(@$blog->blog_likes[0]->self_user_count==1){
					$blog->is_this_user_liked=false;
				}else{
					$blog->is_this_user_liked=true;
				}
				unset($blog->blog_likes);
				unset($blog->likers);
			}
 		}
		else
		{
			$success=false;
			$error="No data found";
			$blogs='';
 		}
		$this->set(compact('success','error','blogs'));
        $this->set('_serialize', ['success','error','blogs']);
	}
	
	public function blogDetails()
	{
		$blog_id=$this->request->query('blog_id');
		$countblog=$this->Blogs->find()->where(['status'=>'published' , 'id' => $blog_id])->count();
		if($countblog>0)
		{
			$blogdetail=$this->Blogs->find();
			$blogdetail->select(['cover_image_fullpath' => $blogdetail->func()->concat([$this->coreVariable['SiteUrl'],'cover_image' => 'identifier' ])])
				->where(['status' => 'published' , 'id' => $blog_id])
				->order(['published_on' => 'DESC'])
				->autoFields(true);	
			$success=true;
			$error="";
 		}
		else
		{
			$success=false;
			$error="No data found";
			$blogdetail='';
 		}
		$this->set(compact('success','error','blogdetail'));
        $this->set('_serialize', ['success','error','blogdetail']);
	}
	
	public function BlogSearch()
	{
		$search_data=$this->request->query['search_data'];
		$Blogs=$this->Blogs->find()->where(['status' => 'published','title LIKE '=>'%'.$search_data.'%'])->count();
		$user_id=$this->request->query('user_id');
		if($Blogs > 0)
		{
			$blogs=$this->Blogs->find();
			$blogs->select(['cover_image_fullpath' => $blogs->func()->concat([$this->coreVariable['SiteUrl'],'cover_image' => 'identifier' ])])
				->where(['status' => 'published','title LIKE '=>'%'.$search_data.'%'])
				->order(['published_on' => 'DESC'])
				->contain([
					'Likers' => function($q){
						$q->select([
							 'Likers.blog_id',
							 'total_likers' => $q->func()->count('Likers.blog_id')							 
						])
						->group(['Likers.blog_id']);
						return $q;
					},
					'BlogLikes' => function($q) use($user_id){
						$q->select([
							 'BlogLikes.blog_id',
							 'self_user_count' => $q->func()->count('BlogLikes.blog_id')
						])
						->where(['user_id'=>$user_id])
						->group(['BlogLikes.blog_id']);
						return $q;
					}])
				->autoFields(true);	
			$success=true;
			$error="";
			foreach($blogs as $blog){  
				// check total Likes 
				if(@$blog->likers[0]->total_likers>0){
					$blog->total_likes=@$blog->likers[0]->total_likers;
				}else{
					$blog->total_likes=0;
				}
				// self user like or not 
				if(@$blog->blog_likes[0]->self_user_count==1){
					$blog->is_this_user_liked=true;
				}else{
					$blog->is_this_user_liked=false;
				}
				unset($blog->blog_likes);
				unset($blog->likers);
			} 
 		}
		else
		{
			$success=false;
			$error="No data found";
			$blogs='';
 		}
		$this->set(compact('success','error','blogs'));
        $this->set('_serialize', ['success','error','blogs']);
	}
	
}

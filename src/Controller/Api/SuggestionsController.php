<?php
namespace App\Controller\Api;
use App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

 
class SuggestionsController extends AppController
{
    public function initialize()
	{
		parent::initialize();
	}
	
    public function add()
    {
        $suggestion = $this->Suggestions->newEntity();
        if ($this->request->is('post')) {
			if(!empty($this->request->data['attachments']))
			{
				$attachments=$this->request->data['attachments'];
				if(!empty($attachments['tmp_name']))
					{  
						$ext = substr(strtolower(strrchr($attachments['name'], '.')), 1); //get the extension
						$arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
						if (in_array($ext, $arr_ext)) {
							$setNewFileName = uniqid().'.'.$ext;
							$target=WWW_ROOT . 'images/suggestions/';
							$insert_path='images/suggestions/'.$setNewFileName;
							$exist = is_dir($target);
							if(!$exist)
							{
								$dir = new folder(WWW_ROOT . 'images/suggestions/', true, 0755);
							}
							move_uploaded_file($attachments['tmp_name'], WWW_ROOT . '/images/suggestions/'.$setNewFileName);
							$this->request->data['attachment']=$insert_path;
						}
						
					}
			}
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($sugg_data=$this->Suggestions->save($suggestion)) {
				$insert_id=$sugg_data->id;
				
                $success=true;
				$error='';
				$response="successfully submitted";
            } 
			else { 
					$success=false;
					$error="Something went wrong.";
					$response="";
            }
        }
        $this->set(compact('success','error','response'));
        $this->set('_serialize', ['success','error','response']);
    }
}

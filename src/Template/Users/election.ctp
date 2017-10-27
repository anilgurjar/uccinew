<?php
use Cake\Mailer\Email;

if(!empty($master_member))
{
	foreach($master_member as $member_data)
	{				
		$email_to=$member_data->email;
		$user_id=$member_data->id;
		$email = new Email();
		$email->transport('SendGrid');

		$subject="Solicit your vote and support UCCI Election-2017";
		$from_name="Hansraj Choudhary";
		$email_to=trim($email_to,' ');
		//$email_to="ashishbohara1008@gmail.com";
		$root=WWW_ROOT .'/img/HansrajChoudhary.jpeg';
		try {
			$email->from(['hansraj.choudhary@me.com' => $from_name])
					->to($email_to)
					->replyTo('hansraj.choudhary@me.com')
					->subject($subject)
					->profile('default')
					->template('election')
					->emailFormat('html')
					->attachments([
					'photo.png' => [
						'file' => $root,
						'mimetype' => 'image/jpeg',
						'contentId' => 'my-unique-id'
					]
				])
				->send();
			$this->requestAction(['controller'=>'Users', 'action'=>'ElectionMail'],['pass'=>array($user_id,2)]);

		} catch (Exception $e) {

			echo 'Exception : ',  $e->getMessage(), "\n";
			$this->requestAction(['controller'=>'Users', 'action'=>'ElectionMail'],['pass'=>array($user_id,0)]);
		}

		/*}
		else
		{
		$this->requestAction(['controller'=>'Users', 'action'=>'UpdateIdCardMail'],['pass'=>array($user_id,$file_name,0)]);
		}*/
	}
}

?>
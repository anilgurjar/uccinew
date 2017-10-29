<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;

if(!empty($master_member))
{
	foreach($master_member as $member_data)
	{
		$user_id=$member_data->id;
		for($file_name=1; $file_name<=2; $file_name++)
		{
			if($file_name==1)
			{
				$member_name=$member_data->member_name;
				$email_to=$member_data->email;
				$id_card_email=$member_data->id_card_email;
			}
			else if($file_name==2)
			{
				$member_name=$member_data->alternate_nominee;
				$email_to=$member_data->alternate_email;
				$id_card_email=$member_data->id_card_alternate_email;
			}
			if($id_card_email==1)
			{
				
					$options = new Options();
					$options->set('defaultFont', 'MoolBoran');
					$dompdf = new Dompdf($options);
					
					$html='<html>
					<head>
					 <style>
					  @page { margin: 40px 20px 20px 20px; }
						
						@font-face {
							font-family: MoolBoran;
							src: url("/assets/moolbor_0.ttf") format("truetype");
						}
						p{
							margin:0;font-family: MoolBoran;
						}
						</style>
					</head>
					<body>';
					if (file_exists(WWW_ROOT . 'images/member_user/'.$member_data->id_card_no.'/'.$file_name.'.jpg'))
					{
						$html_img='<img src="'.ROOT . DS  . 'webroot' . DS  .'/images/member_user/'.$member_data->id_card_no.'/'.$file_name.'.jpg" width="90px" height="100px" />';
					}
					else
					{
						$html_img='<img src="'.ROOT . DS  . 'webroot' . DS  .'/img/tab2.png" width="90px" height="100px" />';
					}
					$html.='<div  style="width:330px; height:530px;position:relative;">';
					$html.='<img src="'.ROOT . DS  . 'webroot' . DS  .'/images/id_card/id_card.png" width="330px" height="530px" style="position:fixed;"/>';
					$html.='<p style="position:absolute; top: 25px;color: #FFF;text-align: center;width: 330px;">Member ID No.'.$member_data->id_card_no.'</p>';
					$html.='<p style="position:absolute; top: 59px;color: #FFF;text-align: center;width: 330px;">'.$html_img.'</p>';
					$html.='<p style="position:absolute; top: 160px;color: #B31F23;text-align: center;width: 330px;">'.$member_name.'</p>';
					$html.='<p style="position:absolute; top: 180px;color: #000;text-align: center;width: 330px;">'.$member_data->company_organisation.'</p>';
					$html.='<p style="position:absolute; top: 200px;color: #000;text-align: center;width: 250px;margin-left: 40px;">'.$member_data->address.'<br/>'.$member_data->city.' - '.$member_data->pincode.' (India)</p>';
					if(strlen($member_data->address)<36)
					{
						$top='275px';
					}
					else if(strlen($member_data->address)<60)
					{
						$top='286px';
					}
					else if(strlen($member_data->address)<90)
					{
						$top='296px';
					}
					else
					{
						$top='310px';
					}
					
					$html.='<p style="position:absolute; top: '.$top.';text-align: center;width: 330px;color: #0066B3;""><img src="'.ROOT . DS  . 'webroot' . DS  .'/images/project_logo/UCCI LOGO.png" width="85px" height="85px" /><br/><p>';
					
					$html.='<p style="position:absolute; top: 394px;text-align: center;width: 330px;color: #0066B3;">Udaipur Chamber of Commerce & Industry<p>';
					
					$html.='<p style="position:absolute; top: 415px;text-align: center;width: 330px;color: #000;">Chamber Bhawan, Chamber Marg<br/>Mewar Industrial Area, Udaipur-313003<br/>Ph. : 2491060, 2492215<br/>E-mail : info@ucciudaipur.com<br/>Website : www.ucciudaipur.com<p>';
					
					$html.='</div>';
					$html.='</body></html>';
					
					/*
					$dompdf->loadHtml($html);
					$dompdf->setPaper('A4', 'portrait');
					$dompdf->render();
					$dompdf->stream($name,array('Attachment'=>0));
					exit(0);
						*/
					$dompdf->loadHtml($html);
					$dompdf->render();
					$output = $dompdf->output();
					file_put_contents('IDCARD.pdf', $output);	

					$email = new Email();
					$email->transport('SendGrid');

					$subject="ID Card";
					$from_name="UCCI";
					$email_to=trim($email_to,' ');
					//$email_to="ashishbohara1008@gmail.com";

					try {
						$email->from(['ucciudaipur@gmail.com' => $from_name])
								->to($email_to)
								->replyTo('ucciudaipur@gmail.com')
								->subject($subject)
								->profile('default')
								->template('id_card')
								->emailFormat('html')
								->viewVars(['member_name'=>$member_name])
								->attachments([
								'ID Card.pdf' => [
									'file' => 'IDCARD.pdf'
								]
							])
							->send();
						$this->requestAction(['controller'=>'Users', 'action'=>'UpdateIdCardMail'],['pass'=>array($user_id,$file_name,2)]);

					} catch (Exception $e) {

						echo 'Exception : ',  $e->getMessage(), "\n";
						$this->requestAction(['controller'=>'Users', 'action'=>'UpdateIdCardMail'],['pass'=>array($user_id,$file_name,0)]);
					}

				/*}
				else
				{
					$this->requestAction(['controller'=>'Users', 'action'=>'UpdateIdCardMail'],['pass'=>array($user_id,$file_name,0)]);
				}*/
			}
		}
	}
}
?>
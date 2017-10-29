<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;

if(!empty($master_member))
{
	foreach($master_member as $member_data)
	{ 
		$user_id=$member_data->id;
		$member_nominee_type=$member_data->member_nominee_type;
			/* if($member_nominee_type=='first'){
				$file_name='1';
			}else{
				$file_name='2';
			} */
			 $member_data->company->id_card_no; 
				$member_name=$member_data->member_name;
				$email_to=$member_data->email;
				$id_card_email=$member_data->id_card_email;
		
				
					$options = new Options();
					//$options->set('defaultFont', 'MoolBoran');
					$options->set('defaultFont', 'Lato-Hairline');
					$dompdf = new Dompdf($options);
					
					$html='<html>
					<head>
					 <style>
					  @page { margin: 0px 20px 20px 0px; }

						@font-face {
						font-family: Lato;
						src: url("https://fonts.googleapis.com/css?family=Lato");
						}
						p{
							margin:0;font-family: Lato;
						}
						</style>
					</head>
					<body>';
					if (file_exists(WWW_ROOT . 'images/member_user/user_profile_'.$user_id.'.jpg'))
					{
						$html_img='<img src="" width="90px" height="100px" />';
					}
					else
					{
						$html_img='<img src="" width="90px" height="100px" />';
					}
					
					$html.='<div  style="width:330px; height:530px;position:relative;">';
					$html.='<img src="'.ROOT . DS  . 'webroot' . DS  .'/images/id_card/id_card.png" width="330px" height="530px" style="position:fixed;"/>';
					$html.='<p style="position:absolute; top: 25px;color: #FFF;text-align: center;width: 330px;"><strong>Member ID '.$member_data->company->id_card_no.' </strong></p>';
					$html.='<p style="position:absolute; top: 59px;color: #FFF;text-align: center;width: 330px;">'.$html_img.'</p>';
					$html.='<p style="position:absolute; top: 160px;color: #B31F23 !important;text-align: center;width: 330px;font-family:moolboran;font-size:18px"><strong>'.$member_name.'</strong></p>';
					$html.='<p style="position:absolute; top: 180px;color: #373435;text-align: center;width: 330px;font-size:13px;">'.$member_data->company->company_organisation.'</p>';
					$html.='<p style="position:absolute; top: 200px;color: #373435;text-align: center;width: 250px;margin-left: 40px;font-size:13px;">'.$member_data->company->address.'<br/>'.$member_data->company->city.' - '.$member_data->company->pincode.' (India)</p>';
					if(strlen($member_data->company->address)<36)
					{
						$top='275px';
					}
					else if(strlen($member_data->company->address)<60)
					{
						$top='286px';
					}
					else if(strlen($member_data->company->address)<90)
					{
						$top='296px';
					}
					else
					{
						$top='310px';
					}
					$html.='<p style="position:absolute; top: 296px;text-align: center;width: 330px;color: #0066B3;""><img src="'.ROOT . DS  . 'webroot' . DS  .'/images/project_logo/UCCI1.png" width="85px" height="85px" /><br/><p>';
					
					$html.='<p style="position:absolute; top: 394px;text-align: center;width: 330px;color: #006CB5;"><strong>Udaipur Chamber of Commerce & Industry </strong><p>';
					
					$html.='<p style="position:absolute; top: 415px;text-align: center;width: 330px;color: #373435;font-size:13px;">Chamber Bhawan, Chamber Marg<br/>Mewar Industrial Area, Udaipur-313003<br/>Ph. : 2491060, 2492215<br/>E-mail : info@ucciudaipur.com<br/>Website : www.ucciudaipur.com<p>';
					
					$html.='</div>';
					$html.='</body></html>';
				
					$dompdf->loadHtml($html);
					$dompdf->setPaper('A4', 'portrait');
					$dompdf->render();
					$dompdf->stream($name,array('Attachment'=>0));
					exit(0);
					
			
		
	}
}
?>
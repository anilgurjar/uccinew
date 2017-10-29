<?php
require_once(ROOT . DS  .'vendor' . DS  . 'dompdf' . DS . 'autoload.inc.php');
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Mailer\Email;

if(!empty($master_member))
{
	foreach($master_member as $member_data)
	{
		$options = new Options();
		$options->set('defaultFont', 'Lato-Hairline');
		$dompdf = new Dompdf($options);

	$html='<html>
	<head>
	 <style>
	  @page { margin: 40px 40px 40px 40px; }

		
		@font-face {
			font-family: Lato;
			src: url("https://fonts.googleapis.com/css?family=Lato");
		}
		p{
			margin:0;font-family: Lato;line-height: 1;
		}
		table td{
			margin:0;font-family: Lato;padding:0;line-height: 1;
		}
		
		.table_rows, .table_rows th, .table_rows td {
		   border: 1pt thin solid  #000;border-collapse: collapse;padding:2px; 
		}

		.next { page-break-after: always; }
		
		.table_rows th{
			font-size:14px;
		}
		 .h3, h3 {
		font-size: 25px;
		font-weight: 700;
	}
	.h1, .h2, .h3, h1, h2, h3 {
		margin-top: 5px;
		margin-bottom: 1px;
	}
	header { position: fixed; top: -70px; left: -100px; right: 0px; }
    footer { position: fixed; bottom: 120px; left: -40px; right: 0px; }
		</style>
	</head>
	<body>
	 <header><img src="'.ROOT . DS  . 'webroot' . DS  .'img/gratitude/gratitude_top.jpg" width="880px" height="180px" /></header>
  <footer><img src="'.ROOT . DS  . 'webroot' . DS  .'img/gratitude/gratitude_bottom.jpg" width="800px" height="180px" /></footer>';
	
	
	$member_name=$member_data->user->member_name;
	$email_to=$member_data->user->email;
	$id=$member_data->id;
	$single_quote="'";
$html.='
		<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<center>
			
					<p style="width:100%; text-align:center; font-size:20px;">
						<strong>“THANKS & GRATITUDE”</strong>
					</p>
					</center>
			<table style="width: 100%;" class="next">
			<tr>
			<td>Dear '.$member_name.',<br/><br/><br/></td>
			</tr>
			<tr>
			<td>At the outset, I convey my thanks and heartfelt gratitude to you for giving me an opportunity to serve as President of the UCCI for the year 2017-18.  I am also thankful to Past Presidents for converting their Vision into the Mission of the Chamber for us to follow, and specially my illustrious predecessor, Shri V.P. Rathi who added new feathers in the UCCI cap.<br/><br/></td>
			</tr>
			<tr>
			<td>I, personally, and also on behalf of my entire team elected for the year 2017-18 would like to assure you, that we would do our best to enhance the image and banding of UCCI, and will endeavour to fulfill the objectives of Chamber in close association with experienced Past Presidents, Office bearers and members of UCCI.  We will exert to maintain representative role of UCCI in various government departments, particularly relating to trade & industry.<br/><br/></td>
			</tr>
			<tr>
			<td>Herewith, I take the opportunity to submit a few agenda points to explain my vision, future plans and priorities for new Team :<br/><br/></td>
			</tr>
			<tr>
			<td>
			<ul style="type:circle">
			<li>Enhance UCCI’s leadership role by being proactive and providing quality services to its constituents. </li>
			<li>Act as a catalyst for rapid economic development and prosperity of the community in the region through promotion of trade, industry and services.</ll>
			<li>Strengthening linkages for technological advancement through effective industry - government partnership.</li>
			<li>Emphasize productivity, improve work ethos and encourage business ethics. </li>
			<li>Enhance the image of business by effectively projecting its credibility and commitment to the society,  at large. </li>
			<li>To provide most effective contribution to the causes of Small and Medium Scale industries as well Tiny Sector entrepreneurs both economically & socially.</li>
			<li>Augmentation of UCCI Secretariat and Upgradation of its organisational capabilities.</li>
			
			<li>Development of South Rajasthan as an investment destination to generate Entrepreneurship, Business, Trade and Employment opportunities.</li>
			<li>Technology upgradation in UCCI'.$single_quote.'s Administration, Communication & Website development to a dynamic model for augmenting services to UCCI members.</li>
			</ul>
			</td>
			</tr>
			</table>
			<table style="width: 100%;margin-top:130px;">
			<tr>
			<td>
			<ul style="type:circle">
			<li>Development of basic infrastructure for trade & industry and economic development, especially broad- gauge connectivity from Udaipur to Ahmedabad and speedy & time-bound establishment of newer industrial areas. </li>
			<li>Capitalise on the opportunities in the area of Skill Development and CSR.</li>
			<li>Creation of online Single Window app for addressing Members’ Grievances.</li>
			<li>To seek support and guidance from Corporate members for development of Udaipur region.</li>
			<li>To boost young & first generation entrepreneurs.</li>
			<li>To enhance the status and services of UCCI at National level like CII, PHDCCI etc.</li>
			</ul>
			</td>
			</tr>
			<tr>
			<td>With above submission, at the same time  I would welcome your feedback & suggestions, and humbly request you to kindly feel free to let me know any other agenda point which you would like us to be taken up during the year 2017-18.  I assure you personally and also from my entire team members, that we would sincerely consider them for inclusion in our agenda of the year, whatever & wherever possible. Kindly respond before 9th June, as the first meeting of New Executive Committee is scheduled on 10th June, 2017.<br/><br/></td>
			</tr>
			<tr>
			<td>Once again I personally and also on behalf of new Team would like to express our thanks and deep sense of gratitude to you, for your kind support and co-operation, and assure you to deliver unprecedented results & growth of UCCI during the year. <br/><br/></td>
			</tr>
			<tr>
			<td>With kindest regards,<br/><br/><br/></td>
			</tr>
			<tr>
			<td>Yours sincerely,</td>
			</tr>
			<tr>
			<td><p  style="width:95%;"><img src="'.ROOT . DS  . 'webroot' . DS  .'img/gratitude/signature.jpg" width="100px" height="50px" align="left" /><br/><br/><br/></p></td>
			</tr>
			<tr>
			<td>Hans Raj Choudhary</td>
			</tr>
			<tr>
			<td>President</td>
			</tr>
			</table>';
			/*
					$dompdf->loadHtml($html);
					$dompdf->setPaper('A4', 'portrait');
					$dompdf->render();
					$dompdf->stream('GratitudeLetters.pdf',array('Attachment'=>0));
					exit(0);
	*/
	
	
$dompdf->loadHtml($html);
$dompdf->render();
$output = $dompdf->output();
file_put_contents('GratitudeLetters.pdf', $output);	

$email = new Email();
$email->transport('SendGrid');

$subject="Thanks and Gratitude";
$from_name="UCCI";
$email_to=trim($email_to,' ');

//$email_to="ashishbohara1008@gmail.com";

try {
	$email->from(['uccisec@hotmail.com' => $from_name])
			->to($email_to)
			->replyTo('uccisec@hotmail.com')
			->subject($subject)
			->profile('default')
			 ->template('gratitude_letter')
			->emailFormat('html')
			 ->viewVars(['member_name'=>$member_name])
			->attachments([
			'Thanks and Gratitude.pdf' => [
				'file' => 'GratitudeLetters.pdf'
			]
		])
		->send();
	
	$this->requestAction(['controller'=>'GratitudeLetters', 'action'=>'UpdateGratitude'],['pass'=>array($id,2)]);
} catch (Exception $e) {

	echo 'Exception : ',  $e->getMessage(), "\n";
	$this->requestAction(['controller'=>'GratitudeLetters', 'action'=>'UpdateGratitude'],['pass'=>array($id,0)]);

}
}
}
?>
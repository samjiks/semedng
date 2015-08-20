<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_MessageMD extends Model_CModel 
{
	public function Send($data)
	{
		$data['username']='';
		$data['password']='';
		if($data['to']=="")
			return;
			
		if(strlen($data['to'])< 11)
			return;
		if(!isset($data['username']))
			throw new Exception('Operation denied! You have not configured the SMS username and password under the general settings');
			
		//$url="http://ileiwe.com.ng/sms/api.php?";
		$request = sprintf("username=%s&password=%s&recipient=%s&sender=%s&message=%s",
							urlencode($data['username']),
							urlencode($data['password']),
							urlencode($data['to']),
							urlencode($data['senderid']),
							urlencode($data['message']));
		$pages=ceil(strlen($data['message'])/160);		
		//$response=Remote::get($url, array(CURLOPT_POST => false,CURLOPT_POSTFIELDS => $request));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		$result = trim(curl_exec($ch));
		$responses=explode(" ",$result);
		$response=$responses[0];

		$consumed=$this->get_consuming_unit($data['to']);
		$page=$pages * $consumed;
		if($response==2905)
			throw new Exception('Incorrect SMS username or password');
		elseif($response==2906)
			throw new Exception('Insufficient Balance');
		elseif($response==2904)
			throw new Exception('The message was unable to send now. Please try again later');
		elseif($response=="OK")
		{
			Cookie::set('used',"Total no of credits used ".$responses[1]);
			//Cookie::set('failed',"Was unable to send to the following nos: ".$responses[2]);
		}
		$ownerset=Model::factory('ownersettmd')->Reduce_SMS_Balance($data['ownerid'],$page); 
	}
	public function get_consuming_unit($phoneno)
	{
		$unit=1.5;
		if(strlen($phoneno)>= 11 AND substr($phoneno,0,3)!="234")
			$network=substr($phoneno,0,6);
		else
			$network=substr($phoneno,0,4);
			
		//Zain Network
		if($network=="0802" OR $network=="0808" OR $network=="0812" OR $network=="0818")
			$unit=1.5;
		// MTN Network
		elseif($network=="0803" OR $network=="0806" OR $network=="0703" OR $network=="0706" OR $network=="0816")
			$unit=1.5;
		//OTHERS
		else
			$unit=1.5;
			
		return $unit;
		
	}
	
	public function SendEmail($post)
	{
		$to=$post['to'];
		if($to=="")
			return;
			
		$from=$post['from'];
		$subject=$post['subject'];
		$message=$post['message'];

		//$transport = Swift_SmtpTransport::newInstance('mail.nnngo.org', 25);
		$transport = Swift_MailTransport::newInstance();
		$transport->start();
		
		
		$mailer = Swift_Mailer::newInstance($transport);
		$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));
		
		$message = Swift_Message::newInstance("$subject")
		 ->setFrom(array("$from"=>"$from"))
		 ->setBody("$message",'text/html', 'iso-8859-2');
				   $message->setReturnPath($post['email']);
				   $message->setSender($from);
				   $message->setPriority(2);
				   $message->setReplyTo($post['email']);
				   
		$message->addTo(UTF8::trim($to));

		if (!$mailer->send($message, $failures))
			echo Kohana::debug($failures);
	}
}

?>

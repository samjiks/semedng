<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_User extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		if($request->action=="regcomplete" OR $request->action=="forgotpass" OR $request->action=="register")
			$this->authenticate=false;
		parent::__construct($request);
		$this->model=Model::factory('usermd');
	}


	public function action_online()
	{
		
		$volume=20;
		//----DOES THE USER WANT TO LIMIT VOLUME?----
		if(isset($_POST["volume"])) Cookie::set("volume",$_POST["volume"]);
		if(Cookie::get("volume"))$volume=Cookie::get("volume",$volume);
		$page_no=1;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=($page_no+$volume)-1;
		endif;
		$page_no-=1;
		$view=View::factory("online_user");
		$view->list=null;
		$view->paging=null;
		try
		{

			$view->list=$this->model->SelectOnlineUsers($page_no,$volume);
			$total=$this->model->CountOnline();

			$paging=Pagination::factory(array('base_url'=> "user/online/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		//-----DONT FORGET OUR PRESENTATION LAYER-------
		$this->template=$view;
		//-----WE ARE DONE. SISE. ALAWADA-------
	}
	
	public function action_index()
	{
		$volume=20;
		//----DOES THE USER WANT TO LIMIT VOLUME?----
		if(isset($_POST["volume"])) Cookie::set("volume",$_POST["volume"]);
		if(Cookie::get("volume"))$volume=Cookie::get("volume",$volume);
		$page_no=1;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=($page_no+$volume)-1;
		endif;
		$page_no-=1;
		$view=View::factory("userl");
		$view->list=null;
		$view->paging=null;
		$view->show_search=false;
		try
		{
			//----- USER WANT TO DELETE A PARTICULAR RECORD-------
			if(isset($_GET['id'])):
				 $id=Html::chars($_GET['id']);
				$this->model->delete($id);
				$this->request->redirect("user");
			//----- DELETION IS DONE AND REDIRECTED-------
			
			else:
			//----- NO OPERATION IS DONE HERE. DEFAULT OPERATION-------
			$view->list=$this->model->SelectByPaging($page_no,$volume);
			$total=$this->model->Count();
			//----- EVERYTHING IS DONE HERE. AYE SIKU SIBE------
			endif;
			//----- LETS GO PAGING. THANKS.-------
			$paging=Pagination::factory(array('base_url'=> "user/index/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			//----- ERROR DONE SHELE. SO DISPLAY ERROR-------
			echo $e->getMessage();
		}
		//-----DONT FORGET OUR PRESENTATION LAYER-------
		$this->template=$view;
		//-----WE ARE DONE. SISE. ALAWADA-------
	}
	public function action_register()
	{
		$view = View::factory('userm');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('firstname', 'not_empty')
				->filter('middlename', 'trim')
				->rule('lastname', 'not_empty')
				->rule('email', 'not_empty')
				->rule('phoneno', 'trim')
				->rule('password', 'not_empty');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['firstname']=Html::chars($_POST['firstname']);
				$post['middlename']=Html::chars($_POST['middlename']);
				$post['lastname']=Html::chars($_POST['lastname']);
				$post['email']=Html::chars($_POST['email']);
				$post['phoneno']=Html::chars($_POST['phoneno']);
				$post['password']=Html::chars($_POST['password']);
				$post['username']=$post['email'];
				
				$post['id']='';

			endif;
			//-------------END ACCEPTING POSTED DATA----------------------
			if(isset($_POST['submit']))
			{
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				//------------NO PRO! LETS GO THERE--------
				$user=$this->model->save($post,"admin");
				Cookie::set('msg','');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("user/register");
			}
		}
		catch(Exception $e)
		{
			//------------ERROR SELE. DISPLAY ERROR--------
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		$view->post=$post;
		//-------WHICH CAPTION SHOULD WE SHOW FOR OUR BUTTON. MULTILANGUAGE PLEASE--------
		if($where!='')
			$view->btName=$this->message['update'];
		else $view->btName=$this->message['submit'];
		//------------OUR PRESENTATION PLEASE!--------
		$this->template->content=$view;
	}
	
	public function action_changeinfo()
	{
		$view = View::factory('userchangeinfo');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('firstname', 'not_empty')
				->filter('middlename', 'trim')
				->rule('lastname', 'not_empty')
				->rule('phoneno', 'not_empty');

			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['firstname']=Html::chars($_POST['firstname']);
				$post['middlename']=Html::chars($_POST['middlename']);
				$post['lastname']=Html::chars($_POST['lastname']);
				$post['phoneno']=Html::chars($_POST['phoneno']);
				$post['id']='';

			endif;
			//-------------END ACCEPTING POSTED DATA----------------------

			if(!isset($_POST["submit"])){
					$post=$this->model->SelectById($this->user->id);
			}
			//------------ON THE CLICK ON SUBMIT BUTTON---------
			elseif(isset($_POST['submit']))
			{
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				//------------NO PRO! LETS GO THERE--------
				$post['id']=$this->user->id;
				$this->model->updateinfo($post);
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				//$this->request->redirect("user/changeinfo");
			}
		}
		catch(Exception $e)
		{
			//------------ERROR SELE. DISPLAY ERROR--------
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		$view->post=$post;
		//-------WHICH CAPTION SHOULD WE SHOW FOR OUR BUTTON. MULTILANGUAGE PLEASE--------
			$view->btName=$this->message['update'];
		//------------OUR PRESENTATION PLEASE!--------
		$this->template=$view;
	}
	
	public function action_changepass()
	{
		$view = View::factory('userchangepass');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('password', 'not_empty')
				->rule('oldpass', 'not_empty')
				->rule('cpass', 'not_empty');

			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				if($_POST["password"]=="")
					throw new Exception('Password cannot be blank');
				if($_POST["password"]!=$_POST["cpass"])
					throw new Exception('Password do not match');
				
				$post['password']=Html::chars($_POST['password']);
				$post['id']='';
				
				$oldpass=Auth::instance()->hash_password($_POST["cpass"]);
				if(!Auth::instance()->check_password($_POST['oldpass']))
					throw new Exception('The old password you entered is invalid');
			endif;
			//-------------END ACCEPTING POSTED DATA----------------------

			if(!isset($_POST["submit"])){
					$post=$this->model->SelectById($this->user->id);
			}
			//------------ON THE CLICK ON SUBMIT BUTTON---------
			elseif(isset($_POST['submit']))
			{
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				//------------NO PRO! LETS GO THERE--------
				$this->model->change_password($post['password'],$this->user->id);
				
				Cookie::set('msg',$this->message['sucess_msg']);
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("user/changepass");
			}
		}
		catch(Exception $e)
		{
			//------------ERROR SELE. DISPLAY ERROR--------
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		$view->post=$post;
		//-------WHICH CAPTION SHOULD WE SHOW FOR OUR BUTTON. MULTILANGUAGE PLEASE--------
			$view->btName=$this->message['change'];
		//------------OUR PRESENTATION PLEASE!--------
		$this->template->content=$view;
	}
	
	public function action_activate()
	{
		$this->template='';
		if(isset($_REQUEST["id"]) AND Auth::instance()->logged_in("admin")):
			$obj=ORM::factory("user",$_REQUEST["id"]);
			if($obj->loaded()):
				$status=$obj->status=="Pending"?"Active":"Pending";
				$obj->status=$status;
				$obj->save();
				echo $status=="Pending"?'Activate':"Deactivate";
			endif;
		endif;
	}
	
	public function action_changerole()
	{
		$this->template='';
		if(isset($_REQUEST["id"]) AND Auth::instance()->logged_in("admin")):
			Model::factory("usermd")->change_role($_REQUEST["from"],$_REQUEST["to"],$_REQUEST["id"]);
			echo ucfirst($_REQUEST["to"]);
		endif;
	}
	
	public function action_forgotpass()
	{
		$view = View::factory('fogotpass');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('email', 'not_empty');
			//------------END RULE-----------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['login'])):
				
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				$user=ORM::factory('user',array('email'=>$_POST["email"]));
				if(!$user->loaded())
					throw new Exception('The email address you entered does not exist in our system');
				$password=Text::random();
				$user->password=$password;
				$user->save();
				
				$subject="Password Reset from AfroThinkItRight.com ";
				$from="info@afrothinkitright.com";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
				$headers .= 'To: $user->firstname $user->lastname<$user->email>' . "\r\n";
				$headers .= 'From: $from <$from>' . "\r\n";
		
				$message="<pre>Provided below is your login information into switchteller.com. <br/>";
				$message.="Email: $user->email <br/>";
				$message.="Password: $password <br/>";
				$message.='Please ensure that you change your password when you login. <a href="http://www.switchteller.com">Click here to navigate to Switchteller website</a><br/>';
				
				$message.="</pre>";echo $message;
				//mail($user->email, $subject, $message, $headers);
		
				Cookie::set('msg','Operation sucessful. Your login details have been sent to your email address');
				//$this->request->redirect("user/forgotpass");	
			endif;

		}
		catch(Exception $e)
		{
			//------------ERROR SELE. DISPLAY ERROR--------
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		$view->post=$post;
		
		$view->btName=$this->message['submit'];
		$this->template = $view;
	}
}
?>

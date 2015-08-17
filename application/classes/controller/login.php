<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_Login extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		$this->authenticate=false;
		parent::__construct($request);
	}
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->request->redirect('login');
	}
	public function action_index()
	{
		$view=View::factory("login");
		$view->username="";
		$view->password="";

		try
		{
		  $redirect=$this->session->get('redirect',"index");
		  if($redirect=="/login")
			  $redirect="index";
			  
		  if(Auth::instance()->logged_in()):
			  $this->request->redirect($redirect);
		  else:
			  if(isset($_POST["login"])):
			  	
				  $user=Model::factory('usermd')->SelectByUsername($_POST['username']);
				  if($user['status']=="disabled")
				  	throw new Exception('');
					
				  $post=$_POST;
				  $username=$_POST['username'];
				  $password=$_POST['password'];
				  $rememberme=isset($_POST['rememberme'])?$_POST['rememberme']:false;
				  $logon=Auth::instance()->login($username,$password,$rememberme);
				  if(!$logon):
					  $view->username=$username;
					  $view->show=true;
				  else:
					  unset($_SESSION["redirect"]);
					  $this->request->redirect($redirect);
				  endif;
			  endif;
		  
		  endif;
		}
		catch(Exception $e)
		{
			$view->show=true;
		}
		$this->template=$view;
	}
}
?>

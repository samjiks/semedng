<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_Specialist extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
		$this->model=Model::factory('specialistmd');
		
	}
	public function action_del()
	{
		$this->template='';
		//----- USER WANT TO DELETE A PARTICULAR RECORD-------
		if(isset($_GET['id']) AND isset($_GET['what']) AND $_GET['what']=='del'):
			 $id=Html::chars($_GET['id']);
			$t=$this->model->SelectById($id);
			Model::factory('usermd')->delete($t['userid']);

			$this->model->delete($id);
		//----- DELETION IS DONE AND REDIRECTED-------
			return $this->message['deleted'];
		endif;
	}
	public function action_list()
	{
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("specialistl");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			//----- NO OPERATION IS DONE HERE. DEFAULT OPERATION-------
			$view->list=$this->model->SelectByPaging($page_no,$volume);
			$total=$this->model->Count();
			//----- EVERYTHING IS DONE HERE. AYE SIKU SIBE------
			//----- LETS GO PAGING. THANKS.-------
			$paging=Pagination::factory(array('base_url'=> "specialist/list/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			//----- ERROR DONE SHELE. SO DISPLAY ERROR-------
			echo $e->getMessage();
		}
		//-----DONT FORGET OUR PRESENTATION LAYER-------
		$this->template->content = $view;
		//-----WE ARE DONE. SISE. ALAWADA-------
	}
	public function action_index()
	{
		$view = View::factory('specialistm');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['firstname']=Html::chars($_POST['firstname']);
				$post['middlename']=Html::chars($_POST['middlename']);
				$post['lastname']=Html::chars($_POST['lastname']);
				$post['unit']=Html::chars($_POST['unit']);
				
				$post['names']=$post['firstname']." ".$post['middlename']." ".$post['lastname'];
				if(!isset($_REQUEST['id']))
				{
					if($_POST["password"]!=$_POST["copassword"])
						throw new Exception("Password does not match");
					
					$post['email']=Html::chars($_POST['email']);
					$post['username']=$post['email'];
					$post['password']=Html::chars($_POST['password']);
				}
				
			endif;
			//-------------END ACCEPTING POSTED DATA----------------------

			if(isset($_REQUEST['id']))
				$where=Html::chars($_REQUEST['id']);

			if(!isset($_POST["submit"])){
				if($where!='')
				{
					$post=$this->model->SelectById($where);
					if(!is_array($post))
						throw new Exception('Invalid data');
				}
			}
			//------------ON THE CLICK ON SUBMIT BUTTON---------
			elseif(isset($_POST['submit']))
			{
				if($where=='')
				{
					$user=Model::factory('usermd')->save($post,"consultant");
					$this->model->save($post,$user->id);
				}
				else 
				{ 
					$post['id']=$where;
					$owner=$this->model->SelectById($post['id']);
					$post['userid']=$owner['userid'];
					
					$this->model->update($post);
					
					if(isset($_POST["update_password"]))
					{
						Model::factory('usermd')->change_password($_POST["password"],$owner['userid']);
					}
				} 
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("specialist/index");
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
		$view->units=Model::factory('providermd')->SelectAll();
		$this->template->content = $view;
	}
}
?>

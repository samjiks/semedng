<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_Provider extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
		$this->model=Model::factory('providermd');
		
	}
	public function action_del()
	{
		$this->template='';
		//----- USER WANT TO DELETE A PARTICULAR RECORD-------
		if(isset($_GET['id']) AND isset($_GET['what']) AND $_GET['what']=='del'):
			 $id=Html::chars($_GET['id']);
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
		$view=View::factory("providerl");
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
			$paging=Pagination::factory(array('base_url'=> "provider/list/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
		$view = View::factory('providerm');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->filter('id', 'trim')
				->filter('name', 'trim');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['name']=Html::chars($_POST['name']);

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
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				//------------NO PRO! LETS GO THERE--------
				if($where=='')
					$this->model->save($post);
				else 
				{ 
					$post['id']=$where;
					$this->model->update($post);
				} 
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("provider/index");
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
		$this->template->content = $view;
	}
}
?>

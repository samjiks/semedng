<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_HMO extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		if($request->action=="register")
			$this->authenticate=false;
			
		parent::__construct($request);
		$this->model=Model::factory('hmomd');
		
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
	
	public function action_status()
	{
		$this->template='';
		//----- USER WANT TO DELETE A PARTICULAR RECORD-------
		if(isset($_GET['id']) AND isset($_GET['what'])):
			 $id=Html::chars($_GET['id']);
			$this->model->change_staus($id);
		//----- DELETION IS DONE AND REDIRECTED-------
			echo "Status successfully changed";
		endif;
	}
	
	public function action_payment()
	{
		$view=View::factory("payment_report_summary");

		$hmo=isset($_GET["h"])?$_GET["h"]:"";
		$from=isset($_GET["from"])?$_GET["from"]:"";
		$to=isset($_GET["to"])?$_GET["to"]:"";
		$view->list=Model::factory('patientdiagnosismd')->GetPaymentReport($hmo,$from,$to);
		$this->template = $view;
	}
	
	public function action_treatment_summary_report()
	{
		$view=View::factory("treatment_summary");

		$hmo=isset($_GET["h"])?$_GET["h"]:"";
		$from=isset($_GET["from"])?$_GET["from"]:"";
		$to=isset($_GET["to"])?$_GET["to"]:"";
		
		$view->list=Model::factory("treatmentcyclemd")->GetTreatmentStatus($hmo,$from,$to);
		$view->from=$from;
		$view->to=$to;
		$view->hmo=Model::factory('hmomd')->SelectById($hmo);
		$this->template = $view;
	}
	
	public function action_approvalformreport()
	{
		$view=View::factory("approval_form_report");

		$hmo=isset($_GET["h"])?$_GET["h"]:"";
		$from=isset($_GET["from"])?$_GET["from"]:"";
		$to=isset($_GET["to"])?$_GET["to"]:"";
		
		$view->list=Model::factory("treatmentcyclemd")->GetTreatmentStatus($hmo,$from,$to);
		$view->from=$from;
		$view->to=$to;
		$view->hmo=Model::factory('hmomd')->SelectById($hmo);
		$this->template = $view;
	}
	public function action_summaryreport()
	{
		$view=View::factory("summary_report");

		$hmo=isset($_GET["h"])?$_GET["h"]:"";
		$from=isset($_GET["from"])?$_GET["from"]:"";
		$to=isset($_GET["to"])?$_GET["to"]:"";
		
		$view->list=Model::factory("treatmentcyclemd")->GetTreatmentStatus($hmo,$from,$to);
		$view->from=$from;
		$view->to=$to;
		$view->hmo=Model::factory('hmomd')->SelectById($hmo);
		$this->template = $view;
	}
	
	public function action_costingreport()
	{
		$view=View::factory("costing_report");

		$hmo=isset($_GET["h"])?$_GET["h"]:"";
		$from=isset($_GET["from"])?$_GET["from"]:"";
		$to=isset($_GET["to"])?$_GET["to"]:"";
		
		$view->list=Model::factory("treatmentcyclemd")->GetTreatmentStatus($hmo,$from,$to);
		$view->from=$from;
		$view->to=$to;
		$view->hmo=Model::factory('hmomd')->SelectById($hmo);
		$this->template = $view;
	}

	public function action_pick_hmo()
	{
		$view=View::factory("pick_hmo");

		$view->hmos=$this->model->SelectAll();
		$this->template->content = $view;
	}
	
	public function action_approvalform()
	{
		$view=View::factory("pick_hmo");
		$view->url="approvalformreport";
		$view->hmos=$this->model->SelectAll();
		$this->template->content = $view;
	}
	
	public function action_cost()
	{
		$view=View::factory("pick_hmo");
		$view->url="costingreport";
		$view->hmos=$this->model->SelectAll();
		$this->template->content = $view;
	}
	
	public function action_summary()
	{
		$view=View::factory("pick_hmo");
		$view->url="summaryreport";
		$view->hmos=$this->model->SelectAll();
		$this->template->content = $view;
	}
	
	public function action_treatmentsummary()
	{
		$view=View::factory("pick_hmo_treatment_summary");
		$view->hmos=$this->model->SelectAll();
		$this->template->content = $view;
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
		$view=View::factory("hmol");
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
			$paging=Pagination::factory(array('base_url'=> "hmo/list/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
		if(!Auth::instance()->logged_in("admin") AND !Auth::instance()->logged_in("nhis"))
			$this->request->redirect("login");

		$view = View::factory('hmom');
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
				->rule('address', 'not_empty')
				->rule('name', 'not_empty');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				if(!isset($_REQUEST["id"]))
				{
					if($_POST["password"]!=$_POST["copassword"])
						throw new Exception("Password does not match");
				}
				$post['name']=Html::chars($_POST['name']);
				$post['address']=Html::chars($_POST['address']);
				$post['phoneno']=Html::chars($_POST['phoneno']);
				$post['mobile']=Html::chars($_POST['mobile']);
				
				$post['firstname']=Html::chars($_POST['firstname']);
				$post['middlename']=Html::chars($_POST['middlename']);
				$post['lastname']=Html::chars($_POST['lastname']);
				$post['email']=Html::chars($_POST['email']);
				$post['status']='active';
				
				if($_REQUEST["id"]=="")
					$post['password']=Html::chars($_POST['password']);
				$post['username']=$post['email'];

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
				{
					$user=Model::factory('usermd')->save($post,"hmo");
					$hom=$this->model->save($post,$user->id);				
				}
				else 
				{ 
					$post['id']=$where;
					$hmo=$this->model->SelectById($post['id']);
					$post['userid']=$hmo['userid'];
					
					$this->model->update($post);
					
					if(isset($_POST["update_password"]))
					{
						Model::factory('usermd')->change_password($_POST["password"],$hmo['userid']);
					}
				} 
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("hmo/index");
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
	
	public function action_register()
	{
		$view = View::factory('new_hmo');
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
				->rule('password', 'not_empty')
				->rule('address', 'not_empty')
				->rule('name', 'not_empty');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				if($_POST["password"]!=$_POST["copassword"])
					throw new Exception("Password does not match");

				$post['name']=Html::chars($_POST['name']);
				$post['address']=Html::chars($_POST['address']);
				$post['phoneno']=Html::chars($_POST['phoneno']);
				$post['mobile']=Html::chars($_POST['mobile']);
				
				$post['firstname']=Html::chars($_POST['firstname']);
				$post['middlename']=Html::chars($_POST['middlename']);
				$post['lastname']=Html::chars($_POST['lastname']);
				$post['email']=Html::chars($_POST['email']);
				$post['status']='disabled';
				$post['password']=Html::chars($_POST['password']);
				$post['username']=$post['email'];

			endif;
			
			if(isset($_POST['submit']))
			{
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				//------------NO PRO! LETS GO THERE--------
				if($where=='')
				{
					$user=Model::factory('usermd')->save($post,"hmo");
					$this->model->save($post,$user->id);
				}
				
				$post['from']='info@nhis.com';
				$post['to']=$post['email'];
				$post['message']='We like to confirm your account. Click here to';
				$post['subject']='HMO Account Registration';
				
				Model::factory('messagemd')->SendEmail($post);
				$this->request->redirect("hmo/register");
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
		$this->template = $view;
	}
}
?>

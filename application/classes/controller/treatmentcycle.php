<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_TreatmentCycle extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
		$this->model=Model::factory('treatmentcyclemd');
		
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
	
	public function action_end()
	{
		$this->template='';
		$pid=$this->request->param("id");
		$this->model->set_elapse($pid);
		$this->request->redirect("patient/details/$pid");
	}
	
	public function action_start()
	{
		$this->template='';
		$pid=$this->request->param("id");
		$formno=Model::factory('patientmd')->generate_id(8,false);
		$this->model->begin_new_cycle($pid,$this->user->id,$formno);
		$this->request->redirect("patient/sht/$pid");
	}

	
	public function action_del_treatment()
	{
		$this->template='';
		//----- USER WANT TO DELETE A PARTICULAR RECORD-------
		if(isset($_GET['id']) AND isset($_GET['what']) AND $_GET['what']=='del'):
			 $id=Html::chars($_GET['id']);
			$this->model->delete_treatment($id);
		//----- DELETION IS DONE AND REDIRECTED-------
			return $this->message['deleted'];
		endif;
	}	
	
	public function action_completed()
	{
		if(!Auth::instance()->logged_in("nhis") AND !Auth::instance()->logged_in("admin"))
			$this->request->redirect("index");
			
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_list_completed_cycle");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			$view->list=$this->model->GetCompletedCycle($page_no,$volume);
			$total=$this->model->CountCompletedCycle();

			$paging=Pagination::factory(array('base_url'=> "treatmentcycle/completed/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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

	public function action_search()
	{
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("treatmentcyclel");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			//----- NO OPERATION IS DONE HERE. DEFAULT OPERATION-------
			$from=isset($_GET["from"])?$_GET["from"]:"";
			$to=isset($_GET["to"])?$_GET["to"]:"";
			$hmo=isset($_GET["h"])?$_GET["h"]:"";
			$view->list=$this->model->SearchByDate($from,$to,$page_no,$volume,$hmo);
			$total=$this->model->CountByDate($from,$to,$hmo);
			//----- EVERYTHING IS DONE HERE. AYE SIKU SIBE------
			//----- LETS GO PAGING. THANKS.-------
			$paging=Pagination::factory(array('base_url'=> "treatmentcycle/search/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			//----- ERROR DONE SHELE. SO DISPLAY ERROR-------
			echo $e->getMessage();
		}
		//-----DONT FORGET OUR PRESENTATION LAYER-------
		$view->hmos=Model::factory('hmomd')->SelectAll();
		$this->template->content = $view;
		//-----WE ARE DONE. SISE. ALAWADA-------
	}
	
	public function action_index()
	{
		if(!Auth::instance()->logged_in("nhis") AND !Auth::instance()->logged_in("admin"))
			$this->request->redirect("index");

		$view=View::factory("patient_begin_treatment");
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("index");
			
		$treatmentcycle=$this->model->getCurrent($patientid);
		if(!is_array($treatmentcycle) OR $treatmentcycle['referringto']=="")
			$this->request->redirect("patient/sht/$patientid");
			
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('proposedstartdate', 'not_empty')
				->filter('proposedenddate', 'trim')
				->filter('approvalstatus', 'trim')
				->rule('refertodoctor', 'not_empty');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				
				$approval=Model::factory('patientmd')->GetApproval($patientid,$_POST["authorisationcode"]);
				if(!is_array($approval))
					throw new Exception('The authorisation code you entered cannot be found for that patient.');
				
				$post['id']=$treatmentcycle['id'];	
				$post['patientid']=$patientid;
				$post['proposedstartdate']=Html::chars($_POST['proposedstartdate']);
				$date = new DateTime($post['proposedstartdate']);
				$date->add(new DateInterval('P21D'));
				$post['proposedenddate']=$date->format('Y-m-d');
				$post['userid']=$this->user->id;
				$post['approvalstatus']='Approved';
				$post['refertodoctor']=Html::chars($_POST['refertodoctor']);

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
				$this->model->update_for_auth_code2($post);
				Cookie::set('msg',$post['proposedenddate']);
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("treatmentcycle/index/".$patient['id']);
			}
		}
		catch(Exception $e)
		{
			//------------ERROR SELE. DISPLAY ERROR--------
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		
		//-------WHICH CAPTION SHOULD WE SHOW FOR OUR BUTTON. MULTILANGUAGE PLEASE--------
		if($where!='')
			$view->btName=$this->message['update'];
		else $view->btName=$this->message['submit'];
		//------------OUR PRESENTATION PLEASE!--------
		$view->shp=Model::factory('specialistmd')->SelectByUnit($treatmentcycle['referringto']);
		
		if(is_array($treatmentcycle) AND $treatmentcycle['proposedenddate']==date("Y-m-j"))
			$this->model->set_elapse($patientid);
		
		$view->treatmentcycle=$treatmentcycle;
		if(is_array($treatmentcycle))
		{
			$approval=Model::factory('patientmd')->GetApprovalById($treatmentcycle['id']);
			if(!is_array($approval))
				$this->request->redirect("index");
				
			$post["authorisationcode"]=$approval['authorisationcode'];
			$post["refertodoctor"]=$treatmentcycle['refertodoctor'];
			$post['proposedstartdate']=$treatmentcycle['proposedstartdate'];
		}
		$view->patient=$patient;
		
		$view->post=$post;
		$this->template->content = $view;
	}
	
	public function action_treatment()
	{
		if(!Auth::instance()->logged_in("consultant") AND !Auth::instance()->logged_in("technician"))
			$this->request->redirect("index");

		$view = View::factory('treatmentm');
		$patient=Model::factory('patientmd')->GetPatient($this->request->param("id"));
		if(!is_array($patient))
			$this->request->redirect("index");
		
		$errors=array();
		$where='';
		$post=array();
		$treatmentcycle=$this->model->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);
		
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('treatment', 'not_empty')
				->rule('provider', 'not_empty')
				->filter('date', 'trim');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['treatment']=Html::chars($_POST['treatment']);
				$post['provider']=Html::chars($_POST['provider']);
				$post['consultant']=Html::chars($_POST['consultant']);
				$post['date']=Html::chars($_POST['date']);
				$post['userid']=$this->user->id;
				$post['patientid']=$patient['id'];
				$post['treatmentcycle']=$treatmentcycle['id'];
			endif;
			//-------------END ACCEPTING POSTED DATA----------------------

			if(isset($_REQUEST['id']))
				$where=Html::chars($_REQUEST['id']);

			if(!isset($_POST["submit"])){
				if($where!='')
				{
					$post=Model::factory('treatmentcyclemd')->GetTreatment($where);
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
					$this->model->save_treatment($post);
				else 
				{ 
					$post['id']=$where;
					$this->model->update_treatment($post);
				} 
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("treatmentcycle/treatment/".$patient['id']);
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
		
		$view->shp=Model::factory('providermd')->SelectAll();
		$view->technicians=Model::factory('technicianmd')->SelectAll();
		$view->list=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		$view->patient=$patient;
		$this->template->content = $view;
	}
}
?>

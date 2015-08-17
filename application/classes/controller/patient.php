<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_Patient extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
		$this->model=Model::factory('patientmd');
		
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
	
	public function action_appointed()
	{
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_appointed");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		$now=getdate();
		
		$m=isset($_GET["m"])?$_GET["m"]:"";
		$y=isset($_GET["y"])?$_GET["y"]:$now["year"];
		$d=isset($_GET["d"])?$_GET["d"]:"";
		$date=$this->request->param("id")==""?"":$this->request->param("id");
		$date=$y."-".$m."-".$d;
		$view->date=$date;
		try
		{
			$elapsed=1;
			$view->list=Model::factory('treatmentcyclemd')->SelectByPaging($elapsed,$date,$page_no,$volume);
			$total=Model::factory('treatmentcyclemd')->Count($elapsed,$date);
			//----- EVERYTHING IS DONE HERE. AYE SIKU SIBE------
			//----- LETS GO PAGING. THANKS.-------
			$paging=Pagination::factory(array('base_url'=> "patient/appointed/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
	
	public function action_details()
	{
		$view=View::factory("patient_details");
		if(isset($_GET["pid"]))
			$patientid=Html::chars($_GET["pid"]);
		else
			$patientid=$this->request->param("id");
		$patient=$this->model->GetPatient($patientid);
		$view->patient=$patient;
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(is_array($treatmentcycle) AND date("Y-m-j")>= $treatmentcycle['proposedenddate'] AND $treatmentcycle['elapsed']==0 AND $treatmentcycle['proposedenddate']!='' )
			Model::factory('treatmentcyclemd')->set_elapse($patient['id']);
		if(!Auth::instance()->logged_in("admin"))
		{
			if(Auth::instance()->logged_in("consultant"))
			{
				$c=Model::factory('specialistmd')->SelectByUser($this->user->id);
				if($treatmentcycle['refertodoctor']!=$c['id'])
					$this->request->redirect("index");
			}
			else
				$this->request->redirect("index");
		}
			
		$view->user=$this->user;
		$view->treatmentcycle=$treatmentcycle;
		$this->template->content = $view;
	}
	
	public function action_search()
	{
		$view=View::factory("search_patient");
		$this->template->content = $view;
	}

	public function action_sht()
	{
		$view=View::factory("patient_for_shc");
		$patientid=$this->request->param("id");
		$patient=$this->model->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("patient/search");
		
		$view->patient=$patient;
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		
		$formno=Model::factory('patientmd')->generate_id(8,false); 
		
		$errors=array();
		$post=array();
		try
		{
			if(isset($_POST['submit']))
			{
				$post['date']=date("Y/m/j");
				$post['patientid']=$patient['id'];
				$post['userid']=$this->user->id;
				$post['formno']=$_POST["formno"];

				if(!is_array($treatmentcycle))
					$id=$this->model->approve_for_sht($post);
				else $id=$treatmentcycle['id'];
								
				if(isset($_POST['referringfrom'])):
					$post['referringfrom']=Html::chars($_POST['referringfrom']);
					$post['referringto']=Html::chars($_POST['referringto']);
					$post['referringdoctor']=Html::chars($_POST['referringdoctor']);
					$post['clicnicinformation']=Html::chars($_POST['clicnicinformation']);
					$post['investigationform']=Html::chars($_POST['investigationform']);
					$post['indicationforsurgery']=Html::chars($_POST['indicationforsurgery']);
					$this->model->update_form($post,$id);
				endif;

				Cookie::set('msg','yes');
				$this->request->redirect("patient/sht/".$patientid);
			}
			elseif(isset($_POST['tc']))
			{
				$post['authorisationcode']=Html::chars($_POST['authorisationcode']);
				$code=$this->model->confirm_code($post['authorisationcode']);
				if(is_array($code))
					throw new Exception("The authorisation code has already been used for another patient");
				
					
				$cycleid=$treatmentcycle['id'];	
				$this->model->update_authorisation_code($post['authorisationcode'],$cycleid);
				
				
/*				$post['approvalid']=$approvalid;	
				$post['patientid']=$patientid;
				$post['proposedstartdate']=date("Y-m-d");
				$date = new DateTime($post['proposedstartdate']);
				$date->add(new DateInterval('P21D'));
				$post['proposedenddate']=$date->format('Y-m-d');
				$post['userid']=$this->user->id;
				$post['approvalstatus']='Approved';
				
				Model::factory('treatmentcyclemd')->update_for_auth_code2($post);
*/				
				Cookie::set('msg','yes');
				$this->request->redirect("patient/sht/".$patientid);
			}
			elseif(isset($_POST['as']))
			{
				$post['dateseen']=Html::chars($_POST['dateseen']);
				$post['serviceprovider']=Html::chars($_POST['serviceprovider']);
				$post['presumptivediagnosis']=Html::chars($_POST['presumptivediagnosis']);
				$post['actiontaken']=Html::chars($_POST['actiontaken']);
				$id=$treatmentcycle['id'];	
				$this->model->update_consultant_form($post,$id);
				
				Cookie::set('msg','yes');
				$this->request->redirect("patient/sht/".$patientid);
			}
			
		}
		catch(Exception $e)
		{
			$errors[]=$e->getMessage();
		}
		$view->errors=$errors;
		if(is_array($treatmentcycle) AND $treatmentcycle['referringto']!="")
		{
			$approval=Model::factory('patientmd')->GetApprovalById($treatmentcycle['id']);
			$treatmentcycle["authorisationcode"]=$approval['authorisationcode'];
			$post=$treatmentcycle;

			$formno=$treatmentcycle['formno'];
			if(!Auth::instance()->logged_in("consultant"))
				$view->disable_as=true;
			elseif(!Auth::instance()->logged_in("admin"))
				$view->disable_main=true;
			elseif(!Auth::instance()->logged_in("hmo") AND $approval['authorisationcode']!="")
				$view->disable_hmo=true;

		}
		else
			$post['authorisationcode']='';
			
		$view->treatmentcycle=$treatmentcycle;
		$view->post=$post;
		$view->formno=$formno;
		
		$view->consultants=Model::factory('specialistmd')->SelectAll();
		$view->units=Model::factory('providermd')->SelectAll();
		
		$view->btName=$this->message['submit'];
		$this->template->content = $view;
	}

	public function action_list()
	{
		if(!Auth::instance()->logged_in("hmo") AND !Auth::instance()->logged_in("hmouser"))
			$this->request->redirect("index");

		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patientl");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			$hmo=Model::factory('hmomd')->get_hmo_by_user($this->user->id);

			$view->list=$this->model->SelectByPaging($hmo['hmid'],$page_no,$volume);
			$total=$this->model->Count($hmo['hmid']);
			$paging=Pagination::factory(array('base_url'=> "patient/list/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		$this->template->content = $view;
	}
	
	public function action_status()
	{
		if(!Auth::instance()->logged_in("nhis") AND !Auth::instance()->logged_in("nhisuser") AND !Auth::instance()->logged_in("admin"))
			$this->request->redirect("index");
			
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_list");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			$status=$this->request->param("id");
			$view->list=$this->model->GetApprovedPatient($status,null,$page_no,$volume);
			$total=$this->model->CountApprovedPatient($status);

			$paging=Pagination::factory(array('base_url'=> "patient/status/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
			$view->paging=$paging;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		$this->template->content = $view;
	}
	
	public function action_referer()
	{
		if(!Auth::instance()->logged_in("nhis") AND !Auth::instance()->logged_in("nhisuser") AND !Auth::instance()->logged_in("admin"))
			$this->request->redirect("index");
			
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_list");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			$hmo=isset($_GET["hmo"])?$_GET["hmo"]:null;
			$view->list=$this->model->SelectByPaging($hmo,$page_no,$volume);
			$total=$this->model->Count($hmo);

			$paging=Pagination::factory(array('base_url'=> "patient/referer/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
	
	public function action_technician()
	{
		if(!Auth::instance()->logged_in("technician"))
			$this->request->redirect("index");
			
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_list");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			
			$consultant=Model::factory('technicianmd')->SelectByUser($this->user->id);
			$unit=is_array($consultant)?$consultant['unit']:"";
			
			$view->list=$this->model->Select4Technician($consultant['id'],$page_no,$volume);
			$total=$this->model->Count4Technician($consultant['id']);

			$paging=Pagination::factory(array('base_url'=> "patient/technician/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
	public function action_consultant()
	{
		if(!Auth::instance()->logged_in("consultant"))
			$this->request->redirect("index");
			
		$volume=50;
		$page_no=0;
		if(isset($_GET['page'])):
			$page_no=Html::chars($_GET['page']);
			$page_no=$page_no-1;
			$page_no=($page_no*$volume)+1;
		endif;
		$view=View::factory("patient_list");
		$view->list=null;
		$view->paging=null;
		$view->message=$this->message;
		try
		{
			
			$consultant=Model::factory('specialistmd')->SelectByUser($this->user->id);
			$unit=is_array($consultant)?$consultant['unit']:"";
			
			$view->list=$this->model->Select4Consultant($consultant['id'],$page_no,$volume);
			$total=$this->model->Count4Consultant($consultant['id']);

			$paging=Pagination::factory(array('base_url'=> "patient/consultant/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
		if(!Auth::instance()->logged_in("hmo") AND !Auth::instance()->logged_in("hmouser"))
			$this->request->redirect("login");
			
		$view = View::factory('patientm');
		$errors=array();
		$where='';
		$post=array();
		try
		{
			//--------------------------------------
			//-------CREATE VALIDATION RULE IF ANY--------
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->filter('hospitalno', 'trim')
				->rule('surname', 'not_empty')
				->filter('othernames', 'trim')
				->filter('hmono', 'trim')
				->rule('gender', 'not_empty')
				->filter('phoneno', 'trim')
				->filter('email', 'trim')
				->filter('address', 'trim')
				->filter('nhisno', 'trim');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['hospitalno']=Html::chars($_POST['hospitalno']);
				$post['qrcode']='';
				$post['surname']=Html::chars($_POST['surname']);
				$post['othernames']=Html::chars($_POST['othernames']);
				$post['hmono']=Html::chars($_POST['hmono']);
				$post['gender']=Html::chars($_POST['gender']);
				$post['phoneno']=Html::chars($_POST['phoneno']);
				$post['email']=Html::chars($_POST['email']);
				$post['address']=Html::chars($_POST['address']);
				$post['nhisno']=Html::chars($_POST['nhisno']);
				$post['dob']=Html::chars($_POST['dob']);
				$hmo=Model::factory('hmomd')->get_hmo_by_user($this->user->id);
				$post['hmoid']=$hmo['hmid'];
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
				$this->request->redirect("patient/index");
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
		$view->gender=array("Male","Female");
		$this->template->content = $view;
	}
	
	public function action_last_form()
	{
		$view=View::factory("patient_last_form");
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("patient/search");
		
		$view->patient=$patient;
		
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);

/*		if($treatmentcycle['refertodoctor']!=$this->user->id)
			$this->request->redirect("index");
*/
		$treatments=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		
		$errors=array();
		$post=array();
		try
		{
			
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim')
				->rule('investigationform', 'not_empty')
				->rule('drugform', 'not_empty');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['drugform']=Html::chars($_POST['drugform']);
				$post['investigationform']=Html::chars($_POST['investigationform']);
				$post['id']=$treatmentcycle['id'];
			endif;

			if(isset($_POST['submit']))
			{
				//------------CHECK FOR ANY VALIDATION RULE AND VALIDATE--------
				if(!$val->check())
				{
					$errors=$val->errors('event');
					throw new Exception('');
				}
				Model::factory('treatmentcyclemd')->update($post);
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("patient/last_form/".$patientid);
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
		$view->btName=$this->message['submit'];
		//------------OUR PRESENTATION PLEASE!--------
		
		$attachments=Model::factory('patientdiagnosismd')->SelectByTreatmentCycle($treatmentcycle['id']);
		$view->attachments=$attachments; 
		
		$view->treatments=$treatments;
		$view->treatmentcycle=$treatmentcycle;
		$this->template->content = $view;
	}
	
	public function action_others()
	{
		$view=View::factory("patient_others");
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("patient/search");
		
		$view->patient=$patient;
		
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);
			
/*		if($treatmentcycle['refertodoctor']!=$this->user->id)
			$this->request->redirect("index");
*/
		$treatments=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		
		$errors=array();
		$post=array();
		try
		{
			
			$val = Validate::factory($_POST)
				->filter(TRUE, 'trim');
			//------------END RULE------------------
			//--------------------------------------
			//------CREATE AN ARRAY OF POSTED DATA NEEDED-----
			if(isset($_POST['submit'])):
				$post['nextappointment']=Html::chars($_POST['nextappointment']);
				$post['clicnicinformation']=Html::chars($_POST['clicnicinformation']);
				$post['complications']=Html::chars($_POST['complications']);
				$post['surgicaloperations']=Html::chars($_POST['surgicaloperations']);
				$post['indicationforsurgery2']=Html::chars($_POST['indicationforsurgery2']);
				$post['conditionondischarge']=Html::chars($_POST['conditionondischarge']);
				$post['id']=$treatmentcycle['id'];
			endif;

			if(isset($_POST['submit']))
			{
				Model::factory('treatmentcyclemd')->update_others($post);
				Cookie::set('msg','yes');
				//------------REGISTRATION SUCESSFUL. WHAT NEXT--------
				$this->request->redirect("patient/others/".$patientid);
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
		$view->btName=$this->message['submit'];
		//------------OUR PRESENTATION PLEASE!--------
		$view->treatments=$treatments;
		$view->treatmentcycle=$treatmentcycle;
		$this->template->content = $view;
	}
	
	public function action_discharge_summary()
	{
		$view=View::factory("patient_discharge_summary");
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("patient/search");
		
		$view->patient=$patient;
		
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);

		$treatments=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		$attachments=Model::factory('patientdiagnosismd')->SelectByTreatmentCycle($treatmentcycle['id']);

		$view->doctor=Model::factory('specialistmd')->SelectById($treatmentcycle['refertodoctor']);
		$view->treatments=$treatments;
		$view->treatmentcycle=$treatmentcycle;
		$view->attachments=$attachments; 
		$this->template = $view;
	}
	
	public function action_approval_form()
	{
		$view=View::factory("approval_form");
		
		$patientid=$_GET["pid"];
		$patient=$this->model->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("patient/search");
		
		$view->patient=$patient;
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		$post=array();
		
		if(is_array($treatmentcycle))
		{
			$approval=Model::factory('patientmd')->GetApprovalById($treatmentcycle['id']);
			$treatmentcycle["authorisationcode"]=$approval['authorisationcode'];
			$post=$treatmentcycle;

			$formno=$treatmentcycle['formno'];
			if(!Auth::instance()->logged_in("consultant"))
				$view->disable_as=true;
		}
		else
			$post['authorisationcode']='';
			
		$view->treatmentcycle=$treatmentcycle;
		$view->post=$post;				
		$this->template = $view;
	}
}
?>

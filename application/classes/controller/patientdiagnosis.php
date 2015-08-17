<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_PatientDiagnosis extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
		$this->model=Model::factory('patientdiagnosismd');
		
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
		$view=View::factory("patientdiagnosisl");
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
			$paging=Pagination::factory(array('base_url'=> "patientdiagnosis/list/",'uri_segment' => 'page','total_items'=> $total, 'items_per_page' => $volume, 'style'=> 'digg'));
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
		if(!Auth::instance()->logged_in("consultant") AND !Auth::instance()->logged_in("technician"))
			$this->request->redirect("index");

		$view = View::factory('patientdiagnosism');
		$errors=array();
		$where='';
		$post=array();
		
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("index");
		
		$view->patient=$patient;
		
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);
		//if($treatmentcycle['refertodoctor']!=$this->user->id)
			//$this->request->redirect("index");

		$treatments=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		try
		{
			if(isset($_POST['submit']) AND count($treatments)>0):
				$me=Model::factory('technicianmd')->SelectByUser($this->user->id);
				foreach($treatments as $t):
				
					if($t['consultant']!=$me['id'])
						continue;
					
				  $id=$t['id'];
				  if(!isset($_POST["cost$id"]))
				  	continue;
				  
				  $post['patientid']=$patientid;
				  $post['date']=date("Y/m/j");
				  $post['diagnosis']=Html::chars($_POST['diagnosis'.$id]);
				  $post['userid']=$this->user->id;
				  $post['provider']=$t['provider'];
				  $post['treatmentcycle']=$treatmentcycle['id'];
				  $post['treatment']=$id;
				  $post['cost']=Html::chars($_POST['cost'.$id]);
				  $path="";
				  if(is_uploaded_file($_FILES["attachment$id"]["tmp_name"])):
					  if($path==""):
						  $gpid=Text::random('distinct',20).substr($_FILES["attachment$id"]["name"],'-5','5');
						  $path="media/document/$gpid";
					  endif;
					  move_uploaded_file($_FILES["attachment$id"]["tmp_name"],$path);
				   endif;
				    $post['attachment']=$path;
				   $this->model->save($post);	
				endforeach;
				
				Cookie::set('msg','yes');
				$this->request->redirect("patientdiagnosis/index/".$patientid);

			endif;

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
		
		$view->treatmentcycle=$treatmentcycle;
		$view->treatments=$treatments;
		$this->template->content = $view;
	}
	
	
	public function action_costing()
	{
		if(!Auth::instance()->logged_in("consultant") AND !Auth::instance()->logged_in("technician"))
			$this->request->redirect("index");

		$view = View::factory('patientdiagnosis_costing');
		$errors=array();
		$where='';
		$post=array();
		
		$patientid=$this->request->param("id");
		$patient=Model::factory('patientmd')->GetPatient($patientid);
		if(!is_array($patient))
			$this->request->redirect("index");
		
		$view->patient=$patient;
		
		$treatmentcycle=Model::factory('treatmentcyclemd')->getCurrent($patient['id']);
		if(!is_array($treatmentcycle))
			$this->request->redirect("treatmentcycle/index/".$patient['id']);

/*		if($treatmentcycle['refertodoctor']!=$this->user->id)
			$this->request->redirect("index");
*/
		$treatments=Model::factory('treatmentcyclemd')->GetTreatments($treatmentcycle['id']);
		try
		{
			if(isset($_POST['submit']) AND count($treatments)>0):
			
				foreach($treatments as $t):
				
				  $id=$t['id'];
					 
				  if(!isset($_POST["cost$id"]))
				  	continue;
					
				 
				  $post['treatment']=$id;
				  $post['date']=date("Y/m/j");
				  $post['userid']=$this->user->id;
				  $post['cost']=Html::chars($_POST['cost'.$id]);
				  $this->model->save_costing($post);
				  	
				endforeach;
				
				Cookie::set('msg','yes');
				$this->request->redirect("patientdiagnosis/costing/".$patientid);

			endif;

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
		
		$view->treatmentcycle=$treatmentcycle;
		$view->treatments=$treatments;
		$this->template->content = $view;
	}
}
?>

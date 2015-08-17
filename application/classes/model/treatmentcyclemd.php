<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_TreatmentCycleMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT tc.*,p.surname,p.othernames FROM `treatmentcycle` tc INNER JOIN patient p ON p.id=tc.patientid WHERE tc.elapsed='1' OR tc.proposedenddate=''";
		$treatmentcycles=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $treatmentcycles;
	}
	
	public function SelectAwaitingAuthCode($hmo)
	{
		$sql="SELECT tc.*,p.surname,p.othernames,pa.date as proposedenddate FROM `treatmentcycle` tc INNER JOIN patient p ON p.id=tc.patientid INNER JOIN patientapproval pa ON pa.treatmentcycleid=tc.id WHERE tc.elapsed='0' AND pa.authorisationcode='' AND p.hmoid='$hmo'";
		$treatmentcycles=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $treatmentcycles;
	}
	
	public function SelectById($id)
	{
		$sql="SELECT * FROM `treatmentcycle` WHERE id='$id'";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($treatmentcycle)>0)return $treatmentcycle[0];else return null;
	}
	
	public function getCurrent($patientid)
	{
		$sql="SELECT * FROM `treatmentcycle` WHERE patientid='$patientid' ORDER BY id DESC";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($treatmentcycle)>0)return $treatmentcycle[0];else return null;
	}
	
	public function GetTreatments($treatmentcycle)
	{
		$treatmentcycle=DB::query(Database::SELECT,"SELECT t.*,p.name as provider,c.names FROM treatment t INNER JOIN provider p ON p.id=t.provider INNER JOIN technician c ON c.id=t.consultant WHERE t.treatmentcycle='$treatmentcycle' ORDER BY t.id ASC")->execute($this->db_link)->as_array();
		return $treatmentcycle;
	}
	
	public function GetTreatment($id)
	{
		$treatmentcycle=DB::query(Database::SELECT,"SELECT t.*,p.name as provider FROM treatment t INNER JOIN provider p ON p.id=t.provider WHERE t.id='$id'")->execute($this->db_link)->as_array();
		if(count($treatmentcycle)>0)return $treatmentcycle[0];else return null;
	}
		
	public function SelectByPaging($status=null,$date,$start,$end)
	{
		$sql="SELECT p.*,tc.* FROM treatmentcycle tc INNER JOIN patient p ON p.id=tc.patientid WHERE tc.proposedenddate='$date'";
		if(isset($status))
			$sql.=" AND tc.elapsed='$status'";
		$sql.=" LIMIT $start,$end";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $treatmentcycle;
	}
	
	public function Count($status=null,$date)
	{
		$sql="SELECT count(tc.id) as total FROM treatmentcycle tc INNER JOIN patient p ON p.id=tc.patientid WHERE tc.proposedenddate='$date'";
		if(isset($status))
			$sql.=" AND tc.elapsed='$status'";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($treatmentcycle)>0)return $treatmentcycle[0]['total'];else return 0;
	}
	
	public function SearchByDate($from,$to,$start,$end,$hmo=null)
	{
		$sql="SELECT t.*,p.* FROM treatmentcycle t INNER JOIN patient p ON p.id=t.patientid WHERE t.proposedstartdate BETWEEN '$from' AND '$to'";
		if(isset($hmo) AND $hmo!=null)
			$sql.=" AND p.hmoid='$hmo'";
		$sql.=" LIMIT $start,$end";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $treatmentcycle;
	}
	
	public function CountByDate($from,$to,$hmo=null)
	{
		$sql="SELECT count(t.id) as total FROM treatmentcycle t INNER JOIN patient p ON p.id=t.patientid WHERE t.proposedstartdate BETWEEN '$from' AND '$to'";
		if(isset($hmo) AND $hmo!=null)
			$sql.=" AND p.hmoid='$hmo'";
		$treatmentcycle=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($treatmentcycle)>0)return $treatmentcycle[0]['total'];else return 0;
	}

	
	public function GetCompletedCycle($start,$end)
	{
		$sql="SELECT p.*,tc.id as treatmentcycleid FROM patient p INNER JOIN treatmentcycle tc ON p.id=tc.patientid WHERE tc.elapsed='1'";
		$sql.=" limit $start, $end";	
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}
	
	public function CountCompletedCycle()
	{
		$sql="SELECT count(p.id) as total FROM `patient` p INNER JOIN treatmentcycle tc ON p.id=tc.patientid WHERE tc.elapsed='1'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0]['total'];else return 0;
	}	

	public function GetTreatmentStatus($hmo,$from=null,$to=null)
	{
		$sql="SELECT p.*,tc.* FROM patient p INNER JOIN treatmentcycle tc ON p.id=tc.patientid INNER JOIN hmo h ON h.id=p.hmoid WHERE p.hmoid='$hmo'";
		if(isset($from) AND $from!="")
			$sql.=" AND tc.proposedstartdate >= '$from' AND tc.proposedstartdate <= '$to'";
			
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}	

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO treatmentcycle(patientid,proposedstartdate,proposedenddate,userid,approvalstatus,refferedclinic,investigationform,drugform,elapsed) VALUES(:patientid,:proposedstartdate,:proposedenddate,:userid,:approvalstatus,:refferedclinic,:investigationform,:drugform,:elapsed)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':proposedstartdate',$post['proposedstartdate']);
		$query->param(':proposedenddate',$post['proposedenddate']);
		$query->param(':userid',$post['userid']);
		$query->param(':approvalstatus',$post['approvalstatus']);
		$query->param(':refferedclinic',$post['refferedclinic']);
		$query->param(':investigationform',$post['investigationform']);
		$query->param(':drugform',$post['drugform']);
		$query->param(':elapsed',0);
		$query->execute($this->db_link);
	}

	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET investigationform=:investigationform,drugform=:drugform WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':investigationform',$post['investigationform']);
		$query->param(':drugform',$post['drugform']);
		$query->execute($this->db_link);
	}
	
	public function update_for_auth_code($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET proposedstartdate=:proposedstartdate,proposedenddate=:proposedenddate,userid=:userid,approvalstatus=:approvalstatus,refertodoctor=:refertodoctor,investigationform=:investigationform,drugform=:drugform WHERE id=:treatmentcycleid');
		$query->param(':treatmentcycleid',$post['treatmentcycleid']);
		$query->param(':proposedstartdate',$post['proposedstartdate']);
		$query->param(':proposedenddate',$post['proposedenddate']);
		$query->param(':userid',$post['userid']);
		$query->param(':approvalstatus',$post['approvalstatus']);
		$query->param(':refertodoctor',$post['refertodoctor']);
		$query->param(':investigationform',$post['investigationform']);
		$query->param(':drugform',$post['drugform']);
		$query->execute($this->db_link);
	}
	
	public function update_for_auth_code2($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET refertodoctor=:refertodoctor,proposedstartdate=:proposedstartdate,proposedenddate=:proposedenddate,userid=:userid,approvalstatus=:approvalstatus WHERE id=:id');
		$query->param(':id',$post['id']);
		$query->param(':proposedstartdate',$post['proposedstartdate']);
		$query->param(':proposedenddate',$post['proposedenddate']);
		$query->param(':refertodoctor',$post['refertodoctor']);
		$query->param(':userid',$post['userid']);
		$query->param(':approvalstatus',$post['approvalstatus']);
		$query->execute($this->db_link);
	}
	
	public function begin_new_cycle($patientid,$userid,$formno)
	{
		$post['date']=date("Y/m/j");
		$post['patientid']=$patientid;
		$post['userid']=$userid;
		$post['formno']=$formno;
		Model::factory('patientmd')->approve_for_sht($post);
	}
	
	public function set_elapse($patientid)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET elapsed=:elapsed WHERE patientid=:patientid ');
		$query->param(':patientid',$patientid);
		$query->param(':elapsed',true);
		$query->execute($this->db_link);
	}
	
	public function elapse_all()
	{
		$now=date("Y/m/j");
		$sql="UPDATE treatmentcycle SET elapsed='1' WHERE $now >= proposedenddate";
		$query=DB::query(Database::UPDATE,$sql);
		//$query->execute($this->db_link);
	}	
	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM treatmentcycle WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}
	
	public function delete_treatment($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM treatment WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}
	
	public function save_treatment($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO treatment(patientid,date,treatment,userid,treatmentcycle,provider,consultant) VALUES(:patientid,:date,:treatment,:userid,:treatmentcycle,:provider,:consultant)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':treatment',$post['treatment']);
		$query->param(':userid',$post['userid']);
		$query->param(':treatmentcycle',$post['treatmentcycle']);
		$query->param(':provider',$post['provider']);
		$query->param(':consultant',$post['consultant']);
		$query->execute($this->db_link);
	}


	public function update_treatment($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatment SET patientid=:patientid,date=:date,treatment=:treatment,userid=:userid,treatmentcycle=:treatmentcycle,provider=:provider WHERE id=:id ');
		$query->param(':id',$post['id']);
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':treatment',$post['treatment']);
		$query->param(':userid',$post['userid']);
		$query->param(':treatmentcycle',$post['treatmentcycle']);
		$query->param(':provider',$post['provider']);
		$query->execute($this->db_link);
	}
	
	public function update_others($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET nextappointment=:nextappointment,clicnicinformation=:clicnicinformation,complications=:complications,surgicaloperations=:surgicaloperations,indicationforsurgery2=:indicationforsurgery2,conditionondischarge=:conditionondischarge WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':conditionondischarge',$post['conditionondischarge']);
		$query->param(':indicationforsurgery2',$post['indicationforsurgery2']);
		$query->param(':surgicaloperations',$post['surgicaloperations']);
		$query->param(':complications',$post['complications']);
		$query->param(':clicnicinformation',$post['clicnicinformation']);
		$query->param(':nextappointment',$post['nextappointment']);
		
		$query->execute($this->db_link);
	}
}
?>

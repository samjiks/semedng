<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_PatientDiagnosisMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `patientdiagnosis`";
		$patientdiagnosiss=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patientdiagnosiss;
	}
	
	public function GetPaymentReport($hmo,$from=null,$to=null)
	{
		$sql="SELECT p.surname,p.othernames,sum(pd.cost) as cost FROM `patientdiagnosis` pd INNER JOIN patient p ON p.id=pd.patientid INNER JOIN hmo h ON h.id=p.hmoid INNER JOIN treatmentcycle tc ON tc.patientid=p.id WHERE tc.elapsed='1' AND h.id='$hmo'"; 
		if(isset($from))
			$sql.=" AND tc.proposedenddate BETWEEN '$from' AND '$to'";
			
		$sql.=" GROUP BY p.id";
		$patientdiagnosiss=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patientdiagnosiss;
	}	
	

	public function SelectById($id)
	{
		$sql="SELECT * FROM `patientdiagnosis` WHERE id='$id'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)return $patientdiagnosis[0];else return null;
	}
	
	public function SelectByTreatment($treatment)
	{
		$sql="SELECT * FROM `patientdiagnosis` WHERE treatment='$treatment'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)return $patientdiagnosis[0];else return null;
	}
	
	public function SelectByTreatmentCycle($cycle)
	{
		$sql="SELECT * FROM `patientdiagnosis` WHERE treatmentcycle='$cycle'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patientdiagnosis;
	}
	
	public function SumTotalBill($cycle)
	{
		$sql="SELECT sum(cost) as total FROM `patientdiagnosis` WHERE treatmentcycle='$cycle'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)return $patientdiagnosis[0]['total'];else	return 0;
	}
	
	public function IsCostAppended($cycle)
	{
		$sql="SELECT sum(cost) as total FROM `patientdiagnosis` WHERE treatmentcycle='$cycle'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)
		{
			return $patientdiagnosis[0]['total']>0?true:false;
		}
		return false;
	}
	
	public function SelectByPaging($start,$end)
	{
		$patientdiagnosis=DB::query(Database::SELECT,"SELECT * FROM patientdiagnosis limit $start, $end")->execute($this->db_link)->as_array();
		return $patientdiagnosis;
	}
	public function Count()
	{
		$sql="SELECT count(id) as total FROM `patientdiagnosis`";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)return $patientdiagnosis[0]['total'];else return 0;
	}

	public function save($post)
	{
		$treatment=$post['treatment'];
		$sql="SELECT * FROM `patientdiagnosis` WHERE treatment='$treatment'";
		$patientdiagnosis=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patientdiagnosis)>0)
		{
			if($post['attachment']=="")
				$post['attachment']=$patientdiagnosis[0]['attachment'];
				
			$this->update($post);
			return;
		}
		
		$query=DB::query(Database::INSERT,'INSERT INTO patientdiagnosis(patientid,date,diagnosis,userid,provider,treatmentcycle,attachment,treatment,cost) VALUES(:patientid,:date,:diagnosis,:userid,:provider,:treatmentcycle,:attachment,:treatment,:cost)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':diagnosis',$post['diagnosis']);
		$query->param(':userid',$post['userid']);
		$query->param(':provider',$post['provider']);
		$query->param(':treatmentcycle',$post['treatmentcycle']);
		$query->param(':attachment',$post['attachment']);
		$query->param(':treatment',$post['treatment']);
		$query->param(':cost',$post['cost']);
		$query->execute($this->db_link);
	}

	public function update($post,$attachment=null)
	{
		$query=DB::query(Database::UPDATE,'UPDATE patientdiagnosis SET patientid=:patientid,date=:date,diagnosis=:diagnosis,userid=:userid,provider=:provider,attachment=:attachment,treatmentcycle=:treatmentcycle,treatment=:treatment WHERE treatment=:treatment  ');
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':diagnosis',$post['diagnosis']);
		$query->param(':userid',$post['userid']);
		$query->param(':provider',$post['provider']);
		$query->param(':treatmentcycle',$post['treatmentcycle']);
		$query->param(':attachment',$post['attachment']);
		$query->param(':treatment',$post['treatment']);
		$query->param(':cost',$post['cost']);
		$query->execute($this->db_link);
	}
	
	public function save_costing($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE patientdiagnosis SET costingdate=:date,costinguserid=:userid,cost=:cost,locked=:locked WHERE treatment=:treatment');
		$query->param(':date',$post['date']);
		$query->param(':treatment',$post['treatment']);
		$query->param(':cost',$post['cost']);
		$query->param(':userid',$post['userid']);
		$query->param(':locked',1);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM patientdiagnosis WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}

}
?>

<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_PatientMD extends Model_CModel 
{
	public function SelectAll($hmo)
	{
		$sql="SELECT p.* FROM `patient` p WHERE p.hmoid='$hmo'";
		$patients=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patients;
	}
	
	public function SelectById($id)
	{
		$sql="SELECT * FROM `patient` WHERE id='$id'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0];else return null;
	}
	
	public function GetPatient($id,$hmo=null)
	{
		$sql="SELECT * FROM `patient` WHERE id='$id'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)
			return $patient[0];
		else
		{ 
			$sql="SELECT * FROM `patient` WHERE hospitalno='$id' AND hospitalno!=''";
			$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
			if(count($patient)>0)
				return $patient[0];
			else
			{
				$sql="SELECT * FROM `patient` WHERE nhisno='$id' AND nhisno!=''";
				$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
				if(count($patient)>0)
					return $patient[0];
				else
				{
					$sql="SELECT * FROM `patient` WHERE qrcode='$id' AND qrcode!=''";
					$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
					if(count($patient)>0)
						return $patient[0];
					else
					{
						$sql="SELECT * FROM `patient` WHERE hmono='$id' AND hmono!=''";
						$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
						if(count($patient)>0)
							return $patient[0];
					}

				}
			}
			return null;
		}
	}

	public function SelectByPaging($hmo=null,$start,$end)
	{
		$sql="SELECT p.*,h.name FROM patient p INNER JOIN hmo h ON h.id=p.hmoid WHERE p.id!=''";
		if(isset($hmo))
			$sql.=" AND h.id='$hmo'";
		$sql.=" limit $start, $end";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}
	
	public function Count($hmo=null)
	{
		$sql="SELECT count(p.id) as total FROM `patient` p INNER JOIN hmo h ON h.id=p.hmoid";
		if(isset($hmo))
			$sql.=" AND h.id='$hmo'";

		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0]['total'];else return 0;
	}
	
	public function GetApprovedPatient($status,$hmo=null,$start,$end)
	{
		$sql="SELECT p.*,h.name FROM patient p INNER JOIN hmo h ON h.id=p.hmoid INNER JOIN treatmentcycle tc ON tc.patientid=p.id WHERE tc.elapsed='0'";
		$sql.=" AND tc.approvalstatus='$status'";
		if(isset($hmo))
			$sql.=" AND h.id='$hmo'";
		$sql.=" limit $start, $end";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}
	
	public function CountApprovedPatient($status,$hmo=null)
	{
		$sql="SELECT count(p.id) as total FROM `patient` p INNER JOIN hmo h ON h.id=p.hmoid INNER JOIN treatmentcycle tc ON tc.patientid=p.id WHERE tc.elapsed='0'";
		$sql.=" AND tc.approvalstatus='$status'";
		if(isset($hmo))
			$sql.=" AND h.id='$hmo'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0]['total'];else return 0;
	}	
	
	public function Select4Consultant($co,$start,$end)
	{
		$sql="SELECT p.* FROM patient p INNER JOIN treatmentcycle tc ON tc.patientid=p.id INNER JOIN specialist sp ON sp.id=tc.refertodoctor WHERE sp.id='$co'";
		$sql.=" ORDER BY tc.id DESC limit $start, $end";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}
	
	public function Count4Consultant($co)
	{
		$sql="SELECT count(p.id) as total FROM `patient` p INNER JOIN treatmentcycle tc ON tc.patientid=p.id INNER JOIN specialist sp ON sp.id=tc.refertodoctor WHERE sp.id='$co'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0]['total'];else return 0;
	}
	
	
	public function Select4Technician($co,$start,$end)
	{
		$sql="SELECT p.* FROM patient p INNER JOIN treatmentcycle tc ON tc.patientid=p.id INNER JOIN treatment t ON t.treatmentcycle=tc.id WHERE t.consultant='$co'";
		$sql.=" ORDER BY tc.id DESC limit $start, $end";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $patient;
	}
	
	public function Count4Technician($co)
	{
		$sql="SELECT count(p.id) as total FROM `patient` p INNER JOIN treatmentcycle tc ON tc.patientid=p.id INNER JOIN treatment t ON t.treatmentcycle=tc.id WHERE tc.elapsed='0' AND t.consultant='$co'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0]['total'];else return 0;
	}

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO patient(hospitalno,qrcode,surname,othernames,gender,phoneno,email,address,nhisno,hmono,dob,hmoid) VALUES(:hospitalno,:qrcode,:surname,:othernames,:gender,:phoneno,:email,:address,:nhisno,:hmono,:dob,:hmoid)');				
		$query->param(':hospitalno',$post['hospitalno']);
		$query->param(':qrcode',$post['qrcode']);
		$query->param(':surname',$post['surname']);
		$query->param(':othernames',$post['othernames']);
		$query->param(':gender',$post['gender']);
		$query->param(':phoneno',$post['phoneno']);
		$query->param(':email',$post['email']);
		$query->param(':address',$post['address']);
		$query->param(':nhisno',$post['nhisno']);
		$query->param(':hmono',$post['hmono']);
		$query->param(':dob',$post['dob']);
		$query->param(':hmoid',$post['hmoid']);
		$query->execute($this->db_link);
		echo Kohana::debug((string)$query);
	}

	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE patient SET hmono=:hmono,hospitalno=:hospitalno,qrcode=:qrcode,surname=:surname,othernames=:othernames,gender=:gender,phoneno=:phoneno,email=:email,address=:address,nhisno=:nhisno,dob=:dob WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':hospitalno',$post['hospitalno']);
		$query->param(':qrcode',$post['qrcode']);
		$query->param(':surname',$post['surname']);
		$query->param(':othernames',$post['othernames']);
		$query->param(':gender',$post['gender']);
		$query->param(':phoneno',$post['phoneno']);
		$query->param(':email',$post['email']);
		$query->param(':address',$post['address']);
		$query->param(':nhisno',$post['nhisno']);
		$query->param(':hmono',$post['hmono']);
		$query->param(':dob',$post['dob']);
		$query->execute($this->db_link);
	}
	
	public function update_form($post,$pid)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET referringfrom=:referringfrom,referringto=:referringto,referringdoctor=:referringdoctor,clicnicinformation=:clicnicinformation,investigationform=:investigationform,indicationforsurgery=:indicationforsurgery,formno=:formno WHERE id=:id ');
		$query->param(':id',$pid);
		$query->param(':referringfrom',$post['referringfrom']);
		$query->param(':formno',$post['formno']);
		$query->param(':referringto',$post['referringto']);
		$query->param(':referringdoctor',$post['referringdoctor']);
		$query->param(':clicnicinformation',$post['clicnicinformation']);
		$query->param(':investigationform',$post['investigationform']);
		$query->param(':indicationforsurgery',$post['indicationforsurgery']);
		$query->execute($this->db_link);
	}
	
	public function update_consultant_form($post,$id)
	{
		$query=DB::query(Database::UPDATE,'UPDATE treatmentcycle SET dateseen=:dateseen,serviceprovider=:serviceprovider,presumptivediagnosis=:presumptivediagnosis,actiontaken=:actiontaken WHERE id=:id ');
		$query->param(':id',$id);
		$query->param(':dateseen',$post['dateseen']);
		$query->param(':serviceprovider',$post['serviceprovider']);
		$query->param(':presumptivediagnosis',$post['presumptivediagnosis']);
		$query->param(':actiontaken',$post['actiontaken']);
		$query->execute($this->db_link);
	}
	
	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM patient WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}
	
	public function approve_for_sht($post)
	{
		$aid= $this->save_treatment_cycle($post);
		$query=DB::query(Database::INSERT,'INSERT INTO patientapproval(userid,treatmentcycleid,date) VALUES(:userid,:treatmentcycleid,:date)');				
		$query->param(':userid',$post['userid']);
		$query->param(':treatmentcycleid',$aid);
		$query->param(':date',$post['date']);
		$obj=$query->execute($this->db_link);

		return $aid;
	}
	
	public function update_authorisation_code($code,$treatmentcycleid)
	{
		$query=DB::query(Database::UPDATE,'UPDATE patientapproval SET authorisationcode=:authorisationcode WHERE treatmentcycleid=:treatmentcycleid ');
		$query->param(':treatmentcycleid',$treatmentcycleid);
		$query->param(':authorisationcode',$code);
		$query->execute($this->db_link);
	}
		
	private function save_treatment_cycle($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO treatmentcycle(patientid,proposedenddate) VALUES(:patientid,:proposedenddate)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':proposedenddate','');
		//$query->param(':approvalstatus','Approved');
		$obj=$query->execute($this->db_link);
		return $obj[0];
	}
	
	public function GetApproval($patientid,$authorisationcode=null)
	{
		$sql="SELECT pa.*,tc.*,pa.id as approvalid FROM `patientapproval` pa INNER JOIN treatmentcycle tc ON tc.id=pa.treatmentcycleid WHERE tc.patientid='$patientid'";
		if(isset($authorisationcode))
			$sql.=" AND pa.authorisationcode='$authorisationcode'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0];else return null;
	}
	
	public function GetApprovalById($appid)
	{
		$sql="SELECT pa.*,tc.*,pa.id as approvalid FROM `patientapproval` pa INNER JOIN treatmentcycle tc ON tc.id=pa.treatmentcycleid WHERE tc.id='$appid'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0];else return null;
	}

	public function confirm_code($authorisationcode)
	{
		$sql="SELECT pa.* FROM `patientapproval` pa WHERE pa.authorisationcode='$authorisationcode'";
		$patient=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($patient)>0)return $patient[0];else return null;
	}
	
	public function generate_id($length,$alp)
	{
		$no="";
        $PASS_LEN =$alp?$length-2:$length; 
		$LEVEL1_LEN = 2;  // Number of level 1 characters (1-9)
		$LEVEL2_LEN = 2;  // Number of level 2 characters (any other)
		
		$LEVEL1 = "abcdefghijklmnpqrstuvwxyz";  // no security
		$LEVEL0 = '123456789';                  // better security
		
		for ($i=0;$i<$PASS_LEN;$i++)
		{		
			$seed=rand(0,9);
			$no.=$seed;
		}
		
		if($alp)
		{
			for ($i=0;$i<2;$i++)
			{
				$no.= strtoupper($LEVEL1{rand(0,strlen($LEVEL1)-1)});
			}
		}
		return $no;	
	}
}
?>

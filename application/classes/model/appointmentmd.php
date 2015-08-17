<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_AppointmentMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `appointment`";
		$appointments=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $appointments;
	}
	public function SelectById($id)
	{
		$sql="SELECT * FROM `appointment` WHERE id='$id'";
		$appointment=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($appointment)>0)return $appointment[0];else return null;
	}
	public function SelectByPaging($start,$end)
	{
		$appointment=DB::query(Database::SELECT,"SELECT * FROM appointment limit $start, $end")->execute($this->db_link)->as_array();
		return $appointment;
	}
	public function Count()
	{
		$sql="SELECT count(id) as total FROM `appointment`";
		$appointment=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($appointment)>0)return $appointment[0]['total'];else return 0;
	}

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO appointment(patientid,doctorid,date) VALUES(:patientid,:doctorid,:date)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':doctorid',$post['doctorid']);
		$query->param(':date',$post['date']);
		$query->execute($this->db_link);
	}


	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE appointment SET id=:id,patientid=:patientid,doctorid=:doctorid,date=:date WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':patientid',$post['patientid']);
		$query->param(':doctorid',$post['doctorid']);
		$query->param(':date',$post['date']);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM appointment WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}

}
?>

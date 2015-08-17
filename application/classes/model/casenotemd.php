<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_CaseNoteMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `casenote`";
		$casenotes=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $casenotes;
	}
	public function SelectById($id)
	{
		$sql="SELECT * FROM `casenote` WHERE id='$id'";
		$casenote=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($casenote)>0)return $casenote[0];else return null;
	}
	public function SelectByPaging($start,$end)
	{
		$casenote=DB::query(Database::SELECT,"SELECT * FROM casenote limit $start, $end")->execute($this->db_link)->as_array();
		return $casenote;
	}
	public function Count()
	{
		$sql="SELECT count(id) as total FROM `casenote`";
		$casenote=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($casenote)>0)return $casenote[0]['total'];else return 0;
	}

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO casenote(patientid,date,doctorid,note,attachment) VALUES(:patientid,:date,:doctorid,:note,:attachment)');				
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':doctorid',$post['doctorid']);
		$query->param(':note',$post['note']);
		$query->param(':attachment',$post['attachment']);
		$query->execute($this->db_link);
	}


	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE casenote SET id=:id,patientid=:patientid,date=:date,doctorid=:doctorid,note=:note,attachment=:attachment WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':patientid',$post['patientid']);
		$query->param(':date',$post['date']);
		$query->param(':doctorid',$post['doctorid']);
		$query->param(':note',$post['note']);
		$query->param(':attachment',$post['attachment']);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM casenote WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}

}
?>

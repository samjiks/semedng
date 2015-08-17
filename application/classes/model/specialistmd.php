<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_SpecialistMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT s.*,u.id as userid FROM `specialist` s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid";
		$specialists=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $specialists;
	}
	
	public function SelectByUnit($unit)
	{
		$sql="SELECT s.*,u.id as userid FROM `specialist` s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid WHERE s.unit='$unit'";
		$specialists=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $specialists;
	}
	
	public function SelectById($id)
	{
		$sql="SELECT s.*,u.firstname,u.middlename,u.lastname,u.id as userid,u.email FROM specialist s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid WHERE s.id='$id'";
		$specialist=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($specialist)>0)return $specialist[0];else return null;
	}
	
	public function SelectByUser($userid)
	{
		$sql="SELECT s.*,u.firstname,u.middlename,u.lastname,u.id as userid FROM specialist s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid WHERE u.id='$userid'";
		$specialist=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($specialist)>0)return $specialist[0];else return null;
	}	
	public function SelectByPaging($start,$end)
	{
		$sql="SELECT s.* FROM specialist s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid ORDER BY s.names ASC limit $start, $end";
		$specialist=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $specialist;
	}
	
	public function Count()
	{
		$sql="SELECT count(s.id) as total FROM `specialist` s INNER JOIN consultant_user cu ON cu.cid=s.id INNER JOIN users u ON u.id=cu.userid";
		$specialist=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($specialist)>0)return $specialist[0]['total'];else return 0;
	}

	public function save($post,$userid)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO specialist(names,unit) VALUES(:names,:unit)');				
		$query->param(':names',$post['names']);
		$query->param(':unit',$post['unit']);
		$obj=$query->execute($this->db_link);
		
		$sid=$obj[0];
		$query=DB::query(Database::INSERT,"INSERT INTO consultant_user(userid,cid) VALUES('$userid','$sid')");
		$obj=$query->execute($this->db_link);

	}

	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE specialist SET names=:names,unit=:unit WHERE id=:id');
		$query->param(':id',$post['id']);
		$query->param(':names',$post['names']);
		$query->param(':unit',$post['unit']);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM specialist WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}

}
?>

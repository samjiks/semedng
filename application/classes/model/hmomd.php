<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_HMOMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `hmo`";
		$hmos=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $hmos;
	}
	
	public function SelectById($id)
	{
		$sql="SELECT *,u.id as userid FROM hmo hm INNER JOIN hmo_user hu ON hu.hmoid=hm.id INNER JOIN users u ON u.id=hu.userid WHERE hm.id='$id'";
		$hmo=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($hmo)>0)return $hmo[0];else return null;
	}
	
	public function SelectByPaging($start,$end)
	{
		$hmo=DB::query(Database::SELECT,"SELECT hm.*,u.*,hm.id as hmid FROM hmo hm INNER JOIN hmo_user hu ON hu.hmoid=hm.id INNER JOIN users u ON u.id=hu.userid ORDER BY hm.name ASC limit $start, $end")->execute($this->db_link)->as_array();
		return $hmo;
	}
	
	public function Count()
	{
		$sql="SELECT count(u.id) as total FROM hmo hm INNER JOIN hmo_user hu ON hu.hmoid=hm.id INNER JOIN users u ON u.id=hu.userid";
		$hmo=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($hmo)>0)return $hmo[0]['total'];else return 0;
	}

	public function save($post,$userid)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO hmo(name,address,phoneno,mobile) VALUES(:name,:address,:phoneno,:mobile)');				
		$query->param(':name',$post['name']);
		$query->param(':address',$post['address']);
		$query->param(':phoneno',$post['phoneno']);
		$query->param(':mobile',$post['mobile']);
		$obj=$query->execute($this->db_link);
		$hmoid=$obj[0];
		
		$query=DB::query(Database::INSERT,"INSERT INTO hmo_user(userid,hmoid) VALUES('$userid','$hmoid')");
		$obj=$query->execute($this->db_link);
	}

	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE hmo SET name=:name,address=:address,phoneno=:phoneno,mobile=:mobile WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':name',$post['name']);
		$query->param(':address',$post['address']);
		$query->param(':phoneno',$post['phoneno']);
		$query->param(':mobile',$post['mobile']);
		$query->execute($this->db_link);
		
		$post['id']=$post['userid'];
		Model::factory('usermd')->updateinfo($post);
	}
	
	public function change_staus($id)
	{
		$hmo=$this->get_hmo_by_user($id); 
		if(!is_array($hmo))
			return;
		$status=$hmo['status']=="active"?"disabled":"active";
		$sql="UPDATE users SET status='$status' WHERE id='$id'";
		$query=DB::query(Database::UPDATE,$sql);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM hmo WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}
	
	public function get_hmo_by_user($userid)
	{
		$sql="SELECT hm.*,u.*,hm.id as hmid FROM hmo hm INNER JOIN hmo_user hu ON hu.hmoid=hm.id INNER JOIN users u ON u.id=hu.userid WHERE u.id='$userid'";
		$hmo=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($hmo)>0)return $hmo[0];else return null;
	}

}
?>

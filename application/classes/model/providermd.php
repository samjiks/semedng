<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_ProviderMD extends Model_CModel 
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `provider` ORDER BY name ASC";
		$providers=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $providers;
	}
	public function SelectById($id)
	{
		$sql="SELECT * FROM `provider` WHERE id='$id'";
		$provider=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($provider)>0)return $provider[0];else return null;
	}
	public function SelectByPaging($start,$end)
	{
		$provider=DB::query(Database::SELECT,"SELECT * FROM provider order by name asc limit $start, $end")->execute($this->db_link)->as_array();
		return $provider;
	}
	public function Count()
	{
		$sql="SELECT count(id) as total FROM `provider`";
		$provider=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($provider)>0)return $provider[0]['total'];else return 0;
	}

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO provider(name) VALUES(:name)');				
		$query->param(':name',$post['name']);
		$query->execute($this->db_link);
	}


	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE provider SET id=:id,name=:name WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':name',$post['name']);
		$query->execute($this->db_link);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,"DELETE FROM provider WHERE id=:id");
		$query->param(':id',$id);
		$query->execute($this->db_link);
	}

}
?>

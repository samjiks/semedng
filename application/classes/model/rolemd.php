<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_RoleMD extends Model_CModel 
{
	public static function SelectAll()
	{
		$roles=DB::select()->from('role')->execute(self::$db)->as_array();
		return $roles;
	}
	public static function SelectById($id)
	{
		$role=DB::select()->from('role')->where('id','=',$id)->execute(self::$db)->as_array();
		if(isset($role))return $role[0];else return null;
	}
	public static function SelectByPaging($start,$end)
	{
		$role=DB::query(Database::SELECT,"SELECT * FROM role limit $start, $end")->execute(self::$db)->as_array();
		return $role;
	}
	public static function Count()
	{
		$total= DB::select(array(DB::expr('COUNT(id)'), 'total'))->from('role')->execute(self::$db)->get('total');
		return $total;
	}
	public static function SearchByParam($param,$op,$value,$start,$end)
	{
		if($op!="like"):
			$sql="SELECT * FROM `role` WHERE `$param` $op '$value' limit $start, $end";
		else: $sql="SELECT * FROM `role` WHERE `$param` like '%$value' limit $start, $end";
		endif;
		$role=DB::query(Database::SELECT,$sql)->execute(self::$db)->as_array();
		return $role;
	}
	public static function CountByParam($param,$op,$value)
	{
		if($op!="like"):
			$sql="SELECT count(*) as total FROM `role` WHERE `$param` $op '$value'";
		else: $sql="SELECT count(*) as total FROM `role` WHERE `$param` like '%$value'";
		endif;
		$role=DB::query(Database::SELECT,$sql)->execute(self::$db)->as_array();
		if(isset($role))return $role[0]['total'];else return 0;
	}

	public function save($post)
	{
		$query=DB::query(Database::INSERT,'INSERT INTO role(id,name,description) VALUES(:id,:name,:description)');				
		$query->param(':id',$post['id']);
		$query->param(':name',$post['name']);
		$query->param(':description',$post['description']);
		$query->execute(self::$db);
	}


	public function update($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE role SET id=:id,name=:name,description=:description WHERE id=:id  ');
		$query->param(':id',$post['id']);
		$query->param(':name',$post['name']);
		$query->param(':description',$post['description']);
		$query->execute(self::$db);
	}

	public function delete($id)
	{
		$query=DB::query(Database::DELETE,'DELETE FROM role WHERE id=:id');
		$query->param(':id',$id);
		$query->execute(self::$db);
	}

}
?>

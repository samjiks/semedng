<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Model_UserMD extends Model_CModel
{
	public function SelectAll()
	{
		$sql="SELECT * FROM `users`";
		$users=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $users;
	}

	public function SelectById($id)
	{
		$sql="SELECT * FROM `users` WHERE id='$id'";
		$user=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($user)>0)return $user[0];else return null;
	}

	public function SelectByUsername($username)
	{  
	

		$sql="SELECT * FROM `users` WHERE username='$username'";
		$user=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		echo $sql;
		if ( count( $user ) > 0 ) {
		echo "FOUND";
			return $user[0];
	}
		else { 
			return null;
		}
	exit;
	}

	public function SelectByPaging($start,$end)
	{
		$sql="SELECT u.*,r.name as role FROM users u INNER JOIN roles_users ur ON ur.user_id=u.id INNER JOIN roles r ON r.id=ur.role_id WHERE r.name!='login' limit $start, $end";
		$user=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		return $user;
	}
	
	public function Count()
	{
		$sql="SELECT count(u.id) as total FROM users u ";
		$user=DB::query(Database::SELECT,$sql)->execute($this->db_link)->as_array();
		if(count($user)>0)return $user[0]['total'];else return 0;
	}

	public function save($post ,$role="login")
	{
		if(ORM::factory('user',array('email' => $post['email']))->loaded())
			throw new Exception('Somebody with the email address has already exist');
		if(ORM::factory('user',array('username' => $post['username']))->loaded())
			throw new Exception('Somebody with the username has already registered');

		
		$user=ORM::factory('user');
		$user->values($post);
		$user->save();
		$post['userid']=$user->id;
		
		
		$user=ORM::factory('user',array('email'=>$user->email));
		if($role!='login')
			$user->add('roles',ORM::factory('role',array('name'=>$role)));
		$user->add('roles',ORM::factory('role',array('name'=>'login')));
		$user->save();
		return $user;
	}
	public function change_password($password,$id)
	{
		$user=ORM::factory('user',$id);echo $id;
		$user->password=$password;
		$user->save();
		return $user->saved();
	}
	public function add_role($role,$id)
	{
		$user=ORM::factory('user',$id);
		$user->add('roles',ORM::factory('role',array('name'=>$role)));
		$user->save();
		return $user;
	}
	public function remove_role($role,$id)
	{
		$user=ORM::factory('user',$id);
		$user->remove('roles',ORM::factory('role',array('name'=>$role)));
		$user->save();
		return $user;
	}
	public function change_role($from,$to,$id)
	{
		$user=ORM::factory('user',$id);
		$user->remove('roles',ORM::factory('role',array('name'=>$from)));
		$user->add('roles',ORM::factory('role',array('name'=>$to)));
		$user->save();
		return $user;
	}
	
	public function delete($id)
	{
		ORM::factory('user',$id)->delete();
	}

	
	public function updateinfo($post)
	{
		$query=DB::query(Database::UPDATE,'UPDATE users SET firstname=:firstname,middlename=:middlename,lastname=:lastname,email=:email,phoneno=:phoneno WHERE id=:id  ');
		$query->param(':firstname',$post['firstname']);
		$query->param(':middlename',$post['middlename']);
		$query->param(':lastname',$post['lastname']);
		$query->param(':email',$post['email']);
		$query->param(':phoneno',$post['phoneno']);
		$query->param(':id',$post['id']);
		$query->execute($this->db_link);
	}
}
?>

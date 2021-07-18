<?php
class Admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	public function check_old_user_password($email,$password)
	{
		$this->db->select("u.username");
        $this->db->from('users as u');
		$this->db->where(array('u.user_email'=>$email,'u.password'=>sha1($password)));
        $result = $this->db->get()->row();
		if(isset($result) && !empty($result))
		{
			return true;
		}
		else{
			return false;
		}
		
	}
	
	public function update_new_password($email,$data)
	{
		$this->db->where('username', $email);  
		$this->db->update('users',$data);
		return true;
	}
	public function get_user_by_id($id)
	{
		$this->db->select("*");
        $this->db->from('users');
		$this->db->where('id',$id);
        $result = $this->db->get()->row();
		return $result;
	}
	public function update_profile($data,$id)
	{
	
		$this->db->where('id', $id);  
		$this->db->update('users',$data);
		return true;
	}
	
	

} //  end class 



?>

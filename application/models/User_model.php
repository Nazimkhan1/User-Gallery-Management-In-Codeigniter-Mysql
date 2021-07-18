<?php
class User_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	public function save_user($data)
	{
		if(empty($data['id']))
		{
			$this->db->insert('deans',$data);
			$last_insert_id = $this->db->insert_id();
			return $last_insert_id;
		}
		else{
			$this->db->where('id', $data['id']);  
			$this->db->update('deans',$data);
			return true;
		}
	}
	public function get_users()
	{
		$this->db->select("d.id,d.dean_username,d.dean_type,d.dean_name,d.dean_email,d.dean_contact_number");
		$this->db->from("deans d");
		$result=$this->db->get()->result();
		return $result;
	}
	public function get_user_by_id($id)
	{
		$this->db->select("d.id,d.dean_username,d.dean_type,d.dean_name,d.dean_email,d.dean_contact_number");
		$this->db->from("deans d");
		$this->db->where("id",$id);
		$result=$this->db->get()->row();
		return $result;
	}
	public function delete_user_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('deans');
		return true;
	}
	
	
} //  end class 



?>

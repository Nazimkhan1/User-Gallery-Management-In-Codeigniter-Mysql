<?php
class Category_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	public function save_category($data)
	{
		if(empty($data['id']))
		{
			$this->db->insert('categories',$data);
			$last_insert_id = $this->db->insert_id();
			return $last_insert_id;
		}
		else{
			$this->db->where('id', $data['id']);  
			$this->db->update('categories',$data);
			return true;
		}
	}
	public function get_category()
	{
		$this->db->select("c.*");
		$this->db->from("categories c");
		$result=$this->db->get()->result();
		return $result;
	}
	public function get_category_by_id($id)
	{
		$this->db->select("c.*");
		$this->db->from("categories c");
		$this->db->where("id",$id);
		$result=$this->db->get()->row();
		return $result;
	}
	public function delete_category_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('categories');
		return true;
	}

	
	

} //  end class 



?>

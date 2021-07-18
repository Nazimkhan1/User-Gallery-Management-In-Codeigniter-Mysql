<?php
class Article_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	public function get_random_articles()
	{
		$this->db->select("*");
		$this->db->order_by('rand()');
		$this->db->limit(5);
		$query = $this->db->get('articles');
	    $result=$query->result();
		return $result;
	}
	public function save_article($data)
	{
		
		if(empty($data['id']))
		{
			$this->db->insert('articles',$data);
			$last_insert_id = $this->db->insert_id();
			return $last_insert_id;
		}
		else{
			$this->db->where('id', $data['id']);  
			$this->db->update('articles',$data);
			return true;
		}
	}
	public function get_category()
	{
		$this->db->select("a.*,c.category_name,c.category_detail");
		$this->db->from("categories c");
		$result=$this->db->get()->result();
		return $result;
	}
	public function get_article()
	{
		$this->db->select("a.*,c.category_name,c.category_detail");
		$this->db->from("articles a");
		$this->db->join('categories c', 'c.id = a.category_id', 'LEFT');
		$result=$this->db->get()->result();
		return $result;
	}
	public function get_article_by_id($id)
	{
		$this->db->select("a.*,c.id as cat_id,c.category_name,c.category_detail");
		$this->db->from("articles a");
		$this->db->join('categories c', 'c.id = a.category_id', 'INNER');
		$this->db->where("a.id",$id);
		$result=$this->db->get()->row();
		return $result;
	}

	
	public function delete_article_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('articles');
		return true;
	}


// front end functions

	public function get_articles_by_category($category_id)
	{
		$this->db->select("c.*");
		$this->db->from("articles c");
		$this->db->where("c.category_id",$category_id);
		$result=$this->db->get()->result();
		return $result;
	}
	
	public function get_articles_ajax($limit,$start,$article_id,$category_id)
	{
		$this->db->select("a.*");
        $this->db->from('article_lists as a');
        $this->db->where(array('a.article_id'=>$article_id,'a.category_id'=>$category_id));
		$this->db->limit($limit, $start);
		$this->db->order_by("a.id", "ASC");
        $result = $this->db->get()->result();
		return $result;
	}
	public function get_service_details($id)
	{
		$this->db->select("c.*");
		$this->db->from("article_lists c");
		$this->db->where("c.id",$id);
		$result=$this->db->get()->row();
		return $result;
	}
	public function service_details($id)
	{
		$this->db->select("c.*");
		$this->db->from("services c");
		$this->db->where("c.id",$id);
		$result=$this->db->get()->row();
		return $result;
	}
	
	

} //  end class 



?>

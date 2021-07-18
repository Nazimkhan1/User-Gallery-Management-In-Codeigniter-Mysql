<?php
class Common extends CI_Model {

	public function __construct() {
		parent::__construct();
		
	}
	    public function SelectResult($select,$from,$where)
		{
			//echo "hello"; exit;
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$result= $this->db->get()->result();
			return $result;
		}
		 public function SelectRow($select,$from,$where)
		{
			$this->db->select($select);
			$this->db->from($from);
			$this->db->where($where);
			$result= $this->db->get()->row();
			return $result;
		}
		public function DeleteRow($from,$where)
		{
			$this->db->where($where);  
			$this->db->delete($from);
			return true;
		}
		
		public function StatusRow($from,$where,$fields)
		{
			$this->db->where($where);  
			$this->db->update($from,$fields);
			return true;
		}
	public function delete_row_by_id($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('events');
		return true;
	}
		function Insert($table,$data){
		  
				
				
				if($table == ""){
		  
					return "Table not specified";
		  
				}
				if(empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
					return "No data is available to be processed";
				}
				
				$result = $this->db->insert($table,$data);  
				
				if($result){
				  
					return  $this->db->insert_id();  
				}else{
				  
					return $result;	  
				  
				} 
		}
		public function InsertArray($table,$data){
	
			if(empty($table) ||  empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
		
				return 'check parameters';
			}
			else{
				$this->db = $this->load->database('consumer', TRUE);
		
				$sql_query= $this->db->insert_batch($table ,$data);
				if($sql_query){
			
					return true;
				}
				else{
			
					return false;
				}
			}
		}
  
		function Update($table,$data,$where){
			
			if($table == ""){
				return "Table not specified";
			}
			if(empty($data) || (!is_array($data)) || (sizeof($data) < 1)){
				return "No data is available to be processed";
			}
			if(empty($where) || (!is_array($where)) || (sizeof($where) < 1)){
				return "No condition specified";
			}
	
			foreach($where as $key=>$val){
		
				$this->db->where($key, $val);	
		
			}	
			return $this->db->update($table, $data);
	 
		}
  
    
		public function FetchSingleRow($table, $field, $id){
		
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($field, $id);
			$query=$this->db->get();
			$result=$query->row_array();
			return $result;
		}
		
		
		public function getAllData($table,$field, $id)
		{
		
			
			
			$this->db->select('*');
			$this->db->where($field, $id);
			$query=$this->db->get($table);
			
			return $query->result_array();
		}
	
		public function FetchAllRow($table){
		
			
			
			$this->consumer_db->select('*');
			$query=$this->consumer_db->get($table);
			//return $query->result();
			return $query->result_array();
		}
	
		public function FetchAllRowById($table, $field, $id){
		
			
			
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($field, $id);
			$query=$this->db->get();
			$result=$query->result();
			return $result;
		}
	
	
		public function GetCount($table)
		{
			
			$this->consumer_db->select('*');
			$query=$this->consumer_db->get($table);
			return $query->num_rows();
		}
	
		public function GetLastRow($table)
		{
			$this->consumer_db->select('*');
			$query=$this->consumer_db->get($table);
			$query->last_row();
			
		}
		
		public function IndianDate($dt)
		{
			return date("d-m-Y", strtotime($dt));
		}

} //  end class 



?>

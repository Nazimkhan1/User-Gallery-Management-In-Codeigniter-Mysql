<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->model("Common");
		$this->load->model("Article_model");
    }
    public function index()
	{
		    $select ='*'; $from='categories'; $where = array('status'=>1);
		    $data['categories'] = $this->Common->SelectResult($select,$from,$where);
		    $data['articles'] = $this->Article_model->get_random_articles();
			//print_r($data['articles']); exit;
			$this->load->view('web/helpers/header_view');
		    $this->load->view('web/index_view',$data);
		    $this->load->view('web/helpers/footer_view');
		   
	}
	
	public function view_gallery($id)
	{
		   $select ='*'; $from='categories'; $where = array('status'=>1);
		   $data['categories'] = $this->Common->SelectResult($select,$from,$where);
		   
		   $select ='*'; $from='articles'; $where = array('status'=>1,'category_id'=>$id);
		   $data['articles'] = $this->Common->SelectResult($select,$from,$where);
			
			
			$select ='id,category_name'; $from='categories'; $where = array('status'=>1,'id'=>$id);
			$data['cat_row'] = $this->Common->SelectRow($select,$from,$where);
		    
		   
		    $this->load->view('web/helpers/header_view');
		    $this->load->view('web/gallery_view',$data);
		    $this->load->view('web/helpers/footer_view');
	}
	
	public function article_details($category_id,$article_id)
	{
		    $select ='*'; $from='categories'; $where = array('status'=>1);
		    $data['categories'] = $this->Common->SelectResult($select,$from,$where);
		    $select ='*'; $from='articles'; $where = array('status'=>1,'id'=>$article_id,'category_id'=>$category_id);
	        $data['detail'] = $this->Common->SelectRow($select,$from,$where);
			$this->load->view('web/helpers/header_view');
		    $this->load->view('web/article_details_view',$data);
		    $this->load->view('web/helpers/footer_view');
		   
	}
}
